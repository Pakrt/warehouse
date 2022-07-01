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
                <th class="text-center">Produk Luar</th>
                <th class="text-center">Produk Lokal</th>
                <th class="text-center">Total</th>
                {{-- <th class="text-center">Asal Produk</th> --}}
              </tr>
            </thead>
           
            <tbody>
                @foreach ($item as $index => $items)
                @php
                    $totalQtyLuar = 0;
                    $totalQtyDalam = 0;
                    $rack = 0;
                @endphp
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$items->name}}</td>
                    <td class="text-right">
                        @foreach ($items->stock as $index1 => $el)
                        @php
                        if ($el->rack_dt_id >= 1 && $el->rack_dt_id <= 60) {
                            $totalQtyLuar +=$el->item_qty;
                        } else {
                        }
                        @endphp    
                        @endforeach
                        {{$totalQtyLuar}} CT
                    </td>
                    <td class="text-right">
                        @foreach ($items->stock as $index1 => $el)
                        @php
                        if ($el->rack_dt_id >= 1 && $el->rack_dt_id <= 60) {
                        } else {
                            $totalQtyDalam +=$el->item_qty;
                        }
                        @endphp    
                        @endforeach
                        {{$totalQtyDalam}} CT
                    </td>
                    <td class="text-right">
                        {{$totalQtyLuar + $totalQtyDalam}} CT
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
