<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Pengaduan extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('MasterModel');
			$this->load->model('PengaduanModel');
		}
	
		
		public function index()
		{
			$data['title'] = 'Pengaduan';
			$this->load->view('front/head', $data);			
			$this->load->view('front/pengaduan');			
			$this->load->view('front/footer');			
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
				                    <td>
				                    	<button class="btn btn-xs btn-warning btn-pengaduan" data-id="'.$dt->id_jalan.'" data-nama="'.$dt->nama_jalan.'" data-kecamatan="'.$dt->kecamatan.'" data-kelurahan="'.$dt->kelurahan.'" data-lat="'.$dt->lat.'" data-lng="'.$dt->lng.'"><i class="far fa-paper-plane"></i></button>
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

		public function kirim_pengaduan()
		{
			$data['id_jalan'] = $this->input->post('id_jalan');
			$data['nama_lengkap'] = $this->input->post('nama_lengkap');
			$data['hp'] = $this->input->post('hp');
			$data['email'] = $this->input->post('email');
			$data['keterangan'] = $this->input->post('keterangan');

			$config['upload_path'] = './assets/img/pengaduan';
	        $config['allowed_types'] = 'jpg|png|jpeg';
	        $config['max_size'] = '1024';
	        $this->load->library('upload', $config);

	        $this->upload->do_upload("img1");
				$data['img1'] = $this->upload->file_name;
			$this->upload->do_upload("img2");
				$data['img2'] = $this->upload->file_name;

			$act = $this->PengaduanModel->save_pengaduan($data);

			if ($act) {
				$response = array(
					'type' => 'Sukses',
					'message' => 'Pengaduan Telah Dikirim Terima Kasih Atas Partisipasinya'
				);
			}else{
				$response = array(
					'type' => 'Error',
					'message' => 'Pengaduan Gagal Di kirim'
				);
			}

			echo json_encode($response);
		}
	
	}
	
	/* End of file Pengaduan.php */
	/* Location: ./application/controllers/Pengaduan.php */
?>