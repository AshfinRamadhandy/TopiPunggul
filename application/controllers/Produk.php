<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
  public function __construct() {
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->library('grocery_CRUD');
		
		$this->session->set_userdata('title', 'Produk');
		$this->session->set_userdata('subtitle', 'Kelola data produk.');

		// Check session
    if(!is_login()) {
      redirect('login');
    }
	}

  public function get_stok_produk($id_produk) {
    $stok_masuk = $this->db->get_where('v_stok_masuk', array('id_produk' => $id_produk))->result();
    $penjualan = $this->db->get_where('v_penjualan', array('id_produk' => $id_produk))->result();

    $jumlah_stok_masuk = 0;
    $jumlah_penjualan = 0;

    foreach($stok_masuk as $row) {
      $jumlah_stok_masuk += $row->jumlah_masuk;
    }

    foreach($penjualan as $row) {
      $jumlah_penjualan += $row->jumlah_beli;
    }

    return (int) ($jumlah_stok_masuk - $jumlah_penjualan);
  }

  public function index() {
		$crud = new grocery_CRUD();
		$state = $crud->getState();
    $state_info = $crud->getStateInfo();

		$crud->set_language('indonesian');
		$crud->set_theme('datatables');
		$crud->set_table('tb_produk');
		$crud->set_subject('Produk');
		$crud->columns('nama_produk', 'kategori_produk', 'harga_produk', 'stok');

		$crud->callback_column('stok', array($this, '_callback_stok'));

		$crud->set_relation('kategori_produk', 'tb_kategori', 'nama_kategori');

		$crud->display_as('id_produk', '#');
		$crud->display_as('nama_produk', 'Produk');
		$crud->display_as('kategori_produk', 'Kategori');
		$crud->display_as('harga_produk', 'Harga');
		
		if($state === 'add') {
			$crud->display_as('jumlah_masuk', 'Jumlah');

			$crud->fields(array('nama_produk', 'kategori_produk', 'harga_produk', 'jumlah_masuk'));
			$crud->required_fields(array('nama_produk', 'kategori_produk', 'harga_produk', 'jumlah_masuk'));
		} else {
			$crud->display_as('catatan', 'Catatan');

			$crud->fields(array('nama_produk', 'kategori_produk', 'harga_produk', 'catatan'));
			$crud->required_fields(array('nama_produk', 'kategori_produk', 'harga_produk'));
		}

		$crud->unique_fields(array('nama_produk'));

		$crud->field_type('harga_produk', 'integer');

		$crud->callback_add_field('jumlah_masuk', function() {
      return '<input id="field-jumlah_masuk" name="jumlah_masuk" type="text" value="" class="numeric form-control">';
    });

		$crud->callback_edit_field('catatan', function($value, $primary_key) {
      return '<p>Di halaman edit produk, Anda tidak dapat merubah jumlah produk secara langsung dikarenakan data telah sinkron dengan data masuk dan penjualan.<p>';
    });

		$crud->callback_before_insert(array($this, 'temp_stok_callback'));
		$crud->callback_after_insert(array($this, 'set_stok_callback'));

		$crud->unset_read();
		$crud->unset_clone();
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_bootstrap();

		$output = $crud->render();

		$this->load->view('template_crud', (array) $output);
	}

	public function _callback_stok($value, $row) {
		return $this->get_stok_produk($row->id_produk);
	}

	public function temp_stok_callback($post_array) {
		$this->session->set_userdata('jumlah_masuk', $post_array['jumlah_masuk']);

		unset($post_array['jumlah_masuk']);

		return $post_array;
	}
  
  public function set_stok_callback($post_array, $primary_key) {
		$jumlah_masuk = $this->session->userdata('jumlah_masuk');
		
    $data = array(
			'id_stok_masuk' => '',
			'id_administrator' => $this->session->userdata('id_administrator'), // ambil dari session
			'id_produk' => $primary_key,
			'jumlah_masuk' => $jumlah_masuk
		);

		$this->db->insert('tb_stok_masuk', $data);

		$this->session->unset_userdata('jumlah_masuk');

		return true;
	}
}
