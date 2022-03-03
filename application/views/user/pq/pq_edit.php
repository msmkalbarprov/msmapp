  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"> 
    <style type="text/css">
      .title .rupiah { float:right }
    </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-plus"></i>
             Tambah Pendapatan </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pq'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         <?php echo form_open(base_url('pq/edit/'.$pqproyek['id_pqproyek']), 'class="form-horizontal"');  ?> 
         <div class="row">
          <div class="col-md-3">
           <div class="form-group">
            <label for="area" class="control-label"><?= trans('area') ?></label>
              <select name="area" id ="area" class="form-control" required disabled>
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
          <div class="col-md-3">
            <div class="form-group">
              <label for="sub_area" class="control-label"><?= trans('sub_area') ?></label>
              <select name="subarea"  id="subarea" class="form-control" required disabled>
                <option value="">No Selected</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="projek" class="control-label">Proyek</label>
                <select name="projek"  id="projek" class="form-control" required disabled>
                <option value="">No Selected</option>
              </select>

            </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="jenis_proyek" class="control-label"><?= trans('jenis_proyek') ?></label>
              <input type="text" name="jnsproyek" id="jnsproyek" class="form-control" readonly>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            </div>
          </div>
          <div class="col-md-3">
           <div class="form-group">
            <label for="jenis_sub_proyek" class="control-label"><?= trans('jenis_sub_proyek') ?></label>
              <input type="text" name="jnssubproyek" id="jnssubproyek" class="form-control" readonly>
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="perusahaan" class="control-label"><?= trans('perusahaan') ?></label>
                <input type="text" name="perusahaan" id="perusahaan" class="form-control" readonly>
            </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="jns_pph" class="control-label">Tipe Pengadaan</label>
              <input type="text" name="tipeproyek" id="tipeproyek" class="form-control" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="thn_ang" class="control-label">Tahun Anggaran</label>
                <input type="text" name="thn_ang" id="thn_ang" class="form-control" readonly>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="dinas" class="control-label"><?= trans('nm_dinas') ?></label>
              <input type="text" name="dinas" id="dinas" class="form-control" readonly>
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="nilai" class="control-label">Nama Paket pekerjaan</label>
              <input type="text" name="paketproyek" class="form-control" id="paketproyek" placeholder="Nama Paket pekerjaan" readonly>
          </div>
          </div>
         </div>
         <div class="row">
            <div class="col-md-6">
              <h6><b>Pendapatan</b></h6>
              <hr>
            </div>
            <div class="col-md-6">
              <h6><b>Perhitungan Nett Profit</b></h6>
              <hr>
            </div>
          </div>
         <div class="row">
           <div class="col-md-6">
            <table width="100%" border="0">
               <tr>
                 <td width="50%">Nilai SPK</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilaispk" style="background:none;border: none;text-align:right;" id="nilaispk" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">PPN</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilaippn" style="background:none;border: none;text-align:right;" id="nilaippn" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">PPH</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;">
                    <input type="hidden" name="jnspph" id="jnspph">
                    <input type="text" name="nilaipph" style="background:none;border: none;text-align:right;" id="nilaipph" class="form-control" readonly>
                  </td>
               </tr>
                <tr>
                 <td width="50%"><b>SPK. Nett</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"> <input type="text" name="nilaipend_nett" style="background:none;border: none;text-align:right;" id="nilaipend_nett" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"> <input type="text" name="titipan" style="background:none;text-align:right;" id="titipan" placeholder="0,00" value="<?= number_format($pqproyek['titipan'],2,',','.'); ?>" onkeypress="return(currencyFormat(this,'.',',',event))"  class="form-control" ></td>
               </tr>
               <tr>
                 <td width="50%">PPN titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilaippntitipan" style="background:none;border: none;text-align:right;" value="<?= number_format($pqproyek['ppntitipan'],2,',','.'); ?>" id="nilaippntitipan" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">PPH titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;">
                  <input type="text" name="nilaipphtitipan" style="background:none;border: none;text-align:right;" id="nilaipphtitipan" class="form-control" readonly>
                </td>
               </tr>
               <tr>
                 <td width="50%"><b>Titipan Net</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="titipan_net" style="background:none;border: none;text-align:right;" id="titipan_net" class="form-control" readonly></td>
               </tr>
               
             </table>
           </div>
           <div class="col-md-6">
            <table width="100%" border="0">
               <tr>
                 <td width="50%"><b>Pendapatan Nett</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilai_pend_net_s_titipan" style="background:none;border: none;text-align:right;" id="nilai_pend_net_s_titipan" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Biaya Partner Lokal (PL)  &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="plpersen" style="background:none;text-align:right;width: 60px;" id="plpersen" placeholder="0,00" value="<?= number_format($pqproyek['persen_pl'],2,',','.'); ?>" onkeypress="return(currencyFormat(this,'.',',',event))" >&nbsp;%
                 <td width="5%">:</td>
                 <td width="45%" align="right" ><input type="text" name="pl" style="background:none;border: none;text-align:right;" id="pl" placeholder="0,00" value="<?= number_format($pqproyek['npl'],2,',','.'); ?>"  class="form-control" readonly></td>
               </tr>
                <tr>
                 <td width="50%">Pembulatan Biaya Partner Lokal (PL)
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;" >
                  <input type="text" name="pl_bulat" style="background:none;text-align:right;" id="pl_bulat" placeholder="0,00" value="<?= number_format($pqproyek['ppl'],2,',','.'); ?>" onkeypress="return(currencyFormat(this,'.',',',event))"  class="form-control" ></td>
               </tr>
                <tr>
                 <td width="50%"><b>Pendapatan Nett Setelah (PL)</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilai_pend_net_s_pl" style="background:none;border: none;text-align:right;" id="nilai_pend_net_s_pl" class="form-control" readonly></td>
               </tr>

               <tr>
                 <td width="50%"><b>Alokasi HO <small>15% dari Pendapatan Nett</small></b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;"><input type="text" name="al_ho" style="background:none;border: none;text-align:right;" id="al_ho" placeholder="0,00" value="<?= number_format($pqproyek['nalokasi_ho'],2,',','.'); ?>"  class="form-control" readonly></td>
               </tr>
             </table>
           </div>
         </div>
         
        
        <div class="form-group">
          <div class="col-md-12" align="right">
            <input type="submit" name="submit" value="Update" class="btn btn-primary btn-sm">
          </div>
        </div>
        <?php echo form_close( ); ?>
      </div>
      <!-- /.box-body -->
    </div>
    
  </section> 
</div>

  
</div>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
  <script>
  // $("#proyek").addClass('menu-open');
  $("#pq> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    get_subareacombo();
    


document.getElementById("titipan").onkeyup = function() {hitungtitipan()};
document.getElementById("plpersen").onkeyup = function() {hitungtitipan()};
document.getElementById("pl_bulat").onkeyup = function() {hitungtitipan()};

function hitungtotalrow() {
  var harga     = number(document.getElementById("harga").value);
  var volume    = number(document.getElementById("volume").value);
  var periode   = number(document.getElementById("periode").value);
  let totalrow = 0;

  totalrow = harga*volume*periode;
  $('[name="total"]').val(number_format(totalrow,"2",",",".")).trigger('change');
}

function hitungtitipan() {
  var titipan     = number(document.getElementById("titipan").value);
  var pilihpph    = number(document.getElementById("jnspph").value);
  var pend_nett   = number(document.getElementById("nilaipend_nett").value);

  // hitung ppn titipan
  var ppntitipan  = (10/100)*((100/110)*titipan);
  
  // hitung pph berdasarkan pajak di apbd
  if (pilihpph==22){
    var nilai_pphtitipan = (1.5/100)*((100/110)*titipan);
    var nilai_ppntitipan=ppntitipan;
  }else if (pilihpph==23){
    var nilai_pphtitipan = (2/100)*((100/110)*titipan);
    var nilai_ppntitipan=ppntitipan;
  }else if (pilihpph==21){
    var nilai_pphtitipan = (50/100)*((5/110)*titipan);
    nilai_ppntitipan=0;
  }
  var titipan_net = titipan-nilai_ppntitipan-nilai_pphtitipan;
  var nilai_pend_net_s_titipan = pend_nett-titipan_net;

  $('[name="nilaippntitipan"]').val(number_format(nilai_ppntitipan,"2",",",".")).trigger('change');
  $('[name="nilaipphtitipan"]').val(number_format(nilai_pphtitipan,"2",",",".")).trigger('change');
  $('[name="titipan_net"]').val(number_format(titipan_net,"2",",",".")).trigger('change');
  $('[name="nilai_pend_net_s_titipan"]').val(number_format(nilai_pend_net_s_titipan,"2",",",".")).trigger('change');

// hitung PL
  var plpersen = number(document.getElementById("plpersen").value);

  if (plpersen!=0 || plpersen!=0.00){
    var al_pl = nilai_pend_net_s_titipan*plpersen/100;//20%  
    $('[name="pl"]').val(number_format(al_pl,"2",",",".")).trigger('change');
  }else{
    var al_pl = number(document.getElementById("pl").value);
    var persenpl = al_pl/nilai_pend_net_s_titipan*100;
    $('[name="plpersen"]').val(number_format(persenpl,"2",",",".")).trigger('change');
  }
  
  var pl2 = number(document.getElementById("pl_bulat").value);
  if (pl2==0 || pl2==0.00){
    al_pl_final=al_pl;
  }else{
    al_pl_final=pl2;
  }
  
  
// hitung HO
  var al_HO = nilai_pend_net_s_titipan*0.15;//20%

  $('[name="al_ho"]').val(number_format(al_HO,"2",",",".")).trigger('change');

// Sub Total A
  var nilai_pend_net_s_pl=nilai_pend_net_s_titipan-al_pl_final;
  $('[name="nilai_pend_net_s_pl"]').val(number_format(nilai_pend_net_s_pl,"2",",",".")).trigger('change');


}


$('#area').change(function(){ 
                var subarea=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('proyek/get_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="subarea"]').empty();
                        $('select[name="subarea"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                            $('select[name="subarea"]').append('<option value="'+ value.kd_subarea +'">'+ value.nm_subarea +'</option>');

                            
                        });

                    }
                });
                return false;
            });

$('#subarea').change(function(){ 
                var subarea=$(this).val();
                var area=document.getElementById("area").value;
                alert(area);
                // var id_pqproyek = "<?= $proyek['kd_proyek']; ?>";

                $.ajax({
                    url : "<?php echo site_url('pq/get_proyek_by_area_subarea_edit') ?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea,area:area,id_pqproyek:id_pqproyek},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="projek"]').empty();
                        $('select[name="projek"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                            $('select[name="projek"]').append('<option value="'+ value.kd_proyek +'">'+value.kd_proyek + ' - ' + value.nm_paket_proyek +'</option>');
                        });

                    }
                });
                return false;
            });

    function get_subareacombo(){ 
                var subarea=document.getElementById("area").value;
                $.ajax({
                    url : "<?php echo site_url('proyek/get_area');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="subarea"]').empty();
                        $('select[name="subarea"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                            if(<?= $proyek['kd_sub_area']; ?>==value.kd_subarea){
                              $('select[name="subarea"]').append('<option value="'+ value.kd_subarea +'" selected>'+ value.nm_subarea +'</option>');
                            }else{
                              $('select[name="subarea"]').append('<option value="'+ value.kd_subarea +'">'+ value.nm_subarea +'</option>');
                            }
                            
                            // $('[name="subarea"]').val(<?= $proyek['kd_sub_area']; ?>).trigger('change');
                        });

                    }
                });
                get_proyekcombo();
                return false;
            };


  function get_projek(){ 
                var idprojek="<?= $proyek['kd_proyek']; ?>";
                $.ajax({
                    url : "<?php echo site_url('pq/get_projek');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: idprojek},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                      $.each(data, function(key, value) {
                        // $('[name="area"]').val(value.nm_area).trigger('change');
                        // $('[name="subarea"]').val(value.nm_sub_area).trigger('change');
                        $('[name="jnsproyek"]').val(value.nm_jns_proyek).trigger('change');
                        $('[name="jnssubproyek"]').val(value.nm_jns_sub_proyek).trigger('change');
                        $('[name="perusahaan"]').val(value.nm_perusahaan).trigger('change');
                        $('[name="dinas"]').val(value.nm_dinas).trigger('change');
                        $('[name="tipeproyek"]').val(value.nm_tipe_proyek).trigger('change');
                        $('[name="paketproyek"]').val(value.nm_paket_proyek).trigger('change');
                        $('[name="thn_ang"]').val(value.thn_anggaran).trigger('change');
                        
                        var spk = value.nilai;

                        var ppn = (10/100)*((100/110)*spk);
                        var pilihpph = value.jns_pph;

                        $('[name="nilaispk"]').val(number_format(spk,"2",",",".")).trigger('change');
                        $('[name="jnspph"]').val(pilihpph).trigger('change');
                        
                        if (pilihpph==22){
                          var nilai_pph = (1.5/100)*((100/110)*spk);
                          var nilai_ppn=ppn;
                        }else if (pilihpph==23){
                          var nilai_pph = (2/100)*((100/110)*spk);
                          var nilai_ppn=ppn;
                        }else if (pilihpph==21){
                          var nilai_pph = (50/100)*((5/110)*spk);
                          nilai_ppn=0;
                        }

                        var pend_nett = spk-nilai_pph-nilai_ppn;

                        $('[name="nilaippn"]').val(number_format(nilai_ppn,"2",",",".")).trigger('change');
                        $('[name="nilaipph"]').val(number_format(nilai_pph,"2",",",".")).trigger('change');
                        $('[name="nilaipend_nett"]').val(number_format(pend_nett,"2",",",".")).trigger('change');

                        hitungtitipan();

                      });
                    }
                });
        }


  function get_proyekcombo(){ 
                var subarea     = "<?= $proyek['kd_sub_area']; ?>";
                var area        = document.getElementById("area").value;
                var id_pqproyek = "<?= $proyek['kd_proyek']; ?>";
                $.ajax({
                    url : "<?php echo site_url('pq/get_proyek_by_area_subarea_edit');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: subarea,area:area,id_pqproyek:id_pqproyek},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        $('select[name="projek"]').empty();
                        $('select[name="projek"]').append('<option value="">No Selected</option>');
                        $.each(data, function(key, value) {
                          if(value.kd_proyek=="<?= $proyek['kd_proyek']; ?>"){
                            $('select[name="projek"]').append('<option value="'+ value.kd_proyek +'" selected>'+ value.nm_paket_proyek +'</option>');
                          }else{
                            $('select[name="projek"]').append('<option value="'+ value.kd_proyek +'">'+ value.nm_paket_proyek +'</option>');
                          }
                        });

                    }
                });
                get_projek();
                return false;
            };

  }); 
</script>