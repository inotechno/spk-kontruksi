<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Table_LHRModel extends CI_Model {
	
		function get_kriteria()
		{
			return $this->db->get('kriteria_lhr');
		}

		function add_kriteria($data)
		{
			return $this->db->insert('kriteria_lhr', $data);
		}

		function edit_kriteria($id, $data)
		{
			return $this->db->update('kriteria_lhr', $data, array('id' => $id));
		}

		function delete_kriteria_lhr($id)
		{
			return $this->db->delete('kriteria_lhr', array('id' => $id));
		}

		function get_lhr()
		{
			$this->db->select('jalan.id_jalan, jalan.nama_jalan, nilai_lhr.*');
			$this->db->from('nilai_lhr');
			$this->db->join('jalan', 'jalan.id_jalan = nilai_lhr.id_jalan', 'left');
			return $this->db->get();
		}

		function add_nilai_lhr($data)
		{
			return $this->db->insert('nilai_lhr', $data);
		}

		function validasi($id)
		{
			return $this->db->get_where('nilai_lhr', array('id_jalan' => $id));
		}

		function update_nilai_lhr($id, $data)
		{
			return $this->db->update('nilai_lhr', $data, array('id_jalan' => $id));
		}
	
	}
	
	/* End of file Table_LHRModel.php */
	/* Location: ./application/models/Table_LHRModel.php */
?>