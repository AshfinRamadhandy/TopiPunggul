<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {
  public function __construct() {
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		
		$this->session->set_userdata('title', 'Dasbor');
		$this->session->set_userdata('subtitle', 'Hai, selamat datang kembali.');

    // Check session
    if(!is_login()) {
      redirect('login');
    }
	}

  public function index() {
    $this->db->order_by('tanggal_penjualan', 'DESC');
    $this->db->limit(7);
    $semua_penjualan = $this->db->get('v_penjualan')->result();

    $parser['total_administrator'] = $this->db->get('tb_administrator')->num_rows();
    $parser['total_kategori'] = $this->db->get('tb_kategori')->num_rows();
    $parser['total_produk'] = $this->db->get('v_produk')->num_rows();
    $parser['total_stok_masuk'] = $this->db->get('v_stok_masuk')->num_rows();
    $parser['total_penjualan'] = $this->db->get('v_penjualan')->num_rows();
    $parser['semua_penjualan'] = $semua_penjualan;

		$this->load->view('dasbor/index', $parser);
	}
}