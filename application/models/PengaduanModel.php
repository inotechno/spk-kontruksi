<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class PengaduanModel extends CI_Model {

		function get_pengaduan()
		{
			$this->db->from('pengaduan');
			return $this->db->get();
		}
	
		function save_pengaduan($data)
		{
			return $this->db->insert('pengaduan', $data);
		}
	
	}
	
	/* End of file PengaduanModel.php */
	/* Location: ./application/models/PengaduanModel.php */
?>