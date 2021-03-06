@extends('layouts.template')
@section('tittlePage', 'Barang Masuk')
@section('tittleContent', '')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item">Transaksi</li>
    <li class="breadcrumb-item active">Barang Masuk</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('stockIn.create') }}" class="btn btn-sm btn-info">
            <i class="fas fa-plus-circle"></i> Tambah Data Manual
          </a>&emsp;
          <a href="{{ route('stockIn.createAuto') }}" class="btn btn-sm btn-info">
            <i class="fas fa-plus-circle"></i> Tambah Data Auto
          </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th class="text-center" width="4%">#</th>
                <th class="text-center">Invoice</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Asal Barang</th>
                <th class="text-center">Kode Barang</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Supplier</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($stockIn as $key => $dt )
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $dt->invoice }}</td>
                  <td>{{ \Carbon\Carbon::parse($dt->date)->locale('id')->isoFormat('LL') }}</td>
                  <td>{{ $dt->product_origin }}</td>
                  <td>
                    @foreach ($dt->stockInDt as $as => $sd)
                        {{ $sd->item->code }} <br>
                    @endforeach
                  </td>
                  <td>
                   @foreach ($dt->stockInDt as $as => $sd)
                      {{ $sd->item->name }} <br>
                    @endforeach
                  </td>
                  <td>{{ $dt->supplier->name }}</td>
                  <td>
                    @foreach ($dt->stockInDt as $qty => $ss)
                        {{ $ss->qty }} CT<br>
                    @endforeach
                  </td>
                  <td>
                    {{ $dt->description }}
                  </td>
                  {{-- <td>
                    <form action="{{ route('stockIn.destroy', $dt->id) }}" method="POST">
                      @method('delete')
                      @csrf
                      <a href="{{ route('stockIn.edit', $dt->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>&emsp;
                      <button type="submit" class="btn btn-outline-danger btn-sm"
                        onclick="return confirm('Anda akan menghapus data master !!')">
                        <i class="fas fa-trash"></i></button>
                    </form>
                  </td> --}}
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
