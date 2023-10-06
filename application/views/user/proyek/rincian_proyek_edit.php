  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-pencil-square-o"></i>
             Edit rincian pekerjaan </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pekerjaan/edit/'.$rincian_proyek["id_proyek"]); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         
         <?php echo form_open_multipart('pekerjaan/editrincian/'.$rincian_proyek["id"]);?>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="jnspagu" class="control-label"><?= trans('jnspagu') ?></label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="id_proyek" value="<?= $rincian_proyek["id_proyek"]; ?>">
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
                <input type="hidden" name="old_pic_file" value="<?php echo html_escape($rincian_proyek['dokumen']); ?>">
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-3">
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
          <div class="col-md-3">
            <div class="form-group">
              <label for="lama_pekerjaan" class="control-label">Lama Pekerjaan</label>
                <input type="number" name="lama_pekerjaan"  class="form-control" id="lama_pekerjaan" placeholder="Lama pekerjaan" >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="nilai" class="control-label"><?= trans('nilai') ?></label>
              <input type="text" name="nilai" class="form-control" id="nilai" placeholder="Nilai" style="text-align:right;" onkeypress="return(currencyFormat(this,',','.',event))"  required>
            </div>
          </div>
         </div>
        <div class="form-group">
          <div class="col-md-12">
            <input type="submit" name="submit" value="Update" class="btn btn-primary btn-sm pull-right">
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
    get_data_detail();
      $('#jnspagu').change(function(){ 
                var id=$(this).val();
                if (id==1){
                  document.getElementById("tipeproyek").disabled = true;
                  document.getElementById("nodpa").disabled = true;
                  document.getElementById("tanggal").disabled = true;
                  document.getElementById("pic_file").disabled = true;
                  document.getElementById("tanggal2").disabled = true;
                  document.getElementById("jns_pph").disabled = true;
                  document.getElementById("lama_pekerjaan").disabled = true;
                }else if(id==2){
                  document.getElementById("tipeproyek").disabled = true;
                  document.getElementById("nodpa").disabled = true;
                  document.getElementById("tanggal").disabled = true;
                  document.getElementById("pic_file").disabled = true;
                  document.getElementById("tanggal2").disabled = true;
                  document.getElementById("jns_pph").disabled = true;
                  document.getElementById("lama_pekerjaan").disabled = true;
                }else if (id==3 || id==4){
                  document.getElementById("tipeproyek").disabled = true;
                  document.getElementById("nodpa").disabled = false;
                  document.getElementById("tanggal").disabled = false;
                  document.getElementById("pic_file").disabled = false;
                  document.getElementById("tanggal2").disabled = true;
                  document.getElementById("jns_pph").disabled = false;
                  document.getElementById("lama_pekerjaan").disabled = false;
                }else if (id==5){
                  document.getElementById("tipeproyek").disabled = false;
                  document.getElementById("nodpa").disabled = true;
                  document.getElementById("tanggal").disabled = true;
                  document.getElementById("pic_file").disabled = false;
                  document.getElementById("tanggal2").disabled = true;
                  document.getElementById("jns_pph").disabled = false;
                  document.getElementById("lama_pekerjaan").disabled = false;
                }else{
                  document.getElementById("tipeproyek").disabled = false;
                  document.getElementById("nodpa").disabled = false;
                  document.getElementById("tanggal").disabled = false;
                  document.getElementById("pic_file").disabled = false;
                  document.getElementById("tanggal2").disabled = false;
                  document.getElementById("jns_pph").disabled = false;
                  document.getElementById("lama_pekerjaan").disabled = false;
                }
                
                return false;
            });
  }); 

  function get_data_detail(){
              var id = "<?php echo $rincian_proyek["id"] ?>";
              $.ajax({
                url : "<?php echo site_url('proyek/get_data_detail_rincian_edit');?>",
                    method : "POST",
                    data :{
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id :id
                    },
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            jnsproyek= data[i].jns_proyek;
                            $('[name="jnspagu"]').val(data[i].jns_pagu).trigger('change');
                            $('[name="tipeproyek"]').val(data[i].tipe_proyek).trigger('change');
                            $('[name="jns_pph"]').val(data[i].jns_pph).trigger('change');
                            $('[name="nodpa"]').val(data[i].no_dokumen);
                            $('[name="lama_pekerjaan"]').val(data[i].lama_pekerjaan);
                            $('[name="tanggal"]').val(data[i].tanggal);
                            $('[name="tanggal2"]').val(data[i].tanggal2);
                            $('[name="paketproyek"]').val(data[i].nm_paket_proyek);
                            $('[name="nilai"]').val(number_format(data[i].nilai,"2",".",","));
                        });
                    }

              });
            }   

</script>
