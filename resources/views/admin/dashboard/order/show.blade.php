@extends('admin.template.main')


 
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Detail Order </h1>
<div class="col-lg-8">
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0"><b>Nama</b> </p>
          </div>
          <div class="col-sm-7">
            <p class="text-muted mb-0">{{ $order[0]->user->name }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0"><b>Kode Order</b></p>
          </div>
          <div class="col-sm-7">
            <p class="text-muted mb-0">{{ $order[0]->kode_order }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0"><b>Jalur</b></p>
          </div>
          <div class="col-sm-7">
            <p class="text-muted mb-0">{{ $order[0]->kuota->jalur }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0"><b>Jumlah Pendaki</b></p>
          </div>
          <div class="col-sm-7">
            <p class="text-muted mb-0">{{ $order[0]->jumlah_pendaki }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0"><b>Total Harga</b></p>
          </div>
          <div class="col-sm-7">
            <p class="text-muted mb-0">{{ $order[0]->harga }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0"><b>Tanggal Naik</b></p>
          </div>
          <div class="col-sm-7">
            <p class="text-muted mb-0">{{ $order[0]->tanggal_naik }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0"><b>Tanggal Turun</b></p>
          </div>
          <div class="col-sm-7">
            <p class="text-muted mb-0">{{ $order[0]->tanggal_turun }}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0"><b>Status</b></p>
          </div>
          <div class="col-sm-7">
            @if ($order[0]->status == 'Tolak')
            <p class="text-white mb-0 btn btn-danger">{{ $order[0]->status }}</p>
            @elseif ($order[0]->status == 'Konfirmasi')
            <p class="text-white mb-0 btn btn-success">{{ $order[0]->status }}</p>
            @else
            <p class="text-white mb-0 btn btn-warning">{{ $order[0]->status }}</p>
            @endif
          </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-5">
              <p class="mb-0"><b>Orderan Dibuat</b></p>
            </div>
            <div class="col-sm-7">
              <p class="text-muted mb-0">{{ $order[0]->created_at }}</p>
            </div>
          </div>
          <hr>
        </div>
    </div>
    <a href="/dashboard/order" class="btn btn-primary">Kembali</a>
      </div>


    @endsection