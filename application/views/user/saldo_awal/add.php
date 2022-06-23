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
              Tambah Saldo Awal </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('saldo_awal/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Saldo Awal</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('saldo_awal/add/'), 'class="form-horizontal"' )?> 

              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id" class="control-label">Area</label>
                    <select name="area" id="area" class="form-control" required>
                      <option value="">No Selected</option>
                      <?php foreach($data_area as $area): ?>
                            <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Pegawai/Rekening</label>
                    <select name="rekening"  id="rekening" class="form-control" required>
                      <option value="">No Selected</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="pemilik" class="control-label">Pemilik</label>
                    <input type="text" name="pemilik" id="pemilik" class="form-control" >
                  </div>
                </div>
                <div class="col-md-3">
                    

                  <div class="form-group">
                  <label for="saldo" class="control-label">Saldo</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" id="c_minus" name="c_minus">&nbsp; minus 
                          <input type="hidden" id="minus" name="minus">
                        </span>
                        
                      </div>
                      <input type="text" name="saldo" id="saldo" class="form-control" value="0,00"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
                      <!-- <input type="text" class="form-control"> -->
                    </div>

                    <!-- <input type="text" name="saldo" id="saldo" class="form-control" value="0,00"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))"> -->
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
    $('[name="minus"]').val('0').trigger('change');
    $('#area').change(function(){ 
                var subarea=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('saldo_awal/get_pegawai_by_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="rekening"]').empty();
                        $('select[name="rekening"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                            $('select[name="rekening"]').append('<option value="'+ value.kd_pegawai +'">'+ value.nama +'</option>');
                        });

                    }
                });
                return false;
            });
  $('#c_minus').click(function() {
      if ($('#c_minus').prop('checked') == true){
        $('[name="minus"]').val('1').trigger('change');
      
      }else{
        $('[name="minus"]').val('0').trigger('change');
      }
    });

  });
  </script>