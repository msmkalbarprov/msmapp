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
             Edit Item PQ Operasional </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pq/add_operasional') ?>" class="btn btn-primary"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         
         <?php echo form_open_multipart('pq/edit_rincian_pq_operasional/'.$rincian_pq_operasional["id_pq_operasional"]);?>
         <div class="row">
          <div class="col-md-2">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">No. PQ Operasional</label>
              <input type="text" name="kd_pq" id="kd_pq" class="form-control"  placeholder="Uraian" value="<?= date('Y')?>/98/00" readonly>
              <input type="hidden" name="id_pq" id="id_pq" class="form-control"  placeholder="Uraian" value="<?= $rincian_pq_operasional['id_pq_operasional'] ?>" readonly>
              <input type="hidden" name="metod" id="metod" class="form-control"  placeholder="Uraian" value="<?= $this->uri->segment(4); ?>" readonly>
          </div>
          </div>

          <div class="col-md-1">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Tahun</label>
              <input type="text" name="tahun" id="tahun" class="form-control"  placeholder="Uraian" value="<?= date('Y')?>" readonly>
          </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <select name="area" id ="area" class="form-control" required>
                <option value="">No Selected</option>
                <?php foreach($data_area as $area): ?>
                  <?php if($area['kd_area'] == $this->session->userdata('kd_area')): ?>
                    <option value="<?= $area['kd_area']; ?>" selected><?= $area['nm_area']; ?></option>
                    <?php else: ?>
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="proyek" class="control-label">Pembebanan Proyek</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <select name="projek" id ="projek" class="form-control select2" style="width: 100%;">
                <option value="">No Selected</option>
                <?php foreach($data_mprojek as $projek): ?>
                      <option value="<?= $projek['kd_proyek']; ?>"><?= $projek['kd_proyek'].' - '.$projek['nm_paket_proyek']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
          </div>
          
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="item_op" class="control-label">PQ Item</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <select name="item_op" id="item_op" class="form-control select2" style="width: 100%;" required>
                <option value="">No Selected</option>
                <?php foreach($item_operasioanl as $item_operasioanl): ?>
                      <option value="<?= $item_operasioanl['no_acc']; ?>"><?= $item_operasioanl['nm_acc']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="tipeproyek" class="control-label">Uraian</label>
              <input type="text" name="uraian" id="uraian" class="form-control"  placeholder="Uraian" >
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="DPA/DPPA" class="control-label">Volume</label>
                <input type="number" name="volume" id="volume" class="form-control" placeholder="" >
            </div>
          </div>
          <div class="col-md-3">
           <div class="form-group">
            <label for="satuan" class="control-label">Satuan</label>
              <input type="text" name="satuan"  class="form-control" id="satuan" placeholder="" >
          </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="tanggal2" class="control-label">Harga</label>
                <input type="text" name="harga" id="harga" class="form-control" value="0" style="background:none;text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
            </div>
          </div>
          <div class="col-md-3">
           <div class="form-group">
            <label for="dinas" class="control-label">Total</label>
               <input type="text" name="total" id="total" class="form-control" value="0" style="background:none;text-align:right;"readonly >
          </div>
          </div>
         </div>

        <div class="form-group">
          <div class="col-md-12">
            <input type="submit" name="submit" id="butsave" value="Simpan" class="btn btn-primary pull-right btn-sm">
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
  $("#pq> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    get_data_detail();
    }); 

  function get_data_detail(){
              var id = "<?php echo $rincian_pq_operasional["kd_pq_operasional"] ?>";
              $.ajax({
                url : "<?php echo site_url('pq/get_data_item_edit');?>",
                    method : "POST",
                    data :{
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id :id
                    },
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            $('[name="projek"]').val(data[i].kd_proyek).trigger('change');
                            $('[name="area"]').val(data[i].kd_area).trigger('change');
                            $('[name="uraian"]').val(data[i].uraian);
                            $('[name="tahun"]').val(data[i].kd_pq_operasional.substr(0,4));
                            $('[name="tanggal"]').val(data[i].tanggal);
                            $('[name="item_op"]').val(data[i].kd_item);
                            $('[name="volume"]').val(data[i].volume);
                            $('[name="satuan"]').val(data[i].satuan);
                            $('[name="kd_pq"]').val(data[i].kd_pq_operasional.substr(0,10));
                            $('[name="harga"]').val(number_format(data[i].harga,"2",",","."));
                            $('[name="total"]').val(number_format(data[i].total,"2",",","."));
                        });
                    }

              });
            }
  document.getElementById("volume").onmouseup = function() {hitung_total()};
document.getElementById("volume").onkeyup   = function() {hitung_total()};

document.getElementById("harga").onkeyup   = function() {hitung_total()};

function hitung_total() {
  var harga     = number(document.getElementById("harga").value);
  var volume    = number(document.getElementById("volume").value);
  let totalrow = 0;

  totalrow = harga*volume;
  $('[name="total"]').val(number_format(totalrow,"2",",",".")).trigger('change');
}   

</script>
