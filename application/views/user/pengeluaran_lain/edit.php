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
              Edit Pengeluaran Lainnya </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('pengeluaran_lain/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List pengeluaran</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('pengeluaran_lain/edit/'.$data_plain['id']), 'class="form-horizontal"' )?> 
            <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id" class="control-label">No. Bukti</label>
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
                    <label for="id" class="control-label">Divisi</label>
                    <select name="divisi" id="divisi" class="form-control select2" style="width: 100%;" required>
                      <option value="">No Selected</option>
                      <?php foreach($data_jnsproyek as $jnsproyek): ?>
                        <?php if($jnsproyek['kd_projek']==$data_plain['divisi']): ?>
                        <option value="<?= $jnsproyek['kd_projek']; ?>" selected><?= $jnsproyek['kd_projek'].' - '.$jnsproyek['nm_projek']; ?></option>
                        <?php else :?>
                          <option value="<?= $jnsproyek['kd_projek']; ?>"><?= $jnsproyek['kd_projek'].' - '.$jnsproyek['nm_projek']; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                
                
                </div>
              <div class="row">
              <div class="col-md-4">
                  <label for="id" class="control-label">Area</label>
                  <select name="area" id="area" class="form-control select2" style="width: 100%;" required>
                    <option value="">No Selected</option>
                    <!-- <option value="00">00 - HEAD OFFICE</option>
                    <option value="01">01	- SISTEM-HO(PUSAT)</option> -->
                  </select>
                </div>
              <div class="col-md-4">
                  <div class="form-group">
                  <div class="form-group">
                    <label for="id" class="control-label">Akun</label>
                    <select name="no_acc" id="no_acc" class="form-control select2" style="width: 100%;" required>
                      <option value="">No Selected</option>
                      
                      </select>
                  </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id" class="control-label">Rekening Sumber</label>
                    <select name="no_rekening" id="no_rekening" class="form-control select2" style="width: 100%;" required>
                      <option value="">No Selected</option>
                      <?php foreach($data_rekening as $rekening): 
                          if($rekening['kode'] == $data_plain['no_rekening']):
                        ?>    
                        <option value="<?= $rekening['kode']; ?>" selected><?= $rekening['nama']; ?></option>
                        <?php else: ?>
                          <option value="<?= $rekening['kode']; ?>"><?= $rekening['nama']; ?></option>
                        
                        <?php 
                      endif;
                      endforeach; ?>
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

    $('#area').val('<?= $data_plain['kd_area']; ?>');
    get_kas_area();
    get_akun_pengeluaran();
    get_area();

    function get_akun_pengeluaran(){
      var divisi = '<?= $data_plain['divisi']; ?>';
      var area = '<?= $data_plain['kd_area']; ?>';
      var akun = '<?= $data_plain['no_acc']; ?>';
      $.ajax({
                    url : "<?php echo site_url('pengeluaran_lain/get_akun_pengeluaran');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: divisi,area:area},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="no_acc"]').empty();
                        $('select[name="no_acc"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                          kode = value.no_acc;
                          if(kode.length!='5'){
                            if (akun==kode){
                              $('select[name="no_acc"]').append('<option value="'+ value.no_acc +'" selected>'+value.no_acc +' - '+ value.nm_acc +'</option>');
                            }else{
                              $('select[name="no_acc"]').append('<option value="'+ value.no_acc +'">'+value.no_acc +' - '+ value.nm_acc +'</option>');
                            }
                          }else{
                            $('select[name="no_acc"]').append('<optgroup label="'+ value.nm_acc +'"></optgroup>');
                          }
                        });

                    }
                });
    }
    function get_kas_area(){
                    var no_rekening = $('#no_rekening').val();
                    $.ajax({
                        url : "<?php echo site_url('pengeluaran_lain/get_kas');?>",
                        method : "POST",
                        data : {
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                        id: no_rekening},
                        async : true,
                        dataType : 'json',
                        success: function(data){
                            $.each(data, function(key, value) {
                                $('[name="saldo"]').val(number_format(value.total,"2",",",".")).trigger('change');

                            });

                        }
                    });
    
            }
   $('#divisi').change(function(){ 
      var divisi = $(this).val();
                $.ajax({
                    url : "<?php echo site_url('pengeluaran_lain/get_area_pengeluaran');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: divisi},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="area"]').empty();
                        $('select[name="area"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                            $('select[name="area"]').append('<option value="'+ value.kd_area +'">'+value.kd_area +' - '+ value.nm_area +'</option>');
                          
                        });

                    }
                });
  });

function get_area(){
  var divisi = $('#divisi').val();
  var area_simpan = '<?= $data_plain['kd_area']; ?>'
  $.ajax({
      url : "<?php echo site_url('pengeluaran_lain/get_area_pengeluaran');?>",
      method : "POST",
      data : {
        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
        id: divisi},
      async : true,
      dataType : 'json',
      success: function(data){
          $('select[name="area"]').empty();
          $('select[name="area"]').append('<option value="">No Selected</option>');
          $.each(data, function(key, value) {
              if (value.kd_area==area_simpan){
                $('select[name="area"]').append('<option value="'+ value.kd_area +'" selected>'+value.kd_area +' - '+ value.nm_area +'</option>');
              }else{
                $('select[name="area"]').append('<option value="'+ value.kd_area +'">'+value.kd_area +' - '+ value.nm_area +'</option>');
              }
              
            
          });

      }
  });
}

  });
  </script>