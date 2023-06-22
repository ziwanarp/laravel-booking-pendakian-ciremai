@extends('admin.template.main')
@section('content')


<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit User </h1>
<div class="col-lg-8">
    <div class="card mb-4">
      <div class="card-body">
        <form action="/dashboard/user/{{ $user->username }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Name</b> </p>
          </div>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="name" value="{{ old('name',$user->name) }}">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Jenis Identitas</b></p>
          </div>
          <div class="col-sm-9">
            <select class="form-control" aria-label="Default select example" id="jenis_identitas" name="jenis_identitas" required>
                <option value="">Jenis Identitas</option>
                <option value="KTP">KTP</option>
                <option value="SIM">SIM</option>
                <option value="KTM">KTM</option>
            </select>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Nomor Identitas</b></p>
          </div>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="no_identitas" value="{{ old('no_identitas',$user->no_identitas) }}">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Alamat</b></p>
          </div>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="alamat" value="{{ old('alamat',$user->alamat) }}">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0"><b>Foto Identitas</b></p>
          </div>
          <div class="col-sm-9">
            <input type="hidden" name="oldImage" value="{{ $user->foto_identitas }}">
            <img src="{{ asset('storage/'. $user->foto_identitas) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            <input type="file" accept="image/png, image/jpeg, image/jpg" id="foto_identitas" name="foto_identitas" onchange="previewImage()">
          </div>
        </div>
        <div class="text-right">
          <a href="/dashboard/user" class="btn btn-primary">Cancel</a>
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
      </div>
    </div>
    

    <script>
            function previewImage(){
            const foto_identitas =document.querySelector('#foto_identitas');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display ='block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto_identitas.files[0]);

            oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;

      }
      }
    </script>

    @endsection