<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class NormalisasiModel extends CI_Model {
	
		function get_jalan()
		{
			$this->db->select('id_jalan, nama_jalan');	
			return $this->db->get('jalan')->result();
		}
		
		function get_kriteria()
		{
			return $this->db->get('kriteria')->result();
		}

		function get_bobot($id_kriteria)
		{
			return $this->db->get_where('bobot_kriteria', array('id_kriteria' => $id_kriteria))->result();
		}

		function save_nilai($data)
		{
			return $this->db->insert('bobot_jalan', $data);
		}

		function update_nilai($id, $data)
		{
			return $this->db->update('bobot_jalan', $data, array('id_bobot_jalan' => $id));
		}

		function get_normalisasi()
		{
			$this->db->select('jalan.nama_jalan, bobot_jalan.*');
			$this->db->join('jalan', 'jalan.id_jalan = bobot_jalan.id_jalan', 'left');
			return $this->db->get('bobot_jalan')->result();
		}

		function validasi($id_jalan)
		{
			return $this->db->get_where('bobot_jalan', array('id_jalan' => $id_jalan));
		}

		function get_max($nama_kriteria)
		{
			$this->db->select('MAX('.$nama_kriteria.') as '.$nama_kriteria);
			return $this->db->get('bobot_jalan')->row();
		}

		function get_total($nilai)
		{
			$this->db->select('SUM(bobot_kriteria) as total_bobot');
			$get = $this->db->get('kriteria')->row();

			return $n = $nilai / $get->total_bobot;
		}

		function get_preferensi()
		{
			$this->db->select('jalan.nama_jalan, bobot_jalan.*');
			$this->db->join('jalan', 'jalan.id_jalan = bobot_jalan.id_jalan', 'left');
			$this->db->limit(3);
			return $this->db->get('bobot_jalan')->result();
		}

	}
	
	/* End of file NormalisasiModel.php */
	/* Location: ./application/models/NormalisasiModel.php */
?>