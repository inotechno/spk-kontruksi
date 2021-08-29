<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class MasterModel extends CI_Model {
	
	// Model Kriteria
		function get_kriteria_all()
		{
			return $this->db->get('kriteria');
		}
		
		function add_kriteria($data)
		{
			return $this->db->insert('kriteria', $data);
		}

		function edit_kriteria($id, $data)
		{
			return $this->db->update('kriteria', $data, array('id_kriteria' => $id));
		}

		function delete_kriteria_by_id($id)
		{
			return $this->db->delete('kriteria', array('id_kriteria' => $id));
		}
	// Model Kriteria

	// Model Bobot Kriteria
		function validate_double_bobot($id, $p_bobot)
		{
			return $this->db->get_where('bobot_kriteria', array('id_kriteria' => $id, 'pilihan_bobot' => $p_bobot));
		}
		function add_bobot_kriteria($data)
		{
			return $this->db->insert('bobot_kriteria', $data);
		}

		function get_bobot_by_kriteria($kriteria)
		{
			return $this->db->get_where('bobot_kriteria', array('id_kriteria' => $kriteria));
		}

		function delete_bobot_by_id($id)
		{
			return $this->db->delete('bobot_kriteria', array('id_bobot_kriteria' => $id));
		}

		function delete_bobot_by_id_kriteria($id)
		{
			return $this->db->delete('bobot_kriteria', array('id_kriteria' => $id));
		}
	// Model Bobot Kriteria

	// Model Jalan
		function get_jalan()
		{
			return $this->db->get('jalan');
		}

		function add_jalan($data)
		{
			return $this->db->insert('jalan', $data);
		}

		function update_jalan($id, $data)
		{
			return $this->db->update('jalan', $data, array('id_jalan' => $id));
		}

		function delete_jalan($id)
		{
			$jalan = $this->db->delete('jalan', array('id_jalan' => $id));
			if ($jalan) {
				$this->db->delete('pengaduan', array('id_jalan' => $id));
				$this->db->delete('bobot_jalan', array('id_jalan' => $id));
				$this->db->delete('nilai_lhr', array('id_jalan' => $id));

				return true;
			}
		}
	// Model Jalan

	// Model Users
		function get_users()
		{
			return $this->db->get('users');
		}

		function add_user($data)
		{
			return $this->db->insert('users', $data);
		}

		function update_user($id, $data)
		{
			return $this->db->update('users', $data, array('id' => $id));
		}

		function delete_user($id)
		{
			return $this->db->delete('users', array('id' => $id));
		}
	// Model Users
	}
	
	/* End of file MasterModel.php */
	/* Location: ./application/models/MasterModel.php */
?>