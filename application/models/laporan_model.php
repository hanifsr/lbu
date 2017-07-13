<?php

class Laporan_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function select_all($kode_bank) {
		$this->db->select('*');
		$this->db->from('laporan');
		$this->db->where('kode_bank', $kode_bank);
		$this->db->where('deleted', FALSE);

		return $this->db->get();
	}

	function select_by_id($id) {
		$this->db->select('*');
		$this->db->from('laporan');
		$this->db->where('id', $id);

		return $this->db->get();
	}

	function update_laporan($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('laporan', $data);
	}

	function delete_laporan($id) {
		$deleted = array('deleted'=>TRUE);
		$this->db->where('id', $id);
		$this->db->update('laporan', $deleted);
	}

	function select_all_paging($limit = array()) {
		$this->db->select('*');
		$this->db->from('laporan');
		$this->db->where('kode_bank', $kode_bank);

		if($limit != NULL) {
			$this->db->limit($limit['perpage'], $limit['offset']);
		}

		return $this->db->get();
	}
}

?>