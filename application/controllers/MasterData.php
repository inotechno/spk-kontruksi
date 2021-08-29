<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class MasterData extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('MasterModel');
			$this->load->dbforge();
			if ($this->session->userdata('status') != 'login') {
				redirect(base_url("Login",'refresh'));
			}
		}
	
		public function kriteria()
		{
			$def['title'] = 'Kriteria | SPK Kontruksi';
			$this->breadcrumb->add('Kriteria', 'kriteria');

			$this->load->view('partials/head', $def);
			$this->load->view('partials/navbar');
			$this->load->view('partials/sidebar');
			$this->load->view('partials/breadcumb', $def);
			$this->load->view('kriteria');
			$this->load->view('partials/footer');
			$this->load->view('plugins/kriteria');
		}

	// fungsi Kriteria
		public function get_kriteria_all()
		{
			$pre = $this->MasterModel->get_kriteria_all()->result();
			echo json_encode($pre);
		}

		public function daftar_kriteria()
		{
			$html = '';
			$pre = $this->MasterModel->get_kriteria_all();

			if ($pre->num_rows() > 0) {
				foreach ($pre->result() as $dt) {
					$html .= '
								<li>
				                    <span class="handle">
				                      <i class="fas fa-ellipsis-v"></i>
				                      <i class="fas fa-ellipsis-v"></i>
				                    </span>

				                    <span class="text">'.$dt->nama_kriteria.'</span>
				                   	<small class="badge badge-warning badge-lg">Nilai </i> '.$dt->bobot_kriteria.'</small>
				                    <div class="tools">
				                    	<i class="fas fa-eye text-warning view_bobot" data-nama="'.$dt->nama_kriteria.'" data-id="'.$dt->id_kriteria.'"></i>
				                    	<i class="fas fa-edit text-primary edit_kriteria" data-nama="'.$dt->nama_kriteria.'" data-id="'.$dt->id_kriteria.'" data-bobot="'.$dt->bobot_kriteria.'"></i>
				                    	<i class="fas fa-trash text-danger delete_kriteria" data-nama="'.$dt->nama_kriteria.'" data-id="'.$dt->id_kriteria.'"></i>
				                    </div>
				                </li>
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

		public function add_kriteria()
		{
			$data['nama_kriteria']	= $this->input->post('nama_kriteria');
			$data['bobot_kriteria']	= $this->input->post('bobot_kriteria');
			$data['created_by']	= $this->session->userdata('id');
			
			$field_name = str_replace(' ', '_', strtolower($data['nama_kriteria']));
			$field = array(
				$field_name => array(
					'type' => 'int',
					'constraint' => 3,
				));

			$this->dbforge->add_column('bobot_jalan', $field);
			$pre = $this->MasterModel->add_kriteria($data);

			if ($pre) {
				$response = array(
					'status' => 'success',
					'message' => 'Kriteria '.$data["nama_kriteria"].' Telah Berhasil Di Tambahkan'
				);
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Kriteria '.$data["nama_kriteria"].' Gagal Di Tambahkan !'
				);
			}

			echo json_encode($response);
		}

		public function edit_kriteria()
		{
			$id = $this->input->post('edit_id_kriteria');
			$kriteria_lama = $this->input->post('kriteria_lama');
			$data['nama_kriteria'] = $this->input->post('edit_nama_kriteria');
			$data['bobot_kriteria'] = $this->input->post('edit_bobot_kriteria');

			$kriteria_lama = str_replace(' ', '_', strtolower($kriteria_lama));
			$field_name = str_replace(' ', '_', strtolower($data['nama_kriteria']));
			$fields = array(
                $kriteria_lama => array(
                        'name' => $field_name,
                        'type' => 'int',
                        'constraint' => 3,
                ),
			);

			$update_field = $this->dbforge->modify_column('bobot_jalan', $fields);
			if ($update_field) {
				$pre = $this->MasterModel->edit_kriteria($id, $data);
				if ($pre) {
					$response = array(
						'status' => 'success',
						'message' => 'Kriteria Telah Berhasil Diubah menjadi '.$data["nama_kriteria"]
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

		public function delete_kriteria_by_id()
		{
			$id = $this->input->get('id');
			$nama = $this->input->get('nama');
			$pre2 = $this->MasterModel->delete_bobot_by_id_kriteria($id);
			if ($pre2) {
				$field_name = str_replace(' ', '_', strtolower($nama));

				$this->dbforge->drop_column('bobot_jalan', $field_name);
				$pre = $this->MasterModel->delete_kriteria_by_id($id);

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
		}
	// Funsi Kriteria

	// Fungsi Bobot Kriteria
		public function add_bobot_kriteria()
		{
			$data['id_kriteria'] = $this->input->post('id_kriteria');
			$data['pilihan_bobot'] = $this->input->post('pilihan_bobot');
			$data['keterangan'] = $this->input->post('keterangan');
			$data['nilai_kriteria'] = $this->input->post('nilai');
			$val = $this->MasterModel->validate_double_bobot($data['id_kriteria'], $data['pilihan_bobot']);

			if ($val->num_rows() > 0) {
				$response = array(
					'status' => 'error',
					'message' => 'Bobot Kriteria Sudah Tersedia'
				);
			}else{
				$pre = $this->MasterModel->add_bobot_kriteria($data);

				if ($pre) {
					$response = array(
						'status' => 'success',
						'message' => 'Bobot Kriteria Telah Berhasil Di Tambahkan'
					);
				}else{
					$response = array(
						'status' => 'error',
						'message' => 'Bobot Kriteria Gagal Di Tambahkan !'
					);
				}
			}

			echo json_encode($response);
		}

		public function get_bobot_by_kriteria()
		{
			$kriteria = $this->input->get('id');

			$html = '';
			$pre = $this->MasterModel->get_bobot_by_kriteria($kriteria);

			if ($pre->num_rows() > 0) {
				$no = 1;
				foreach ($pre->result() as $dt) {
					$html .= '
								<tr>
				                    <td>'.$no++.'</td>
				                    <td>'.$dt->pilihan_bobot.'</td>
				                    <td>'.$dt->keterangan.'</td>
				                    <td>'.$dt->nilai_kriteria.'</td>
				                    <td>
				                    	<a href="#" class="fas fa-trash text-danger text-center delete_bobot" data-id="'.$dt->id_bobot_kriteria.'" data-id-kriteria="'.$dt->id_kriteria.'"></a>
				                    </td>
				                </tr>
					';
				}
			}else{
				$html .= '
							<tr>
			                    <td class="text-center" colspan="4">Tidak Ada Data</td>
			                </tr>
				        ';
			}

			echo $html;
		}

		public function delete_bobot_by_id()
		{
			$id = $this->input->get('id');
			$pre = $this->MasterModel->delete_bobot_by_id($id);

			if ($pre) {
				$response = array(
					'status' => 'success',
					'message' => 'Bobot Kriteria Telah Berhasil Dihapus'
				);
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Bobot Kriteria Gagal Dihapus !'
				);
			}
		}
	// Fungsi Bobot Kriteria

	// Fungsi Jalan
		public function jalan()
		{
			$def['title'] = 'Jalan | SPK Kontruksi';
			$this->breadcrumb->add('Jalan', 'jalan');

			$this->load->view('partials/head', $def);
			$this->load->view('partials/navbar');
			$this->load->view('partials/sidebar');
			$this->load->view('partials/breadcumb', $def);
			$this->load->view('jalan');
			$this->load->view('partials/footer');
			$this->load->view('plugins/jalan');
		}

		public function daftar_jalan()
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
				                    <td>
				                    	<button class="btn btn-xs btn-warning update_jalan" data-id="'.$dt->id_jalan.'" data-nama="'.$dt->nama_jalan.'" data-kecamatan="'.$dt->kecamatan.'" data-kelurahan="'.$dt->kelurahan.'" data-lat="'.$dt->lat.'" data-lng="'.$dt->lng.'"><span class="fas fa-pencil-alt"></span></button>
				                    	<button class="btn btn-xs btn-danger delete_jalan" data-id="'.$dt->id_jalan.'" data-nama="'.$dt->nama_jalan.'"><span class="fas fa-trash-alt"></span></button>
				                    </td>
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

		public function add_jalan()
		{
			$data['nama_jalan'] 	= $this->input->post('nama_jalan');
			$data['kecamatan'] 		= strtoupper($this->input->post('kecamatan'));
			$data['kelurahan'] 		= strtoupper($this->input->post('kelurahan'));
			$data['lat'] 			= substr($this->input->post('lat'), 0, 10);
			$data['lng'] 			= substr($this->input->post('lng'), 0, 10);
			$data['created_by'] 	= $this->session->userdata('id');
			$pre = $this->MasterModel->add_jalan($data);

			if ($pre) {
				$response = array(
					'status' => 'success',
					'message' => 'Data Jalan Telah Berhasil Ditambahkan'
				);
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Data Jalan Gagal Ditambahkan !'
				);
			}

			echo json_encode($response);
		}

		public function update_jalan()
		{
			$id 					= $this->input->post('id_jalan_update');
			$data['nama_jalan'] 	= $this->input->post('nama_jalan_update');
			$data['kecamatan'] 		= strtoupper($this->input->post('kecamatan_update'));
			$data['kelurahan'] 		= strtoupper($this->input->post('kelurahan_update'));
			$data['lat'] 			= substr($this->input->post('lat_update'), 0, 10);
			$data['lng'] 			= substr($this->input->post('lng_update'), 0, 10);

			$pre = $this->MasterModel->update_jalan($id, $data);

			if ($pre) {
				$response = array(
					'status' => 'success',
					'message' => 'Data Jalan Telah Berhasil Diubah'
				);
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Data Jalan Gagal Diubah !'
				);
			}

			echo json_encode($response);
		}

		public function delete_jalan()
		{
			$id = $this->input->get('id');
			$act = $this->MasterModel->delete_jalan($id);
			if ($act) {
				$response = array(
					'status' => 'success',
					'message' => 'Data Jalan Telah Berhasil Dihapus'
				);
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Data Jalan Gagal Dihapus !'
				);
			}

			echo json_encode($response);
		}
	// Fungsi Jalan


	// Pengguna
		public function pengguna()
		{
			$def['title'] = 'Pengguna | SPK Kontruksi';
			$this->breadcrumb->add('Pengguna', 'pengguna');

			$this->load->view('partials/head', $def);
			$this->load->view('partials/navbar');
			$this->load->view('partials/sidebar');
			$this->load->view('partials/breadcumb', $def);
			$this->load->view('pengguna');
			$this->load->view('partials/footer');
			$this->load->view('plugins/pengguna');
		}

		public function list_pengguna()
		{
			$html = '';
			$pre = $this->MasterModel->get_users();

			if ($pre->num_rows() > 0) {
				$no = 1;
				foreach ($pre->result() as $dt) {
					$html .= '
								<tr>
				                    <td class="text-center align-middle" style="width:10px;">'.$no++.'</td>
				                    <td><a href="'.site_url('assets/img/users/'.$dt->foto).'" target="_blank"><img src="'.site_url('assets/img/users/'.$dt->foto).'" width="40" height="40"></a></td>
				                    <td class="align-middle">'.$dt->nama_user.'</td>
				                    <td class="align-middle">'.$dt->username.'</td>
				                    <td class="align-middle">'.($dt->status == 1 ? "Aktif":"Tidak Aktif").'</td>
				                    
				                    <td class="align-middle">
				                    	<button class="btn btn-xs btn-warning update_user" data-id="'.$dt->id.'" data-nama="'.$dt->nama_user.'" data-username="'.$dt->username.'" data-foto="'.$dt->foto.'" data-status="'.$dt->status.'"><span class="fas fa-pencil-alt"></span></button>
				                    	<button class="btn btn-xs btn-danger delete_user" data-id="'.$dt->id.'" data-nama="'.$dt->nama_user.'" data-foto="'.$dt->foto.'"><span class="fas fa-trash-alt"></span></button>
				                    </td>
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

		public function add_user()
		{
			$data['nama_user'] = $this->input->post('nama_user');
			$data['username'] = $this->input->post('username');
			$data['password'] = hash('sha512', $this->input->post('password').config_item('encryption_key'));
			$data['status'] = $this->input->post('status');
			$data['level'] = 1;
			
			$config['upload_path'] = './assets/img/users';
	        $config['allowed_types'] = 'jpg|png|jpeg';
	        $config['max_size'] = '1024';
	        $this->load->library('upload', $config);

	        if ($this->upload->do_upload("foto")) {
				$data['foto'] = $this->upload->file_name;
	        }else{
				$data['foto'] = '';
	        }

	        $act = $this->MasterModel->add_user($data);

	        if ($act) {
				$response = array(
					'status' => 'success',
					'message' => 'Data berhasil disimpan'
				);
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Data gagal disimpan'
				);
			}

			echo json_encode($response);
		}

		public function update_user()
		{
			$id = $this->input->post('id');
			$data['nama_user'] = $this->input->post('nama_user');
			$data['username'] = $this->input->post('username');
			$data['password'] = hash('sha512', $this->input->post('password').config_item('encryption_key'));
			$data['status'] = $this->input->post('status');
			$foto = $this->input->post('foto_lama');
			
			$config['upload_path'] = './assets/img/users';
	        $config['allowed_types'] = 'jpg|png|jpeg';
	        $config['max_size'] = '1024';
	        $this->load->library('upload', $config);

	        if ($this->upload->do_upload("foto")) {
	        	unlink("./assets/img/users/".$foto);
				$data['foto'] = $this->upload->file_name;
	        }

			$act = $this->MasterModel->update_user($id, $data);

			if ($act) {
				$response = array(
					'status' => 'success',
					'message' => 'Data berhasil diubah'
				);
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Data gagal diubah'
				);
			}

			echo json_encode($response);
		}

		public function delete_user()
		{
			$id = $this->input->post('id');
			$foto = $this->input->post('foto');

			$act = $this->MasterModel->delete_user($id);

			if ($act) {
				$del_foto = unlink("./assets/img/users/".$foto);
				if ($del_foto) {
					$response = array(
						'status' => 'success',
						'message' => 'Data berhasil dihapus'
					);
				}
			}else{
				$response = array(
					'status' => 'error',
					'message' => 'Data gagal dikirim'
				);
			}

			echo json_encode($response);
		}
	// Pengguna
	
	}
	
	/* End of file Kriteria.php */
	/* Location: ./application/controllers/Kriteria.php */
?>