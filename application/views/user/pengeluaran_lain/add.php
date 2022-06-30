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
              Tambah Pengeluaran Lainnya </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('pengeluaran_lain/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Pengeluaran</a>
          </div>
        </div>
        <div class="card-body">   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
              
            <?php echo form_open(base_url('pengeluaran_lain/add/'), 'class="form-horizontal"' )?> 

              <div class="row">
              <div class="col-md-3">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">No. Bukti</label>
                    <input type="text" name="nobukti" id="nobukti" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="sub_area" class="control-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id" class="control-label">Akun</label>
                    <select name="no_acc" id="no_acc" class="form-control select2" style="width: 100%;" required>
                      <option value="">No Selected</option>
                      <?php foreach($data_akun as $akun): ?>
                            <option value="<?= $akun['no_acc']; ?>"><?= $akun['nm_acc']; ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id" class="control-label">Rekening</label>
                    <select name="no_rekening" id="no_rekening" class="form-control select2" style="width: 100%;" required>
                      <option value="">No Selected</option>
                      <?php foreach($data_rekening as $rekening): ?>
                            <option value="<?= $rekening['kode']; ?>"><?= $rekening['nama']; ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="saldo" class="control-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="1" class="form-control"></textarea>
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
    get_nomor_urut()
        $('#saldo').val('0,00');
    get_kas_area();
    // $('#area').change(function(){ 
    //     $('#saldo').val('0,00');
    //     get_kas_area($(this).val())
    //             var subarea=$(this).val();
    //             $.ajax({
    //                 url : "<?php echo site_url('pengeluaran_lain/get_pegawai_by_area');?>",
    //                 method : "POST",
    //                 data : {
    //                   '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
    //                   id: subarea},
    //                 async : true,
    //                 dataType : 'json',
    //                 success: function(data){
    //                     $('select[name="kd_pegawai"]').empty();
    //                     $('select[name="kd_pegawai"]').append('<option value="">No Selected</option>');
    //                     $.each(data, function(key, value) {
    //                         $('select[name="kd_pegawai"]').append('<option value="'+ value.kd_pegawai +'">'+ value.nama +'</option>');
    //                     });

    //                 }
    //             });
    //             return false;
    //         });


            function get_kas_area(area){
                    var area  = '01';
                    $.ajax({
                        url : "<?php echo site_url('pengeluaran_lain/get_kas');?>",
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