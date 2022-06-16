<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Rak Penyimpanan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- form start -->
          <form role="form" method="POST" action="{{ route('rack.store') }}">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="area">Area</label>
                <select name="area" id="area" class="form-control select">
                    <option>- Select -</option>
                    <option value="Produk Lokal">Produk Lokal</option>
                    <option value="Produk Luar">Produk Luar</option>
                </select>
              </div>
              <div class="form-group">
                <label for="row">Jumlah Baris</label>
                <input class="form-control @error('row') is-invalid @enderror"
                  type="number" id="row" name="row" max="100" required>
                @error('row')
                  <label for="row" style="color: red">{{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="row">Jumlah Rak</label>
                <input class="form-control @error('qty') is-invalid @enderror"
                  type="number" id="qty" name="qty" required>
                @error('qty')
                  <label for="row" style="color: red">{{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="name">Nama</label>
                <input class="form-control @error('name') is-invalid @enderror"
                  type="text" id="name" name="name" required>
                @error('name')
                  <label for="name" style="color: red">{{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="status">Status</label><br>
                <input class="form-control" type="checkbox" name="status" checked data-bootstrap-switch data-on-color="success">
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
