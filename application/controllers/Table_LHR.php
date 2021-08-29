<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Table_LHR extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Table_LHRModel');
			$this->load->model('MasterModel');
			$this->load->dbforge();
			if ($this->session->userdata('status') != 'login') {
				redirect(base_url("Login",'refresh'));
			}

		}
	
		public function index()
		{
			$def['title'] = 'Table LHR | SPK Kontruksi';
			$this->breadcrumb->add('LHR', 'lhr');
			$data['thead'] = $this->Table_LHRModel->get_kriteria()->result();
			$data['jalan'] = $this->MasterModel->get_jalan()->result();

			$this->load->view('partials/head', $def);
			$this->load->view('partials/navbar');
			$this->load->view('partials/sidebar');
			$this->load->view('partials/breadcumb', $def);
			$this->load->view('table_lhr', $data);
			$this->load->view('partials/footer');
			$this->load->view('plugins/table_lhr');
		}

		public function get_kriteria_lhr()
		{
			$html = '';
			$pre = $this->Table_LHRModel->get_kriteria();

			if ($pre->num_rows() > 0) {
				foreach ($pre->result() as $dt) {
					$html .= '
								<div class="col-md-3">
									<div class="card card-secondary">
										<div class="card-header">
						                    <div class="card-title">'.$dt->nama_kriteria_lhr.'</div>
						                    <div class="card-tools">
						                    	<button class="btn btn-tool edit_kriteria_lhr" data-nama="'.$dt->nama_kriteria_lhr.'" data-id="'.$dt->id.'"><i class=" fas fa-edit text-primary"></i></button>
						                    	<button class="btn btn-tool delete_kriteria_lhr" data-nama="'.$dt->nama_kriteria_lhr.'" data-id="'.$dt->id.'"><i class=" fas fa-trash text-danger"></i></button>
						                    </div>
						                </div>
					                </div>
				                </div>
					';
				}
			}else{
				$html .= '
							<li>
			                    <span class="handle">
			                      <i class="fas fa-ellipsis-v"></i>
			                      <i class="fas fa-ellipsis-v"></i>
			                    </span>

			                    <span class="text">Tidak Ada Data</span>
			                </li>
				        ';
			}

			echo $html;
		}

		public function add_kriteria_lhr()
		{
			$data['nama_kriteria_lhr']	= $this->input->post('nama_kriteria_lhr');
			
			$field_name = str_replace(' ', '_', strtolower($data['nama_kriteria_lhr']));
			$field = array(
				$field_name => array(
					'type' => 'real'
				));

			$this->dbforge->add_column('nilai_lhr', $field);
			$pre = $this->Table_LHRModel->add_kriteria($data);

			if ($pre) {
				$response = array(
					'status' => 'success',
					'message' => 'Kriteria '.$data["nama_kriteria_lhr"].' Telah Berhasil Di Tambahkan'
				);
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Kriteria '.$data["nama_kriteria_lhr"].' Gagal Di Tambahkan !'
				);
			}

			echo json_encode($response);
		}

		public function edit_kriteria_lhr()
		{
			$id = $this->input->post('id');
			$kriteria_lama = $this->input->post('nama_kriteria_lama');
			$data['nama_kriteria_lhr'] = $this->input->post('edit_nama_kriteria_lhr');
			
			$kriteria_lama = str_replace(' ', '_', strtolower($kriteria_lama));
			$field_name = str_replace(' ', '_', strtolower($data['nama_kriteria_lhr']));
			$fields = array(
                $kriteria_lama => array(
                        'name' => $field_name,
                        'type' => 'int',
                        'constraint' => 3,
                ),
			);

			$update_field = $this->dbforge->modify_column('nilai_lhr', $fields);
			if ($update_field) {
				$pre = $this->Table_LHRModel->edit_kriteria($id, $data);
				if ($pre) {
					$response = array(
						'status' => 'success',
						'message' => 'Kriteria Telah Berhasil Diubah menjadi '.$data["nama_kriteria_lhr"]
					);
				}else{
					$response = array(
						'status' => 'error',
						'message' => 'Kriteria Gagal Diubah !'
					);
				}
			}

			echo json_encode($response);
		}

		public function delete_kriteria_lhr()
		{
			$id = $this->input->get('id');
			$nama = $this->input->get('nama');
			$pre2 = $this->Table_LHRModel->delete_kriteria_lhr($id);
			if ($pre2) {
				$field_name = str_replace(' ', '_', strtolower($nama));

				$pre = $this->dbforge->drop_column('nilai_lhr', $field_name);

				if ($pre) {
					$response = array(
						'status' => 'success',
						'message' => 'Kriteria Telah Berhasil Dihapus'
					);
				}else{
					$response = array(
						'status' => 'error',
						'message' => 'Kriteria Gagal Dihapus !'
					);
				}
			}

			echo json_encode($response);
		}

		public function get_nilai_kriteria_lhr()
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
					$html .= '
						<tr>
							<td>'.$no++.'
							<td>'.$dt->nama_jalan.'</td>';
						foreach ($kriteria->result() as $k => $kr) {
							$field = str_replace(' ', '_', strtolower($kr->nama_kriteria_lhr));
							$html .= '<td>'.$dt->$field.'</td>';
							$total[$k] = $dt->$field;
							$total_nilai = array_sum($total)*1.28; 
						}
					$html .= '<td>'.$total_nilai.'</td>
						<td><button class="btn btn-tool edit_table" data-nama="'.$dt->nama_jalan.'" data-id="'.$dt->id_jalan.'"><i class=" fas fa-edit text-danger"></i></button></td>
							</tr>';
				}
			}else{
				$html .= '
						<tr>
							<td>Tidak Ada Data</td>
						</tr>
				        ';
			}

			echo $html;
		}

		public function generate_field_lhr()
		{
			$html = '';
			$kriteria = $this->Table_LHRModel->get_kriteria();
			foreach ($kriteria->result() as $kr) {
				$kriteria = str_replace(' ', '_', strtolower($kr->nama_kriteria_lhr));
				$html .= '<div class="col">
			                <div class="form-group">
			                  <label>'.$kr->nama_kriteria_lhr.'</label>
			                  <input class="form-control" name="'.$kriteria.'">
              				</div>
              			  </div>';
			}

			echo $html;
		}

		public function generate_field_lhr_update()
		{
			$html = '';
			$nilai = array();
			$id = $this->input->get('id');
			$kriteria = $this->Table_LHRModel->get_kriteria();
			$nilai = $this->db->get_where('nilai_lhr', array('id_jalan' => $id))->row_array();
			foreach ($kriteria->result() as $kr) {
				$kriteria = str_replace(' ', '_', strtolower($kr->nama_kriteria_lhr));

				$html .= '<div class="col">
			                <div class="form-group">
			                  <label>'.$kr->nama_kriteria_lhr.'</label>
			                  <input class="form-control" name="'.$kriteria.'_update" value="'.$nilai[$kriteria].'">
              				</div>
              			  </div>';
			}

			echo $html;
		}

		public function add_nilai_lhr()
		{
			$data['id_jalan'] = $this->input->post('id_jalan');
			$val = $this->Table_LHRModel->validasi($data['id_jalan']);
			if ($val->num_rows() > 0) {
				$kriteria = $this->Table_LHRModel->get_kriteria();
				foreach ($kriteria->result() as $kr) {
					$data[str_replace(' ', '_', strtolower($kr->nama_kriteria_lhr))] = $this->input->post(str_replace(' ', '_', strtolower($kr->nama_kriteria_lhr)));
				}
				$update = $this->Table_LHRModel->update_nilai_lhr($data['id_jalan'], $data);
				$response = array(
					'status' => 'success',
					'message' => 'Data Berhasil Diubah'
				);
			}else{
				$kriteria = $this->Table_LHRModel->get_kriteria();
				foreach ($kriteria->result() as $kr) {
					$data[str_replace(' ', '_', strtolower($kr->nama_kriteria_lhr))] = $this->input->post(str_replace(' ', '_', strtolower($kr->nama_kriteria_lhr)));
				}
			    
			    $pre = $this->Table_LHRModel->add_nilai_lhr($data); 

			    if ($pre) {
					$response = array(
						'status' => 'success',
						'message' => 'Data Nilai LHR Berhasil Ditambahkan'
					);
				}else{
					$response = array(
						'status' => 'error',
						'message' => 'Data Nilai LHR Gagal Di Tambahkan !'
					);
				}
			}

			echo json_encode($response);
		}

		public function update_nilai_lhr()
		{
			$data['id_jalan'] = $this->input->post('id_jalan_update');
			// $val = $this->Table_LHRModel->validasi($data['id_jalan']);
			
			$kriteria = $this->Table_LHRModel->get_kriteria();
			foreach ($kriteria->result() as $kr) {
				$data[str_replace(' ', '_', strtolower($kr->nama_kriteria_lhr))] = $this->input->post(str_replace(' ', '_', strtolower($kr->nama_kriteria_lhr).'_update'));
			}
			$update = $this->Table_LHRModel->update_nilai_lhr($data['id_jalan'], $data);
			$response = array(
				'status' => 'success',
				'message' => 'Data Berhasil Diubah'
			);

			echo json_encode($response);
		}
	
	}
	
	/* End of file Table_LHR.php */
	/* Location: ./application/controllers/Table_LHR.php */
?>