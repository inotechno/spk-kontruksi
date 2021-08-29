<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class PengaduanModel extends CI_Model {

		function get_pengaduan()
		{
			$this->db->select('pengaduan.*, jalan.id_jalan, jalan.nama_jalan');
			$this->db->from('pengaduan');
			$this->db->join('jalan', 'jalan.id_jalan = pengaduan.id_jalan', 'left');
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