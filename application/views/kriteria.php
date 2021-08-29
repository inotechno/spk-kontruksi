<!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-row card-warning">
              <div class="card-header">
                <h3 class="card-title">
                  Daftar Kriteria
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="tambah-kriteria" data-toggle="modal" data-target="#modal-add-kriteria"><i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <ul class="todo-list" id="daftar-kriteria">
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-row card-primary">
              <div class="card-header">
                <h3 class="card-title">
                 Pilihan Bobot Kriteria
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="tambah-bobot-kriteria" data-toggle="modal" data-target="#modal-add-bobot-kriteria"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body p-1">
                <table id="bobot_kriteria" class="table">
                  <thead>
                    <th>No</th>
                    <th>Pilihan Bobot</th>
                    <th>Keterangan</th>
                    <th>Nilai Kriteria</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody id="table-body-bobot-kriteria">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="modal-add-kriteria" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-add-kriteria" method="POST">

            <div class="form-group">
              <label>Nama Kriteria</label>
              <input type="text" name="nama_kriteria" class="form-control">
            </div>

            <div class="form-group">
              <label>Bobot Kriteria</label>
              <input type="text" name="bobot_kriteria" class="form-control">
            </div>

            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-edit-kriteria" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-edit-kriteria" method="POST">
            <div class="form-group">
              <label>Nama Kriteria</label>
              <input type="hidden" name="kriteria_lama">
              <input type="hidden" name="edit_id_kriteria">
              <input type="text" name="edit_nama_kriteria" class="form-control">
            </div>

            <div class="form-group">
              <label>Bobot Kriteria</label>
              <input type="text" name="edit_bobot_kriteria" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>




  <div class="modal fade" id="modal-add-bobot-kriteria" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Bobot Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-add-bobot-kriteria" method="POST">

            <div class="form-group">
              <label>Nama Kriteria</label>
              <select name="id_kriteria" class="form-control">
              </select>
            </div>

            <div class="form-group">
              <label>Pilihan Bobot</label>
              <input type="number" name="pilihan_bobot" class="form-control" placeholder="2">
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="keterangan" class="form-control" placeholder="Cukup">
            </div>

            <div class="form-group">
              <label>Nilai Bobot</label>
              <input type="number" name="nilai" class="form-control" placeholder="5">
            </div>

            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>