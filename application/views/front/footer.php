
        <div class="alert alert-warning" style="display: none;" role="alert">
          <strong class="type-alert"></strong> <p class="message"></p>
        </div>
        <!-- Footer-->
        <footer class="py-3 bg-dark">
            <div class="container px-4 px-lg-"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="<?= site_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= site_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
        <script src="<?= site_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
        <script src="<?= site_url('front/js/scripts.js') ?>"></script>
        <script src="http://maps.googleapis.com/maps/api/js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(function () {
                  bsCustomFileInput.init();
                });
                list_alternatif();
                function list_alternatif() {
                    $.ajax({
                        url: '<?= base_url('Home/list_alternatif') ?>',
                        type: 'GET',
                        dataType: 'HTML',
                        success:function (html) {
                            $('#list-alternatif').html(html);
                        }
                    });
                    
                }
                daftar_jalan();
       
                function daftar_jalan() {
                    $.ajax({
                        url: '<?= base_url('Pengaduan/get_pengaduan') ?>',
                        type: 'POST',
                        dataType: 'HTML',
                        async:false,
                        success:function (html) {
                            $('#table-body-pengaduan').html(html);
                        }
                    });
                }

                $('#btn-addPengaduan').click(function() {
                    $('#modal-addPengaduan').modal('show');
                });

                $("#pengaduan").DataTable({
                  "responsive": true, "lengthChange": false, "autoWidth": false,
                });


                $('#form-pengaduan').submit(function() {
                    var formData = new FormData();
                    formData.append('nama_jalan', $('[name="nama_jalan"]').val()); 
                    formData.append('lat', $('[name="lat"]').val()); 
                    formData.append('lng', $('[name="lng"]').val()); 
                    formData.append('nama_lengkap', $('[name="nama_lengkap"]').val()); 
                    formData.append('hp', $('[name="hp"]').val()); 
                    formData.append('email', $('[name="email"]').val()); 
                    formData.append('keterangan', $('[name="keterangan"]').val()); 
                    formData.append('img1', $('[name="img1"]')[0].files[0]);
                    formData.append('img2', $('[name="img2"]')[0].files[0]);

                    $.ajax({
                        url: '<?= base_url("Pengaduan/kirim_pengaduan") ?>',
                        type: 'POST',
                        dataType:'JSON',
                        data:formData,
                        cache:false,
                        processData: false,
                        contentType: false,
                        success:function (response) {

                            $('.type-alert').html(response.type);
                            $('.message').html(response.message);

                            $('.alert').show();
                            $('#modal-addPengaduan').modal('hide');
                            $('#form-pengaduan')[0].reset();

                            // setTimeout(function(){ 
                            //   location.reload()
                            // }, 1500);
                            daftar_jalan();
                        }
                    });
                    
                    return false;
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
                  
                }

                // event jendela di-load  
                  google.maps.event.addDomListener(window, 'load', initialize);
            });


        </script>
    </body>
</html>
