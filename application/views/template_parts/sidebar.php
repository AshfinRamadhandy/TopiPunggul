      <div class="app-sidebar sidebar-shadow">
        <div class="scrollbar-sidebar">
          <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
              <li class="app-sidebar__heading">Menu</li>
              <li class="<?php echo ($this->uri->segment(1) === 'dasbor' ? 'mm-active' : ''); ?>">
                <a href="<?php echo site_url('dasbor'); ?>">
                  <i class="metismenu-icon pe-7s-display2"></i>
                  Dasboard
                </a>
              </li>
              <?php if(is_super()) { ?>
              <li class="<?php echo ($this->uri->segment(1) === 'administrator' ? 'mm-active' : ''); ?>">
                <a href="<?php echo site_url('administrator'); ?>">
                  <i class="metismenu-icon pe-7s-user"></i>
                  Administrator
                </a>
              </li>
              <?php } ?>
              <li class="<?php echo ($this->uri->segment(1) === 'kategori' ? 'mm-active' : ''); ?>">
                <a href="<?php echo site_url('kategori'); ?>">
                  <i class="metismenu-icon pe-7s-ticket"></i>
                  Kategori
                </a>
              </li>
              <li class="<?php echo ($this->uri->segment(1) === 'produk' || $this->uri->segment(1) === 'stok_masuk' || $this->uri->segment(1) === 'penjualan' ? 'mm-active' : ''); ?>">
                <a href="#">
                  <i class="metismenu-icon pe-7s-box1"></i>
                  Produk
                </a>
                <ul>
                  <li class="<?php echo ($this->uri->segment(1) === 'produk' ? 'mm-active' : ''); ?>">
                    <a href="<?php echo site_url('produk'); ?>">
                      <i class="metismenu-icon"></i>
                      Semua Produk
                    </a>
                  </li>
                  <li class="<?php echo ($this->uri->segment(1) === 'stok_masuk' ? 'mm-active' : ''); ?>">
                    <a href="<?php echo site_url('stok_masuk'); ?>">
                      <i class="metismenu-icon"></i>
                      Stok Masuk
                    </a>
                  </li>
                  <li class="<?php echo ($this->uri->segment(1) === 'penjualan' ? 'mm-active' : ''); ?>">
                    <a href="<?php echo site_url('penjualan'); ?>">
                      <i class="metismenu-icon"></i>
                      Penjualan
                    </a>
                  </li>
                </ul>
              </li>
              <li class="<?php echo ($this->uri->segment(1) === 'prediksi' ? 'mm-active' : ''); ?>">
                <a href="<?php echo site_url('prediksi'); ?>">
                  <i class="metismenu-icon pe-7s-graph3"></i>
                  Prediksi
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>