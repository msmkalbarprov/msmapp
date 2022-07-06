<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
  <?php 
  function angka($nilai){

    if($nilai<0){
      $lc = '('.number_format(abs($nilai),2,',','.').')';
    }else{
      if($nilai==0){
        $lc ='0,00';
      }else{
        $lc = number_format($nilai,2,',','.');
      }
    }
    return $lc;
  }
  ?>

    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title">
             laporan Saldo Awal Area </h3>
           </div>
           <div class="d-inline-block float-right">
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>
         
         <div class="form-group">
          <div class="col-md-12" align="right">
            <button  name="submit" id="butcetak"  class="btn btn-dark btn-sm"><i class="fa fa-print"></i> Cetak</button>
            <button  name="submit" id="butexport"  class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Export</button>
          </div>
         </div>
         <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr style="background: #CACACA;">
                        <th>No</th>
                        <th>Area/Nama Pegawai</th>
                        <th>Saldo Awal</th>
                    </tr>
                  </thead>
                  <?php 
                  $total_saldo = 0;
                  $i=0;
              ?>
            <?php foreach($rincian as $rincian): ?>
                    
                  <?php if($rincian['urut']==0): ?>
                    <tr>
                        <td align="center"><b><?= ++$i; ?></b></td>
                        <td><b> <?= $rincian['pemilik']; ?></b></td>
                        <td align="right" ><b><?=  angka($rincian['saldo']); ?></b></td>
                      </tr>
                  <?php else: ?>
                    <tr>
                        <td align="center"></td>
                        <td>&#8627; <?= $rincian['pemilik']; ?></td>
                        <td align="right" ><?=  angka($rincian['saldo']); ?></td>
                      </tr>

                      <?php 
                        $total_saldo = $total_saldo+$rincian['saldo']; 
                      ?>
                  <?php endif; ?>
            <?php endforeach; ?>

                  <tr>
                    <td colspan="2" align="center">
                      Total
                    </td>
                    <td align="right" style="background: #CCCCCC"><?=  angka($total_saldo); ?></td>
                  </tr>
                </table>
              </div>
            </div>
           </div>
      </div>
      <!-- /.box-body -->
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script>
  // $("#proyek").addClass('menu-open');
  $("#lap_saldo_awal> a").addClass('active');
</script>

<script>
$(document).ready(function(){
  $('#butcetak').on('click', function() {
    var url = '<?= base_url() ?>'+'laporan/cetak_saldo_awal/1/Laporan Saldo Awal';
    window.open(url, '_blank');
  });

  $('#butexport').on('click', function() {
        var url = '<?= base_url() ?>'+'laporan/cetak_saldo_awal/0/Laporan Saldo Awal'; 
      window.open(url, '_blank');
  });
});



</script>

