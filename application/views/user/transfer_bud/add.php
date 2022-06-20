  <!-- Content Wrapper. Contains page content -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
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
              <h3 class="card-title">
              Tambah Transfer ke Kas Besar</h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('transfer_bud/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List pelimpahan</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('transfer_bud/add/'), 'class="form-horizontal"' )?> 

              <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="saldo" class="control-label">No. Bukti</label>
                    <input type="text" name="nobukti" id="nobukti" class="form-control"placeholder="" style="text-align:right;" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id" class="control-label">Rekening Asal</label>
                    <select name="rek_asal" id="rek_asal" class="form-control select2" style="width: 100%;" required>
                      <option value="">No Selected</option>
                      <?php foreach($data_rekening as $rekening): ?>
                            <option value="<?= $rekening['no_rekening']; ?>"><?= $rekening['nm_rekening']; ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Saldo Rekening Asal</label>
                    <input type="text" name="saldo" id="saldo" class="form-control" value="0,00"  placeholder="" style="text-align:right;" readonly>
                  </div>
                </div>
                
                
              </div>
              <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Tanggal transfer</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                  </div>
                </div>
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="1" class="form-control"></textarea>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nilai" class="control-label">Nilai</label>
                    <input type="text" name="nilai" id="nilai" class="form-control" value="0,00"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
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
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
  <script type="text/javascript">

  $(document).ready(function(){
    $('.select2').select2()
    get_nomor_urut();
    $('#rek_asal').change(function(){ 
        $('#saldo').val('0,00');
        var rekening=$(this).val();
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
        return false;
    });


    function get_nomor_urut(){
        $.ajax({
        url : "<?php echo site_url('pencairan_pdo/get_nomor_bud');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                  $('[name="nobukti"]').val(value.nomor).trigger('change');
                
            });

        }
    });
}

  });
  </script>