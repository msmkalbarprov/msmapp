<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
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

<table border="0" width="100%">
  <tr>
    <td colspan="4" style="text-align:center"><b>PT. MURFA SURYA MAHARDIKA</b></td>
  </tr>
  <tr>
    <td colspan="4" style="text-align:center">LAPORAN SALDO AWAL AREA DAN PEGAWAI</td>
  </tr>
  <tr>
    <td colspan="4" style="text-align:center">&nbsp;</td>
  </tr>

</table>
<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;font-size: 12px;" cellspacing="2" cellpadding="3">
<thead>
  <tr style="background: #CACACA;">
      <th>No</th>
      <th>Area</th>
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
                          <td> - <?= $rincian['pemilik']; ?></td>
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