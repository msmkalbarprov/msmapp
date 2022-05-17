  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Tambah Bank  </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('bank/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Bank</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('bank/add/'), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class=" control-label">No Rekening</label>
                    <input type="text" name="no_rekening"  class="form-control" id="no_rekening"  required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nama_dinas" class=" control-label">Pemilik</label>
                    <input type="text" name="pemilik"  class="form-control" id="pemilik" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class=" control-label">Bank</label>
                    <input type="text" name="nm_bank"  class="form-control" id="nm_bank"  required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nama_dinas" class=" control-label">Jenis</label>
                    <select name="jenis" id="jenis" class="form-control" required>
                      <option value="">No Selected</option>
                      <option value="1">Perusahaan</option>
                      <option value="2">Karyawan</option>
                      <option value="3">Pihak Ke 3</option>
                    </select>
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