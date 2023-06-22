

{{-- {{ dd(auth()->user()) }} --}}
{{-- {{ dd($kuota[0]->id); }} --}}
@extends('user.template.main')

@section('container')


    <div class="hero hero-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mx-auto text-center">
          <div class="intro-wrap">
            <h2 class="mb-4 text-white">Konfirmasi Order</h2>
            <form action="/order" method="post">
              @csrf
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Nama Pemesan</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" readonly>
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" >
                      <input type="hidden" name="kuota_id" value="{{ $kuota[0]->id }}">
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Harga / Orang</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" name="harga" value="Rp. {{ number_format(HARGA, 0, ".", ".") }},-" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Jalur</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" name="jalur" value="{{ $kuota[0]->jalur }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Tanggal Naik</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" name="tanggal_naik" value="{{ $kuota[0]->tanggal }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Tanggal Turun</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" name="tanggal_turun" value="{{ Carbon\Carbon::parse( $kuota[0]->tanggal)->addDays(3)->format('Y-m-d') }}" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Jumlah Pendaki</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="number" class="form-control" name="jumlah_pendaki"  min="4" required>
                      <input type="hidden" name="status" value="Pending" >
                    </div>
                  </div>
                  <div class="form-check my-3 text-left">
                    <input class="form-check-input " type="checkbox" id="checkbox" name="checkbox" required>
                    <label class="form-check-label text-left text-white mx-2" for="checkbox">
                      Saya setuju dengan sayarat & ketentuan pendakian ciremai
                    </label>
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

		

