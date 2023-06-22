@extends('admin.template.main')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Users </h1>

    <div class="my-3">
        <a href="" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#ModalTambahUser">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Tambah Admin / User</span>
        </a>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show mx-0" role="alert">
     {{ session('success') }}
     <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
     @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Last Login</th>
                            <th>Foto Identitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                        @foreach ($users as $user)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ Carbon\Carbon::parse($user->last_login)->diffForHumans() }}</td>
                            <td><a href="{{ asset('storage/'. $user->foto_identitas) }}" target="_blank">Lihat Foto</a></td>
                            <td>
                                <a href="user/{{ $user->username }}" class="btn btn-info btn-circle">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="user/{{ $user->username }}/edit" class="btn btn-warning btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="user/{{ $user->username }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-circle" onclick="return confirm('Hapus user {{$user->name}} ?')"><i class="fas fa-trash-alt"></i>
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

<!-- Modal Tambah User -->
  <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/user" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="form-label">Name :</label>
                        <input type="text" class="form-control" id="name" name="name"   required>
                    </div>
                    <div class="mb-2">
                        <label for="username" class="form-label">Username :</label>
                        <input type="text" class="form-control" id="username" name="username"   required>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email :</label>
                        <input type="text" class="form-control" id="email" name="email"   required>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Alamat :</label>
                        <input type="text" class="form-control" id="alamat" name="alamat"   required>
                    </div>
                    <div class="mb-2">
                        <label for="role" class="form-label mr-3">Role :</label>
                        <select class="form-control" aria-label="Default select example" id="role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="jenis_kelamin" class="form-label mr-3">Jenis Kelamin :</label>
                        <select class="form-control" aria-label="Default select example" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih JK</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="jenis_identitas" class="form-label mr-3">Jenis Identitas :</label>
                        <select class="form-control" aria-label="Default select example" id="jenis_identitas" name="jenis_identitas" required>
                            <option value="">Pilih Identitas</option>
                            <option value="KTP">KTP</option>
                            <option value="SIM">SIM</option>
                            <option value="KTM">KTM</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="no_identitas" class="form-label">No Identitas :</label>
                        <input type="text" class="form-control" id="no_identitas" name="no_identitas"   required>
                    </div>
                    <div class="mb-2">
                        <label for="no_hp" class="form-label">No Hp :</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp"   required>
                    </div>
                    <div class="mb-3">
                        <label for="foto_identitas" class="form-label">Foto Identitas :</label>
                        <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="foto_identitas" name="foto_identitas"  required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password :</label>
                        <input type="password" class="form-control" id="password" name="password"  required>
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

@endsection

