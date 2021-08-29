<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Dashboard extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('NormalisasiModel');
			$this->load->model('MasterModel');
			$this->load->model('PengaduanModel');

			if ($this->session->userdata('status') != 'login') {
				redirect(base_url('Login','refresh'));
			}
		}
	
		public function index()
		{
			$def['title'] = 'Dashboard | SPK Kontruksi';
			$this->breadcrumb->add('Dashboard', 'dashboard');

			$this->load->view('partials/head', $def);
			$this->load->view('partials/navbar');
			$this->load->view('partials/sidebar');
			$this->load->view('partials/breadcumb', $def);
			$this->load->view('dashboard');
			$this->load->view('partials/footer');
			$this->load->view('plugins/dashboard');
		}

		public function chart_nilai_alternatif()
		{
			$data = array();
			$jalan = $this->NormalisasiModel->get_preferensi();
			$nilai = array();
			$bobot = array();
			$max = array();

			foreach ($jalan as $jl => $j) {
				$kriteria = $this->NormalisasiModel->get_kriteria();
				foreach ($kriteria as $i => $ii) {
					$data['nama_kriteria'][$i] = $ii->nama_kriteria;
   					$nama_kriteria = str_replace(' ', '_', strtolower($ii->nama_kriteria));
					$nilai[$i][$jl] = $j->$nama_kriteria;
					$max[$i] = max($nilai[$i]);
					$bobot[$i][] = round(($ii->bobot_kriteria/$this->total_bobot()->total_bobot), 3);
				}
				$data['nama_jalan'][$jl] = $j->nama_jalan;
				// echo $this->db->last_query($kriteria);
			}
			$data['nilai'] = $this->bagi($nilai, $max, $bobot);
			echo json_encode($data);
			
				// echo json_encode($data);


			// $max = array();
			// $kp = 0;
			// $pref = array();
			// $pref1 = array();

			// foreach ($jalan as $jl => $j) {

			// 	    $kriteria = $this->NormalisasiModel->get_kriteria();
   //                  foreach ($kriteria as $kr => $i) {
   //                  	$nama_kriteria = str_replace(' ', '_', strtolower($i->nama_kriteria));
   //                  	$max = $this->get_max($nama_kriteria);
   //                  	$nilai = ($j->$nama_kriteria!=0)?($j->$nama_kriteria/$max):0;
   //                  	$kp = $this->total_bobot($i->bobot_kriteria);

   //                  	// $html .= '<td>'.round($nilai*$kp, 3).'</td>';
   //                  	$pref[$jl] += ($nilai*$kp);
   //                  }
   //                  	$pref1 = round($pref[$jl], 3);
   //                  	// $html .= '<td>'.$pref1.'</td>';
			// }

			// echo json_encode($pref1);


		}

		public function get_jalan()
		{
			$html = '';
			$pre = $this->MasterModel->get_jalan();

			if ($pre->num_rows() > 0) {
				$no = 1;
				foreach ($pre->result() as $dt) {
					$html .= '
								<tr>
				                    <td class="text-center">'.$no++.'</td>
				                    <td>'.$dt->nama_jalan.'</td>
				                    <td>'.$dt->kecamatan.'</td>
				                    <td>'.$dt->kelurahan.'</td>
				                    <td><a href="https://www.google.com/maps/place/'.$dt->lat.','.$dt->lng.'" target="_blank">'.$dt->lat.', '.$dt->lng.'</a></td>
				                </tr>
					';
				}
			}else{
				$html .= '
							<tr>
			                    <td class="text-center" colspan="6">Tidak Ada Data</td>
			                </tr>
				        ';
			}

			echo $html;
		}

		public function get_pengaduan()
		{
			$html = '';
			$pre = $this->PengaduanModel->get_pengaduan();

			if ($pre->num_rows() > 0) {
				$no = 1;
				foreach ($pre->result() as $dt) {
					$html .= '
								<tr>
				                    <td class="text-center">'.$no++.'</td>
				                    <td>
				                    	<a href="'.site_url('assets/img/pengaduan/'.$dt->img1).'" target="_blank">
				                    		<img src="'.site_url('assets/img/pengaduan/'.$dt->img1).'" height="50" width="50">
				                    	</a>
				                    	<a href="'.site_url('assets/img/pengaduan/'.$dt->img2).'" target="_blank">
				                    		<img src="'.site_url('assets/img/pengaduan/'.$dt->img2).'" height="50" width="50">
				                    	</a>
				                    </td>
				                    <td>'.$dt->nama_jalan.'</td>
				                    <td>'.$dt->nama_lengkap.'</td>
				                    <td>'.$dt->hp.'</td>
				                    <td>'.$dt->email.'</td>
				                    <td>'.$dt->keterangan.'</td>
				                </tr>
					';
				}
			}else{
				$html .= '
							<tr>
			                    <td class="text-center" colspan="6">Tidak Ada Data</td>
			                </tr>
				        ';
			}

			echo $html;
		}

		public function bagi($nilai, $max, $bobot)
		{
			$data = array();
			$bbt = array();

			for ($baris=0; $baris < count($nilai); $baris++) { 
				for ($kolom=0; $kolom < count($nilai[$baris]); $kolom++) { 
					// $data['nilai'][$baris][$kolom] = $nilai[$baris][$kolom].' ';
					// $data['max'][$baris][$kolom] = $max[$baris].' ';
					$nilai[$baris][$kolom] = $nilai[$baris][$kolom] / $max[$baris];
					$bobot[$kolom][] = $bobot[$baris][$kolom];
					$bbt[$kolom][] = ($nilai[$baris][$kolom]*$bobot[$baris][$kolom]);
					$data[$kolom] = array_sum($bbt[$kolom]);
				}
			}

			return $data;
		}

		public function total_bobot()
		{
			$this->db->select('SUM(bobot_kriteria) as total_bobot');
			return $this->db->get('kriteria')->row();
		}

	
	}
	
	/* End of file Dashboard.php */
	/* Location: ./application/controllers/Dashboard.php */
?>