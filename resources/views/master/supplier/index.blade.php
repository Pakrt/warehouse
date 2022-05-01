@extends('layouts.template')
@section('tittlePage', 'Supplier')
@section('tittleContent', 'Supplier')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Master Supplier</li>
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
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center">Kode</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Telepon</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($supplier as $supplier)
                <tr>
                  <td>{{ $supplier->code }}</td>
                  <td>{{ $supplier->name }}</td>
                  <td>{{ $supplier->phone }}</td>
                  <td>{{ $supplier->address }}</td>
                  <td class="text-center">
                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST">
                      @method('delete')
                      @csrf
                      <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>&emsp;
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
@include('master.supplier.create')
