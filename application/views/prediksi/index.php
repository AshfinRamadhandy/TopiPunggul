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
                  <form method="POST" action="<?php echo site_url('prediksi/hasil'); ?>">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="position-relative form-group">
                          <label for="id_produk">Pilih produk yang akan diprediksi.</label>
                          <?php if(count($semua_produk) > 0) { ?>
                          <select name="id_produk" class="form-control" required="required">
                            <?php foreach($semua_produk as $produk) { ?>
                            <option value="<?php echo $produk->id_produk; ?>"><?php echo $produk->nama_produk; ?></option>
                            <?php } ?>
                          </select>
                          <?php } else { ?>
                          <p>Tidak ada produk yang dapat diprediksi.</p>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    
                    <h5 class="card-title">Moving Average</h5>
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="position-relative form-group">
                          <label for="ma_periode">Tentukan jumlah periode (bulan) untuk dilakukan perhitungan.</label>
                          <input type="number" name="ma_periode" class="form-control" min="3" value="3" step="1" required="required">
                        </div>
                      </div>
                    </div>
                    
                    <h5 class="card-title">Trend Moment</h5>
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="position-relative form-group">
                          <label for="exampleSelect" class="">Tentukan minimal periode (tahun) untuk menentukan sebuah trend.</label>
                          <input type="number" name="tm_periode" class="form-control" min="2" value="2" step="1" required="required">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="position-relative form-group">
                          <label for="exampleSelect" class="">Tentukan periode (bulan) kedepan yang akan diprediksi.</label>
                          <input type="number" name="tm_periode_x" class="form-control" min="1" value="1" step="1" required="required">
                        </div>
                      </div>
                    </div>
                    
                    <button name="doHitung" class="mt-1 btn btn-primary">Kirim</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url(); ?>themes/assets/scripts/main.js"></script>
</body>
</html>
