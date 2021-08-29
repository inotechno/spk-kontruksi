<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= site_url('assets/index3.html') ?>" target="_blank" class="brand-link">
    <img src="<?= site_url('assets/dist/img/AdminLTELogo.png') ?>" alt="<?= $this->session->userdata('nama_lengkap'); ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">PUPR</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('assets/img/users/'.$this->session->userdata("foto")) ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $this->session->userdata('nama_lengkap'); ?></a>
      </div>
    </div> 

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <?php
              $link = base_url($this->uri->segment(1));
            // data main menu
              $main_menu = $this->db->get_where('menus', 
                                        array('sub_menu' => 0, 'level' => $this->session->userdata('level')));
              foreach ($main_menu->result() as $main) {
                  // Query untuk mencari data sub menu
                  $sub_menu = $this->db->get_where('menus', 
                                        array('sub_menu' => $main->id, 'level' => $this->session->userdata('level')));
                  // periksa apakah ada sub menu
                if ($sub_menu->num_rows() > 0) {?>     
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon <?= $main->icon .' '. $main->warna ?>"></i>
                      <p>
                        <?= $main->nama_menu ?>
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <?php foreach ($sub_menu->result() as $sub) {?>
                        <li class="nav-item">
                          <a href="<?= base_url($sub->link) ?>" class="nav-link <?= base_url($sub->link) == $link ? 'active':''; ?>">
                            <i class="far fa-circle nav-icon text-warning"></i>
                            <p><?= $sub->nama_menu ?></p>
                          </a>
                        </li>
                      <?php } ?>
                    </ul>
                  </li>
                <?php } else { ?>
                  <li class="nav-item">
                    <a href="<?= base_url($main->link) ?>" class="nav-link <?= base_url($main->link) == $link ? 'active':''; ?>">
                      <i class="nav-icon <?= $main->icon .' '. $main->warna ?>"></i>
                      <p><?= $main->nama_menu ?></p>
                    </a>
                  </li>
          <?php }
        } ?>
       <li class="nav-header">EKSTRAS</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-file-alt"></i>
            <p>
              Documentation
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-question-circle"></i>
            <p>
              Support
            </p>
          </a>
        </li>


      </ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
  <div class="sidebar-custom">
    <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
    <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
  </div>
</aside>
