<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table border="0" width="100%">
  <tr>
    <td colspan="4" style="text-align:center"><h3>PT. MURFA SURYA MAHARDIKA<br>REGISTER PDO</h3></td>
  </tr>
  <tr>
    <td colspan="4" style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" style="text-align:left"><b>AREA</b></td>
    <td width="2%" style="text-align:left"><b>:</b></td>
    <td colspan="2" width="88%" style="text-align:left"><b><?= $area['nm_area']; ?></b></td>
  </tr>

  <tr>
    <td width="10%" style="text-align:left"><b>Periode</b></td>
    <td width="2%" style="text-align:left"><b>:</b></td>
    <td colspan="2" width="88%" style="text-align:left"><b><?= $bulan.' '.$tahun; ?></b></td>
  </tr>
</table>
<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;font-size: 12px;" cellspacing="2" cellpadding="3">
<thead>
  <tr style="background: #CACACA;">
        <th align="center" ><b>No. PDO</th>
        <th align="center" ><b>Tgl. PDO</b> </th>
        <th align="center" ><b>Keterangan</b></th>
        <th align="center" ><b>Nilai</b></th>
  </tr>
</thead>
  <?php 
      $total_pdo=0;
  ?>
<?php foreach($register_pdo as $register_pdo): ?>
      
          <tr>
            <td><?= $register_pdo['kd_pdo']; ?></td>
            <td align="center"><?= $register_pdo['tgl_pdo']; ?></td>
            <td><?= $register_pdo['keterangan']; ?></td>
            <td align="right" ><?= number_format($register_pdo['nilai'],2,',','.'); ?></td>
          </tr>

          <?php $total_pdo = $total_pdo+$register_pdo['nilai']; ?>

        
<?php endforeach; ?>

      <tr>
        <td colspan="3" align="center">
          Total Biaya
        </td>
        <td align="right" style="background: #CCCCCC ;border-right:white;"><?= number_format($total_pdo,2,',','.'); ?></td>
      </tr>

</table>