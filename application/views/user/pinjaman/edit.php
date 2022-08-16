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
              Edit Pinjaman </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('pinjaman/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List pinjaman</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('pinjaman/edit/'.$bank['id'].'/'.$bank['kd_pegawai']), 'class="form-horizontal"' )?> 
            <div class="row">
            <div class="col-md-3">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">No. Kas</label>
                    <input type="text" name="no_kas" id="no_kas" value="<?= $bank['no_bukti']; ?>" class="form-control" readonly required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id" class="control-label">Area</label>
                    <input type="text" name="nm_area" value="<?= $bank['nm_area']; ?>"  class="form-control" id="nm_area" placeholder="" readonly>
                      <input type="hidden" name="area" value="<?= $bank['kd_area']; ?>"  class="form-control" id="area" placeholder="">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="<?= $bank['tgl_pinjaman']; ?>" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Pegawai Tujuan</label>
                    <select name="kd_pegawai_asal"  id="kd_pegawai_asal" class="form-control" required>
                      <option value="">No Selected</option>
                    </select>
                  </div>
                </div>
                
              </div>
              <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Pegawai</label>
                    <select name="kd_pegawai"  id="kd_pegawai" class="form-control" required>
                      <option value="">No Selected</option>
                    </select>
                  </div>
                </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="1" class="form-control"><?= $bank['keterangan']; ?></textarea>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Saldo Kas</label>
                    <input type="text" name="saldo" id="saldo" class="form-control" value="0,00"  placeholder="" style="text-align:right;" readonly>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="nilai" class="control-label">Nilai</label>
                    <input type="text" name="nilai" id="nilai" class="form-control" value="<?= number_format($bank['nilai'],2,',','.'); ?>"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
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
    kd_area = "<?= $bank['kd_area']; ?>";
    get_pegawai(kd_area);
    get_pegawai_asal(kd_area);
    var kd_pegawai='<?= $bank['kd_pegawai']; ?>'
    var kd_pegawai_asal='<?= $bank['kd_pegawai_asal']; ?>'
    get_kas_area(kd_pegawai_asal);
    function get_pegawai (kd_area){ 
                $.ajax({
                    url : "<?php echo site_url('pinjaman/get_pegawai_by_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: kd_area},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="kd_pegawai"]').empty();
                        $('select[name="kd_pegawai"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                            if (value.kd_pegawai==kd_pegawai){
                                $('select[name="kd_pegawai"]').append('<option value="'+ value.kd_pegawai +'" selected>'+ value.nama +'</option>');
                            }else{
                                $('select[name="kd_pegawai"]').append('<option value="'+ value.kd_pegawai +'">'+ value.nama +'</option>');
                            }
                            
                        });

                    }
                });
                return false;
            }

  function get_pegawai_asal (kd_area){ 
                $.ajax({
                    url : "<?php echo site_url('pinjaman/get_pegawai_kas_by_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: kd_area},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="kd_pegawai_asal"]').empty();
                        $('select[name="kd_pegawai_asal"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                            if (value.kd_pegawai==kd_pegawai_asal){
                                $('select[name="kd_pegawai_asal"]').append('<option value="'+ value.kd_pegawai +'" selected>'+ value.nama +'</option>');
                            }else{
                                $('select[name="kd_pegawai_asal"]').append('<option value="'+ value.kd_pegawai +'">'+ value.nama +'</option>');
                            }
                            
                        });

                    }
                });
                return false;
            }

            $('#kd_pegawai').val("<?= $bank['kd_pegawai']; ?>");
            $('#kd_pegawai_asal').val("<?= $bank['kd_pegawai_asal']; ?>");
            
            $('#kd_pegawai_asal').change(function(){ 
              get_kas_area($(this).val())
            });

            function get_kas_area(id){
                    var project  = $('#project').val();
                    $.ajax({
                        url : "<?php echo site_url('pinjaman/get_kas_area');?>",
                        method : "POST",
                        data : {
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                        id: id},
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