@extends('layouts.template')
@section('tittlePage', 'Kategori')
@section('tittleContent', 'Kategori')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route("category.index") }}">Master Kategori</a></li>
    <li class="breadcrumb-item active">Edit Kategori</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-5">
      <div class="card">
        <div class="card-body">
            <form role="form" method="POST" action="{{ route('category.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="code">Kode</label>
                    <input class="form-control @error('code') is-invalid @enderror"
                      type="text" id="code" value="{{ $category->code }}" name="code">
                    @error('code')
                      <label for="code" style="color: red">{{ $message }}</label>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input class="form-control @error('name') is-invalid @enderror" 
                      type="text" id="name" name="name" value="{{ $category->name }}" required>
                    @error('name')
                      <label for="name" style="color: red">{{ $message }}</label>
                    @enderror
                  </div>
                  <div class="form-group" hidden>
                    <input type="text" name="updated_by" value="{{ Auth::user()->id }}">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-between">
                  <a href="{{ route('category.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
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