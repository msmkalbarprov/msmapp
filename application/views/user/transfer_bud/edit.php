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
              Edit Pelimpahan </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('transfer_bud/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Pelimpahan</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('transfer_bud/edit/'.$transfer['id']), 'class="form-horizontal"' )?> 
            <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id" class="control-label">No. Bukti</label>
                    <input type="text" name="nobukti" value="<?= $transfer['no_bukti']; ?>"  class="form-control" id="nobukti" placeholder="" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">rekening Asal</label>
                    <input type="text" name="rek_asal" value="<?= $transfer['nm_rek_asal']; ?>"  class="form-control" id="rek_asal" placeholder="" readonly>
                    <input type="hidden" name="rek_asal" value="<?= $transfer['rek_asal']; ?>"  class="form-control" id="rek_asal" placeholder="" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Saldo Kas</label>
                    <input type="text" name="saldo" id="saldo" class="form-control" value="0,00"  placeholder="" style="text-align:right;" readonly>
                  </div>
                </div>
                
                
              </div>
              <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="<?= $transfer['tgl_transfer']; ?>" class="form-control">
                  </div>
                </div>
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="1" class="form-control"><?= $transfer['keterangan']; ?></textarea>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nilai" class="control-label">Nilai</label>
                    <input type="text" name="nilai" id="nilai" class="form-control" value="<?= number_format($transfer['nilai'],2,',','.'); ?>"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
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
    var rekening='<?= $transfer['rek_asal']; ?>'
    get_kas_area(rekening)
            function get_kas_area(area){
                  $.ajax({
                    url : "<?php echo site_url('transfer_bud/get_kas_rekening');?>",
                    method : "POST",
                    data : {
                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                    id: rekening},
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