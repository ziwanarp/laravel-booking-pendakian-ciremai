
@extends('user.template.main')

@section('container')

    <div class="hero hero-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mx-auto text-center">
          <div class="intro-wrap">
            <h2 class="mb-4 text-white">Detail Profile</h2>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Name</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Username</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      <input type="text" class="form-control" value="{{ $user->username }}" disabled>
                    </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Email</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                        <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                      </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Alamat</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                        <textarea class="form-control" rows="3" disabled>{{ $user->alamat }}</textarea>
                      </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Jenis Kelamin</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                      @if ($user->jenis_kelamin == 'L')
                        <input type="text" class="form-control" value="Laki-Laki" disabled>
                      @else
                        <input type="text" class="form-control" value="Perempuan" disabled>
                      @endif
                      </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Jenis Identitas</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                        <input type="text" class="form-control" value="{{ $user->jenis_identitas }}" disabled>
                      </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Nomor Identitas</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                        <input type="text" class="form-control" value="{{ $user->no_identitas }}" disabled>
                      </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Nomor Hp</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                        <input type="text" class="form-control" value="{{ $user->no_hp }}" disabled>
                      </div>
                  </div>
                  <hr>
                  <div class="row align-items-center text-white">
                    <div class="col-lg-5">
                      <p class="mb-0 text-left"><b>Foto {{ $user->jenis_identitas }}</b> </p>
                    </div>
                    <div class="col-lg-7 text-white">
                        <img width="250px" src="{{ asset('storage/'.$user->foto_identitas) }}" alt="{{ $user->foto_identitas }}">
                      </div>
                  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
@endsection