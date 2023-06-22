@extends('admin.template.main')
 
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Kuota </h1>

    
    <div class="my-3 text-right">
        <a href="" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#ModalTambahKuota">
            <span class="icon text-white-50">
                <i class="fas fa-calendar-plus"></i>
            </span>
            <span class="text">Tambah Kuota</span>
        </a>
        <a href="" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#modalImport">
            <span class="icon text-white-50">
                <i class="fas fa-file-excel"></i>
            </span>
            <span class="text">Import Kuota</span>
        </a>
        <form class="d-inline" action="/dashboard/kuota/hapus/{{ request()->jalur }}" method="post">
            @csrf
        <button type="submit" class="btn btn-danger btn-icon-split " onclick="return confirm('Hapus semua Kuota expired {{request()->jalur}} ?')">
            <span class="icon text-white-50">
                <i class="fas fa-trash-alt"></i>
            </span>
            <span class="text">Kuota Expired {{ request()->jalur }}</span>
        </button>
        </form>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jalur Pendakian {{ request()->jalur }} </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jalur</th>
                            <th>Tanggal</th>
                            <th>Kuota Tersisa</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    @foreach ($kuotas as $kuota)
                        
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ request()->jalur }}</td>
                            <td>{{ $kuota[0]->tanggal }}</td>
                            @if ($kuota[0]->tanggal < $today)
                            <td><p class="btn btn-secondary btn-sm" >Kuota Expired</p></td>
                            @else
                            <td>{{ collect($kuota)->sum('jumlah_kuota') }}</td>
                            @endif
                            <td>
                                <form action="kuota/{{ $kuota[0]->tanggal.$kuota[0]->jalur }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                <button type="submit" class="btn btn-danger btn-circle" onclick="return confirm('Hapus Kuota {{request()->jalur}} tanggal {{$kuota[0]->tanggal}}  ?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            </td>
                        </tr>
                    </tbody>

                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah Kuota -->
  <div class="modal fade" id="ModalTambahKuota" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah Kuota</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/kuota" method="post">
                    @csrf
                    <div>
                        <label for="jalur" class="form-label mr-3">Jalur Pendakian :</label>
                        <select class="form-select" aria-label="Default select example" id="jalur" name="jalur" required>
                            <option value="">Pilih Jalur</option>
                            <option value="Palutungan">Palutungan</option>
                            <option value="Linggarjati">Linggarjati</option>
                            <option value="Linggasana">Linggasana</option>
                            <option value="Apuy">Apuy</option>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_kuota" class="form-label">Jumlah Kuota :</label>
                        <input type="number" class="form-control" id="jumlah_kuota" name="jumlah_kuota"   required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal :</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"  required>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
            </div>
        
        </div>
    </div>
</div>

<!-- Modal import kuota -->
<div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Import Data Kuota</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/kuota/import" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Masukan File (.csv / .xlsx / .xls)</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required> 
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection