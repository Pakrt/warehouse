@extends('layouts.template')
@section('tittlePage', 'Tambah Barang Keluar')
@section('tittleContent', '')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item">Transaksi</li>
    <li class="breadcrumb-item"><a href="{{ route("stockIn.index") }}">Barang Keluar</a></li>
    <li class="breadcrumb-item active">Tambah Barang Keluar</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h5><b>Form Barang Keluar</b></h5>
        </div>
          <form role="form" method="POST" class="form-data"  action="{{ route('stockIn.chooseRack') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="invoice">Invoice</label>
                                <input class="form-control invoice validation @error('invoice') is-invalid @enderror"
                                  data-name="Kode Invoice" type="text" id="invoice" name="invoice" required>
                                @error('invoice')
                                <label for="invoice" style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date">Tanggal</label>
                                <input class="form-control date validation" data-name="Tanggal" type="date" id="date" name="date" value="<?= date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="supplier">Asal Produk</label>
                            <select class="form-control select validation" data-name="Asal Produk" name="origin" required>
                                <option value="-">- Select -</option>
                                <option value="Produk Lokal">Produk Lokal</option>
                                <option value="Produk Luar">Produk Luar</option>
                            </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="supplier">Supplier</label>
                                <select class="form-control select validation" data-name="Supplier" name="supplier_id" required>
                                    <option value="-">- Select -</option>
                                    @foreach ($suppliers as $suppliers)
                                    <option value="{{ $suppliers->id }}">{{ $suppliers->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <textarea type="text" rows="4" class="form-control" name="description" ></textarea>
                            <input readonly id="totalRack" onchange="totalRack()" type="hidden" value="0"
                                class="form-control validation" data-name="Data Item" name="totalRack">
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
                @foreach ($items as $items)
                    <input type="hidden" class="items" data-name="{{ $items->name }}" data-weight="{{ $items->total_weight }}" data-capacity="{{ $items->rack_capacity }}"
                      data-code="{{ $items->code }}" data-unit="{{ $items->unit->code }}" value="{{ $items->id }}">
                @endforeach
                @foreach ($rackDt as $el)
                    <input type="hidden" class="rackDtRaw" data-name="{{ $el->racks->name .'-'.$el->number  }}" 
                     value="{{ $el->id }}">
                @endforeach
                <table class="table table-striped" id="addItem" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">#</th>
                            <th class="text-center">ITEM</th>
                            {{-- <th class="text-center" width="20%">QTY</th> --}}
                            <th class="text-center" width="10%">RACK</th>
                            <th class="text-center" width="20%">EX DATE</th>
                            <th class="text-center" width="10%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="dropItem">

                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">
                                <button class="btn btn-sm btn-info" onclick="addItem()" type="button" id="tambah"><i class="fas fa-plus"></i> Tambah Barang</button>
                            </th>
                        </tr>
                    </tfoot>
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
<script>
    var route = "{{ route('stockIn.chooseRack') }}";

</script>
<script src="{{ asset('assets/stock/stockOut.js') }}"></script>
@endsection
