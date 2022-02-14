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
             Tambah Project Qualifying(PQ) Proyek </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pq'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  <?= trans('proyek_list') ?></a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         <?php echo form_open(base_url('pq/add'), 'class="form-horizontal"');  ?> 
         <div class="row">
          <div class="col-md-3">
           <div class="form-group">
            <label for="area" class="control-label"><?= trans('area') ?></label>
              <input type="text" name="area" id="area" class="form-control" readonly>
          </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="sub_area" class="control-label"><?= trans('sub_area') ?></label>
              <input type="text" name="subarea" id="subarea" class="form-control" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="projek" class="control-label">Proyek</label>
                <select name="projek" id ="projek" class="form-control" required>
                <option value="">No Selected</option>
                <?php foreach($data_mprojek as $projek): ?>
                      <option value="<?= $projek['kd_proyek']; ?>"><?= $projek['kd_proyek'].' - '.$projek['nm_paket_proyek']; ?></option>
                  <?php endforeach; ?>
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
                 <td width="50%"><b>Pend. Nett</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"> <input type="text" name="nilaipend_nett" style="background:none;border: none;text-align:right;" id="nilaipend_nett" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"> <input type="text" name="titipan" style="background:none;text-align:right;" id="titipan" placeholder="0,00" value="0" onkeypress="return(currencyFormat(this,'.',',',event))"  class="form-control" ></td>
               </tr>
               <tr>
                 <td width="50%">PPN titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilaippntitipan" style="background:none;border: none;text-align:right;" id="nilaippntitipan" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">PPH titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;">
                  <input type="text" name="nilaipphtitipan" style="background:none;border: none;text-align:right;" id="nilaipphtitipan" class="form-control" readonly>
                </td>
               </tr>
               <tr>
                 <td width="50%">Titipan Net</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="titipan_net" style="background:none;border: none;text-align:right;" id="titipan_net" class="form-control" readonly></td>
               </tr>
               
             </table>
           </div>
           <div class="col-md-6">
            <table width="100%" border="0">
               <tr>
                 <td width="50%"><b>Pend. Nett setelah titipan</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilai_pend_net_s_titipan" style="background:none;border: none;text-align:right;" id="nilai_pend_net_s_titipan" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Biaya Partner Lokal (PL)  &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="plpersen" style="background:none;text-align:right;width: 60px;" id="plpersen" placeholder="0,00" value="0" onkeypress="return(currencyFormat(this,'.',',',event))" >&nbsp;%
                 <td width="5%">:</td>
                 <td width="45%" align="right" ><input type="text" name="pl" style="background:none;border: none;text-align:right;" id="pl" placeholder="0,00" value="0"  class="form-control" readonly></td>
               </tr>
                <tr>
                 <td width="50%">Pembulatan Biaya Partner Lokal (PL)
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;" >
                  <input type="text" name="pl_bulat" style="background:none;text-align:right;" id="pl_bulat" placeholder="0,00" value="0" onkeypress="return(currencyFormat(this,'.',',',event))"  class="form-control" ></td>
               </tr>
                <tr>
                 <td width="50%"><b>Pendapatan Nett Setelah (PL)</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilai_pend_net_s_pl" style="background:none;border: none;text-align:right;" id="nilai_pend_net_s_pl" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Total Biaya (PQ Detail)</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;"><input type="text" name="detail_pq" value="0" style="background:none;border: none;text-align:right;" id="detail_pq" class="form-control" onkeypress="return(currencyFormat(this,'.',',',event))" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Nett Profit</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nett_profit" style="background:none;border: none;text-align:right;" id="nett_profit" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Alokasi HO <small>15%</small></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;"><input type="text" name="al_ho" style="background:none;border: none;text-align:right;" id="al_ho" placeholder="0,00" value="0"  class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%"><b>Net Profit setelah Alokasi HO</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="profit_net" style="background:none;border: none;text-align:right;" id="profit_net" class="form-control" readonly></td>
               </tr>
             </table>
           </div>
         </div>
         
         <h6>Detail PQ</h6>
         <hr>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="coa_pq" class="control-label">Jenis Item</label>
                <select name="coa_pq" id ="coa_pq" class="form-control" required>
                <option value="">No Selected</option>
                <?php foreach($data_coa_item as $coa_item): ?>
                      <option value="<?= $coa_item['no_acc']; ?>"><?= $coa_item['nm_acc']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="sub_area" class="control-label">Uraian</label>
              <input type="text" name="uraian" id="uraian" class="form-control" >
            </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="projek" class="control-label">Volume</label>
                <input type="number" name="volume" id="volume" value="0" class="form-control" >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="projek" class="control-label">Satuan</label>
                <input type="text" name="satuan" id="satuan" class="form-control" >
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="sub_area" class="control-label">Periode(Bulan) </label>
              <input type="number" name="periode" id="periode" value="0" class="form-control" >
            </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="projek" class="control-label">Harga</label>
                <input type="text" name="harga" id="harga" class="form-control" value="0" style="background:none;text-align:right;" onkeypress="return(currencyFormat(this,'.',',',event))">
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="sub_area" class="control-label">Total</label>
              <input type="text" name="total" style="background:none;text-align:right;" id="total" class="form-control" readonly>
            </div>
          </div>
         </div>
          <div class="row">
            <div class="col-md-12" align="center">
              <button type="button" class="btn btn-success" id="tambah"><i class="fa fa-plus"></i> Tambah</button>
            </div>
          </div>
         
        <div class="row">
              <div class="col-md-12">
                <div class="card-body table-responsive">
                  <table id="temporary" class="display" style="width:100%">
                    <thead>
                      <tr>
                        <th>Jenis Item</th>
                        <th>Uraian</th>
                        <th>Volume</th>
                        <th>Satuan</th>
                        <th>Periode(bln)</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
             </div>
        <div class="form-group">
          <div class="col-md-12" align="right">
            <input type="submit" name="submit" value="Simpan" class="btn btn-primary btn-sm">
          </div>
        </div>
        <?php echo form_close( ); ?>
      </div>
      <!-- /.box-body -->
    </div>
    
  </section> 
</div>
<!-- Modal -->
<!-- <div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Detail PQ</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
      
    </div>
      <div class="modal-footer" align="right">
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
      </div>
    </div>
  </div>
</div> -->
  
</div>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
  <script>
  // $("#proyek").addClass('menu-open');
  $("#pq> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    
  $('#projek').change(function(){ 
                var idprojek=$(this).val();
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
                        $('[name="area"]').val(value.nm_area).trigger('change');
                        $('[name="subarea"]').val(value.nm_sub_area).trigger('change');
                        $('[name="jnsproyek"]').val(value.nm_jns_proyek).trigger('change');
                        $('[name="jnssubproyek"]').val(value.nm_jns_sub_proyek).trigger('change');
                        $('[name="perusahaan"]').val(value.nm_perusahaan).trigger('change');
                        $('[name="dinas"]').val(value.nm_dinas).trigger('change');
                        $('[name="tipeproyek"]').val(value.nm_sub_area).trigger('change');
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

                        // $('select[name="subarea"]').empty();
                        // $('select[name="subarea"]').append('<option value="">No Selected</option>');
                        // $.each(data, function(key, value) {
                        //     $('select[name="subarea"]').append('<option value="'+ value.kd_subarea +'">'+ value.nm_subarea +'</option>');
                        // });

                    }
                });
                return false;
          });

document.getElementById("titipan").onkeyup = function() {hitungtitipan()};

document.getElementById("detail_pq").onkeyup = function() {hitungtitipan()};

document.getElementById("plpersen").onkeyup = function() {hitungtitipan()};

document.getElementById("pl_bulat").onkeyup = function() {hitungtitipan()};

document.getElementById("harga").onkeyup = function() {hitungtotalrow()};
document.getElementById("periode").onkeyup = function() {hitungtotalrow()};
document.getElementById("satuan").onkeyup = function() {hitungtotalrow()};

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
// alert(titipan);
  // alert(pend_nett+'-'+titipan+''+pilihpph);
  var ppntitipan  = (10/100)*((100/110)*titipan);
  
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
  // alert(al_pl);
  



  var nilai_pend_net_s_pl=nilai_pend_net_s_titipan-al_pl_final;
  $('[name="nilai_pend_net_s_pl"]').val(number_format(nilai_pend_net_s_pl,"2",",",".")).trigger('change');

  detail_pq =  number(document.getElementById("detail_pq").value);

  var nett_profit=nilai_pend_net_s_pl-detail_pq;
  $('[name="nett_profit"]').val(number_format(nett_profit,"2",",",".")).trigger('change');

  var al_HO = nett_profit*0.15;//20%

  $('[name="al_ho"]').val(number_format(al_HO,"2",",",".")).trigger('change');
  
  var profit_net = nett_profit - Math.abs(al_HO);
  $('[name="profit_net"]').val(number_format(profit_net,"2",",",".")).trigger('change')
}


// tambah ke temporary
var t = $('#temporary').DataTable();
var no=0;
var total = 0;
$('#tambah').on( 'click', function () {
        if ($('select[name="coa_pq"]').val()=='' || $('select[name="coa_pq"]').val()==0){
          alert('Pilih PQ Item terlebih dahulu');
          return;
        }

        t.row.add( [
              $('select[name="coa_pq"]').val(),
              $('input[name="uraian"]').val(),
              $('input[name="volume"]').val(),
              $('input[name="satuan"]').val(),
              $('input[name="periode"]').val(),
              $('input[name="harga"]').val(),
              $('input[name="total"]').val(),
              '<button type="button" class="btn btn-danger btn-sm remove" id="tombol-hapus" data-nama-barang="'+$('select[name="coa_pq"]').val()+'"><i class="fa fa-trash"></i></button>'
        ] ).draw( false );

        total = total+number($('input[name="total"]').val());
        $('input[name="detail_pq"]').val(number_format(total,"2",",","."))
        reset()
        hitungtitipan()
        // if(parseInt($('input[name="max_hidden"]').val()) <= parseInt(data_keranjang.jumlah)) {
        //   alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))  
        // } else {
          // $.ajax({
          //   url: url_keranjang_barang,
          //   type: 'POST',
          //   data: {
          //     '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          //     coa_pq: $('select[name="coa_pq"]').val(),
          //     uraian: $('input[name="uraian"]').val(),
          //     volume: $('input[name="volume"]').val(),
          //     satuan: $('input[name="satuan"]').val(),
          //     periode: $('input[name="periode"]').val(),
          //     harga: $('input[name="harga"]').val(),
          //     total: $('input[name="total"]').val()
          //   },
          //   success: function(data){
          //     reset()

          //     $('table#temporary tbody').append(data)
          //     $('tfoot').show()

          //     $('#total').html('<strong>' + hitung_total() + '</strong>')
          //     $('input[name="detail_pq"]').val(hitung_total())
          //   }
          // })
        // }
    } );

function hitung_biaya_detail() {
  
  $('input[name="detail_pq"]').val(hitung_total())
}

    
     $('#temporary').on('click', '.remove', function () {
    var table = $('#temporary').DataTable();
    var row = $(this).parents('tr');
    
    if ($(row).hasClass('child')) {
      table.row($(row).prev('tr')).remove().draw();
    }
    else
    {
    table
      .row($(this).parents('tr'))
      .remove()
    .draw();
        }

    });


$('#tombol-hapus').on( 'click', function () {
      alert('yakin?');
      t.row('.remove').remove().draw( false );
      })


// function hitung_total(){
//         let total = 0;
//         $('.sub_total').each(function(){
//           total += parseInt($(this).text())
//         })

//         return total;
//       }

function reset(){
        $('input[name="uraian"]').val('')
        $('input[name="volume"]').val('')
        $('input[name="satuan"]').val('')
        $('input[name="periode"]').val('')
        $('input[name="harga"]').val(0)
        $('input[name="total"]').val(0)
      }
// $(document).on('click', '#tambah', function(e){
//         // const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
//         const url_keranjang_barang = <?php echo site_url('pq/temporary');?>
//         const data_keranjang = {
//           coa_pq: $('select[name="coa_pq"]').val(),
//           uraian: $('input[name="uraian"]').val(),
//           colume: $('input[name="volume"]').val(),
//           satuan: $('input[name="satuan"]').val(),
//           periode: $('input[name="periode"]').val(),
//           harga: $('input[name="harga"]').val(),
//           total: $('input[name="total"]').val()
//         }

//         $.ajax({
//           url: url_keranjang_barang,
//           type: 'POST',
//           data: data_keranjang,
//           success: function(data){
//             // if(
//             //  $('select[name="nama_aplikasi"]').val() == data_keranjang.nama_aplikasi) 
//             //  $('option[value="' + data_keranjang.nama_aplikasi + '"]').hide()
//             reset()

//             $('table#temporary tbody').append(data)
//             $('tfoot').show()

//             // $('#total').html('<strong>' + hitung_total() + '</strong>')
//             // $('input[name="total_hidden"]').val(hitung_total())
//           }
//         })
//       })



  }); 
</script>