<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table border="0" width="100%">
  <tr>
    <td colspan="4" style="text-align:center"><h3>PT. MURFA SURYA MAHARDIKA<br>(JURNAL)</h3></td>
  </tr>
  <tr>
    <td colspan="4" style="text-align:center">&nbsp;</td>
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
        <th align="center" width="5%"><b>No.</th>
        <th align="center" width="15%"><b>Nomor</b> </th>
        <th align="center" width="10%"><b>Tanggal</b></th>
        <th align="center" width="10%"><b>Area</b></th>
        <th align="center" width="15%"><b>Akun</b></th>
        <th align="center" width="25%"><b>Uraian</b></th>
        <th align="center" width="10%"><b>debet</b></th>
        <th align="center" width="10%"><b>Kredit</b></th>
        
  </tr>
</thead>

  <?php 
      $terima = 0;
      $keluar   = 0;
      $i=0;
  ?>
  
<?php foreach($list as $list): ?>
          
    <tr>
        <td align="center"><?= ++$i; ?></td>
        <td><?= $list['no_voucher']; ?></td>
        <td><?= $list['tgl_voucher']; ?></td>
        <td><?= $list['kd_area']; ?> - <?= $list['nm_area']; ?></td>
        <td><?= $list['no_acc']; ?> - <?= $list['nm_acc']; ?></td>
        <td><?= $list['uraian']; ?></td>
        <td align="right" ><?= number_format($list['debet'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($list['kredit'],2,',','.'); ?></td>
    </tr>
          
        
<?php endforeach; ?>
</table>