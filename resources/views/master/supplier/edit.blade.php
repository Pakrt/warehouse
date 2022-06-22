@extends('layouts.template')
@section('tittlePage', 'Supplier')
@section('tittleContent', '')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route("supplier.index") }}">Master Supplier</a></li>
    <li class="breadcrumb-item active">Edit Supplier</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-5">
      <div class="card">
        <div class="card-body">
            <form role="form" method="POST" action="{{ route('supplier.update', $supplier->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="code">Kode</label>
                    <input class="form-control @error('code') is-invalid @enderror"
                      type="text" id="code" value="{{ $supplier->code }}" name="code" readonly>
                    @error('code')
                      <label for="code" style="color: red">{{ $message }}</label>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input class="form-control @error('name') is-invalid @enderror" 
                      type="text" id="name" name="name" value="{{ $supplier->name }}" required>
                    @error('name')
                      <label for="name" style="color: red">{{ $message }}</label>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="phone">Telepon</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input class="form-control @error('phone') is-invalid @enderror"
                        type="tel" id="phone" name="phone" value="{{ $supplier->phone }}" required>
                    </div>
                    @error('phone')
                      <label for="phone" style="color: red">{{ $message }}</label>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="address">Alamat</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                      </div>
                      <input type="text" class="form-control" name="address" value="{{ $supplier->address }}" required>
                    </div>
                  </div>
                  <div class="form-group" hidden>
                    <input type="text" name="updated_by" value="{{ Auth::user()->id }}">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-between">
                  <a href="{{ route('supplier.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                  <button type="submit" class="btn btn-success btn-sm">Simpan Data</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection