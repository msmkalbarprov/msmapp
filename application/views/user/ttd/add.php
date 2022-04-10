  <!-- Content Wrapper. Contains page content -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
    <style type="text/css">
.select2-container .select2-selection {
  height: 37px; 
}
    </style>
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Tambah Tanda Tangan </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('ttd/penandatangan'); ?>" class="btn btn-success btn-sm"><i class="fa fa-list"></i> List Sub Area</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('ttd/add_ttd/'), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="id" class="col-md-2 control-label">Nama penandatangan</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Penandatangan">
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

  <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
  <script>
  $(document).ready(function(){
    $('.select2').select2()
  });
</script>