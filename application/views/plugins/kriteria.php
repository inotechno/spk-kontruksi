
<script>
  $(function () {
  	daftar_kriteria();
  	$('#daftar-kriteria').sortable({
	    placeholder: 'sort-highlight',
	    handle: '.handle',
	    forcePlaceholderSize: true,
	    zIndex: 999999
	});


    // $("#table-kriteria").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

// Fungsi Kriteria  
    function daftar_kriteria() {
    	$.ajax({
    		url: '<?= base_url('MasterData/daftar_kriteria') ?>',
    		type: 'POST',
    		dataType: 'HTML',
    		success:function (html) {
    			$('#daftar-kriteria').html(html);
    		}
    	});
    	return false;
    }

    function delete_kriteria_by_id(id, nama) {
    	$.ajax({
			url: '<?= base_url('MasterData/delete_kriteria_by_id') ?>',
			type: 'GET',
			dataType: 'JSON',
			data:{id:id, nama:nama},
			success:function (response) {
				if (response.status == 'success') {
                  toastr.success(response.message);
                }else{
                  toastr.error(response.message);
                }
			}
		});
		
		return false;
    }
    
    $('#modal-add-kriteria').on('shown.bs.modal', function () {
	    $('[name="nama_kriteria"]').focus();
	}); 
    
    $('#form-add-kriteria').submit(function() {
    	var data = $(this).serialize();
    	$.ajax({
    		url: '<?= base_url('MasterData/add_kriteria') ?>',
    		type: 'POST',
    		dataType: 'JSON',
    		data:data,
    		success:function (response) {
    			if (response.status == 'success') {
                  toastr.success(response.message);
                }else{
                  toastr.error(response.message);
                }

                $('#form-add-kriteria')[0].reset();
                $('#modal-add-kriteria').modal('hide');
                daftar_kriteria();
    		}
    	});
    	
    	return false;
    });

    $('#daftar-kriteria').on('click', '.edit_kriteria', function() {
    	var id = $(this).attr('data-id');
    	var nama = $(this).attr('data-nama');
    	var bobot = $(this).attr('data-bobot');
    	$('#modal-edit-kriteria').modal('show');
    	$('[name="edit_bobot_kriteria"]').val(bobot);
    	$('[name="edit_nama_kriteria"]').val(nama);
        $('[name="edit_id_kriteria"]').val(id);
    	$('[name="kriteria_lama"]').val(nama);
	    $('#modal-edit-kriteria').on('shown.bs.modal', function () {
		    $('[name="edit_nama_kriteria"]').focus();
		}); 
    });

    $('#daftar-kriteria').on('click', '.delete_kriteria', function() {
    	var id = $(this).attr('data-id');
    	var nama = $(this).attr('data-nama');
    	var bobot = $(this).attr('data-bobot');
    	
    	toastr.warning('Apakah Anda Yakin Ingin Menghapus Kriteria '+nama+'<br><button class="btn btn-danger btn-sm" id="delete-kriteria-by-id" data-id="'+id+'">Yes</button><button class="btn btn-primary btn-sm">No</button>');
    	$('#delete-kriteria-by-id').click(function() {
    		delete_kriteria_by_id(id, nama);
    		daftar_kriteria(id);
    	});
    });

    $('#form-edit-kriteria').submit(function() {
    	var data = $(this).serialize();
    	$.ajax({
    		url: '<?= base_url('MasterData/edit_kriteria') ?>',
    		type: 'POST',
    		dataType: 'JSON',
    		data:data,
    		success:function (response) {
    			if (response.status == 'success') {
                  toastr.success(response.message);
                }else{
                  toastr.error(response.message);
                }

                $('#form-add-kriteria')[0].reset();
                $('#modal-edit-kriteria').modal('hide');
                daftar_kriteria();
    		}
    	});
    	
    	return false;
    });
// Fungsi Kriteria

// Fungsi Bobot Kriteria
	function view_bobot_kriteria(id) {
		$.ajax({
			url: '<?= base_url("MasterData/get_bobot_by_kriteria") ?>',
			type: 'GET',
			dataType: 'HTML',
			data:{id:id},
			success:function (html) {
				$('#table-body-bobot-kriteria').html(html);
			}
		});			
	}

	function delete_bobot_by_id(id) {
		$.ajax({
			url: '<?= base_url('MasterData/delete_bobot_by_id') ?>',
			type: 'GET',
			dataType: 'JSON',
			data:{id:id},
			success:function (response) {
				if (response.status == 'success') {
                  toastr.success(response.message);
                }else{
                  toastr.error(response.message);
                }
			}
		});
		
		return false;
	}

    function pilihan_kriteria() {
    	$.ajax({
    		url: '<?= base_url('MasterData/get_kriteria_all') ?>',
    		type: 'GET',
    		dataType: 'JSON',
    		success:function (data) {
    			for (let i = 0; i < data.length; i++) {
		          $('[name="id_kriteria"]').append('<option value="'+data[i].id_kriteria+'">'+data[i].nama_kriteria+'</option>');
		    	} 
    		}
    	});    
    }

    $('#modal-add-bobot-kriteria').on('shown.bs.modal', function () {
        $('[name="id_kriteria"]').empty();
        pilihan_kriteria();
    }); 

    $('#form-add-bobot-kriteria').submit(function() {
    	var data = $(this).serialize();
    	$.ajax({
    		url: '<?= base_url('MasterData/add_bobot_kriteria') ?>',
    		type: 'POST',
    		dataType: 'JSON',
    		data:data,
    		success:function (response) {
    			if (response.status == 'success') {
                  toastr.success(response.message);
                }else{
                  toastr.error(response.message);
                }

                $('[name="pilihan_bobot"]').val('');
                $('[name="keterangan"]').val('');
                $('[name="nilai"]').val('');

                $('#modal-add-bobot-kriteria').modal('hide');
                daftar_kriteria();
    		}
    	});
    	
    	return false;
    });

    $('#daftar-kriteria').on('click', '.view_bobot', function() {
    	var id = $(this).attr('data-id');
    	var nama = $(this).attr('data-nama');
    	view_bobot_kriteria(id);
    });

    $('#table-body-bobot-kriteria').on('click', '.delete_bobot', function() {
    	var id = $(this).attr('data-id');
    	var id_kriteria = $(this).attr('data-id-kriteria');
    	toastr.warning('Apakah Anda Yakin Ingin Menghapus Data Ini ? <br><button class="btn btn-danger btn-sm" id="delete-bobot-by-id" data-id="'+id+'">Yes</button><button class="btn btn-primary btn-sm">No</button>');
    	$('#delete-bobot-by-id').click(function() {
    		delete_bobot_by_id(id);
    		view_bobot_kriteria(id_kriteria);
    	});
    });

// Fungsi Bobot Kriteria
  });
</script>
</body>
</html>
