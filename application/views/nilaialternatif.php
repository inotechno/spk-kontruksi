<!-- Main content -->
  <section class="content">
      <div class="container-fluid">
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
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <?php 
                      foreach ($thead as $kr) {?>
                        <th><?= $kr->nama_kriteria ?></th>
                      <?php } 
                    ?>
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
