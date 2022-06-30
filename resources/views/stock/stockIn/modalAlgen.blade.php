<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title">Hasil Generate Algoritma Genetika</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- form start -->
          <form 
          {{-- role="form" method="POST" action="" --}}
          >
            @csrf
            <div class="card-body ">
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">#</th>
                            <th class="text-center" width="30%">ITEM</th>
                            <th class="text-center">RACK</th>
                        </tr>
                    </thead>
                    <tbody class="dropHere">
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success"  onclick="save2()" >Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->