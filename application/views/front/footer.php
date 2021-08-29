
        <div class="alert alert-warning" style="display: none;" role="alert">
          <strong class="type-alert"></strong> <p class="message"></p>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="<?= site_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= site_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
        <script src="<?= site_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
        <script src="<?= site_url('front/js/scripts.js') ?>"></script>
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
            });

            daftar_jalan();
   
            function daftar_jalan() {
                $.ajax({
                    url: '<?= base_url('Pengaduan/get_jalan') ?>',
                    type: 'POST',
                    dataType: 'HTML',
                    async:false,
                    success:function (html) {
                        $('#table-body-jalan').html(html);
                    }
                });
            }

            $("#jalan").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
            });

            $('#table-body-jalan').on('click', '.btn-pengaduan', function() {
                $('#modal-pengaduan').modal('show');
                var id_jalan = $(this).attr('data-id');
                var nama_jalan = $(this).attr('data-nama');
                var kecamatan = $(this).attr('data-kecamatan');
                var kelurahan = $(this).attr('data-kelurahan');
                var lat = $(this).attr('data-lat');
                var lng = $(this).attr('data-lng');

                $('[name="id_jalan"]').val(id_jalan);
                $('[name="nama_jalan"]').val(nama_jalan);
                $('[name="kecamatan"]').val(kecamatan);
                $('[name="kelurahan"]').val(kelurahan);
                $('[name="lat"]').val(lat);
                $('[name="lng"]').val(lng);

            });

            $('#form-pengaduan').submit(function() {
                var formData = new FormData();
                formData.append('id_jalan', $('[name="id_jalan"]').val()); 
                formData.append('nama_lengkap', $('[name="nama_lengkap"]').val()); 
                formData.append('hp', $('[name="hp"]').val()); 
                formData.append('email', $('[name="email"]').val()); 
                formData.append('keterangan', $('[name="keterangan"]').val()); 
                formData.append('img1', $('[name="img1"]')[0].files[0]);
                formData.append('img2', $('[name="img2"]')[0].files[0]);

                $.ajax({
                    url: '<?= base_url("Pengaduan/kirim_pengaduan") ?>',
                    type: 'POST',
                    data:formData,
                    cache:false,
                    processData: false,
                    contentType: false,
                    success:function (response) {

                        $('.type-alert').html(response.type);
                        $('.message').html(response.message);

                        $('.alert').show();
                        $('#modal-pengaduan').modal('hide');
                        $('#form-pengaduan')[0].reset();

                        // setTimeout(function(){ 
                        //   location.reload()
                        // }, 1500);
                    }
                });
                
                return false;
            });

        </script>
    </body>
</html>
