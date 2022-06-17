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
                                <input class="form-control invoice validation @error('invoice') is-invalid @enderror"
                                type="text" id="invoice" name="invoice" required>
                                @error('invoice')
                                <label for="invoice" style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date">Tanggal</label>
                                <input class="form-control" type="date" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="supplier">Asal Produk</label>
                            <select class="form-control select" name="origin" required>
                                <option value="-">- Select -</option>
                                <option value="local">Produk Lokal</option>
                                <option value="interlocal">Produk Luar</option>
                            </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="supplier">Supplier</label>
                                <select class="form-control select" name="supplier_id" required>
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
                    <input type="hidden" class="items" data-name="{{ $items->name }}" data-weight="{{ $items->weight }}"
                      data-code="{{ $items->code }}" data-unit="{{ $items->unit->code }}" value="{{ $items->id }}">
                @endforeach
                <button class="btn btn-sm btn-info" onclick="addItem()" type="button" id="tambah"><i class="fas fa-plus"></i> Tambah Barang</button><br>
                <table class="table table-striped" id="addItem" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">#</th>
                            <th class="text-center">ITEM</th>
                            <th class="text-center" width="20%">QTY</th>
                            <th class="text-center" width="20%">EX DATE</th>
                            <th class="text-center" width="10%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="dropItem">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
              <a href="{{ route('stockIn.index') }}" class="btn btn-secondary">Kembali</a>
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
{{-- @include('js.stock.stockInScript') --}}
@section('script')
{{-- <script src="{{ asset('assets/stock/stockIn.js') }}"></script> --}}
<script>
    function addItem() {
        var dataRow = $('.dataRow').length;
        var index = $('.itemsId').length;
        var dataItems = [];
        $.each($('.items'), function () {
            dataItems += "<option data-index='"+(index+1)+"' data-unit='"+$(this).data('unit')+"' data-weight='"+$(this).data('weight')+"' value='"+this.value+"'>"+$(this).data('name')+"</option>";
        });

        $('.dropItem').append(
            "<tr class='dataRow dataRow_"+(dataRow+1)+"'>"+
                "<td class='text-center' data-index='"+(index+1)+"'>" +(index+1)+ "</td>"+
                "<td>"+
                    "<select class='form-control select itemsId' name='itemsId[]'>"+
                        "<option value='-' data-index='"+(index+1)+"'>- Select Item -</option>"+dataItems+
                    "</select>"+
                "</td>"+
                "<td style='display:none'>"+
                    "<input type='text' class='form-control text-right itemsWeight itemsWeight_"+(index+1)+"' readonly name='itemsWeight[]' data-index='"+(index+1)+"'>"+
                "</td>"+
                "<td>"+
                    "<div class='input-group'>"+
                        "<input type='text' class='form-control text-right itemsQty itemsQty_"+(index+1)+"' name='itemsQty[]' data-index='"+(index+1)+"' value='0'>"+
                        // "<input type='text' class='form-control text-right itemsUnit itemsUnit_"+(index+1)+"' data-index='"+(index+1)+"' readonly>"+
                        "<div class='input-group-prepend'>"+
                        "<span class='input-group-text'>CT</span>"+
                        // "<span class='input-group-text itemsUnit itemsUnit_"+(index+1)"'>"+$(this).data('unit')+"</span>"+
                        "</div>"+
                    "</div>"+
                "</td>"+
                "<td>"+
                    "<input type='date' class='form-control itemsExp ItemsExp_"+(index+1)+"' name='itemsExp[]' data-index='"+(index+1)+"'>"+
                "</td>"+
                "<td class='text-center'>"+
                    "<button class='btn btn-danger btn-sm removeItem' value='"+(index+1)+"' >"+
                    "<i class='fas fa-times'></i>"+
                    "</button>"+
                "</td>"+
            "</tr>"
        );
    }

    $(document.body).on("change", ".itemsId", function () {
        var index = $(this).find(':selected').data('index');

        if ($(this).val() == '-') {
            $('.itemsWeight_' + index).val(0);
            $('.itemsUnit_' + index).val(' ');
        } else {
            $('.itemsWeight_' + index).val($(this).find(':selected').data('weight'));
            $('.itemsUnit_' + index).val($(this).find(':selected').data('unit'));
        }
    });

    $(document.body).on('click', '.removeItem', function () {
        $('.dataRow_'+this.value).remove();
    });

    function save() {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan menyimpan data Anda !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan Data'
            }).then((willSave) => {
            if (willSave) {
                var validation = 0;
                $('.validation').each(function () { 
                    if ($(this).val() == '' || $(this).val() == null || $(this).val() == 0) {
                        validation++;
                        toastr.options = {
                            "progressBar" : true,
                            "positionClass" : "toast-bottom-right"
                        }
                        toastr.error("Data Harus Diisi !", "Warning");
                    } else {
                        validation-1;
                    }
                });
                if (validation != 0) {
                    return false;
                }
                $.ajax({
                    url: "{{ route('stockIn.store') }}",
                    data: $(".form-data").serialize(),
                    type: 'POST',
                    processData: false,
                    success: function(data) {
                        Swal.fire(
                        'Success!',
                        'Data berhasil disimpan',
                        'success'
                        )
                        location.reload();
                        // window.open("{{ route('stockIn.index') }}");
                    }
                });
            }
        })
        
    }
</script>
@endsection
