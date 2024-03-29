<?php 
$cur_tab = $this->uri->segment(1)==''?'dashboard': $this->uri->segment(1);  


  $warna = 'dark';
  $warna2 = 'primary';
  $warna4 = '';



?>  




<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-<?= $warna.'-'.$warna2; ?> elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('admin'); ?>" class="brand-link <?= $warna4; ?>">
    <img src="<?= base_url($this->general_settings['favicon']); ?>" alt="Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light"><?= $this->general_settings['application_name']; ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('assets/dist/img/'.$this->session->userdata('avatar')) ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= ucwords($this->session->userdata('nama')); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             <!-- <li class="nav-header">Menu</li> -->
        <?php 
          $menu = get_sidebar_menu(); 
          $akses = get_akses($this->session->userdata('admin_role_id'));
          foreach ($menu as $nav):

            $sub_menu = get_sidebar_sub_menu($nav['module_id']);

            $has_submenu = (count($sub_menu) > 0) ? true : false;
        ?>

        <?php if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama'): ?>
                  <?php if($nav['class']=='nav-header'){
                  ?>
                    <li class="<?= $nav['class'] ?>"><?= $nav['module_name'] ?></li>
                  <?php
                }else{
                  ?>
                  <li id="<?= ($nav['controller_name']) ?>" class="<?= $nav['class'] ?> <?= ($has_submenu) ? 'has-treeview' : '' ?> has-treeview">
                    <a href="<?= base_url($nav['controller_name']) ?>" class="nav-link">
                      <i class="nav-icon fa <?= $nav['fa_icon'] ?>"></i>
                      <p>
                        <?= $nav['module_name'] ?>
                        <?= ($has_submenu) ? '<i class="right fa fa-angle-left"></i>' : '' ?>
                      </p>
                    </a>

                    <!-- sub-menu -->
                    <?php 
                      if($has_submenu): 
                    ?>
                    <ul class="nav nav-treeview">

                      <?php foreach($sub_menu as $sub_nav): ?>

                      <li class="nav-item">
                        <a href="<?= base_url($nav['controller_name'].'/'.$sub_nav['link']); ?>" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p><?= $sub_nav['name'] ?></p>
                        </a>
                      </li>

                      <?php endforeach; ?>
                    
                    </ul>
                    <?php endif; ?>
                  <?php
                } ?>
                  <!-- /sub-menu -->
                </li>
        <?php else: ?> <!-- selain admin -->
              <?php if (in_array($nav['jenis'].$nav['module_id'], $akses)):?>
                
                <?php if($nav['class']=='nav-header'){
                  ?>
                    <li class="<?= $nav['class'] ?>"><?= $nav['module_name'] ?></li>
                  <?php
                }else{
                  ?>
                  <li id="<?= ($nav['controller_name']) ?>" class="<?= $nav['class'] ?> <?= ($has_submenu) ? 'has-treeview' : '' ?> has-treeview">
                    <a href="<?= base_url($nav['controller_name']) ?>" class="nav-link">
                      <i class="nav-icon fa <?= $nav['fa_icon'] ?>"></i>
                      <p>
                        <?= $nav['module_name'] ?>
                        <?= ($has_submenu) ? '<i class="right fa fa-angle-left"></i>' : '' ?>
                      </p>
                    </a>

                    <!-- sub-menu -->
                    <?php 
                      if($has_submenu): 
                    ?>
                    <ul class="nav nav-treeview">

                      <?php foreach($sub_menu as $sub_nav): ?>
                        <?php if (in_array($sub_nav['jenis'].$sub_nav['id'], $akses)):?>
                          <li class="nav-item">
                            <a href="<?= base_url($nav['controller_name'].'/'.$sub_nav['link']); ?>" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p><?= $sub_nav['name'] ?></p>
                            </a>
                          </li>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    
                    </ul>
                    <?php endif; ?>
                  <?php
                } ?>
                  <!-- /sub-menu -->
                </li>

                
                <?php endif; ?>
        <?php endif; ?>
        <?php endforeach; ?>

        
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<script>
  $("#<?= $cur_tab ?>").addClass('menu-open');
  $("#<?= $cur_tab ?> > a").addClass('active');
</script>