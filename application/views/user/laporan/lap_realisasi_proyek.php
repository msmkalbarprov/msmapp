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
      <th>No</th>
      <th>Area</th>
      <th>APBD</th>
      <th>SPK</th>
      <th>PDP</th>
      <th>PDO</th>
      <th>SPJ</th>
  </tr>
</thead>
  <?php 
      $total_apbd = 0;
      $total_spk = 0;
      $total_pdp = 0;
      $total_pdo = 0;
      $total_spj = 0;
      $i=0;
  ?>
<?php foreach($rincian as $rincian): ?>
      
          <tr>
            <td align="center"><?= ++$i; ?></td>
            <td><?= $rincian['nm_area']; ?></td>
            <td align="right" ><?= number_format($rincian['apbd'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($rincian['spk'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($rincian['pdp'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($rincian['pdo'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($rincian['spj'],2,',','.'); ?></td>
          </tr>

          <?php 
            $total_apbd = $total_apbd+$rincian['apbd']; 
            $total_spk = $total_spk+$rincian['spk']; 
            $total_pdp = $total_pdp+$rincian['pdp']; 
            $total_pdo = $total_pdo+$rincian['pdo']; 
            $total_spj = $total_spj+$rincian['spj']; 
          ?>

        
<?php endforeach; ?>

      <tr>
        <td colspan="2" align="center">
          Total
        </td>
        <td align="right" style="background: #CCCCCC"><?= number_format($total_apbd,2,',','.'); ?></td>
        <td align="right" style="background: #CCCCCC"><?= number_format($total_spk,2,',','.'); ?></td>
        <td align="right" style="background: #CCCCCC"><?= number_format($total_pdp,2,',','.'); ?></td>
        <td align="right" style="background: #CCCCCC"><?= number_format($total_pdo,2,',','.'); ?></td>
        <td align="right" style="background: #CCCCCC"><?= number_format($total_spj,2,',','.'); ?></td>
      </tr>

</table>