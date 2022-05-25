  <!-- Content Wrapper. Contains page content -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Edit bank </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('saldo_awal/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Saldo Awal</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('saldo_awal/edit/'.$bank['id']), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id" class=" control-label">No. Rekening</label>
                    <input type="text" name="no_rekening" value="<?= $bank['no_rekening']; ?>" class="form-control" id="no_rekening"  placeholder="" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nama_dinas" class=" control-label">Area</label>
                    <input type="text" name="nm_area" value="<?= $bank['nm_area']; ?>"  class="form-control" id="nm_area" placeholder="" readonly>
                    <input type="hidden" name="kd_area" value="<?= $bank['kd_area']; ?>"  class="form-control" id="kd_area" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id" class=" control-label">Saldo</label>
                    <input type="text" name="saldo" id="saldo" class="form-control" value="<?= number_format($bank['saldo'],2,',','.'); ?>"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
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

  <script type="text/javascript">
    $("div.jenis select").val("<?= $bank['jenis']; ?>").change();
  </script>