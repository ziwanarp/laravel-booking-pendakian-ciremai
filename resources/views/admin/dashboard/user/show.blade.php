@extends('admin.template.main')


 
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Detail User </h1>
<div class="col-lg-8">
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Name</b> </p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{ $user->name }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Username</b></p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{ $user->username }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Last Login</b></p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{  Carbon\Carbon::parse($user->last_login)->diffForHumans()}}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Email</b></p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{ $user->email }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Role</b></p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{ $user->role }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Jenis Kelamin</b></p>
          </div>
          <div class="col-sm-9">
            @if ($user->jenis_kelmain = 'L')
                <p class="text-muted mb-0">Laki-Laki</p>
            @elseif ($user->jenis_kelmain = 'P')
                 <p class="text-muted mb-0">Perempuan</p>
            @endif
            
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Jenis Identitas</b></p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{ $user->jenis_identitas }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Nomor {{ $user->jenis_identitas }}</b></p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{ $user->no_identitas }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Alamat</b></p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{ $user->alamat }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Foto {{ $user->jenis_identitas }}</b></p>
          </div>
          <div class="col-sm-9">
            <img src="{{ asset('storage/'. $user->foto_identitas) }}" alt="$user->foto_identitas" width="200">
            <p class="text-muted mb-0"><a href="{{ asset('storage/'. $user->foto_identitas) }}" target="_blank">Lihat Foto</a></p>
          </div>
        </div>
      </div>
    </div>

    @endsection