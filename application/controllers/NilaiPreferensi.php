<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class NilaiPreferensi extends CI_Controller {
	
		public function __construct()
		{
			parent::__construct();
			$this->load->model('NormalisasiModel');
			if ($this->session->userdata('status') != 'login') {
				redirect(base_url("Login",'refresh'));
			}
		}
	
		public function index()
		{
			$def['title'] = 'Nilai Preferensi | SPK Kontruksi';
			$this->breadcrumb->add('Nilai Preferensi', 'NilaiPreferensi');
			$def['thead'] = $this->NormalisasiModel->get_kriteria();

			$this->load->view('partials/head', $def);
			$this->load->view('partials/navbar');
			$this->load->view('partials/sidebar');
			$this->load->view('partials/breadcumb', $def);
			$this->load->view('nilaipreferensi', $def);
			$this->load->view('partials/footer');
			$this->load->view('plugins/nilaipreferensi');
		}

		public function nilai_preferensi()
		{
			$html = '';
			$jalan = $this->NormalisasiModel->get_preferensi();
			$no = 1;
			$max = array();
			$kp = 0;
			$pref = array();
			$pref1 = array();
			foreach ($jalan as $jl => $j) {
				$html .= '
							<tr>
			                    <td>'.$j->nama_jalan.'</td>';
			                    $kriteria = $this->NormalisasiModel->get_kriteria();
			                    foreach ($kriteria as $kr => $i) {
			                    	$nama_kriteria = str_replace(' ', '_', strtolower($i->nama_kriteria));
			                    	$max = $this->get_max($nama_kriteria);
			                    	$nilai = ($j->$nama_kriteria!=0)?($j->$nama_kriteria/$max):0;
			                    	$kp = $this->total_bobot($i->bobot_kriteria);

			                    	$html .= '<td>'.round($nilai*$kp, 3).'</td>';
			                    	$pref[$jl] += ($nilai*$kp);
			                    }
			                    	$pref1 = round($pref[$jl], 3);
			                    	$html .= '<td>'.$pref1.'</td>';

				$html .=   '</tr>';
			}

			echo $html;
		}

		public function get_max($nama_kriteria)
		{
			$max = $this->NormalisasiModel->get_max($nama_kriteria);
			return $max->$nama_kriteria;
		}

		public function total_bobot($nilai)
		{
			$totaln = $this->NormalisasiModel->get_total($nilai);
			return $totaln;
		}

	}
	
	/* End of file NilaiPreferensi.php */
	/* Location: ./application/controllers/NilaiPreferensi.php */
?>