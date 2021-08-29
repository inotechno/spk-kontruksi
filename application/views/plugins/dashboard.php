
<script type="text/javascript">
  $(function () {
  chart();
  daftar_jalan();
  daftar_pengaduan();

	function daftar_jalan() {
		$.ajax({
    		url: '<?= base_url('Dashboard/get_jalan') ?>',
    		type: 'POST',
    		dataType: 'HTML',
    		async:false,
    		success:function (html) {
    			$('#table-body-jalan').html(html);
    		}
    	});
	}

  function daftar_pengaduan() {
    $.ajax({
        url: '<?= base_url('Dashboard/get_pengaduan') ?>',
        type: 'POST',
        dataType: 'HTML',
        async:false,
        success:function (html) {
          $('#table-body-pengaduan').html(html);
        }
      });
  }

	$("#jalan").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
  });

  $("#pengaduan").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
  });


    // Sales graph chart
    var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
    // $('#revenue-chart').get(0).getContext('2d');

    function chart() {

      $.ajax({
        url: '<?= base_url('Dashboard/chart_nilai_alternatif') ?>',
        type: 'GET',
        dataType: 'JSON',
        success:function (data) {
          console.log(data.nama_kriteria);
            var salesGraphChartData = {
              labels: data.nama_jalan,
              datasets: [
                {
                  label: 'Nilai Alternatif',
                  fill: false,
                  borderWidth: 2,
                  lineTension: 0,
                  spanGaps: true,
                  borderColor: '#efefef',
                  pointRadius: 3,
                  pointHoverRadius: 7,
                  pointColor: '#efefef',
                  backgroundColor : '#F93B3B',
                  pointBackgroundColor: '#efefef',
                  data: data.nilai
                }
              ]
          }

          var salesGraphChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
              display: false
            },
            scales: {
              xAxes: [{
                ticks: {
                  fontColor: '#efefef'
                },
                gridLines: {
                  display: false,
                  color: '#efefef',
                  drawBorder: false
                }
              }],
              yAxes: [{
                ticks: {
                  stepSize: 0.01,
                  fontColor: '#efefef'
                },
                gridLines: {
                  display: true,
                  color: '#efefef',
                  drawBorder: false
                }
              }]
            }
          }

          // This will get the first returned node in the jQuery collection.
          // eslint-disable-next-line no-unused-vars
          var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'bar',
            data: salesGraphChartData,
            options: salesGraphChartOptions
          })
        }
      });

    }


});

</script>

<!-- ChartJS -->
<script src="<?= site_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= site_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
</body>
</html>
