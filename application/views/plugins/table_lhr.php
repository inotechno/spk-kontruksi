<script type="text/javascript">
	$(document).ready(function() {
		daftar_lhr();
		nilai_lhr();
		generate_field_kriteria();
		function daftar_lhr() {
			$.ajax({
				url: '<?= base_url("Table_LHR/get_kriteria_lhr") ?>',
				type: 'GET',
				dataType: 'HTML',
				success:function (data) {
					$('#daftar-lhr').html(data);
				}
			});
		}

		function nilai_lhr() {
			$.ajax({
				url: '<?= base_url("Table_LHR/get_nilai_kriteria_lhr") ?>',
				type: 'GET',
				dataType: 'HTML',
				success:function (data) {
					$('#table-body-lhr').html(data);
				}
			});
		}

		function delete_kriteria_lhr(id, nama) {
			$.ajax({
				url: '<?= base_url('Table_LHR/delete_kriteria_lhr') ?>',
				type: 'GET',
				dataType: 'JSON',
				data:{id:id, nama:nama},
				success:function (response) {
					if (response.status == 'success') {
	                  toastr.success(response.message);
	                }else{
	                  toastr.error(response.message);
	                }

	                setTimeout(function(){ 
	                  location.reload()
	                }, 1500);
				}
			});
			
			return false;
		}

		function generate_field_kriteria() {
	        $.ajax({
	            url: '<?= base_url('Table_LHR/generate_field_lhr') ?>',
	            type: 'GET',
	            dataType: 'HTML',
	            success:function (html) {
	                $('.field_lhr').html(html);
	            }
	        });
	    }

	    function generate_field_kriteria_update(id) {
	        $.ajax({
	            url: '<?= base_url('Table_LHR/generate_field_lhr_update') ?>',
	            type: 'GET',
	            dataType: 'HTML',
	            data:{id:id},
	            success:function (html) {
	                $('.field_lhr_update').html(html);
	            }
	        });
	    }

		$('#form-add-kriteria-lhr').submit(function() {
			var data = $(this).serialize();
	    	$.ajax({
	    		url: '<?= base_url('Table_LHR/add_kriteria_lhr') ?>',
	    		type: 'POST',
	    		dataType: 'JSON',
	    		data:data,
	    		success:function (response) {
	    			if (response.status == 'success') {
	                  toastr.success(response.message);
	                }else{
	                  toastr.error(response.message);
	                }

	                $('#form-add-kriteria-lhr')[0].reset();
	                $('#modal-add-kriteria-lhr').modal('hide');
	                daftar_lhr();

	                setTimeout(function(){ 
	                  location.reload()
	                }, 1500);
	    		}
	    	});
	    	
	    	return false;
		});

		$('#table-body-lhr').on('click', '.edit_table', function() {
			var nama = $(this).attr('data-nama');
			var id = $(this).attr('data-id');

			$('[name="id_jalan_update"]').val(id).trigger('change');

			generate_field_kriteria_update(id);
			$('#modal-update-nilai-lhr').modal('show');
		});	

		$('#table-body-lhr').on('click', '.delete_table', function() {
			var nama = $(this).attr('data-nama');
			var id = $(this).attr('data-id');

			$('[name="id_jalan_delete"]').val(id);
			$('#modal-delete-nilai-lhr').modal('show');
		});	

		$('#daftar-lhr').on('click', '.edit_kriteria_lhr', function() {
			var nama = $(this).attr('data-nama');
			var id = $(this).attr('data-id');

			$('[name="id"]').val(id);
			$('[name="nama_kriteria_lama"]').val(nama);
			$('[name="edit_nama_kriteria_lhr"]').val(nama);

			$('#modal-edit-kriteria-lhr').modal('show');
		});	

		$('#form-edit-kriteria-lhr').submit(function() {
			var data = $(this).serialize();
	    	$.ajax({
	    		url: '<?= base_url('Table_LHR/edit_kriteria_lhr') ?>',
	    		type: 'POST',
	    		dataType: 'JSON',
	    		data:data,
	    		success:function (response) {
	    			if (response.status == 'success') {
	                  toastr.success(response.message);
	                }else{
	                  toastr.error(response.message);
	                }

	                $('#form-add-kriteria-lhr')[0].reset();
	                $('#modal-edit-kriteria-lhr').modal('hide');
	                daftar_lhr();
	                setTimeout(function(){ 
	                  location.reload()
	                }, 1500);
	    		}
	    	});
	    	
	    	return false;
		});	

		$('#daftar-lhr').on('click', '.delete_kriteria_lhr', function() {
	    	var id = $(this).attr('data-id');
	    	var nama = $(this).attr('data-nama');
	    	
	    	toastr.warning('Apakah Anda Yakin Ingin Menghapus Kriteria '+nama+'<br><button class="btn btn-danger btn-sm" id="delete-kriteria-lhr" data-id="'+id+'">Yes</button><button class="btn btn-primary btn-sm">No</button>');
	    	$('#delete-kriteria-lhr').click(function() {
	    		delete_kriteria_lhr(id, nama);
	    	});
	    });

	    $('#form-add-nilai-lhr').submit(function() {
	    	var data = $(this).serialize();
	    	$.ajax({
	    		url: '<?= base_url('Table_LHR/add_nilai_lhr') ?>',
	    		type: 'POST',
	    		dataType: 'JSON',
	    		data:data,
	    		success:function (response) {
	    			if (response.status == 'success') {
	                  toastr.success(response.message);
	                }else{
	                  toastr.error(response.message);
	                }

	                $('#form-add-nilai-lhr')[0].reset();
	                $('#modal-add-nilai-lhr').modal('hide');
	                nilai_lhr();
	    		}
	    	});
	    	
	    	return false;
	    });

	    $('#form-update-nilai-lhr').submit(function() {
	    	var data = $(this).serialize();
	    	$.ajax({
	    		url: '<?= base_url('Table_LHR/update_nilai_lhr') ?>',
	    		type: 'POST',
	    		dataType: 'JSON',
	    		data:data,
	    		success:function (response) {
	    			if (response.status == 'success') {
	                  toastr.success(response.message);
	                }else{
	                  toastr.error(response.message);
	                }

	                $('#form-update-nilai-lhr')[0].reset();
	                $('#modal-update-nilai-lhr').modal('hide');
	                nilai_lhr();
	    		}
	    	});
	    	
	    	return false;
	    });

	    $('#form-delete-nilai-lhr').submit(function() {
	    	var data = $(this).serialize();
	    	$.ajax({
	    		url: '<?= base_url('Table_LHR/delete_nilai_lhr') ?>',
	    		type: 'POST',
	    		dataType: 'JSON',
	    		data:data,
	    		success:function (response) {
	    			if (response.status == 'success') {
	                  toastr.success(response.message);
	                }else{
	                  toastr.error(response.message);
	                }

	                $('#form-delete-nilai-lhr')[0].reset();
	                $('#modal-delete-nilai-lhr').modal('hide');
	                nilai_lhr();
	    		}
	    	});
	    	
	    	return false;
	    });
	});

</script>
</body>
</html>
