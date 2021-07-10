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
  <div class="app-container app-theme-white body-tabs-shadow">
    <div class="app-main">
      <div class="app-main__outer">
        <div class="app-main__inner">
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <?php if($this->session->userdata('message')) { ?>
              <p class="mt-5"><?php echo $this->session->userdata('message'); ?></p>
              <?php } ?>
              <div class="main-card mb-3 card mt-5">
                <div class="card-header">Login</div>
                <div class="card-body">
                  <form method="POST" action="<?php echo site_url('login/do_login'); ?>">
                    <div class="form-row">
                      <div class="col-12">
                        <div class="position-relative form-group">
                          <label for="email_administrator">Email</label>
                          <input type="email" name="email_administrator" class="form-control" required="required">
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-row">
                      <div class="col-12">
                        <div class="position-relative form-group">
                          <label for="sandi_administrator">Kata Sandi</label>
                          <input type="password" name="sandi_administrator" class="form-control" required="required">
                        </div>
                      </div>
                    </div>
                    
                    <button name="doLogin" class="mt-1 btn btn-primary">Kirim</button>
                  </form>
                </div>
              </div>
              <p class="text-center">Copyright &copy; 2021 Sistem Toko Pintar. Allright reserved.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url(); ?>themes/assets/scripts/main.js"></script>
</body>
</html>
