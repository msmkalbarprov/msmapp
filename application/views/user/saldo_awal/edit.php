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
              Edit Saldo Awal</h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('saldo-awal'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Saldo Awal</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('saldo-awal/edit/'.$bank['id']), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama_dinas" class=" control-label">Area</label>
                      <input type="text" name="nm_area" value="<?= $bank['nm_area']; ?>"  class="form-control" id="nm_area" placeholder="" readonly>
                      <input type="hidden" name="kd_area" value="<?= $bank['kd_area']; ?>"  class="form-control" id="kd_area" placeholder="">
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id" class=" control-label">Pegawai/Rekening</label>
                    <input type="text" name="nama" value="<?= $bank['nama']; ?>" class="form-control" id="nama"  placeholder="" readonly>
                    <input type="hidden" name="kd_pegawai" value="<?= $bank['kd_pegawai']; ?>" class="form-control" id="kd_pegawai"  placeholder="" readonly>
                    <input type="hidden" name="no_rekening" value="<?= $bank['kd_pegawai']; ?>" class="form-control" id="no_rekening"  placeholder="" readonly>
                  </div>
                </div>
               
              </div>

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id" class=" control-label">Pemilik</label>
                    <input type="text" name="pemilik" value="<?= $bank['pemilik']; ?>" class="form-control" id="pemilik"  placeholder="">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="jns_saldo" class="control-label">Jenis Saldo</label>
                    <select name="jenis" id="jenis" class="form-control">
                      <option value="">No Selected</option>
                      <option value="BANK">BANK</option>
                      <option value="TUNAI">TUNAI</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="saldo" class="control-label">Saldo</label>
                <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" id="c_minus" name="c_minus">&nbsp; minus 
                          <input type="hidden" id="minus" name="minus">
                        </span>
                        
                      </div>
                      <?php if ($bank['saldo']<0){
                        $saldo=$bank['saldo']*-1;
                      }else{
                        $saldo=$bank['saldo'];
                      } ?>
                      <input type="text" name="saldo" id="saldo" class="form-control" value="<?= number_format($saldo,2,',','.'); ?>"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
                      <!-- <input type="text" class="form-control"> -->
                    </div>
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
    
  if (<?= $bank['saldo'] ?><0){
    $('[name="minus"]').val('1').trigger('change');
    $('#c_minus').attr('checked', 'checked');
  }else{
    $('[name="minus"]').val('0').trigger('change');
  }
  var jenis = '<?= $bank['jenis'] ?>';
  $('[name="jenis"]').val(jenis).trigger('change');

    $('#c_minus').click(function() {
      if ($('#c_minus').prop('checked') == true){
        $('[name="minus"]').val('1').trigger('change');
      
      }else{
        $('[name="minus"]').val('0').trigger('change');
      }
    });


  </script>