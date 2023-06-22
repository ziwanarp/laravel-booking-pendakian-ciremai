

@extends('user.template.main')

@section('container')


    <div class="hero hero-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mx-auto text-center">
          <div class="intro-wrap">
            <h2 class="mb-4 text-white">Konfirmasi Order</h2>
           
            <form action="/order/confirm" method="post" enctype="multipart/form-data">
              @csrf
                  <div class="row align-items-center text-white">
                    <div class="col-lg-4">
                      <p class="mb-0 text-left"><b>Nama Pemesan</b> </p>
                    </div>
                    <div class="col-lg-8 text-white">
                      <input type="text" class="form-control" name="name" value="{{ $order->name }}" readonly>
                      <input type="hidden" name="user_id" value="{{ $order->user_id }}" >
                      <input type="hidden" name="kuota_id" value="{{ $order->kuota_id }}">
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-4">
                      <p class="mb-0 text-left"><b>Status</b> </p>
                    </div>
                    <div class="col-lg-8 text-white">
                        <p class="form-control border-0 btn-warning ">{{ $order->status }}</p>
                      <input type="hidden" name="status" value="{{ $order->status }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-4">
                      <p class="mb-0 text-left"><b>Total Harga</b> </p>
                    </div>
                    <div class="col-lg-8 text-white">
                      <input type="hidden" name="harga" value="{{ $harga }}">
                      <input type="text" class="form-control" value="Rp. {{ number_format($harga, 0, ".", ".") }},-" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-4">
                      <p class="mb-0 text-left"><b>Jalur</b> </p>
                    </div>
                    <div class="col-lg-8 text-white">
                      <input type="text" class="form-control" name="jalur" value="{{ $order->jalur }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-4">
                      <p class="mb-0 text-left"><b>Tanggal Naik</b> </p>
                    </div>
                    <div class="col-lg-8 text-white">
                      <input type="text" class="form-control" name="tanggal_naik" value="{{ $order->tanggal_naik }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-4">
                      <p class="mb-0 text-left"><b>Tanggal Turun</b> </p>
                    </div>
                    <div class="col-lg-8 text-white">
                      <input type="text" class="form-control" name="tanggal_turun" value="{{ $order->tanggal_turun }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-4">
                      <p class="mb-0 text-left"><b>Jumlah Pendaki</b> </p>
                    </div>
                    <div class="col-lg-8 text-white">
                      <input type="number" class="form-control" name="jumlah_pendaki" value="{{ $order->jumlah_pendaki }}" readonly>
                      <input type="hidden" name="status" value="Pending" >
                      <input type="hidden" name="kode_order" value="CRM-" >
                    </div>
                  </div>
                  <div class="mt-4 text-right">
                    <a href="/" class="btn btn-primary">Batal</a>
                    <button type="submit" class="btn btn-danger">Konfirmasi</button>
                  </div>
                </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <script>

    var x = document.getElementById("checkbox").required;
    
</script>
 
@endsection