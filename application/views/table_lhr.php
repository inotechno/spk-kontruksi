<!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-row card-warning">
              <div class="card-header">
                <h3 class="card-title">
                  Table LHR
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="tambah-kriteria-lhr" data-toggle="modal" data-target="#modal-add-kriteria-lhr"><i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row" id="daftar-lhr">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-row card-primary">
              <div class="card-header">
                <h3 class="card-title">
                 Table LHR
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="tambah-nilai-lhr" data-toggle="modal" data-target="#modal-add-nilai-lhr"><i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-1">
                <table id="table_lhr" class="table table-responsive">
                  <thead>
                    <th>No</th>
                    <th>Alternatif</th>
                    <?php 
                      foreach ($thead as $th) {
                        echo "<th>".$th->nama_kriteria_lhr."</th>";
                      }
                    ?>
                    <th>Total</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody id="table-body-lhr">
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

  <div class="modal fade" id="modal-add-kriteria-lhr" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kriteria LHR</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-add-kriteria-lhr" method="POST">

            <div class="form-group">
              <label>Nama Kriteria</label>
              <input type="text" name="nama_kriteria_lhr" class="form-control">
            </div>

            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-edit-kriteria-lhr" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-edit-kriteria-lhr" method="POST">
            <div class="form-group">
              <label>Nama Kriteria</label>
              <input type="hidden" name="id">
              <input type="hidden" name="nama_kriteria_lama">
              <input type="text" name="edit_nama_kriteria_lhr" class="form-control">
            </div>

            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-add-nilai-lhr" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nilai LHR</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-add-nilai-lhr" method="POST">

            <div class="form-group">
              <label>Nama Alternatif</label>
              <select class="form-control select-jalan" name="id_jalan">
                <?php 
                  foreach ($jalan as $jl) {?>
                    <option value="<?= $jl->id_jalan ?>"><?= $jl->nama_jalan ?></option>
                  <?php }
                ?>
              </select>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 field_lhr">
              
            </div>

            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-update-nilai-lhr" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nilai LHR</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-update-nilai-lhr" method="POST">

            <div class="form-group">
              <label>Nama Alternatif</label>
              <select class="form-control select-jalan" name="id_jalan_update">
                <?php 
                  foreach ($jalan as $jl) {?>
                    <option value="<?= $jl->id_jalan ?>"><?= $jl->nama_jalan ?></option>
                  <?php }
                ?>
              </select>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 field_lhr_update">
              
            </div>

            <button type="submit" class="btn btn-sm btn-primary float-right">Update</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-delete-nilai-lhr" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin ingin menghapus nilai tabel LHR ini ?!</p>
          <form id="form-delete-nilai-lhr">
            <input type="hidden" name="id_jalan_delete">
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-light" form="form-delete-nilai-lhr">Hapus</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->