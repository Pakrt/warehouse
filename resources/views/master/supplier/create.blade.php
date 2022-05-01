<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Supplier</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- form start -->
          <form role="form" method="POST" action="{{ route('supplier.store') }}">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="code">Kode</label>
                <input class="form-control @error('code') is-invalid @enderror"
                  type="text" id="code" value="{{ $code }}" name="code" readonly>
                @error('code')
                  <label for="code" style="color: red">{{ $message }}</label>
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
                <label for="phone">Telepon</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input class="form-control @error('phone') is-invalid @enderror"
                    type="tel" id="phone" name="phone" required>
                </div>
                @error('phone')
                  <label for="phone" style="color: red">{{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="address">Alamat</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                  </div>
                  <input type="text" class="form-control" name="address" required>
                </div>
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