<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- form start -->
          <form role="form" method="POST" action="{{ route('item.store') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <input class="form-control @error('code') is-invalid @enderror"
                              type="text" id="code" name="code" required>
                            @error('code')
                              <label for="code" style="color: red">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input class="form-control @error('name') is-invalid @enderror"
                              type="text" id="name" name="name" required>
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
                                <option>- Select -</option>
                                @foreach ($category as $category)
                                <option value="{{ $category->id }}">{{ $category->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="unit">Satuan</label>
                            <select class="form-control select" name="unit_id" required>
                                <option>- Select -</option>
                                @foreach ($unit as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="capacity">Kapasitas</label>
                            <input class="form-control @error('capacity') is-invalid @enderror"
                              type="number" id="capacity" name="capacity" min="0" required>
                            @error('capacity')
                              <label for="capacity" style="color: red">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Keterangan</label>
                    <input class="form-control" type="text" id="description" name="description">
                </div>
                <div class="form-group" hidden>
                    <input type="text" name="created_by" value="{{ Auth::user()->id }}">
                    <input type="text" name="updated_by" value="{{ Auth::user()->id }}">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
