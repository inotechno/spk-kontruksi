<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Home extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('MasterModel');
		}
	
		public function index()
		{
			$data['title'] = 'Homepage';

			$this->load->view('front/head', $data);
			$this->load->view('front/home');
			$this->load->view('front/footer');
		}

		public function list_alternatif()
		{
			$html = '';
			$get = $this->MasterModel->get_jalan();
			foreach ($get->result() as $gt) {
				$html .= '<div class="col-md-4 mb-5">
		                    <div class="card h-100">
		                        <div class="card-body">
		                            <h3 class="card-title">'.$gt->nama_jalan.'</h3>
		                            <p class="card-text">
		                            	<ul>
		                            		<li>Kecamatan : '.$gt->kecamatan.'</li>
		                            		<li>Kelurahan : '.$gt->kelurahan.'</li>
		                            	</ul>
		                            </p>
		                        </div>
		                        <div class="card-footer"><a class="btn btn-primary btn-sm" href="https://www.google.com/maps/place/'.$gt->lat.','.$gt->lng.'" target="_blank">Lihat Map</a></div>
		                    </div>
		                </div>';
			}

			echo $html;
		}
	
	}
	
	/* End of file Home.php */
	/* Location: ./application/controllers/Home.php */
?>