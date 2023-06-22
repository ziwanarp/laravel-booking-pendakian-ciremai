@extends('admin.template.main')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Halaman Orders</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Order</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode Order</th>
                            <th>Jalur</th>
                            <th>Tanggal Naik</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    @foreach ($orders as $item)
                        
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td><a href="?kode_order={{ $item->kode_order }}">{{ $item->kode_order }}</a></td>
                            <td>{{ $item->kuota->jalur }}</td>
                            <td>{{ $item->tanggal_naik }}</td>
                            <td>Rp.{{ number_format($item->harga, 0, ".", ".") }}</td>
                            @if ($item->status == 'Konfirmasi')
                            <td><p class="btn btn-success">{{ $item->status }}</p></td>
                            @elseif ($item->status == 'Tolak')
                            <td><p class="btn btn-danger">{{ $item->status }}</p></td>
                            @else
                            <td>
                                <a href="?confirm={{ $item->id }}" class=" mx-2 btn btn-success btn-circle">
                                <i class="fas fa-check-circle"></i>
                                <a href="?tolak={{ $item->id }}" class="btn btn-danger btn-circle">
                                <i class="fas fa-times-circle"></i>
                            </td>
                            @endif 
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>

 

@endsection