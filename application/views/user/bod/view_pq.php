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
             PQ Proyek </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('bod'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         
         <?php $this->load->view('admin/includes/_messages.php') ?>

         <?php echo form_open(base_url('pq/add'), 'class="form-horizontal"');  ?> 
         <div class="row">
          <div class="col-md-3">
            <label for="area" class="control-label">Kode PQ Proyek</label>
          </div>
          <div class="col-md-3">
             <input type="text" name="kd_pqproyek" id="kd_pqproyek" style="background:none;border: none;" class="form-control" value="<?= $pqproyek['kd_pqproyek']; ?>" readonly>
             <input type="hidden" name="idpqproyek" id="idpqproyek" style="background:none;border: none;" class="form-control" value="<?= $pqproyek['id_pqproyek']; ?>" readonly>
          </div>
          <div class="col-md-3">
            <label for="area" class="control-label">Status PQ</label>
          </div>
          <div class="col-md-3">
            <?php if($pqproyek['status']==1): ?>
              <input type="text" name="status" id="status" style="background:none;border: none;" class="form-control text-success" value="Disetujui" readonly>
            <?php elseif ($pqproyek['status']==2): ?>
              <input type="text" name="status" id="status" style="background:none;border: none;" class="form-control text-danger" value="Ditolak" readonly>
              <?php else: ?>
              <input type="text" name="status" id="status" style="background:none;border: none;" class="form-control" value="-" readonly>
          <?php endif; ?>
             
          </div>
         </div>
         <div class="row">
          <div class="col-md-3">
            <label for="area" class="control-label"><?= trans('area') ?></label>
          </div>
          <div class="col-md-3">
             <input type="text" name="area" id="area" style="background:none;border: none;" class="form-control" value="<?= $proyek['nm_area']; ?>" readonly>
          </div>
          <div class="col-md-3">
            <label for="sub_area" class="control-label"><?= trans('sub_area') ?></label>
          </div>
          <div class="col-md-3">
            <input type="text" name="subarea" id="subarea" style="background:none;border: none;" value="<?= $proyek['nm_sub_area']; ?>" class="form-control" readonly>
          </div>
         </div>

         


         <div class="row">
          <div class="col-md-3">
            <label for="projek" class="control-label">Kode Proyek</label>
          </div>
          <div class="col-md-3">
             <input type="text" name="projek" id="projek" style="background:none;border: none;" value="<?= $proyek['kd_proyek']; ?>" class="form-control" readonly>
          </div>
          <div class="col-md-3">
            <label for="sub_area" class="control-label">Jenis Proyek</label>
          </div>
          <div class="col-md-3">
            <input type="text" name="jnsproyek" id="jnsproyek" style="background:none;border: none;" value="<?= $proyek['nm_jns_proyek']; ?>" class="form-control" readonly>
          </div>
         </div>


         <div class="row">
          <div class="col-md-3">
            <label for="projek" class="control-label"><?= trans('jenis_sub_proyek') ?></label>
          </div>
          <div class="col-md-3">
             <input type="text" name="jnssubproyek" id="jnssubproyek" style="background:none;border: none;" value="<?= $proyek['nm_jns_sub_proyek']; ?>" class="form-control" readonly>
          </div>
          <div class="col-md-3">
            <label for="sub_area" class="control-label"><?= trans('perusahaan') ?></label>
          </div>
          <div class="col-md-3">
            <input type="text" name="perusahaan" id="perusahaan" style="background:none;border: none;" value="<?= $proyek['nm_perusahaan']; ?>" class="form-control" readonly>
          </div>
         </div>

         <div class="row">
          <div class="col-md-3">
            <label for="projek" class="control-label">Tipe Pengadaan</label>
          </div>
          <div class="col-md-3">
             <input type="text" name="tipeproyek" id="tipeproyek" style="background:none;border: none;" value="<?= $proyek['nm_tipe_proyek']; ?>" class="form-control" readonly>
          </div>
          <div class="col-md-3">
            <label for="sub_area" class="control-label">Tahun Anggaran</label>
          </div>
          <div class="col-md-3">
            <input type="text" name="thn_ang" id="thn_ang" style="background:none;border: none;" value="<?= $proyek['thn_anggaran']; ?>" class="form-control" readonly>
          </div>
         </div>

         <div class="row">
          <div class="col-md-3">
            <label for="projek" class="control-label"><?= trans('nm_dinas') ?></label>
          </div>
          <div class="col-md-3">
            <textarea name="dinas" id="dinas" class="form-control" rows="2" style="background:none;border: none;" readonly> <?= $proyek['nm_dinas']; ?> </textarea>
          </div>
          <div class="col-md-3">
            <label for="sub_area" class="control-label">Nama Paket pekerjaan</label>
          </div>
          <div class="col-md-3">
            <textarea name="paketproyek" id="paketproyek" class="form-control" rows="2" style="background:none;border: none;" readonly> <?= $proyek['nm_paket_proyek']; ?> </textarea>
          </div>
         </div>

         <br>
         <div class="row">
            <div class="col-md-12">
              <h6><b>Perhitungan Pendapatan Nett</b></h6>
              <hr>
            </div>
            
        </div>
         <div class="row">
           <div class="col-md-6">
            <table width="100%" border="0">
               <tr>
                 <td width="50%">Nilai SPK</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilaispk" value="<?= number_format($proyek['nilai_spk'],2,',','.'); ?>" style="background:none;border: none;text-align:right;" id="nilaispk" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">PPN</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilaippn" value="<?= number_format($pqproyek['ppn'],2,',','.'); ?>" style="background:none;border: none;text-align:right;" id="nilaippn" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">PPH</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;">
                    <input type="hidden" name="jnspph" id="jnspph">
                    <input type="text" name="nilaipph" style="background:none;border: none;text-align:right;" value="<?= number_format($pqproyek['pph'],2,',','.'); ?>" id="nilaipph" class="form-control" readonly>
                  </td>
               </tr>
                <tr>
                 <td width="50%"><b>SPK. Nett</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"> <input type="text" name="nilaipend_nett" value="<?= number_format($pqproyek['spk_net'],2,',','.'); ?>" style="background:none;border: none;text-align:right;" id="nilaipend_nett" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"> <input type="text" name="titipan" style="background:none;border: none;text-align:right;" value="<?= number_format($pqproyek['titipan'],2,',','.'); ?>" id="titipan" placeholder="0,00" value="0"  class="form-control" readonly></td>
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
                  <input type="text" name="nilaipphtitipan" style="background:none;border: none;text-align:right;" value="<?= number_format($pqproyek['pphtitipan'],2,',','.'); ?>" id="nilaipphtitipan" class="form-control" readonly>
                </td>
               </tr>
               <tr>
                 <td width="50%"><b>Titipan Net</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="titipan_net" style="background:none;border: none;text-align:right;" value="<?= number_format($pqproyek['titipan_net'],2,',','.'); ?>" id="titipan_net" class="form-control" readonly></td>
               </tr>
               
             </table>
           </div>
           <div class="col-md-6">
            <table width="100%" border="0">
               <tr>
                 <td width="50%"><b>Pendapatan Nett</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilai_pend_net_s_titipan" value="<?= number_format($pqproyek['pendapatan_nett'],2,',','.'); ?>" style="background:none;border: none;text-align:right;" id="nilai_pend_net_s_titipan" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Biaya Partner Lokal (PL)  &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="plpersen" value="<?= number_format($pqproyek['persen_pl'],2,',','.'); ?>" style="background:none;border: none;text-align:right;width: 60px;" id="plpersen" placeholder="0,00" value="0" readonly>&nbsp;%
                 <td width="5%">:</td>
                 <td width="45%" align="right" ><input type="text" name="pl" style="background:none;border: none;text-align:right;" value="<?= number_format($pqproyek['npl'],2,',','.'); ?>" id="pl" placeholder="0,00"  class="form-control" readonly></td>
               </tr>
                <tr>
                 <td width="50%">Pembulatan Biaya Partner Lokal (PL)
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;" >
                  <input type="text" name="pl_bulat" style="background:none;border: none;text-align:right;" id="pl_bulat" placeholder="0,00" value="<?= number_format($pqproyek['ppl'],2,',','.'); ?>"   class="form-control" readonly></td>
               </tr>
                <tr>
                 <td width="50%"><b>Pendapatan Nett Setelah (PL)</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilai_pend_net_s_pl" style="background:none;border: none;text-align:right;" value="<?= number_format($pqproyek['sub_total_a'],2,',','.'); ?>" id="nilai_pend_net_s_pl" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Biaya HPP</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;"><input type="text" name="al_ho" style="background:none;border: none;text-align:right;" id="al_ho" placeholder="0,00" value="<?= number_format($pqproyek['hpp'],2,',','.'); ?>"  class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%"><b>Pendapatan Nett setelah HPP </b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="al_ho" style="background:none;border: none;text-align:right;" id="al_ho" placeholder="0,00" value="<?= number_format($pqproyek['sub_total_a']-$pqproyek['hpp'],2,',','.'); ?>"  class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Alokasi HO <small>15% dari Pendapatan Nett</small></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;"><input type="text" name="al_ho" style="background:none;border: none;text-align:right;" id="al_ho" placeholder="0,00" value="<?= number_format($pqproyek['nalokasi_ho'],2,',','.'); ?>"  class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%"><b>Pendapatan Nett setelah Al. HO </b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="al_ho" style="background:none;border: none;text-align:right;" id="al_ho" placeholder="0,00" value="<?= number_format($pqproyek['sub_total_a']-$pqproyek['hpp']-$pqproyek['nalokasi_ho'],2,',','.'); ?>"  class="form-control" readonly></td>
               </tr>
               
             </table>
           </div>
         </div>

         <br>
         <br>
         <h3>Rincian HPP</h3>
         <hr>
         <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th>#No</th>
                      <th>Kode Item</th>
                      <th>Item/Uraian</th>
                      <th>Volume</th>
                      <th>Satuan</th>
                      <th>Periode</th>
                      <th>Harga</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
         </div>

         <div class="row">
           <div class="col-md-12">
             <div class="form-group">
               <label>Catatan</label>
               <textarea id="catatan" name="catatan" class="form-control" rows="3"><?= $pqproyek['catatan']; ?></textarea>
             </div>
           </div>
         </div>
         <!-- For Messages -->
         <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <div class="form-group">
          <div class="col-md-12" align="center">
            <input type="button" id="butsave" value="Setuju" class="btn btn-primary btn-sm">
            <input type="button" id="butcancel" value="Tolak" class="btn btn-danger btn-sm">
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
  $("#bod> a").addClass('active');
</script>

<script type="text/javascript">
    get_datatable()

function get_datatable(){
    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('pq/datatable_json_hpp_rinci_view'.'/'.$this->uri->segment(3)) ?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "kd_pqproyek", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "nm_item", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "volume", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "satuan", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "periode", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "harga", 'searchable':true, 'orderable':false},
    { "targets": 7, "name": "total", 'searchable':true, 'orderable':false}
    ]
  });

  }

$(document).ready(function(){

    // SAVE
$('#butsave').on('click', function() {
    var catatan       = $('#catatan').val();
    var id_pqproyek   = $('#idpqproyek').val();
      $("#butsave").attr("disabled", "disabled");
      $.ajax({
        url: "<?php echo base_url("bod/setuju");?>",
        type: "POST",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          type:1,
          catatan:catatan,
          id_pqproyek:id_pqproyek
        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
          
            $("#butsave").removeAttr("disabled");
            $('#fupForm').find('input:text').val('');
            $("#success").show();
            $('#success').html('PQ Proyek berhasil disetujui !!'); 
          }
          else if(dataResult.statusCode==201){
             alert("Error !");
          }
          
        }
      });

  });


$('#butcancel').on('click', function() {
    var catatan       = $('#catatan').val();
    var id_pqproyek   = $('#idpqproyek').val();
      $("#butcancel").attr("disabled", "disabled");
      $.ajax({
        url: "<?php echo base_url("bod/setuju");?>",
        type: "POST",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          type:2,
          catatan:catatan,
          id_pqproyek:id_pqproyek
        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){

            $("#butcancel").removeAttr("disabled");
            $('#fupForm').find('input:text').val('');
            $("#success").show();
            $('#success').html('PQ Proyek berhasil ditolak !!'); 
          }
          else if(dataResult.statusCode==201){
             alert("Error !");
          }
          
        }
      });

  });
 });

</script>