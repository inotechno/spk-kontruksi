<!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-row card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  Normalisasi
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="tambah-data" data-toggle="modal" data-target="#modal-normalisasi"><i class="fas fa-plus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-1" id="body-normalisasi">
                <table class="table table-sm table-bordered" id="table-normalisasi">
                  <thead>
                    <th style="width: 5px">No</th>
                    <th>Nama Jalan</th>
                    <?php 
                      foreach ($thead as $kr) {?>
                        <th><?= $kr->nama_kriteria ?></th>
                      <?php } 
                    ?>
                    <th style="width: 5px;">X</th>
                  </thead>
                  <tbody id="table-body-normalisasi"></tbody>
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

  <div class="modal fade" id="modal-normalisasi" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Normalisasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="form-add-normalisasi" method="POST">

            <div class="form-group">
              <label>Nama Jalan</label>
              <select class="form-control" name="id_jalan"></select>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 field_kriteria">
              
            </div>

            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-update-normalisasi" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Data Normalisasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="form-update-normalisasi" method="POST">
            <input type="hidden" name="id_bobot_jalan">
            <div class="form-group">
              <label>Nama Jalan</label>
              <select class="form-control" name="id_jalan_update" disabled=""></select>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 field_kriteria">
              
            </div>

            <button type="submit" class="btn btn-sm btn-primary float-right">Update</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
