<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Normalisasi extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('NormalisasiModel');
			$this->load->model('Table_LHRModel');
			if ($this->session->userdata('status') != 'login') {
				redirect(base_url("Login",'refresh'));
			}
		}
	
		public function index()
		{
			$def['title'] = 'Normalisasi | SPK Kontruksi';
			$this->breadcrumb->add('Normalisasi', 'normalisasi');
			$def['thead'] = $this->NormalisasiModel->get_kriteria();
			
			$this->load->view('partials/head', $def);
			$this->load->view('partials/navbar');
			$this->load->view('partials/sidebar');
			$this->load->view('partials/breadcumb', $def);
			$this->load->view('normalisasi', $def);
			$this->load->view('partials/footer');
			$this->load->view('plugins/normalisasi');
		}

		public function table_normalisasi()
		{
			$html = '';
			$jalan = $this->NormalisasiModel->get_normalisasi();
			$no = 1;
			foreach ($jalan as $jl) {
				$html .= '
							<tr>
								<td class="text-center">'.$no++.'</td>
			                    <td>'.$jl->nama_jalan.'</td>';
			                    $kriteria = $this->NormalisasiModel->get_kriteria();
			                    foreach ($kriteria as $kr) {
			                    	$nama_kriteria = str_replace(' ', '_', strtolower($kr->nama_kriteria));
			                    	$html .= '<td>'.$jl->$nama_kriteria.'</td>';
			                    }
				$html .=   '	<td>
											<button class="btn btn-xs btn-warning update_normalisasi" data-id="'.$jl->id_bobot_jalan.'" data-nama="'.$jl->id_jalan.'"><span class="fas fa-pencil-alt"></span></button>
								
											<button class="btn btn-xs btn-danger delete_normalisasi" data-id="'.$jl->id_bobot_jalan.'" data-nama="'.$jl->id_jalan.'"><span class="fas fa-trash-alt"></span></button>
										
								</td>
							</tr>';
			}

			echo $html;
		}

		public function generate_field_jalan()
		{
			$html = '';

			$pre = $this->Table_LHRModel->get_lhr();
			$kriteria = $this->Table_LHRModel->get_kriteria();
			$field = array();
			$total = array();
			$total_nilai = 0;

			if ($pre->num_rows() > 0) {
				$no = 1;
				foreach ($pre->result() as $d => $dt) {

					foreach ($kriteria->result() as $k => $kr) {
						$field = str_replace(' ', '_', strtolower($kr->nama_kriteria_lhr));
						$total[$k] = $dt->$field;
						$total_nilai = array_sum($total)*1.28; 
					}
					$html .= '<option value="'.$dt->id_jalan.'">'.$dt->nama_jalan.' | Nilai LHR = '.$total_nilai.'</option>';
				}
			}

			echo $html;
		}

		public function generate_field_kriteria()
		{
			$html = '';
			$kriteria = $this->NormalisasiModel->get_kriteria();
			foreach ($kriteria as $kr) {
				$kriteria = str_replace(' ', '_', strtolower($kr->nama_kriteria));
				$html .= '<div class="col">
			                <div class="form-group">
			                  <label>'.$kr->nama_kriteria.'</label>
			                  <select name="'.$kriteria.'" class="form-control">';
				                  $bobot = $this->NormalisasiModel->get_bobot($kr->id_kriteria);
				                  foreach ($bobot as $bt) {
				                  	$html .= '<option value="'.$bt->nilai_kriteria.'">'.$bt->pilihan_bobot.' | '.$bt->keterangan.'</option>';
				                  }
              	$html .= 	 '</select>
              				</div>
              			  </div>';
			}

			echo $html;
		}

		public function insert_normalisasi()
		{
			$data['id_jalan'] = $this->input->post('id_jalan');
			$data['created_by'] = $this->session->userdata('id');

			$val = $this->NormalisasiModel->validasi($data['id_jalan']);
			if ($val->num_rows() > 0) {
				$response = array(
					'status' => 'error',
					'message' => 'Data Jalan Sudah Tersedia !'
				);
			}else{
				
				$kriteria = $this->NormalisasiModel->get_kriteria();
				foreach ($kriteria as $kr) {
					$data[str_replace(' ', '_', strtolower($kr->nama_kriteria))] = $this->input->post(str_replace(' ', '_', strtolower($kr->nama_kriteria)));
				}
			    
			    $pre = $this->NormalisasiModel->save_nilai($data); 

			    if ($pre) {
					$response = array(
						'status' => 'success',
						'message' => 'Data Normalisasi Berhasil Ditambahkan'
					);
				}else{
					$response = array(
						'status' => 'error',
						'message' => 'Data Normalisasi Gagal Di Tambahkan !'
					);
				}
			}

			echo json_encode($response);
		}

		public function update_normalisasi()
		{
			$id_bobot_jalan = $this->input->post('id_bobot_jalan');

			$kriteria = $this->NormalisasiModel->get_kriteria();
			foreach ($kriteria as $kr) {
				$data[str_replace(' ', '_', strtolower($kr->nama_kriteria))] = $this->input->post(str_replace(' ', '_', strtolower($kr->nama_kriteria)));
			}
		    
		    $pre = $this->NormalisasiModel->update_nilai($id_bobot_jalan, $data); 

		    if ($pre) {
				$response = array(
					'status' => 'success',
					'message' => 'Data Normalisasi Berhasil Diubah'
				);
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Data Normalisasi Gagal Diubah !'
				);
			}

			echo json_encode($response);
		}

		public function delete_normalisasi()
		{
			$id = $this->input->get('id');
			$pre = $this->NormalisasiModel->delete_normalisasi($id);
			if ($pre) {
				$response = array(
					'status' => 'success',
					'message' => 'Data Normalisasi Berhasil Dihapus'
				);
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Data Normalisasi Gagal Dihapus !'
				);
			}

			echo json_encode($response);
		}
	
	}
	
	/* End of file Normalisasi.php */
	/* Location: ./application/controllers/Normalisasi.php */
?>