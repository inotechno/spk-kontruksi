<!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <!-- <div class="row">
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><h1>1</h1></span>

              <div class="info-box-content">
                <span class="info-box-text rank-1"></span>
                <span class="info-box-number nilai-rank-1"></span>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><h1>2</h1></span>

              <div class="info-box-content">
                <span class="info-box-text rank-2"></span>
                <span class="info-box-number nilai-rank-2"></span>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><h1>3</h1></span>

              <div class="info-box-content">
                <span class="info-box-text rank-3"></span>
                <span class="info-box-number nilai-rank-3"></span>
              </div>
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-row card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  Nilai Alternatif
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-1" id="body-alternatif">
                <table class="table table-sm table-bordered" id="table-alternatif">
                  <thead>
                    <th>Nama Jalan</th>
                    <?php 
                      foreach ($thead as $kr) {?>
                        <th><?= $kr->nama_kriteria ?></th>
                      <?php } 
                    ?>
                    <th>Preferensi</th>
                  </thead>
                  <tbody id="table-body-alternatif"></tbody>
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
