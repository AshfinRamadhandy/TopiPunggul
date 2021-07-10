<?php

if(!function_exists('get_month_by_number')) {
  function get_month_by_number($number) {
    switch ($number) {
      case '1':
        return "Januari";
        break;
      case '2':
        return "Februari";
        break;
      case '3':
        return "Maret";
        break;
      case '4':
        return "April";
        break;
      case '5':
        return "Mei";
        break;
      case '6':
        return "Juni";
        break;
      case '7':
        return "Juli";
        break;
      case '8':
        return "Agustus";
        break;
      case '9':
        return "September";
        break;
      case '10':
        return "Oktober";
        break;
      case '11':
        return "November";
        break;
      case '12':
        return "Desember";
        break;
      
      default:
        return "Not defined";
        break;
    }
  }
}

if(!function_exists('is_login')) {
	function is_login() {
		$ci =& get_instance();

		if($ci->session->has_userdata('logged_in')) {
			return true;
		} else {
			return false;
		}
	}
}

if(!function_exists('is_super')) {
	function is_super() {
		$ci =& get_instance();

		if($ci->session->userdata('is_super') == '1') {
			return true;
		} else {
			return false;
		}
	}
}