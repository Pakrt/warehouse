@extends('layouts.template')
@section('tittlePage', 'Barang')
@section('tittleContent', 'Barang')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route("item.index") }}">Master Barang</a></li>
    <li class="breadcrumb-item active">Edit Barang</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
            <form role="form" method="POST" action="{{ route('item.update', $item->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="code">Kode</label>
                                <input class="form-control @error('code') is-invalid @enderror"
                                  type="text" id="code" name="code" value="{{ $item->code }}" required>
                                @error('code')
                                  <label for="code" style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input class="form-control @error('name') is-invalid @enderror"
                                  type="text" id="name" name="name" value="{{ $item->name }}" required>
                                @error('name')
                                  <label for="name" style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Kategori</label>
                                <select class="form-control select" name="category_id" required>
                                    @foreach ($category as $category)
                                    <option @if ($item->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="unit">Satuan</label>
                                <select class="form-control select" name="unit_id" required>
                                    @foreach ($unit as $unit)
                                    <option @if($item->unit_id == $unit->id) selected @endif value="{{ $unit->id }}">{{ $unit->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="capacity">Kapasitas</label>
                                <input class="form-control" type="number" id="capacity" name="capacity" min="0" value="{{ $item->capacity }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Keterangan</label>
                        <input class="form-control" type="text" id="description" name="description" value="{{ $item->description }}">
                    </div>
                    <div class="form-group" hidden>
                        <input type="text" name="created_by" value="{{ Auth::user()->id }}">
                        <input type="text" name="updated_by" value="{{ Auth::user()->id }}">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-between">
                  <a href="{{ route('item.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
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
