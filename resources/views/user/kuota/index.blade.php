



@extends('user.template.main')

@section('container')

@if ($kuota->count())
    <div class="hero hero-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-10 mx-auto text-center">
          <div class="intro-wrap">
            <h2 class="mb-3 text-white">Kuota Tersedia</h2>
            <table class="table table-striped text-white">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Jalur</th>
                    <th scope="col">Tanggal Naik</th>
                    <th scope="col">Kuota Tersisa</th>
                    <th scope="col">Booking</th>
                  </tr>
                </thead>
                @foreach ($kuota->groupBy('jalur','tanggal') as $k)
                    <tbody>
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->first()->jalur }}</td>
                    <td>{{ $k->first()->tanggal }}</td>
                    <td>{{ collect($kuota)->sum('jumlah_kuota') }}</td>
                    @auth
                      <td><a href="/order?kuota={{ $k->first()->id }}" class="btn-warning btn-sm" >Booking</a></td>
                    @else
                        <td><a href="" data-toggle="modal" data-target="#ModalLogin" class="btn-warning btn-sm" >Login Untuk Booking</a></td>
                    @endauth
                  </tr>
                </tbody>
                @endforeach
              </table>
          </div>
          
          

          <div class="text-left">
            <a href="/"  class="btn btn-primary" >Kembali</a>
            <a href=""  class="btn btn-danger " data-toggle="modal" data-target="#ModalCekKuota" >Cek Kuota / Bulan</a>
            <a href=""  class="btn btn-danger " data-toggle="modal" data-target="#ModalCekKuotaPerJalur" >Cek Kuota / Jalur</a>
        </div>
        </div>
      </div>
    </div>
  </div>

@else

  <div class="hero hero-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-10 mx-auto text-center">
          <div class="intro-wrap">
            <h1 class="mb-3 text-white">Kuota Tidak Tersedia </h1>
          </div>
          <div class="text-center mt-3">
            <a href="/"  class="btn btn-primary" >Kembali</a>
            <a href=""  class="btn btn-danger " data-toggle="modal" data-target="#ModalCekKuota" >Cek Kuota / Bulan</a>
            <a href=""  class="btn btn-danger" data-toggle="modal" data-target="#ModalCekKuotaPerJalur" >Cek Kuota / Jalur</a>
        </div>
        </div>
      </div>
    </div>
  </div>
  
@endif

  <!-- Modal cek kuota / bulan -->
  <div class="modal fade" id="ModalCekKuota" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Cek Kuota / Bulan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/checkkuota/bulan" method="post">
            @csrf
            <div class="mb-2">
              <label for="jalur" class="form-label mr-3">Jalur :</label>
              <select class="form-control" aria-label="Default select example" id="jalur" name="jalur" required>
                <option value="">Pilih jalur</option>
                @foreach ($jalur as $j)
                <option value="{{ $j->first()->jalur }}">{{ $j->first()->jalur }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-2">
              <label for="bulan" class="form-label mr-3">Bulan / tahun :</label>
              <select class="form-control" aria-label="Default select example" id="bulan" name="bulan" required>
                <option value="">Pilih bulan / tahun</option>
                @foreach ($bulan as $b)
                @if ( $b->first()->bulan == 1)
                  <option value="{{ $b->first()->bulan }}">Januari / {{ $b->first()->tahun }}</option>
                @elseif ( $b->first()->bulan == 2)
                  <option value="{{ $b->first()->bulan }}">Februari / {{ $b->first()->tahun }}</option>
                @elseif ( $b->first()->bulan == 3)
                  <option value="{{ $b->first()->bulan }}">Maret / {{ $b->first()->tahun }}</option>
                @elseif ( $b->first()->bulan == 12)
                  <option value="{{ $b->first()->bulan }}">Desember / {{ $b->first()->tahun }}</option>
                @endif
                @endforeach
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        </div>
      
      </div>
    </div>
  </div>

  <!-- Modal cek kuota / jalur -->
  <div class="modal fade" id="ModalCekKuotaPerJalur" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Cek Kuota / Bulan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/checkkuota/jalur" method="post">
            @csrf
            <div class="mb-2">
              <label for="jalur" class="form-label mr-3">Jalur :</label>
              <select class="form-control" aria-label="Default select example" id="jalur" name="jalur" required>
                <option value="">Pilih jalur</option>
                @foreach ($jalur as $j)
                <option value="{{ $j->first()->jalur }}">{{ $j->first()->jalur }}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        </div>
      </div>
    </div>
  </div>



  
 
@endsection

		

