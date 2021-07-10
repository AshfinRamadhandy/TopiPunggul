<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_masuk extends CI_Controller {
  public function __construct() {
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->library('grocery_CRUD');
		
		$this->session->set_userdata('title', 'Stok Masuk');
		$this->session->set_userdata('subtitle', 'Kelola data stok masuk.');

		// Check session
    if(!is_login()) {
      redirect('login');
    }
	}

  public function index() {
		$crud = new grocery_CRUD();
		$state = $crud->getState();
    $state_info = $crud->getStateInfo();

		$crud->set_language('indonesian');
		$crud->set_theme('datatables');
		$crud->set_table('tb_stok_masuk');
		$crud->set_subject('Stok Masuk');
		$crud->columns('tanggal_masuk', 'id_produk', 'kategori_produk', 'jumlah_masuk');

		$crud->callback_column('kategori_produk', array($this, '_callback_kategori_produk'));

		$crud->set_relation('id_produk', 'tb_produk', 'nama_produk');

		$crud->display_as('id_stok_masuk', '#');
		$crud->display_as('id_produk', 'Produk');
		$crud->display_as('kategori_produk', 'Kategori');
		$crud->display_as('jumlah_masuk', 'Jumlah');
		$crud->display_as('tanggal_masuk', 'Tanggal');
		
		$crud->fields(array('id_produk', 'jumlah_masuk', 'tanggal_masuk'));
		$crud->required_fields(array('id_produk', 'jumlah_masuk', 'tanggal_masuk'));

		$crud->unset_read();
		$crud->unset_clone();
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_bootstrap();

		$output = $crud->render();

		$this->load->view('template_crud', (array) $output);
	}

	public function _callback_kategori_produk($value, $row) {
    $produk = $this->db->get_where('v_produk', array('id_produk' => $row->id_produk))->row();

		return $produk->kategori_produk;
	}
}
