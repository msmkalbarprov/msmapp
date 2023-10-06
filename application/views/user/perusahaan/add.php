  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Tambah perusahaan </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('perusahaan'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List perusahaan</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('perusahaan/add/'), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class=" control-label">Nama Perusahaan</label>
                    <input type="text" name="nama"  class="form-control" id="nama"  placeholder="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nama_dinas" class=" control-label">Akronim</label>
                    <input type="text" name="akronim"  class="form-control" id="akronim" placeholder="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class=" control-label">No. Telp</label>
                    <input type="text" name="notelp"  class="form-control" id="notelp"  placeholder="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nama_dinas" class=" control-label">Alamat</label>
                    <input type="text" name="alamat"  class="form-control" id="alamat" placeholder="">
                  </div>
                </div>
              </div>
             
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary pull-right">
                  </div>
                </div>
                <?php echo form_close(); ?>
              </div>
              <!-- /.box-body -->
            </div>
    </section>
  </div>