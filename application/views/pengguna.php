<!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-row card-primary">
              <div class="card-header">
                <h3 class="card-title">
                 Daftar Pengguna
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="tambah-pengguna" data-toggle="modal" data-target="#modal-add-pengguna"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body p-1">
                <table id="pengguna" class="table">
                  <thead>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Lengkap</th>
                    <th>username</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody id="table-body-pengguna">
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

  <div class="modal fade" id="modal-add-pengguna" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-add-Pengguna" method="POST">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" name="nama_user" class="form-control">
            </div>
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control">
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="password" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md">
                  <label>Status</label>
                  
                  <div class="form-group d-inline">
                    <div class="form-check">
                      <input type="radio" name="status" id="status_aktif" class="form-check-input" value="1">
                      <label class="form-check-label">Aktif</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" name="status" id="status_tidak_aktif" class="form-check-input" value="0">
                      <label class="form-check-label">Tidak Aktif</label>
                    </div>
                  </div>

              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Foto</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="foto" id="customFile2" required="">
                    <label class="custom-file-label" for="customFile2">Pilih file</label>
                  </div>
                </div>
              </div>
            </div>
                    
            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-update-pengguna" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-update-Pengguna" method="POST">
            <input type="hidden" name="id_update">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" name="nama_user_update" class="form-control">
            </div>
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username_update" class="form-control">
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="password_update" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md">
                  <label>Status</label>
                  
                  <div class="form-group d-inline">
                    <div class="form-check">
                      <input type="radio" name="status_update" id="status_aktif" class="form-check-input" value="1">
                      <label class="form-check-label">Aktif</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" name="status_update" id="status_tidak_aktif" class="form-check-input" value="0">
                      <label class="form-check-label">Tidak Aktif</label>
                    </div>
                  </div>

              </div>
              <div class="col-md">
                <div class="form-group">
                  <label>Foto</label>
                  <div class="custom-file">
                    <input type="text" hidden name="foto_lama">
                    <input type="file" class="custom-file-input" name="foto_update" id="customFile2" required="">
                    <label class="custom-file-label" for="customFile2">Pilih file</label>
                  </div>
                </div>
              </div>
            </div>
                    
            <button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>