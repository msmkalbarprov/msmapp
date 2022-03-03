<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
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
            <h3 class="card-title"> <i class="fa fa-pencil-square-o"></i>
             Edit HPP </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pq/add_hpp/'.$data_hpp_rinci["id_pqproyek"]) ?>" class="btn btn-primary"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         
         <?php echo form_open_multipart('pq/edit_hpp/'.$data_hpp_rinci["id"].'/'.$data_hpp_rinci["id_pqproyek"]);?>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
              <input type="hidden" name="id" id="id" class="form-control"  placeholder="Uraian" value="<?= $data_hpp_rinci["id"]; ?>" readonly>
              <input type="hidden" name="idpqproyek" id="idpqproyek" class="form-control"  placeholder="Uraian" value="<?= $data_hpp_rinci["id_pqproyek"]; ?>" readonly>
                <select name="area" id ="area" class="form-control select2" style="width: 100%;" required>
                <option value="">No Selected</option>
                <?php foreach($data_area as $area): ?>
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="proyek" class="control-label">PQ Proyek</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <select name="projek" id ="projek" class="form-control select2" style="width: 100%;" readonly>
                <option value="">No Selected</option>
                <?php foreach($data_pqproyek as $projek): ?>
                      <option value="<?= $projek['id_pqproyek']; ?>" selected><?= $projek['kd_pqproyek'].' - '.$projek['nm_paket_proyek']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
          </div>

        </div>

         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="item_hpp" class="control-label">PQ Item</label>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <select name="item_hpp" id="item_hpp" class="form-control select2" style="width: 100%;" required>
                <option value="">No Selected</option>
                <?php foreach($item_hpp as $item_hpp): ?>
                      <option value="<?= $item_hpp['no_acc']; ?>"><?= $item_hpp['nm_acc']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
          </div>
          <div class="col-md-3">
           <div class="form-group">
            <label for="jenis_tk" class="control-label">Jenis <small>(Khusus Tenaga Kerja Langsung)</small></label>
              <select class="form-control" name="jenis_tk" id="jenis_tk" disabled>
                <option value="">No Selected</option>
                <option value="programer">Programer</option>
                <option value="akuntan">Akuntan</option>
                <option value="rc">RC</option>
                <option value="lain">Lainnya</option>
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
         <div class="col-md-2">
            <div class="form-group">
              <label for="DPA/DPPA" class="control-label">Volume</label>
                <input type="number" name="volume" id="volume" class="form-control" placeholder="" >
            </div>
          </div>
          <div class="col-md-2">
           <div class="form-group">
            <label for="satuan" class="control-label">Satuan</label>
              <input type="text" name="satuan"  class="form-control" id="satuan" placeholder="" >
          </div>
          </div>

          <div class="col-md-2">
           <div class="form-group">
            <label for="satuan" class="control-label">Periode <small>(Bulan)</small></label>
              <input type="number" name="periode"  class="form-control" id="periode" placeholder="" >
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

         <div class="row">
          
          <div class="col-md-9" align="right">
            <label for="dinas" class="control-label">Pendapatan Nett</label>
          </div>
          <div class="col-md-3">
           <div class="form-group">
                <input type="text" name="pnet" id="pnet" class="form-control"  style="background:none;text-align:right;"readonly >
            </div>
          </div>
         
         </div>

         <div class="row">
          
          <div class="col-md-9" align="right">
           <label for="dinas" class="control-label">Total HPP</label>
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
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
  <script>
  $("#pq> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    $('.select2').select2()
    get_data_detail();
    get_sisa()
     $('#item_hpp').change(function(){ 
                var kd_coa=$(this).val();
                if (kd_coa=='5010202'){
                  document.getElementById("jenis_tk").disabled = false;
                }else{
                  document.getElementById("jenis_tk").value = '';
                  document.getElementById("jenis_tk").disabled = true;
                }
                
                return false;
            });
    }); 

  function get_data_detail(){
              var id = "<?php echo $data_hpp_rinci["id"] ?>";
              $.ajax({
                url : "<?php echo site_url('pq/get_data_hpp_edit');?>",
                    method : "POST",
                    data :{
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id :id
                    },
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            $('[name="projek"]').val(data[i].id_pqproyek).trigger('change');
                            $('[name="area"]').val(data[i].kd_area).trigger('change');
                            $('[name="uraian"]').val(data[i].keterangan);
                            $('[name="item_hpp"]').val(data[i].kd_item).trigger('change');
                            $('[name="jenis_tk"]').val(data[i].jenis_tk).trigger('change');
                            $('[name="volume"]').val(data[i].volume);
                            $('[name="satuan"]').val(data[i].satuan);
                            $('[name="periode"]').val(data[i].periode);
                            $('[name="harga"]').val(number_format(data[i].harga,"2",",","."));
                            $('[name="total"]').val(number_format(data[i].total,"2",",","."));
                        });
                    }

              });
      document.getElementById("area").disabled=true;
      document.getElementById("projek").disabled=true;
    }

function get_sisa(){
        var idpqproyek = document.getElementById("projek").value;
        $.ajax({
        url : "<?php echo site_url('pq/get_sisapqproyek');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: idpqproyek},
        async : true,
        dataType : 'json',
        success: function(data){
            $.each(data, function(key, value) {
                $('[name="pnet"]').val(number_format(value.pnet,"2",",",".")).trigger('change');
                $('[name="thpp"]').val(number_format(value.hpp,"2",",",".")).trigger('change');
                $('[name="sisa"]').val(number_format(value.sisa,"2",",",".")).trigger('change');
            });

        }
    });
}

document.getElementById("volume").onmouseup = function() {hitung_total()};
document.getElementById("volume").onkeyup   = function() {hitung_total()};
document.getElementById("periode").onmouseup = function() {hitung_total()};
document.getElementById("periode").onkeyup   = function() {hitung_total()}
document.getElementById("harga").onkeyup   = function() {hitung_total()};

function hitung_total() {
  var harga     = number(document.getElementById("harga").value);
  var volume    = number(document.getElementById("volume").value);
  var periode   = number(document.getElementById("periode").value);
  let totalrow = 0;

  totalrow = harga*volume*periode;
  $('[name="total"]').val(number_format(totalrow,"2",",",".")).trigger('change');
}

</script>
