  <!-- Content Wrapper. Contains page content -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
              Tambah Pengeluaran Lainnya (Area) </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('pengeluaran_lain_area'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Pengeluaran</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('pengeluaran_lain_area/edit/'.$data_plain['id']), 'class="form-horizontal"' )?> 

              <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">No. Bukti</label>
                    <input type="text" name="nobukti" id="nobukti" value="<?= $data_plain['no_bukti']; ?>" class="form-control" readonly>
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
                        <?php if( $jnsproyek['kd_projek'] == $data_plain['divisi']): ?>
                          <option value="<?= $jnsproyek['kd_projek']; ?>" selected><?= $jnsproyek['kd_projek'].' - '.$jnsproyek['nm_projek']; ?></option>
                         <?php else: ?>
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
                  </select>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label for="id" class="control-label">Akun</label>
                    <select name="no_acc" id="no_acc" class="form-control select2" style="width: 100%;" required>
                      <option value="">No Selected</option>
                      
                      </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                  <label for="item_hpp" class="control-label">Pegawai</label>
                    <select name="kd_pegawai"  id="kd_pegawai" class="form-control" required>
                      <option value="">No Selected</option>
                    </select> 
                </div>
                </div>
                
              </div>
              <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                    <div class="form-group">
                      <label for="id" class="control-label">Rekening sumber</label>
                      <select name="no_rekening" id="no_rekening" class="form-control select2" style="width: 100%;" required>
                        <option value="">No Selected</option>
                        <?php foreach($data_rekening as $rekening): ?>
                          <?php if($rekening['kode']== $data_plain['no_rekening']): ?>
                            <option value="<?= $rekening['kode']; ?>" selected><?= $rekening['nama']; ?></option>
                            <?php else: ?>
                              <option value="<?= $rekening['kode']; ?>"><?= $rekening['nama']; ?></option>
                              <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                  <label for="saldo" class="control-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="1" class="form-control"><?= $data_plain['keterangan']; ?></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                  &nbsp;
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nilai" class="control-label">Nilai</label>
                    <input type="text" name="nilai" id="nilai" class="form-control" value="0,00"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                  &nbsp;
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Saldo Kas</label>
                    <input type="text" name="saldo" id="saldo" class="form-control" value="0,00"  placeholder="" style="text-align:right;" readonly>
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
<!-- <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript">

  $(document).ready(function(){
        
      $(".select2").select2(); 
    
        $('#saldo').val('0,00');
        var ddivisi   = "<?=  $data_plain['divisi'] ?>";
        var darea     = "<?=  $data_plain['kd_area'] ?>";
        var drekening = "<?=  $data_plain['no_rekening'] ?>";
        var dakun     = "<?=  $data_plain['no_acc'] ?>";
        var dpegawai  = "<?=  $data_plain['kd_pegawai'] ?>";
        var dnilai    = "<?= $data_plain['nilai']; ?>";
        $('#nilai').val(number_format(dnilai,"2",",","."));
        get_area_by_divisi(ddivisi);
        get_akun(ddivisi,darea)
        get_pegawai(darea)
        get_kas_area(dpegawai);
        // $('[name="area"]').val(darea).trigger('change');
    

  function get_area_by_divisi(ddivisi) {
    $.ajax({
                    url : "<?php echo site_url('pengeluaran_lain_area/get_area_pengeluaran');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: ddivisi},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $("select[name='area']").empty();
                        // $("select[name='area']").append(`<option value="">No Selected</option>`);
                        $.each(data, function(key, value) {
                          if(value.kd_area == darea){
                            $("select[name='area']").append(`<option value="${value.kd_area}" selected>${value.kd_area} - ${value.nm_area}</option>`);
                          }else{
                            $("select[name='area']").append(`<option value="${value.kd_area}">${value.kd_area} - ${value.nm_area}</option>`);
                          }
                          
                        });

                    }
                });
  }

  function get_akun(divisi,area) {
    $.ajax({
          url : "<?php echo site_url('pengeluaran_lain_area/get_akun_pengeluaran');?>",
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
                  if(kode==dakun){
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

  // $('#tanggal').change(function(){ 
  //   alert(darea);
  //   $("#area").val(data).select2();
    
  // });
  $('#divisi').change(function(){ 
      var divisi = $(this).val();
                $.ajax({
                    url : "<?php echo site_url('pengeluaran_lain_area/get_area_pengeluaran');?>",
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
                          $("select[name='area']").append(`<option value="${value.kd_area}">${value.kd_area} - ${value.nm_area}</option>`);
                        });

                    }
                });
  });

  function get_pegawai(darea) {
    $.ajax({
                    url : "<?php echo site_url('pengeluaran_lain_area/get_pegawai_by_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: darea},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="kd_pegawai"]').empty();
                        $('select[name="kd_pegawai"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                            if(value.kd_pegawai == dpegawai){
                              $('select[name="kd_pegawai"]').append('<option value="'+ value.kd_pegawai +'" selected>'+ value.nama +'</option>');
                            }else{
                              $('select[name="kd_pegawai"]').append('<option value="'+ value.kd_pegawai +'">'+ value.nama +'</option>');
                            }
                        });

                    }
                });
}
  $('#area').change(function(){ 
        var divisi  = $('#divisi').val();
        var area    = $(this).val();
        get_pegawai(area);
                var subarea=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('pengeluaran_lain_area/get_akun_pengeluaran');?>",
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
                            $('select[name="no_acc"]').append('<option value="'+ value.no_acc +'">'+value.no_acc +' - '+ value.nm_acc +'</option>');
                          }else{
                            $('select[name="no_acc"]').append('<optgroup label="'+ value.nm_acc +'"></optgroup>');
                          }
                        });

                    }
                });
                return false;
            });



$('#kd_pegawai').change(function(){ 
  $('[name="saldo"]').val(number_format(0,"2",",",".")).trigger('change');
    // get_nomor_urut($(this).val());
    var dpegawai = $(this).val();
      get_kas_area(dpegawai);
  });

  

            function get_kas_area(dpegawai){
                    // var no_rekening = $('#kd_pegawai').val();
                    // alert(no_rekening);
                    $.ajax({
                        url : "<?php echo site_url('pengeluaran_lain_area/get_kas');?>",
                        method : "POST",
                        data : {
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                        id: dpegawai},
                        async : true,
                        dataType : 'json',
                        success: function(data){
                            $.each(data, function(key, value) {
                                $('[name="saldo"]').val(number_format(value.total,"2",",",".")).trigger('change');
                            });

                        }
                    });
    
            }


        //  

  });
  </script>