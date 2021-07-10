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
            <div class="col-md-8">
              <div class="main-card mb-3 card">
                <div class="card-header">Penjualan Terakhir</div>
                <div class="table-responsive">
                  <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(count($semua_penjualan) > 0) { ?>
                      <?php foreach($semua_penjualan as $row) { ?>
                      <tr>
                        <td><?php echo get_month_by_number(date('m', strtotime($row->tanggal_penjualan))) . " " . date('d, Y H:i A', strtotime($row->tanggal_penjualan)); ?></td>
                        <td><?php echo $row->nama_produk; ?></td>
                        <td><?php echo $row->nama_kategori; ?></td>
                        <td><?php echo $row->jumlah_beli; ?></td>
                      </tr>
                      <?php } ?>
                      <?php } else { ?>
                      <tr>
                        <td colspan="4">Tidak ada penjualan.</td>
                      </tr>
                      <?php } ?>  
                    </tbody>
                  </table>
                </div>
                <div class="d-block text-center card-footer">
                  <a href="<?php echo site_url('penjualan'); ?>" class="btn-wide btn btn-success">Lihat Semua</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <a href="<?php echo site_url('administrator'); ?>" style="text-decoration: none;">
                <div class="card mb-2 widget-content">
                  <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left">
                        <div class="widget-heading" style="color: #000000;">Administrator</div>
                        <div class="widget-subheading" style="color: #000000;">Total data administrator</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers" style="color: #3f6ad8;"><?php echo $total_administrator; ?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>

              <a href="<?php echo site_url('kategori'); ?>" style="text-decoration: none;">
                <div class="card mb-2 widget-content">
                  <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left">
                        <div class="widget-heading" style="color: #000000;">Kategori</div>
                        <div class="widget-subheading" style="color: #000000;">Total data kategori</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers" style="color: #3f6ad8;"><?php echo $total_kategori; ?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>

              <a href="<?php echo site_url('produk'); ?>" style="text-decoration: none;">
                <div class="card mb-2 widget-content">
                  <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left">
                        <div class="widget-heading" style="color: #000000;">Produk</div>
                        <div class="widget-subheading" style="color: #000000;">Total data produk</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers" style="color: #3f6ad8;"><?php echo $total_produk; ?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>

              <a href="<?php echo site_url('stok_masuk'); ?>" style="text-decoration: none;">
                <div class="card mb-2 widget-content">
                  <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left">
                        <div class="widget-heading" style="color: #000000;">Stok Masuk</div>
                        <div class="widget-subheading" style="color: #000000;">Total data stok masuk</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers" style="color: #3f6ad8;"><?php echo $total_stok_masuk; ?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>

              <a href="<?php echo site_url('penjualan'); ?>" style="text-decoration: none;">
                <div class="card mb-2 widget-content">
                  <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left">
                        <div class="widget-heading" style="color: #000000;">Penjualan</div>
                        <div class="widget-subheading" style="color: #000000;">Total data penjualan</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers" style="color: #3f6ad8;"><?php echo $total_penjualan; ?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url(); ?>themes/assets/scripts/main.js"></script>
</body>
</html>
