<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
  public function __construct() {
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->library('grocery_CRUD');
    $this->load->library('encryption');
		
		$this->session->set_userdata('title', 'Kategori');
		$this->session->set_userdata('subtitle', 'Kelola data kategori.');

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
		$crud->set_table('tb_kategori');
		$crud->set_subject('Kategori');
		$crud->columns('nama_kategori');

		$crud->display_as('id_kategori', '#');
		$crud->display_as('nama_kategori', 'Kategori');
    
    $crud->fields(array('nama_kategori'));
		$crud->required_fields(array('nama_kategori'));
		$crud->unique_fields(array('nama_kategori'));

		$crud->unset_read();
		$crud->unset_clone();
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_bootstrap();

		$output = $crud->render();

		$this->load->view('template_crud', (array) $output);
	}
}
