@extends('layouts.template')
@section('tittlePage', 'Stock Barang')
@section('tittleContent', '')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Stock Barang</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th class="text-center" width="5%">#</th>
                <th class="text-center">Item</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Asal Produk</th>
              </tr>
            </thead>
            @php
                $totalQty = 0;
            @endphp
            <tbody>
                @foreach ($item as $item => $items)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $items->name }}</td>
                    {{-- @php
                        $totalQty = 0;
                        $qty = DB::table('stocks')->where('item_id', $items->id->select('item_qty')->get());
                        $totalQty = sum($qty);
                    @endphp --}}
                    @foreach ($stock as $s => $stocks)
                        @if ($items->id == $stocks->item_id)
                            @php
                                $totalQty += $stocks->item_qty;
                            @endphp
                        @endif
                    @endforeach
                    <td class="text-right">{{ $totalQty }} CT</td>
                    <td> Produk Luar </td>
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
