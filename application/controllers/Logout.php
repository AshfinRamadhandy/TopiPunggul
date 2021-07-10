<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
  public function __construct() {
		parent::__construct();
	}

  public function index() {
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('is_super');
    $this->session->unset_userdata('id_administrator');
    $this->session->unset_userdata('nama_administrator');

    redirect('login');
  }
}
