<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prediksi extends CI_Controller {
  public function __construct() {
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		
		$this->session->set_userdata('title', 'Prediksi');
		$this->session->set_userdata('subtitle', 'Halaman untuk melakukan prediksi penjualan.');

    // Check session
    if(!is_login()) {
      redirect('login');
    }
	}

  public function index() {
    $semua_produk = $this->db->get('v_produk')->result();

    $parser['semua_produk'] = $semua_produk;

		$this->load->view('prediksi/index', $parser);
	}

  public function check_validation_data($arr, $bulan, $min) {
    $jumlah = 0;

    foreach($arr as $row) {
      if($row['bulan'] === $bulan) {
        $jumlah += 1;
      }
    }

    if($jumlah >= $min) {
      return true;
    } else {
      return false;
    }
  }

  public function get_avg_trend_moment($arr, $bulan) {
    $total = 0;
    $jumlah = 0;

    foreach($arr as $row) {
      if($row['bulan'] === $bulan) {
        $total += $row['penjualan'];
        $jumlah += 1;
      }
    }

    return ($total / $jumlah);
  }

  public function hasil() {
    if(!isset($_POST['doHitung'])) {
      redirect('prediksi');
    }

    $parser = array();
    
    $id_produk = $this->input->post('id_produk');
    $ma_periode = $this->input->post('ma_periode');
    $tm_periode = $this->input->post('tm_periode');
    $tm_periode_x = $this->input->post('tm_periode_x');

    $cek_produk = $this->db->get_where('v_produk', array('id_produk' => $id_produk));

    if($cek_produk->num_rows() === 0) {
      $parser['valid'] = false;
      $parser['message'] = "Produk tidak ada.";

      redirect('prediksi');
    } else {
      $produk = $cek_produk->row();

      $parser['produk'] = $produk;

      // Moving Average
      if($ma_periode < 3) {
        $parser['ma_valid'] = false;
        $parser['ma_message'] = "Periode untuk perhitungan Moving Average minimal 3 bulan.";
      } else {
        $dataset = array();
        $sort_dataset = array();
        $result = array();

        // Data penjualan
        $data_penjualan = $this->db->query("SELECT tahun_penjualan, bulan_penjualan, SUM(jumlah_beli) total_penjualan FROM v_penjualan WHERE id_produk = " . $id_produk . " GROUP BY tahun_penjualan, bulan_penjualan ORDER BY tahun_penjualan ASC, bulan_penjualan ASC")->result();

        if(count($data_penjualan) < $ma_periode) {
          $parser['ma_valid'] = false;
          $parser['ma_message'] = "Data penjualan produk " . $produk->nama_produk . " tidak memenuhi syarat minimal periode yaitu " . $ma_periode . " bulan.";
        } else {
          // Data set
          foreach($data_penjualan as $data) {
            $dataset[$data->tahun_penjualan][$data->bulan_penjualan] = (int) $data->total_penjualan;
          }

          $tahun = $data_penjualan[0]->tahun_penjualan;
          $bulan = $data_penjualan[0]->bulan_penjualan;

          // $tahun = 2020;
          // $bulan = 12;

          do {
            do {
              $dataset[$tahun][$bulan] = (isset($dataset[$tahun][$bulan]) ? $dataset[$tahun][$bulan] : 0);

              $bulan++;

              if($bulan > 12) {
                $bulan = 1;
                $tahun++;
              }
            } while($bulan <= date('m'));
          } while($tahun < date('Y'));

          ksort($dataset);
          foreach($dataset as $tahun => $bulan) {
            ksort($bulan);
            
            foreach($bulan as $key => $value) {
              $temp = array(
                'tahun' => $tahun,
                'bulan' => $key,
                'penjualan' => $value
              );

              array_push($sort_dataset, $temp);
            }
          }

          $i = 1;
          foreach($sort_dataset as $row) {
            $ma_value = '&mdash;';

            // Perhitungan: Moving average
            if($i > $ma_periode) {
              $temp_total = 0;

              for($j=($i-2); $j>=($i-4); $j--) {
                $temp_total += $sort_dataset[$j]['penjualan'];
              }

              $ma_value = round($temp_total / $ma_periode);
            }
            
            $row['ma'] = $ma_value;
            
            // Semua data
            array_push($result, $row);

            $i++;
          }

          $chart_period = array();
          $chart_data_actual = array();
          $chart_data_forecast = array();

          $i=1;
          $bu_arr = count($sort_dataset) - 1;
          $bb_arr = $bu_arr - 12;
          foreach($result as $row) {
            // Data terakhir
            if(($i - 1) >= $bb_arr && ($i - 1) <= $bu_arr) {
              $chart_period[] = $row['tahun'] . "/" . $row['bulan'];
              $chart_data_actual[] = ($row['tahun'] == date('Y') && $row['bulan'] == date('m') ? NULL : $row['penjualan']);
              $chart_data_forecast[] = $row['ma'];
            }

            $i++;
          }
          
          $parser['ma_valid'] = true;
          $parser['ma_result'] = $result;

          $parser['chart_title'] = "Grafik Data Aktual vs Forecast";
          $parser['chart_period'] = json_encode($chart_period);
          $parser['chart_data_actual'] = json_encode($chart_data_actual);
          $parser['chart_data_forecast'] = json_encode($chart_data_forecast);
        }
      }

      // Trend Moment
      if($tm_periode < 2) {
        $parser['tm_valid'] = false;
        $parser['tm_message'] = "Periode untuk perhitungan Trend Moment minimal 2 tahun.";
      } else {
        $dataset = array();
        $sort_dataset = array();
        $result = array();

        // Data penjualan
        $data_penjualan = $this->db->query("SELECT tahun_penjualan, bulan_penjualan, SUM(jumlah_beli) total_penjualan FROM v_penjualan WHERE id_produk = " . $id_produk . " GROUP BY tahun_penjualan, bulan_penjualan ORDER BY tahun_penjualan ASC, bulan_penjualan ASC")->result();

        if(count($data_penjualan) === 0) {
          $parser['tm_valid'] = false;
          $parser['tm_message'] = "Data penjualan produk " . $produk->nama_produk . " tidak memenuhi syarat minimal periode yaitu " . $tm_periode . " tahun.";
        } else {
          $min_tahun = date('Y') - $tm_periode;

          // Data set
          foreach($data_penjualan as $data) {
            $dataset[$data->tahun_penjualan][$data->bulan_penjualan] = (int) $data->total_penjualan;
          }

          $tahun = $data_penjualan[0]->tahun_penjualan;
          $bulan = $data_penjualan[0]->bulan_penjualan;

          // $tahun = 2020;
          // $bulan = 12;

          do {
            do {
              $dataset[$tahun][$bulan] = (isset($dataset[$tahun][$bulan]) ? $dataset[$tahun][$bulan] : 0);

              $bulan++;

              if($bulan > 12) {
                $bulan = 1;
                $tahun++;
              }
            } while($bulan < date('m'));
          } while($tahun < date('Y'));

          $x = 0;

          // Mencari total penjualan, waktu, dan rata-rata dari masing-masing variabel
          $total_penjualan = 0;
          $total_x = 0;
          $total_xy = 0;
          $total_x2 = 0;

          ksort($dataset);
          foreach($dataset as $tahun => $bulan) {
            ksort($bulan);
            
            foreach($bulan as $key => $value) {
              $temp = array(
                'tahun' => $tahun,
                'bulan' => $key,
                'penjualan' => $value,
                'x' => $x,
                'xy' => ($x * $value),
                'x2' => pow($x, 2)
              );

              array_push($sort_dataset, $temp);

              $total_penjualan += $value;
              $total_x += $x;
              $total_xy += ($x * $value);
              $total_x2 += pow($x, 2);

              $x++;
            }
          }

          $avg_penjualan = $total_penjualan / count($sort_dataset);
          $avg_x = $total_x / count($sort_dataset);

          // Maks waktu dataset
          $max_x = (count($sort_dataset) - 1);

          // Mencari nilai b dan nilai a
          $nilai_b = (($max_x * $total_xy) - ($total_x * $total_penjualan)) / (($max_x * $total_x2) - ($total_x * $total_x));
          $nilai_a = $avg_penjualan - ($nilai_b * $avg_x);

          // Mencari trend moment, rata-rata, dan indeks musim setiap bulan yang akan diprediksi
          $arr_tm = array();

          for($i=0; $i<$tm_periode_x; $i++) {
            $temp_tahun = (end($sort_dataset)['bulan'] == '12' ? end($sort_dataset)['tahun'] + 1 : end($sort_dataset)['tahun']);
            $temp_bulan = (end($sort_dataset)['bulan'] == '12' ? 1 : end($sort_dataset)['bulan'] + 1);
            $temp_x = end($sort_dataset)['x'] + 1;

            $arr_tm[$temp_tahun][$temp_bulan]['trend_moment'] = $nilai_a + ($nilai_b * $temp_x);
            $arr_tm[$temp_tahun][$temp_bulan]['avg_tm'] = ($this->check_validation_data($sort_dataset, $temp_bulan, $tm_periode) ? $this->get_avg_trend_moment($sort_dataset, $temp_bulan) : 'Tidak memenuhi syarat.');
            $arr_tm[$temp_tahun][$temp_bulan]['indeks_musim'] = ($this->check_validation_data($sort_dataset, $temp_bulan, $tm_periode) ? ($this->get_avg_trend_moment($sort_dataset, $temp_bulan) / $avg_penjualan) * $arr_tm[$temp_tahun][$temp_bulan]['trend_moment'] : 'Tidak memenuhi syarat.');

            $temp = array(
              'tahun' => $temp_tahun,
              'bulan' => $temp_bulan,
              'penjualan' => NULL,
              'x' => $temp_x,
              'xy' => NULL,
              'x2' => pow($temp_x, 2)
            );

            array_push($sort_dataset, $temp);
          }

          // Menambahkan nilai prediksi pada setiap data
          foreach($sort_dataset as $row) {
            $temp_prediksi = $nilai_a + ($nilai_b * $row['x']);

            $row['prediksi'] = $temp_prediksi;
            $row['mse'] = abs(pow(($row['penjualan'] - $temp_prediksi), 2)) / $max_x;
            $row['mad'] = ($row['penjualan'] - $temp_prediksi) / $max_x;

            array_push($result, $row);
          }

          $chart_period2 = array();
          $chart_data_actual2 = array();
          $chart_data_forecast2 = array();

          $i=1;
          $bu_arr = count($sort_dataset) - 1;
          $bb_arr = $bu_arr - 12;
          foreach($result as $row) {
            // Data terakhir
            if(($i - 1) >= $bb_arr && ($i - 1) <= $bu_arr) {
              $chart_period2[] = $row['tahun'] . "/" . $row['bulan'];
              $chart_data_actual2[] = $row['penjualan'];
              $chart_data_forecast2[] = $row['prediksi'];
            }
            
            $i++;
          }
          
          $parser['tm_valid'] = true;
          $parser['tm_result'] = $result;
          $parser['arr_tm'] = $arr_tm;

          $parser['total_penjualan'] = $total_penjualan;
          $parser['total_x'] = $total_x;
          $parser['total_xy'] = $total_xy;
          $parser['total_x2'] = $total_x2;

          $parser['avg_penjualan'] = $avg_penjualan;
          $parser['avg_x'] = $avg_x;

          $parser['nilai_b'] = $nilai_b;
          $parser['nilai_a'] = $nilai_a;

          $parser['chart_title2'] = "Grafik Data Aktual vs Forecast";
          $parser['chart_period2'] = json_encode($chart_period2);
          $parser['chart_data_actual2'] = json_encode($chart_data_actual2);
          $parser['chart_data_forecast2'] = json_encode($chart_data_forecast2);
        }
      }
    }

    $this->load->view('prediksi/hasil', $parser);
  }
}
