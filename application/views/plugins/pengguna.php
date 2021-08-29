<script src="http://maps.googleapis.com/maps/api/js"></script>

<script type="text/javascript">
  $(function () {
  bsCustomFileInput.init();
  daftar_pengguna();
   
	function daftar_pengguna() {
		$.ajax({
    		url: '<?= base_url('MasterData/list_pengguna') ?>',
    		type: 'POST',
    		dataType: 'HTML',
    		async:false,
    		success:function (html) {
    			$('#table-body-pengguna').html(html);
    		}
    	});
	}

  function delete_kriteria_by_id(id, foto) {
    $.ajax({
      url: '<?= base_url("MasterData/delete_user") ?>',
      type: 'POST',
      dataType: 'JSON',
      data:{id:id, foto:foto},
      success:function (response) {
         if (response.status == 'success') {
            toastr.success(response.message);
          }else{
            toastr.error(response.message);
          }

          daftar_pengguna();
      }
    });
    
  }

  $("#pengguna").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [
          { extend: 'copy', className: 'btn-sm' },
            { extend: 'excel', className: 'btn-sm' },
            { extend: 'csv', className: 'btn-sm' },
            { extend: 'pdf', className: 'btn-sm' },
            { extend: 'print', className: 'btn-sm' }
      ]
  }).buttons().container().appendTo('#pengguna_wrapper .col-md-6:eq(0)');
  
  $('#table-body-pengguna').on('click', '.update_user', function() {
    var id = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');
    var username = $(this).attr('data-username');
    var status = $(this).attr('data-status');
    var foto = $(this).attr('data-foto');

    $('[name="id_update"]').val(id);
    $('[name="nama_user_update"]').val(nama);
    $('[name="username_update"]').val(username);
    $('[name="foto_lama"]').val(foto);
    if (status == 1) {
      $('#status_aktif').prop('checked', true);
      $('#status_tidak_aktif').prop('checked', false);
    }else{
      $('#status_aktif').prop('checked', false);
      $('#status_tidak_aktif').prop('checked', true);
    }

    $('#modal-update-pengguna').modal('show');
  });

  $('#table-body-pengguna').on('click', '.delete_user', function() {
    var id = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');
    var foto = $(this).attr('data-foto');

    toastr.warning('Apakah Anda Yakin Ingin Menghapus Data User '+nama+'<br><button class="btn btn-danger btn-sm" id="delete-kriteria-by-id">Yes</button><button class="btn btn-primary btn-sm">No</button>');
      $('#delete-kriteria-by-id').click(function() {
        delete_kriteria_by_id(id, foto);
      });
  });

  $('#form-add-Pengguna').on('submit', function() {
    var formData = new FormData();
    formData.append('nama_user', $('[name="nama_user"]').val()); 
    formData.append('username', $('[name="username"]').val()); 
    formData.append('password', $('[name="password"]').val()); 
    formData.append('status', $('[name="status"]').val()); 
    formData.append('foto', $('[name="foto"]')[0].files[0]);

    $.ajax({
        url: '<?= base_url("MasterData/add_user") ?>',
        type: 'POST',
        data:formData,
        cache:false,
        dataType:'JSON',
        processData: false,
        contentType: false,
        success:function (response) {

            if (response.status == 'success') {
              toastr.success(response.message);
            }else{
              toastr.error(response.message);
            }

            $('#form-add-Pengguna')[0].reset();
            $('#modal-add-pengguna').modal('hide');
            daftar_pengguna();
        }
    });
    
    return false;
  });

  $('#form-update-Pengguna').on('submit', function() {
    var formData = new FormData();
    formData.append('id', $('[name="id_update"]').val()); 
    formData.append('nama_user', $('[name="nama_user_update"]').val()); 
    formData.append('username', $('[name="username_update"]').val()); 
    formData.append('password', $('[name="password_update"]').val()); 
    formData.append('status', $('[name="status_update"]').val()); 
    formData.append('foto_lama', $('[name="foto_lama"]').val());
    formData.append('foto', $('[name="foto_update"]')[0].files[0]);

    $.ajax({
        url: '<?= base_url("MasterData/update_user") ?>',
        type: 'POST',
        data:formData,
        cache:false,
        dataType:'JSON',
        processData: false,
        contentType: false,
        success:function (response) {

            if (response.status == 'success') {
              toastr.success(response.message);
            }else{
              toastr.error(response.message);
            }

            $('#form-update-Pengguna')[0].reset();
            $('#modal-update-pengguna').modal('hide');
            daftar_pengguna();
        }
    });
    
    return false;
  });
});
</script>

<script src="<?= site_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
</body>
</html>
