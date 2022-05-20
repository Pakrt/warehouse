@extends('layouts.template')
@section('tittlePage', 'Rak Penyimpanan')
@section('tittleContent', 'Rak Penyimpanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route("rack.index") }}">Master Rak Penyimpanan</a></li>
    <li class="breadcrumb-item active">Edit Rak Penyimpanan</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-5">
      <div class="card">
        <div class="card-body">
            <form role="form" method="POST" action="{{ route('rack.update', $rack->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                      <label for="area">Area</label>
                      <select name="area" id="area" class="form-control select">
                          <option @if ($rack->area == "local") selected @endif value="local">Produk Lokal</option>
                          <option @if ($rack->area == "nonlocal") selected @endif value="nonlocal">Produk Luar</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="row">Jumlah Bagian</label>
                      <input class="form-control @error('row') is-invalid @enderror" 
                        type="number" id="row" name="row" max="100" value="{{ $rack->row }}" required>
                      @error('row')
                        <label for="row" style="color: red">{{ $message }}</label>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="name">Nama</label>
                      <input class="form-control @error('name') is-invalid @enderror" 
                        type="text" id="name" name="name" value="{{ $rack->name }}" required>
                      @error('name')
                        <label for="name" style="color: red">{{ $message }}</label>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label><br>
                      <input class="form-control" type="checkbox" name="status" @if($rack->status == "on") checked @endif data-bootstrap-switch data-on-color="success">
                    </div>
                    <div class="form-group" hidden>
                      <input type="text" name="updated_by" value="{{ Auth::user()->id }}">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-between">
                  <a href="{{ route('rack.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
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