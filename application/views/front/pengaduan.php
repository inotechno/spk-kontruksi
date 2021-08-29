
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <table class="table" id="jalan">
                    <thead>
                        <th>No</th>
                        <th>Nama Jalan</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>Koordinat</th>
                        <th>Pengaduan</th>
                    </thead>
                    <tbody id="table-body-jalan"></tbody>
                </table>
            </div>
           
        </div>

        <div class="modal fade" id="modal-pengaduan" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Pengaduan Jalan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form id="form-pengaduan" method="POST">
                    <input type="hidden" name="id_jalan">
                    <div class="form-group">
                      <label>Nama Jalan</label>
                      <input type="text" name="nama_jalan" class="form-control" readonly="">
                    </div>
                    <div class="row">
                      <div class="col-md">
                        <div class="form-group">
                          <label>Kecamatan</label>
                          <input type="text" name="kecamatan" class="form-control" readonly="">
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <label>Kelurahan</label>
                          <input type="text" name="kelurahan" class="form-control" readonly="">
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md">
                        <div class="form-group">
                          <label>Lattitude</label>
                          <input type="text" name="lat" id="lat" class="form-control" readonly="" readonly="">
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-group">
                          <label>Longitude</label>
                          <input type="text" name="lng" id="lng" class="form-control" readonly="" readonly="">
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>HP</label>
                                <input type="number" name="hp" class="form-control">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-md">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" required=""></textarea>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md">
                            <div class="form-group">
                              <label for="customFile">Gambar 1</label>

                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="img1" id="customFile" required="">
                                <label class="custom-file-label" for="customFile">Pilih file</label>
                              </div>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-group">
                              <label for="customFile">Gambar 2</label>

                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="img2" id="customFile2" required="">
                                <label class="custom-file-label" for="customFile2">Pilih file</label>
                              </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary float-right mt-2">Simpan</button>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>