
@extends('user.template.main')

@section('container')
      <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('midtrans.client_key') }}"></script>

    <div class="hero hero-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mx-auto text-center">
          <div class="intro-wrap">
            <h2 class="mb-4 text-white">Detail Order</h2>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Nama Pemesan</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" name="name" value="{{ $order[0]->user->name }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Kode Order</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" name="name" value="{{ $order[0]->kode_order }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Status</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      @if ($order[0]->status == 'Konfirmasi')
                      <p class="btn-success btn-sm form-control border-0">{{ $order[0]->status }}</p>
                      @elseif ($order[0]->status == 'Tolak')
                      <p class="btn-danger btn-sm form-control border-0">{{ $order[0]->status }}</p>
                      @else
                      <p class="btn-warning btn-sm form-control border-0">{{ $order[0]->status }}</p>
                      @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Total Harga</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" name="harga" class="form-control" value="Rp. {{ number_format($order[0]->harga, 0, ".", ".") }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Jalur</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" name="jalur" class="form-control" value="{{ $order[0]->kuota->jalur }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Tanggal Naik</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" name="tanggal_naik" class="form-control" value="{{ $order[0]->tanggal_naik }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Tanggal Turun</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" name="tanggal_turun" class="form-control" value="{{ $order[0]->tanggal_turun }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Jumlah Pendaki</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="number" name="jumlah_kuota" class="form-control" value="{{ $order[0]->jumlah_pendaki }}" readonly>
                    </div>
                  </div>

                  <div class="mt-4 text-right">
                    <a href="/order/myorders" class="btn btn-primary">Kembali</a>
                    @if ($order[0]->status != 'Konfirmasi')
                    <button class="btn btn-danger" id="pay-button">Bayar Sekarang</button>
                    @endif
                    @if ($order[0]->status == 'Konfirmasi')
                    <form class="d-inline" action="/order/struk/{{ $order[0]->kode_order }}" method="get">
                      <button type="submit" class="text-white btn btn-danger border-0" >Struk Pembayaran <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                      </svg></button>
                    </form>
                    @endif
                  </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{ $order[0]->snapToken }}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
  </script>
 
@endsection