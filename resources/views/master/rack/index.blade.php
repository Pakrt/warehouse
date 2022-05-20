@extends('layouts.template')
@section('tittlePage', 'Rak Penyimpanan')
@section('tittleContent', 'Rak Penyimpanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Master Rak Penyimpanan</li>
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
                <th class="text-center">Nama</th>
                <th class="text-center">Area</th>
                <th class="text-center" width="15%">Jumlah Row</th>
                <th class="text-center" width="15%">Jumlah Sisi</th>
                <th class="text-center" width="10%">Status</th>
                <th class="text-center" width="10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($rack as $rack)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $rack->name }}</td>
                  <td>{{ $rack->area }}</td>
                  <td class="text-right">{{ $rack->row }}</td>
                  <td class="text-right">{{ $rack->qty }}</td>
                  <td class="text-center">
                    @if ($rack->status == "on")
                    <span class="badge bg-success">Aktif</span>
                    @else
                    <span class="badge bg-gray">Non Aktif</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <form action="{{ route('rack.destroy', $rack->id) }}" method="POST">
                      @method('delete')
                      @csrf
                      <a href="{{ route('rack.edit', $rack->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>&emsp;
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
@include('master.rack.create')
