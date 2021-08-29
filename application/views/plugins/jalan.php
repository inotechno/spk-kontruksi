<script src="http://maps.googleapis.com/maps/api/js"></script>

<script type="text/javascript">
  $(function () {
  daftar_jalan();
   
	function daftar_jalan() {
		$.ajax({
    		url: '<?= base_url('MasterData/daftar_jalan') ?>',
    		type: 'POST',
    		dataType: 'HTML',
    		async:false,
    		success:function (html) {
    			$('#table-body-jalan').html(html);
    		}
    	});
	}

  function delete_jalan(id) {
    $.ajax({
      url: '<?= base_url('MasterData/delete_jalan') ?>',
      type: 'GET',
      dataType: 'JSON',
      data:{id:id},
      success:function (response) {
          if (response.status == 'success') {
            toastr.success(response.message);
          }else{
            toastr.error(response.message);
          }

          daftar_jalan();
      }
    });
    
  }

	$('#form-add-jalan').submit(function() {
    	var data = $(this).serialize();
    	$.ajax({
    		url: '<?= base_url('MasterData/add_jalan') ?>',
    		type: 'POST',
    		dataType: 'JSON',
    		data:data,
    		success:function (response) {
    			if (response.status == 'success') {
                  toastr.success(response.message);
                }else{
                  toastr.error(response.message);
                }

                $('#form-add-jalan')[0].reset();
                $('#modal-add-jalan').modal('hide');
                daftar_jalan();
    		}
    	});
    	
    	return false;
    });

    $('#form-update-jalan').submit(function() {
    	var data = $(this).serialize();
    	$.ajax({
    		url: '<?= base_url('MasterData/update_jalan') ?>',
    		type: 'POST',
    		dataType: 'JSON',
    		data:data,
    		success:function (response) {
    			if (response.status == 'success') {
                  toastr.success(response.message);
                }else{
                  toastr.error(response.message);
                }

                $('#form-update-jalan')[0].reset();
                $('#modal-update-jalan').modal('hide');
                daftar_jalan();
    		}
    	});
    	
    	return false;
    });
	
	$('#table-body-jalan').on('click', '.update_jalan', function() {
		var id = $(this).attr('data-id');
		var nama = $(this).attr('data-nama');
		var kec = $(this).attr('data-kecamatan');
		var kel = $(this).attr('data-kelurahan');
		var lat = $(this).attr('data-lat');
		var lng = $(this).attr('data-lng');

		$('[name="id_jalan_update"]').val(id);
		$('[name="nama_jalan_update"]').val(nama);
		$('[name="kecamatan_update"]').val(kec);
		$('[name="kelurahan_update"]').val(kel);
		$('[name="lat_update"]').val(lat);
		$('[name="lng_update"]').val(lng);

		$('#modal-update-jalan').modal('show');
		initialize_update(lat, lng);

	});

  $('#table-body-jalan').on('click', '.delete_jalan', function() {
    var id = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');

    toastr.warning('Apakah Anda Yakin Ingin Menghapus Jalan '+nama+'<br><button class="btn btn-danger btn-sm" id="delete-jalan" data-id="'+id+'">Yes</button><button class="btn btn-primary btn-sm">No</button>');
      $('#delete-jalan').click(function() {
        delete_jalan(id);
      });

  });

	$("#jalan").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [
      		{ extend: 'copy', className: 'btn-sm' },
          { extend: 'excel', className: 'btn-sm' },
          { extend: 'csv', className: 'btn-sm' },
          { extend: 'pdf', className: 'btn-sm' },
          { extend: 'print', className: 'btn-sm' }
      ]
    }).buttons().container().appendTo('#jalan_wrapper .col-md-6:eq(0)');
  
});

  function showPosition() {
      if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
              const positionInfo = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };

          });
      } else {
          alert("Sorry, your browser does not support HTML5 geolocation.");
      }
  }

  var marker;
  function taruhMarker(peta, posisiTitik){
   if( marker ){
      // pindahkan marker
      marker.setPosition(posisiTitik);
    } else {
      // buat marker baru
      marker = new google.maps.Marker({
        position: posisiTitik,
        map: peta
      });
    }

    // isi nilai koordinat ke form

  document.getElementById("lat").value = posisiTitik.lat();
  document.getElementById("lng").value = posisiTitik.lng();
}
  
function initialize() {
  var propertiPeta = {
    center:new google.maps.LatLng(-6.076854639,106.113010290),
    zoom:15,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };

  
  var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
  google.maps.event.addListener(peta, 'click', function(event) {
    taruhMarker(this, event.latLng);
  });
  
  if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(function (position) {
         const initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
         taruhMarkerUpdate(peta, initialLocation);
         peta.setCenter(initialLocation);

         console.log(initialLocation);
     });
  }
}

var marker_update;

  function taruhMarkerUpdate(peta, posisiTitik){
      
     if( marker_update ){
        // pindahkan marker
        marker_update.setPosition(posisiTitik);
      } else {
        // buat marker baru
        marker_update = new google.maps.Marker({
          position: posisiTitik,
          map: peta
        });
      }

      document.getElementById("lat_update").value = posisiTitik.lat();
      document.getElementById("lng_update").value = posisiTitik.lng();   
  }

  function initialize_update(lattitude, longitude) {

    var propertiPeta = {
      center:new google.maps.LatLng(-6.1169772,106.149635),
      zoom:9,
      mapTypeId:google.maps.MapTypeId.ROADMAP
  };
    
  var peta_update = new google.maps.Map(document.getElementById("googleMap_update"), propertiPeta);
    
    // membuat Marker
  var marker_update = new google.maps.Marker({
      position: new google.maps.LatLng(lattitude, longitude),
      map: peta_update,
      animation: google.maps.Animation.BOUNCE

  });

      google.maps.event.addListener(peta_update, 'click', function(event) {
         taruhMarkerUpdate(this, event.latLng);
      });
  }

// event jendela di-load  
  google.maps.event.addDomListener(window, 'load', initialize);
  google.maps.event.addDomListener(window, 'load', initialize_update);
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
</body>
</html>
