@extends('layouts.template')
@section('tittlePage', 'Tambah Barang Masuk')
@section('tittleContent', '')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item">Transaksi</li>
    <li class="breadcrumb-item"><a href="{{ route("stockIn.index") }}">Barang Masuk</a></li>
    <li class="breadcrumb-item active">Tambah Barang Masuk</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h5><b>Form Barang Masuk</b></h5>
        </div>
          <form role="form" method="POST" class="form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="invoice">Invoice</label>
                                <input class="form-control" type="text" id="invoice" name="invoice" value="{{ $request->invoice }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date">Tanggal</label>
                                <input class="form-control date" type="date" id="date" name="date" value="{{ $request->date }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="supplier">Asal Produk</label>
                            <select class="form-control select" name="origin" readonly>
                                <option @if ($request->origin == 'Produk Lokal') selected @endif value="Produk Lokal">Produk Lokal</option>
                                <option @if ($request->origin == 'Produk Luar') selected @endif value="Produk Luar">Produk Luar</option>
                            </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="supplier">Supplier</label>
                                <select class="form-control select" name="supplier_id" readonly>
                                    @foreach ($suppliers as $suppliers)
                                    <option @if ($request->supplier_id == $suppliers->id) selected @endif value="{{ $suppliers->id }}">{{ $suppliers->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <textarea type="text" rows="4" class="form-control" name="description">{{ $request->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group" hidden>
                    <input type="text" name="created_by" value="{{ Auth::user()->id }}">
                    <input type="text" name="updated_by" value="{{ Auth::user()->id }}">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-body">
                <table class="table table-striped" id="addItem" width="100%">
                    <thead>
                        <h5><b>Form Rak Barang Masuk</b></h5>
                    </thead>
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">#</th>
                            <th class="text-center" width="20%">ITEM</th>
                            <th class="text-center" width="5%">QTY</th>
                            <th class="text-center">RACK</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($items as $items) --}}
                            @for ($i = 0; $i < count($request->itemsId); $i++)
                                {{-- @if ($items->id == $request->itemsId[$i]) --}}
                                <tr style="width: 100%">
                                    <td class="text-center">{{ $i+1 }}</td>
                                    <td>
                                        {{-- <input type="hidden" class="form-control" value="{{ $items->id }}" name="itemsId{{$i}}[]"> --}}
                                        {{-- <input type="text" class="form-control" value="{{ $items->name }}" readonly> --}}
                                        <select class="form-control" name="itemsId{{$i}}[]" readonly>
                                            @foreach ($items as $item)
                                            <option @if ($item->id == $request->itemsId[$i]) value="{{ $item->id }}" selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control" value="{{ $request->itemsCapacity[$i] }}" name="itemsCapacity[]">
                                        <input type="hidden" class="form-control" value="{{ $request->itemsWeight[$i] }}" name="itemsWeight[]">
                                        <input type="text" class="form-control" value="{{ $request->itemsQty[$i] }}" name="itemsQty[]" readonly>
                                    </td>
                                    @for ($j = 0; $j < $request->itemsRack[$i]; $j++)
                                    <td>
                                        <select class="form-control" style="width: 100%" name="rackDt{{$i}}[]" id="">
                                            @for ($x = 0; $x < count($racks); $x++)
                                                @for ($y = 0; $y < count($racks[$x]->rackDt); $y++)
                                                    @if ($racks[$x]->rackDt[$y]->is_load == 0)
                                                    <option value="{{ $racks[$x]->rackDt[$y]->id }}">{{ $racks[$x]->name }} - {{ $racks[$x]->rackDt[$y]->number }}</option>
                                                    @endif
                                                @endfor
                                            @endfor
                                        </select>
                                    </td>
                                    @endfor
                                </tr>
                                {{-- @endif --}}
                            @endfor
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
              <a href="{{ route('stockIn.index') }}" class="btn btn-secondary">Kembali</a>
              {{-- <button type="button" class="btn btn-success" onclick="chooseRack()">Lanjutkan</button> --}}
              <button type="button" class="btn btn-success" onclick="save()" >Simpan Data</button>
            </div>
          </form>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('script')
<script src="{{ asset('assets/stock/stockIn.js') }}"></script>
@endsection
