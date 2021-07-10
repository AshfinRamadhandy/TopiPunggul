<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {
  public function __construct() {
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->library('grocery_CRUD');
    $this->load->library('encryption');
		
		$this->session->set_userdata('title', 'Administrator');
		$this->session->set_userdata('subtitle', 'Kelola data administrator.');

		// Check session
    if(!is_login()) {
      redirect('login');
    } else {
			if(!is_super()) {
				redirect('dasbor');
			}
		}
	}

  public function index() {
		$crud = new grocery_CRUD();
		$state = $crud->getState();
    $state_info = $crud->getStateInfo();

		$crud->set_language('indonesian');
		$crud->set_theme('datatables');
		$crud->set_table('tb_administrator');
		$crud->set_subject('Administrator');
		$crud->columns('nama_administrator', 'email_administrator', 'super_administrator');

		$crud->display_as('id_administrator', '#');
		$crud->display_as('nama_administrator', 'Nama Lengkap');
		$crud->display_as('email_administrator', 'Email');
		$crud->display_as('sandi_administrator', 'Kata Sandi');
		$crud->display_as('super_administrator', 'Super Admin');
    
    $crud->fields(array('nama_administrator', 'email_administrator', 'sandi_administrator', 'super_administrator'));
		$crud->required_fields(array('nama_administrator', 'email_administrator', 'sandi_administrator', 'super_administrator'));
		$crud->unique_fields(array('email_administrator'));

		$crud->field_type('super_administrator', 'true_false', array('Tidak', 'Iya'));

		$crud->callback_add_field('sandi_administrator', function() {
      return '<input type="password" class="form-control" name="sandi_administrator" />';
    });

		$crud->callback_edit_field('sandi_administrator', function($value, $primary_key) {
      return '<input type="password" class="form-control" name="sandi_administrator" value="' . $this->encryption->decrypt($value) . '" />';
    });

    $crud->callback_before_insert(array($this, 'encrypt_password_insert_callback'));
    $crud->callback_before_update(array($this, 'encrypt_password_update_callback'));

		$crud->unset_read();
		$crud->unset_clone();
		$crud->unset_export();
		$crud->unset_print();
		$crud->unset_bootstrap();

		$output = $crud->render();

		$this->load->view('template_crud', (array) $output);
	}

  public function encrypt_password_insert_callback($post_array) {
    $post_array['sandi_administrator'] = $this->encryption->encrypt($post_array['sandi_administrator']);

    return $post_array;
  }

  public function encrypt_password_update_callback($post_array, $primary_key) {
    $post_array['sandi_administrator'] = $this->encryption->encrypt($post_array['sandi_administrator']);

    return $post_array;
  }
}
