
<script>
  $(function () {
    nilai_preferensi();

    function nilai_preferensi() {
        $.ajax({
            url: '<?= base_url('NilaiPreferensi/nilai_preferensi') ?>',
            type: 'GET',
            dataType: 'HTML',
            async:false,
            success:function (data) {
                $('#table-body-alternatif').html(data);
            }
        });
    }

$("#table-alternatif").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [
            { extend: 'copy', className: 'btn-sm' },
            { extend: 'excel', className: 'btn-sm' },
            { extend: 'csv', className: 'btn-sm' },
            { extend: 'pdf', className: 'btn-sm' },
            { extend: 'print', className: 'btn-sm' }
      ],
      "order":[[6, "desc"]]
    }).buttons().container().appendTo('#table-alternatif_wrapper .col-md-6:eq(0)');
  
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
