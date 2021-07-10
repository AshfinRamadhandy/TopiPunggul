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
          <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
              <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                <span>Moving Average</span>
              </a>
            </li>
            <li class="nav-item">
              <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                <span>Trend Moment</span>
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
              <?php if($ma_valid) { ?>
              <div class="row">
                <div class="col-12">
                  <div class="main-card mb-3 card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-xl-4">
                          <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                              <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                  <div class="widget-heading">Produk</div>
                                  <div class="widget-subheading"><?php echo $produk->nama_produk; ?></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                          <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                              <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                  <div class="widget-heading">Prediksi Penjualan</div>
                                  <div class="widget-subheading"><?php echo get_month_by_number(date('m')) . " " . date('Y'); ?></div>
                                </div>
                                <div class="widget-content-right">
                                  <div class="widget-numbers text-success"><?php echo $ma_result[count($ma_result) - 1]['ma']; ?></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" id="chartTitle" value="<?php echo $chart_title; ?>" />
                      <input type="hidden" id="chartPeriod" value='<?php echo $chart_period; ?>' />
                      <input type="hidden" id="chartDataActual" value="<?php echo $chart_data_actual; ?>" />
                      <input type="hidden" id="chartDataForecast" value="<?php echo $chart_data_forecast; ?>" />
                      <figure class="highcharts-figure">
                        <div id="container"></div>
                      </figure>

                      <table class="table">
                        <thead>
                          <tr>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Penjualan</th>
                            <th>Prediksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($ma_result as $row) { ?>
                          <tr class="<?php echo ($row['tahun'] == date('Y') && $row['bulan'] == date('m') ? 'bg-secondary text-white' : '');?>">
                            <td><?php echo $row['tahun']; ?></td>
                            <td><?php echo get_month_by_number($row['bulan']); ?></td>
                            <td><?php echo ($row['tahun'] == date('Y') && $row['bulan'] == date('m') ? '&mdash;' : $row['penjualan']); ?></td>
                            <td><?php echo $row['ma']; ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <?php } else { ?>
              <p><?php echo $ma_message; ?></p>
              <?php } ?>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
              <?php if($tm_valid) { ?>
              <div class="row">
                <div class="col-12">
                  <div class="main-card mb-3 card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-xl-4">
                          <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                              <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                  <div class="widget-heading">Produk</div>
                                  <div class="widget-subheading"><?php echo $produk->nama_produk; ?></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" id="chartTitle2" value="<?php echo $chart_title2; ?>" />
                      <input type="hidden" id="chartPeriod2" value='<?php echo $chart_period2; ?>' />
                      <input type="hidden" id="chartDataActual2" value="<?php echo $chart_data_actual2; ?>" />
                      <input type="hidden" id="chartDataForecast2" value="<?php echo $chart_data_forecast2; ?>" />
                      <figure class="highcharts-figure">
                        <div id="container2"></div>
                      </figure>

                      <h5 style="font-weight: bold;">Langkah 1: Mencari nilai Xi, Xi.Yi, Xi^2</h5>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Penjualan (Yi)</th>
                            <th>Waktu (Xi)</th>
                            <th>Xi.Yi</th>
                            <th>Xi^2</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($tm_result as $row) { ?>
                          <tr>
                            <td><?php echo $row['tahun']; ?></td>
                            <td><?php echo get_month_by_number($row['bulan']); ?></td>
                            <td><?php echo ($row['penjualan'] === NULL ? '&mdash;' : $row['penjualan']); ?></td>
                            <td><?php echo $row['x']; ?></td>
                            <td><?php echo ($row['xy'] === NULL ? '&mdash;' : $row['xy']); ?></td>
                            <td><?php echo $row['x2']; ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>

                      <h5 style="font-weight: bold;">Langkah 2: Mencari total dan rata-rata</h5>
                      <table class="table">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Penjualan (Yi)</th>
                            <th>Waktu (Xi)</th>
                            <th>Xi.Yi</th>
                            <th>Xi^2</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>Total</th>
                            <td><?php echo $total_penjualan; ?></td>
                            <td><?php echo $total_x; ?></td>
                            <td><?php echo $total_xy; ?></td>
                            <td><?php echo $total_x2; ?></td>
                          </tr>
                          <tr>
                            <th>Rata-rata</th>
                            <td><?php echo $avg_penjualan; ?></td>
                            <td><?php echo $avg_x; ?></td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>

                      <h5 style="font-weight: bold;">Langkah 3: Mencari nilai b</h5>
                      <table class="table">
                        <tbody>
                          <tr>
                            <th>Nilai B</th>
                            <td><?php echo $nilai_b; ?></td>
                          </tr>
                        </tbody>
                      </table>

                      <h5 style="font-weight: bold;">Langkah 4: Mencari nilai a</h5>
                      <table class="table">
                        <tbody>
                          <tr>
                            <th>Nilai A</th>
                            <td><?php echo $nilai_a; ?></td>
                          </tr>
                        </tbody>
                      </table>

                      <h5 style="font-weight: bold;">Langkah 5: Mencari nilai trend moment, rata-rata, dan indeks setiap musimnya</h5>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Trend Moment</th>
                            <th>Rata-rata</th>
                            <th>Indeks</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($tm_result as $row) { ?>
                          <?php if($row['penjualan'] === NULL) { ?>
                          <tr>
                            <td><?php echo $row['tahun']; ?></td>
                            <td><?php echo get_month_by_number($row['bulan']); ?></td>
                            <td><?php echo $arr_tm[$row['tahun']][$row['bulan']]['trend_moment']; ?></td>
                            <td><?php echo $arr_tm[$row['tahun']][$row['bulan']]['avg_tm']; ?></td>
                            <td><?php echo $arr_tm[$row['tahun']][$row['bulan']]['indeks_musim']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php } ?>
                        </tbody>
                      </table>

                      <h5 style="font-weight: bold;">Langkah 6: Mencari hasil prediksi</h5>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Penjualan</th>
                            <th>Prediksi</th>
                            <th>MAD</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($tm_result as $row) { ?>
                          <tr class="<?php echo ($row['penjualan'] === NULL ? 'bg-secondary text-white' : '');?>">
                            <td><?php echo $row['tahun']; ?></td>
                            <td><?php echo get_month_by_number($row['bulan']); ?></td>
                            <td><?php echo $row['penjualan']; ?></td>
                            <td><?php echo round($row['prediksi']); ?></td>
                            <td><?php echo ($row['penjualan'] === NULL ? '' : round($row['mad'], 2)); ?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <?php } else { ?>
              <p><?php echo $tm_message; ?></p>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>themes/assets/scripts/main.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/series-label.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/exporting.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/export-data.js"></script>

  <script>
    $(document).ready(function() {
      var _title = $('#chartTitle').val();
      var _period = JSON.parse($('#chartPeriod').val());
      var _data_actual = JSON.parse($('#chartDataActual').val());
      var _data_forecast = JSON.parse($('#chartDataForecast').val());
      
      Highcharts.chart('container', {
        chart: {
          type: 'spline'
        },
        title: {
          text: _title
        },
        xAxis: {
          categories: _period
        },
        yAxis: {
          title: {
            text: 'Total Penjualan'
          },
          labels: {
            formatter: function () {
              return this.value;
            }
          }
        },
        tooltip: {
          crosshairs: true,
          shared: true
        },
        plotOptions: {
          spline: {
            marker: {
              radius: 4,
              lineColor: '#ffffff',
              lineWidth: 1
            }
          }
        },
        series: [{
          name: 'Aktual',
          marker: {
            symbol: 'circle'
          },
          data: _data_actual
        },
        {
          name: 'Forecast',
          color: '#f55600',
          marker: {
            symbol: 'circle'
          },
          data: _data_forecast
        }]
      });
    })
  </script>

  <script>
    $(document).ready(function() {
      var _title = $('#chartTitle2').val();
      var _period = JSON.parse($('#chartPeriod2').val());
      var _data_actual = JSON.parse($('#chartDataActual2').val());
      var _data_forecast = JSON.parse($('#chartDataForecast2').val());
      
      Highcharts.chart('container2', {
        chart: {
          type: 'spline'
        },
        title: {
          text: _title
        },
        xAxis: {
          categories: _period
        },
        yAxis: {
          title: {
            text: 'Total Penjualan'
          },
          labels: {
            formatter: function () {
              return this.value;
            }
          }
        },
        tooltip: {
          crosshairs: true,
          shared: true
        },
        plotOptions: {
          spline: {
            marker: {
              radius: 4,
              lineColor: '#ffffff',
              lineWidth: 1
            }
          }
        },
        series: [{
          name: 'Aktual',
          marker: {
            symbol: 'circle'
          },
          data: _data_actual
        },
        {
          name: 'Forecast',
          color: '#f55600',
          marker: {
            symbol: 'circle'
          },
          data: _data_forecast
        }]
      });
    })
  </script>
</body>
</html>
