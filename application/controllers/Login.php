<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  public function __construct() {
		parent::__construct();

    date_default_timezone_set('Asia/Jakarta');

    $this->load->library('encryption');

		// Check session
    if(is_login()) {
      redirect('dasbor');
    }
	}

  public function index() {
    $this->load->view('login/index');
  }

  public function do_login() {
    $email_administrator = $this->input->post('email_administrator');
    $sandi_administrator = $this->input->post('sandi_administrator');
    
    $query = $this->db->get_where('tb_administrator', array('email_administrator' => $email_administrator));

    if($query->num_rows() > 0) {
      $data = $query->row();

      if($this->encryption->decrypt($data->sandi_administrator) === $sandi_administrator) {
        $this->session->set_userdata('logged_in', true);
        $this->session->set_userdata('is_super', $data->super_administrator);
        $this->session->set_userdata('id_administrator', $data->id_administrator);
        $this->session->set_userdata('nama_administrator', $data->nama_administrator);

        redirect('dasbor');
      } else {
        $this->session->set_flashdata('status', 'Gagal');
        $this->session->set_flashdata('message', 'Maaf, kata sandi Anda tidak benar.');

        redirect('login');
      }
    } else {
      $this->session->set_flashdata('status', 'Gagal');
      $this->session->set_flashdata('message', 'Maaf, akun Anda tidak dapat digunakan atau belum terdaftar.');

      redirect('login');
    }
  }
}
