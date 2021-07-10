<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Language" content="en">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title><?php echo $this->session->userdata('title') . " &mdash; " . $this->session->userdata('subtitle'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
  <meta name="description" content="Tables are the backbone of almost all web applications.">
  <meta name="msapplication-tap-highlight" content="no">
  <link href="<?php echo base_url(); ?>themes/main.css" rel="stylesheet">

  <?php foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
  <?php endforeach; ?>
</head>
<body>
  <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <?php $this->load->view('template_parts/header'); ?>
    
    <div class="app-main">
      <?php $this->load->view('template_parts/sidebar'); ?>
      
      <div class="app-main__outer">
        <div class="app-main__inner">
          <div class="app-page-title">
            <div class="page-title-wrapper">
              <div class="page-title-heading">
                <div>
                  <?php echo $this->session->userdata('title'); ?>
                  <div class="page-title-subheading"><?php echo $this->session->userdata('subtitle'); ?></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="main-card mb-3 card">
                <div class="card-body">
                  <?php echo $output; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url(); ?>themes/assets/scripts/main.js"></script>
  
  <?php foreach($js_files as $file): ?>
  <script src="<?php echo $file; ?>"></script>
  <?php endforeach; ?>
</body>
</html>
