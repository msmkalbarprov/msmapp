<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table border="0" width="100%">
  <tr>
    <td colspan="4" style="text-align:center"><h3>PT. MURFA SURYA MAHARDIKA</h3></td>
  </tr>
  <tr>
    <td colspan="4" style="text-align:center">&nbsp;</td>
  </tr>

</table>
<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;font-size: 12px;" cellspacing="2" cellpadding="3">
<thead>
  <tr style="background: #CACACA;">
      <th rowspan="2">No</th>
      <th rowspan="2">Area</th>
      <th rowspan="2">APBD</th>
      <th rowspan="2">SPK</th>
      <th rowspan="2">PDP</th>
      <th rowspan="2">PIUTANG PROJECT</th>
      <th colspan="2">PDO</th>
      <th colspan="2">SPJ</th>
  </tr>
  
   <tr style="background: #CACACA;">

      <th >NON PL</th>
      <th >PL</th>
      <th >NON PL</th>
      <th >PL</th>
  </tr>
  
</thead>
  <?php 
      $total_apbd = 0;
      $total_spk = 0;
      $total_pdp = 0;
      $total_piutang = 0;
      $total_pdo = 0;
      $total_pdo_pl = 0;
      $total_spj = 0;
      $total_spj_pl = 0;
      $i=0;
  ?>
<?php foreach($rincian as $rincian): ?>
      
          <tr>
            <td align="center"><?= ++$i; ?></td>
            <td><?= $rincian['nm_area']; ?></td>
            <td align="right" ><?= $rincian['apbd']; ?></td>
            <td align="right" ><?= $rincian['spk']; ?></td>
            <td align="right" ><?= $rincian['pdp']; ?></td>
            <td align="right" ><?= $rincian['piutang_prj']; ?></td>
           
         
            <td align="right" ><?= $rincian['pdo']; ?></td>
            <td align="right" ><?= $rincian['pdo_pl']; ?></td>
            <td align="right" ><?= $rincian['spj']; ?></td>
            <td align="right" ><?= $rincian['spj_pl']; ?></td>
          </tr>

          <?php 
            $total_apbd = $total_apbd+$rincian['apbd']; 
            $total_spk = $total_spk+$rincian['spk']; 
            $total_pdp = $total_pdp+$rincian['pdp']; 
            $total_piutang = $total_piutang+$rincian['piutang_prj']; 
            $total_pdo = $total_pdo+$rincian['pdo']; 
            $total_pdo_pl = $total_pdo_pl+$rincian['pdo_pl']; 
            $total_spj = $total_spj+$rincian['spj']; 
            $total_spj_pl = $total_spj_pl+$rincian['spj_pl']; 
          ?>

        
<?php endforeach; ?>

      <tr>
        <td colspan="2" align="center">
          Total
        </td>
        <td align="right" style="background: #CCCCCC"><?= $total_apbd; ?></td>
        <td align="right" style="background: #CCCCCC"><?= $total_spk; ?></td>
        <td align="right" style="background: #CCCCCC"><?= $total_pdp; ?></td>
        <td align="right" style="background: #CCCCCC"><?= $total_piutang; ?></td>
        <td align="right" style="background: #CCCCCC"><?= $total_pdo; ?></td>
        <td align="right" style="background: #CCCCCC"><?= $total_pdo_pl; ?></td>
        <td align="right" style="background: #CCCCCC"><?= $total_spj; ?></td>
        <td align="right" style="background: #CCCCCC"><?= $total_spj_pl; ?></td>
      </tr>

</table>