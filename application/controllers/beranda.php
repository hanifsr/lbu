<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('laporan_model');
		$this->load->model('form_model');
	}

	public function index() {
		$kode_bank = $this->session->userdata('kode_bank');
		$data['daftar_laporan'] = $this->laporan_model->select_all($kode_bank)->result();
		$this->load->view('beranda_view', $data);
	}

	public function delete_laporan($id) {
		$this->laporan_model->delete_laporan($id);
		redirect(site_url('beranda'));
	}

	public function detail_laporan($id) {
		$data['form13'] = $this->form_model->select_all_form13($id)->row();
		$data['form19'] = $this->form_model->select_all_form19($id)->row();
		$data['laporan_id'] = $id;
		$this->load->view('detail_view', $data);
	}

	public function validasi_form() {
		$form = $this->input->post('form_num');
		$form_id = $this->input->post('id');
		$laporan_id = $this->input->post('laporan_id');
		if($form == 13) {
			$this->form_model->validasi_form13($form_id);
			$this->laporan_model->tambah_persentase($laporan_id);
		} else if($form == 19) {
			$this->form_model->validasi_form19($form_id);
			$this->laporan_model->tambah_persentase($laporan_id);
		}
		redirect(site_url('beranda/detail_laporan/'.$laporan_id));
	}
}

?>