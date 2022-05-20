@extends('layouts.template')
@section('tittlePage', 'Kategori')
@section('tittleContent', 'Kategori')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Master Kategori</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-sm bg-gradient-info" data-toggle="modal" data-target="#modal-lg">
            <i class="fas fa-plus-circle"></i> Tambah Data
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th class="text-center" width="5%">#</th>
                <th class="text-center">Kode</th>
                <th class="text-center">Nama</th>
                <th class="text-center" width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($category as $category)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $category->code }}</td>
                  <td>{{ $category->name }}</td>
                  <td class="text-center">
                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                      @method('delete')
                      @csrf
                      <a href="{{ route('category.edit', $category->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>&emsp;
                      <button type="submit" class="btn btn-outline-danger btn-sm"
                        onclick="return confirm('Anda akan menghapus data master !!')">
                        <i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
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
@include('master.category.create')
