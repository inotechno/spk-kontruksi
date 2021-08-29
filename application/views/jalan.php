<!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-row card-primary">
              <div class="card-header">
                <h3 class="card-title">
                 Daftar Jalan
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="tambah-jalan" data-toggle="modal" data-target="#modal-jalan"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body p-1">
                <table id="jalan" class="table">
                  <thead>
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Koordinat</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody id="table-body-jalan">
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

  <div class="modal fade" id="modal-jalan" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Jalan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-add-jalan" method="POST">
            <div class="form-group">
              <label>Nama Jalan</label>
              <input type="text" name="nama_jalan" class="form-control">
            </div>
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Kecamatan</label>
                  <input type="text" name="kecamatan" class="form-control">
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Kelurahan</label>
                  <input type="text" name="kelurahan" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Lattitude</label>
                  <input type="text" name="lat" id="lat" class="form-control" readonly="">
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Longitude</label>
                  <input type="text" name="lng" id="lng" class="form-control" readonly="">
                </div>
              </div>
                
            </div>           

            <div class="form-group">
              <div id="googleMap" style="width: 100%; height: 380px;"></div>
            </div>
            
            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-update-jalan" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Jalan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-update-jalan" method="POST">
            <input type="hidden" name="id_jalan_update">
            <div class="form-group">
              <label>Nama Jalan</label>
              <input type="text" name="nama_jalan_update" class="form-control">
            </div>
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Kecamatan</label>
                  <input type="text" name="kecamatan_update" class="form-control">
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Kelurahan</label>
                  <input type="text" name="kelurahan_update" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Lattitude</label>
                  <input type="text" name="lat_update" id="lat_update" class="form-control" readonly="">
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Longitude</label>
                  <input type="text" name="lng_update" id="lng_update" class="form-control" readonly="">
                </div>
              </div>
                
            </div>           

            <div class="form-group">
              <div id="googleMap_update" style="width: 100%; height: 380px;"></div>
            </div>

            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>