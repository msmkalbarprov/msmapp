  <!-- Content Wrapper. Contains page content -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title">
              Edit Penerimaan Lainnya </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('penerimaan_lain/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Pelimpahan</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('penerimaan_lain/edit/'.$data_plain['id']), 'class="form-horizontal"' )?> 
            <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id" class="control-label">Area</label>
                    <input type="text" name="nobukti" value="<?= $data_plain['no_bukti']; ?>"  class="form-control" id="nobukti" placeholder="" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="<?= $data_plain['tgl_bukti']; ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id" class="control-label">Akun</label>
                    <select name="no_acc" id="no_acc" class="form-control select2" style="width: 100%;" required>
                      <option value="">No Selected</option>
                      <?php foreach($data_akun as $akun): 
                        if($akun['no_acc']==$data_plain['no_acc']):
                        ?>
                        <option value="<?= $akun['no_acc']; ?>" selected><?= $akun['nm_acc']; ?></option>
                        <?php else: ?>
                            <option value="<?= $akun['no_acc']; ?>"><?= $akun['nm_acc']; ?></option>

                        <?php 
                    endif;  
                    endforeach; 
                      ?>
                      </select>
                  </div>
                </div>
                
              </div>
              <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="1" class="form-control"><?= $data_plain['keterangan']; ?></textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Saldo Kas</label>
                    <input type="text" name="saldo" id="saldo" class="form-control" value="0,00"  placeholder="" style="text-align:right;" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nilai" class="control-label">Nilai</label>
                    <input type="text" name="nilai" id="nilai" class="form-control" value="<?= number_format($data_plain['nilai'],2,',','.'); ?>"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
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
      $(document).ready(function(){
    get_kas_area();
    function get_kas_area(){
                    var area  = '01';
                    $.ajax({
                        url : "<?php echo site_url('penerimaan_lain/get_kas');?>",
                        method : "POST",
                        data : {
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                        id: area},
                        async : true,
                        dataType : 'json',
                        success: function(data){
                            $.each(data, function(key, value) {
                                $('[name="saldo"]').val(number_format(value.total,"2",",",".")).trigger('change');

                            });

                        }
                    });
    
            }



  });
  </script>