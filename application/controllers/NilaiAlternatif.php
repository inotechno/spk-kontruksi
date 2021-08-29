<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class NilaiAlternatif extends CI_Controller {

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
			$def['title'] = 'Nilai Alternatif | SPK Kontruksi';
			$this->breadcrumb->add('Nilai Alternatif', 'NilaiAlternatif');
			$def['thead'] = $this->NormalisasiModel->get_kriteria();

			$this->load->view('partials/head', $def);
			$this->load->view('partials/navbar');
			$this->load->view('partials/sidebar');
			$this->load->view('partials/breadcumb', $def);
			$this->load->view('nilaialternatif', $def);
			$this->load->view('partials/footer');
			$this->load->view('plugins/nilaialternatif');
		}

		public function nilai_alternatif()
		{
			$html = '';
			$jalan = $this->NormalisasiModel->get_normalisasi();
			$no = 1;
			$max = array();
			foreach ($jalan as $jl) {
				$html .= '
							<tr>
								<td class="text-center">'.$no++.'</td>
			                    <td>'.$jl->nama_jalan.'</td>';
			                    $kriteria = $this->NormalisasiModel->get_kriteria();
			                    foreach ($kriteria as $kr => $i) {
			                    	$nama_kriteria = str_replace(' ', '_', strtolower($i->nama_kriteria));
			                    	$max = $this->get_max($nama_kriteria);
			                    	$nilai = ($jl->$nama_kriteria!=0)?($jl->$nama_kriteria/$max):0;

			                    	$html .= '<td>'.$nilai.'</td>';
			                    }
				$html .=   '</tr>';
			}

			echo $html;
		}

		public function get_max($nama_kriteria)
		{
			$max = $this->NormalisasiModel->get_max($nama_kriteria);
			return $max->$nama_kriteria;
		}
	
	}
	
	/* End of file NilaiAlternatif.php */
	/* Location: ./application/controllers/NilaiAlternatif.php */
?>