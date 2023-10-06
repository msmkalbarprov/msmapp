  <!-- Content Wrapper. Contains page content -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
    <?php if ($bank['status_terima']=='1') echo '<div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <p>
                    <i class="icon fa fa-check"></i>
                    Sudah diterima                </p>
            </div>';?>
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title">
              Terima Pembayaran Tahun Lalu </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('penerimaan_pembayaran_hutang_tahun_lalu'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List pembayaran</a>
          </div>
        </div>

        
                     
        
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('penerimaan_pembayaran_hutang_tahun_lalu/terima/'.$bank['id']), 'class="form-horizontal"' )?> 
            <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id" class="control-label">No.Kas</label>
                    <input type="text" name="no_kas" value=""  class="form-control" id="no_kas" placeholder="" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Tanggal Terima</label>
                    <input type="date" name="tanggal_terima" id="tanggal_terima" value="<?= $bank['tgl_bayar']; ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sub_area" class="control-label">Status</label>
                        <select name="status_terima"  id="status_terima" class="form-control" required>
                        <option value="">No Selected</option>
                        <option value="1" 
                        <?php if ($bank['status_terima']=='1') echo 'selected';?>
                        >Diterima</option>
                        <option value="0" <?php if ($bank['status_terima']=='0') echo 'selected';?>>Belum Diterima</option>
                        </select>
                    </div>
                </div>
                
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="id" class="control-label">Area</label>
                    <input type="text" name="nm_area" value="<?= $bank['nm_area']; ?>"  class="form-control" id="nm_area" placeholder="" readonly>
                      <input type="hidden" name="area" value="<?= $bank['kd_area']; ?>"  class="form-control" id="area" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Tanggal Bayar</label>
                    <input type="date" name="tanggal" id="tanggal" value="<?= $bank['tgl_bayar']; ?>" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Pegawai</label>
                    <select name="kd_pegawai"  id="kd_pegawai" class="form-control" required readonly>
                      <option value="">No Selected</option>
                    </select>
                  </div>
                </div>
                
              </div>
              <div class="row">
              <div class="col-md-8">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="1" class="form-control" readonly><?= $bank['keterangan']; ?></textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- <div class="form-group">
                    <label for="saldo" class="control-label">Saldo Kas</label>
                    <input type="text" name="saldo" id="saldo" class="form-control" value="0,00"  placeholder="" style="text-align:right;" readonly>
                  </div> -->
                  <div class="form-group">
                    <label for="nilai" class="control-label">Nilai</label>
                    <input type="text" name="nilai" id="nilai" class="form-control" value="<?= number_format($bank['nilai'],2,',','.'); ?>"  placeholder="" style="text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))" readonly>
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
    var kd_pegawai='<?= $bank['kd_pegawai']; ?>'
    get_nomor_urut(kd_pegawai);
    function get_pegawai (kd_area){ 
        get_kas_area()
                $.ajax({
                    url : "<?php echo site_url('pembayaranTahunLalu/get_pegawai_by_area');?>",
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

            $('#kd_pegawai').val("<?= $bank['kd_pegawai']; ?>");
            function get_kas_area(){
                    var project  = $('#project').val();
                    var rekening = '1010102';
                    $.ajax({
                        url : "<?php echo site_url('pelimpahan_kb/get_kas');?>",
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


    function get_nomor_urut(kd_pegawai){
        $.ajax({
        url : "<?php echo site_url('pinjaman/get_nomor');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          kd_pegawai: kd_pegawai},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                nospj = value.nomor;
                $('[name="no_kas"]').val(value.nomor).trigger('change');
            });

        }
    });
}

  });
  </script>