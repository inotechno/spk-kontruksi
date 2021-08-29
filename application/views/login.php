<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PUPR</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= site_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= site_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">

  <link rel="stylesheet" href="<?= site_url('assets/plugins/toastr/toastr.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= site_url('assets/dist/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>PUPR</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="form-login" method="post">
        <div class="input-group mb-2">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-2">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block" id="btn-login">Sign In</button>
        
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= site_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= site_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<script src="<?= site_url('assets/plugins/toastr/toastr.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= site_url('assets/dist/js/adminlte.min.js') ?>"></script>

<script type="text/javascript">
  $(document).ready(function() {
      $('#form-login').on('submit', function() {
          
          $.ajax({
              url: '<?= site_url('Login/proses_login') ?>',
              type: 'POST',
              dataType:'JSON',
              data: $(this).serialize(),
              beforeSend: function()
              { 
                  $("#btn-login").attr('disabled', '');
                  $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span>   Sending ...');
              },
              success:function(response) {
                if (response.status == 'success') {
                  toastr.success(response.message);
                }else{
                  toastr.error(response.message);
                }
                setTimeout(function(){ 
                  window.location.href = response.redirect;
                }, 1500);
              }
          });

          return false;
      });
  });
</script>
</body>
</html>
