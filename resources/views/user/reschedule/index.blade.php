
@extends('user.template.main')

@section('container')

    <div class="hero hero-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mx-auto text-center">
          <div class="intro-wrap">
            <h2 class="mb-4 text-white">Reschedule Pendakian</h2>

            <form action="/order/reschedule/{{ $order->kode_order }}" method="post">
                @csrf
                @method('put')
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Jalur</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" name="jalur" value="{{ $order->kuota->jalur }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Tanggal naik Sebelumnya</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" value="{{ $order->tanggal_naik }}" disabled>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Tanggal naik <strong>baru</strong></b></p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="date" class="form-control" min="{{$today}}" name="tanggal_naik" required>
                      <input type="hidden" class="form-control" value="{{ $order->jumlah_pendaki }}" name="jumlah_pendaki">

                    </div>
                </div>
                <div class=" col-lg-12 my-3 text-right">
                    <a href="/order/myorders" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-danger text-right">Reschedule</button>
                </div>
            </form>
                  
          </div>
        </div>
      </div>
    </div>
  </div>
 
@endsection