  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-plus"></i>
             <?= trans('rincian_proyek_add') ?> </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('proyek/edit/'.$proyek["id_proyek"]); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         
         <?php echo form_open_multipart('proyek/addrincian/'.$proyek["id_proyek"]);?>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="jnspagu" class="control-label"><?= trans('jnspagu') ?></label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="id_proyek" value="<?= $proyek["id_proyek"]; ?>">
                <select name="jnspagu" id="jnspagu" class="form-control" required>
                <option value="">No Selected</option>
                <?php foreach($data_jnspagu as $jnspagu): ?>
                      <option value="<?= $jnspagu['id']; ?>"><?= $jnspagu['nama']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label"><?= trans('tipeproyek') ?></label>
              <select name="tipeproyek" id="tipeproyek" class="form-control">
                  <option value="">No Selected</option>
                  <?php foreach($data_tipeproyek as $tipeproyek): ?>
                    <option value="<?= $tipeproyek['id']; ?>"><?= $tipeproyek['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="DPA/DPPA" class="control-label">No. DPA/DPPA/SPK</label>
                <input type="text" name="nodpa" id="nodpa" class="form-control" id="nodpa" placeholder="No. DPA/DPPA" >
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="tanggal" class="control-label">Tanggal DPA/DPPA/SPK</label>
              <input type="date" name="tanggal"  class="form-control" id="tanggal" placeholder="Tanggal" >
          </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="tanggal2" class="control-label">Tanggal Selesai SPK</label>
                <input type="date" name="tanggal2"  class="form-control" id="tanggal2" placeholder="Tanggal Selesai SPK" >
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="dinas" class="control-label">File DPA/DPPA/Kontrak</label>
               <input type="file" name="pic_file" class="form-control" id="pic_file">
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="jns_pph" class="control-label">Jenis PPH</label>
              <select name="jns_pph" id="jns_pph" class="form-control" disabled>
                  <option value="">No Selected</option>
                  <option value="21">PPH 21</option>
                  <option value="22">PPH 22</option>
                  <option value="23">PPH 23</option>
                </select>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <div class="form-group">
              <label for="nilai" class="control-label"><?= trans('nilai') ?></label>
              <input type="text" name="nilai" class="form-control" id="nilai" placeholder="Nilai" style="text-align:right;" onkeypress="return(currencyFormat(this,',','.',event))"  required>
            </div>
          </div>
          </div>
         </div>
        <div class="form-group">
          <div class="col-md-12">
            <input type="submit" name="submit" value="Simpan" class="btn btn-primary pull-right btn-sm">
          </div>
        </div>
        <?php echo form_close( ); ?>
      </div>
      <!-- /.box-body -->
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
  <script>
  $("#proyek> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
      $('#jnspagu').change(function(){ 
                var id=$(this).val();
                if (id==1){
                  document.getElementById("tipeproyek").disabled = true;
                  document.getElementById("nodpa").disabled = true;
                  document.getElementById("tanggal").disabled = true;
                  document.getElementById("pic_file").disabled = true;
                  document.getElementById("tanggal2").disabled = true;
                  document.getElementById("jns_pph").disabled = true;
                }else if(id==2){
                  document.getElementById("tipeproyek").disabled = true;
                  document.getElementById("nodpa").disabled = true;
                  document.getElementById("tanggal").disabled = true;
                  document.getElementById("pic_file").disabled = true;
                  document.getElementById("tanggal2").disabled = true;
                  document.getElementById("jns_pph").disabled = true;
                }else if (id==3 || id==4){
                  document.getElementById("tipeproyek").disabled = true;
                  document.getElementById("nodpa").disabled = false;
                  document.getElementById("tanggal").disabled = false;
                  document.getElementById("pic_file").disabled = false;
                  document.getElementById("tanggal2").disabled = true;
                  document.getElementById("jns_pph").disabled = false;
                }else if (id==5){
                  document.getElementById("tipeproyek").disabled = false;
                  document.getElementById("nodpa").disabled = true;
                  document.getElementById("tanggal").disabled = true;
                  document.getElementById("pic_file").disabled = true;
                  document.getElementById("tanggal2").disabled = true;
                  document.getElementById("jns_pph").disabled = false;
                }else{
                  document.getElementById("tipeproyek").disabled = false;
                  document.getElementById("nodpa").disabled = false;
                  document.getElementById("tanggal").disabled = false;
                  document.getElementById("pic_file").disabled = false;
                  document.getElementById("tanggal2").disabled = false;
                  document.getElementById("jns_pph").disabled = false;
                }
                
                return false;
            });
  }); 
</script>