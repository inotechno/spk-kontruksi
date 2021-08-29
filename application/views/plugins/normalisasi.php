
<script>
  $(function () {
    table_normalisasi();
    generate_field_jalan();
    generate_field_kriteria();

    function table_normalisasi() {
        $.ajax({
            url: '<?= base_url('Normalisasi/table_normalisasi') ?>',
            type: 'GET',
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#table-body-normalisasi').html(data);
            }
        });
    }

  	function generate_field_jalan() {
        $.ajax({
            url: '<?= base_url('Normalisasi/generate_field_jalan') ?>',
            type: 'GET',
            dataType: 'HTML',
            success:function (html) {
                $('[name="id_jalan"]').append(html);
                $('[name="id_jalan_update"]').append(html);
            }
        });
    }

    function generate_field_kriteria() {
        $.ajax({
            url: '<?= base_url('Normalisasi/generate_field_kriteria') ?>',
            type: 'GET',
            dataType: 'HTML',
            success:function (html) {
                $('.field_kriteria').html(html);
            }
        });
    }

    $('#form-add-normalisasi').submit(function() {
        var data = $(this).serialize();
        $.ajax({
            url: '<?= base_url('Normalisasi/insert_normalisasi') ?>',
            type: 'POST',
            dataType: 'JSON',
            data:data,
            success:function (response) {
                if (response.status == 'success') {
                  toastr.success(response.message);
                }else{
                  toastr.error(response.message);
                }

                $('#form-add-normalisasi')[0].reset();
                $('#modal-normalisasi').modal('hide');
                table_normalisasi();
            }
        });
        
        return false;
    });

    $('#form-update-normalisasi').submit(function() {
        var data = $(this).serialize();
        $.ajax({
            url: '<?= base_url('Normalisasi/update_normalisasi') ?>',
            type: 'POST',
            dataType: 'JSON',
            data:data,
            success:function (response) {
                if (response.status == 'success') {
                  toastr.success(response.message);
                }else{
                  toastr.error(response.message);
                }

                $('#form-update-normalisasi')[0].reset();
                $('#modal-update-normalisasi').modal('hide');
                table_normalisasi();
            }
        });
        
        return false;
    });

    $('#table-body-normalisasi').on('click', '.update_normalisasi', function() {
        var id = $(this).attr('data-id');
        var id_jalan = $(this).attr('data-nama');
        $('[name="id_bobot_jalan"]').val(id);
        $('[name="id_jalan_update"]').val(id_jalan);
        $('#modal-update-normalisasi').modal('show');

    });

$("#table-normalisasi").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [
            { extend: 'copy', className: 'btn-sm' },
            { extend: 'excel', className: 'btn-sm' },
            { extend: 'csv', className: 'btn-sm' },
            { extend: 'pdf', className: 'btn-sm' },
            { extend: 'print', className: 'btn-sm' }
      ]
    }).buttons().container().appendTo('#table-normalisasi_wrapper .col-md-6:eq(0)');
  
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
</script>
</body>
</html>
