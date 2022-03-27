  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
    <style type="text/css">
.select2-container .select2-selection {
  height: 37px; 
}
    </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-plus"></i>
             Edit PDO Operasional </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pdo'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

        <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <?php $this->load->view('admin/includes/_messages.php') ?>
         <?php echo form_open_multipart('cpdo/edit_pdo_operasional/'.$data_pdo["id_pdo"]);?>
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="item_hpp" class="control-label">Kode PDO</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="text" name="kd_pdo" id="kd_pdo" class="form-control" value="<?= $data_pdo['kd_pdo']; ?>" readonly>

            </div>
          </div>
          
          <div class="col-md-3">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tanggal PDO</label>
              <input type="date" name="tgl_pdo" id="tgl_pdo" class="form-control" value="<?= $data_pdo['tgl_pdo']; ?>"  readonly >
          </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="proyek" class="control-label">Tahun Anggaran</label>
              <input type="text" name="thn_ang" id="thn_ang" class="form-control" value="<?= substr($data_pdo['kd_project'],0,4); ?>"  readonly>
            </div>
          </div>
          

         </div>

         <div class="row">
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label">Area</label>
                <input type="text" name="area" id="area" class="form-control" value="<?= $data_pdo['nm_area']; ?>" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="item_hpp" class="control-label">PQ Operasional</label>
              <input type="text" name="item_hpp" id="item_hpp" class="form-control" value="<?= $data_pdo['no_acc'].' '.$data_pdo['nm_acc']; ?>" readonly>
            </div>
          </div>
          
         </div>

         <div class="row">
          
          
          <div class="col-md-12">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Uraian</label>
              <input type="text" name="uraian" id="uraian" class="form-control" value="<?= $data_pdo['uraian']; ?>"  placeholder="Uraian" >
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-2">
            
          </div>
          <div class="col-md-2">
          </div>

          <div class="col-md-2">
          </div>

          <div class="col-md-3" align="right">
            <label for="dinas" class="control-label">Nilai PDO </label>
          </div>
          <div class="col-md-3">
           <div class="form-group">
            <input type="hidden" name="nilai_ini" id="nilai_ini" class="form-control" value="<?= $data_pdo['nilai']; ?>" style="background:none;text-align:right;"readonly >
               <input type="text" name="total" id="total" class="form-control bg-light text-white" value="<?= number_format($data_pdo['nilai'],'2',',','.'); ?>" placeholder="Input Nilai"  style="background:none;text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
          </div>
          </div>
         </div>

         <div class="row">
          
          <div class="col-md-9" align="right">
            <label for="dinas" class="control-label">Nilai HPP</label>
          </div>
          <div class="col-md-3">
           <div class="form-group">
                <input type="text" name="pnet" id="pnet" class="form-control"  style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

         <div class="row">
          
          <div class="col-md-9" align="right">
           <label for="dinas" class="control-label">Realisasi</label>
          </div>
          <div class="col-md-3" >
           <div class="form-group">
                <input type="text" name="thpp" id="thpp" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

         <div class="row">
          
          <div class="col-md-9" align="right">
           <label for="dinas" class="control-label">Sisa</label>
          </div>
          <div class="col-md-3">
           <div class="form-group">
                <input type="text" name="sisa" id="sisa" class="form-control"   style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

        <div class="form-group">
          <div class="col-md-12" align="center">
            <input type="submit" name="submit" id="butsave" value="Update" class="btn btn-primary btn-sm">
          </div>
        </div>
      
      <?php echo form_close( ); ?>
      </div>
      <!-- /.box-body -->
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script>
  $("#pq> a").addClass('active');
</script>
<script>
  $(document).ready(function(){

var kode_pqoperasional = "<?= $data_pdo['kd_project'] ?>";
get_nilai(kode_pqoperasional);  


function get_nilai(kode_pqoperasional){
        $.ajax({
        url : "<?php echo site_url('cpdo/get_nilai_op');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          kode_pqoperasional: kode_pqoperasional},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="pnet"]').val(number_format(value.total,"2",",",".")).trigger('change');

                get_realisasi(kode_pqoperasional,value.total)
            });

        }
    });
}



function get_realisasi(kode_pqoperasional,nil_hpp){
        $.ajax({
        url : "<?php echo site_url('cpdo/get_realisasi_op');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          kode_pqoperasional: kode_pqoperasional},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="thpp"]').val(number_format(value.total,"2",",",".")).trigger('change');

                $('[name="sisa"]').val(number_format(nil_hpp - value.total,"2",",",".")).trigger('change');

            });

        }
    });
        
}

  }); 


</script>