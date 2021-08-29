<!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          
          <div class="col-md-12">
             <!-- solid sales graph -->
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Nilai Alternatif
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">
                 Daftar Pengaduan
                </h3>
              </div>
              <div class="card-body p-1 table-responsive" style="height: 300px;">
                <table id="pengaduan" class="table table-head-fixed text-nowrap table-striped">
                  <thead>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Jalan</th>
                    <th>Nama Lengkap</th>
                    <th>Hp</th>
                    <th>Email</th>
                    <th>Keterangan</th>
                  </thead>
                  <tbody id="table-body-pengaduan">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                 Daftar Jalan
                </h3>
              </div>
              <div class="card-body p-1 table-responsive" style="height: 300px;">
                <table id="jalan" class="table table-head-fixed text-nowrap">
                  <thead>
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Koordinat</th>
                  </thead>
                  <tbody id="table-body-jalan">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->