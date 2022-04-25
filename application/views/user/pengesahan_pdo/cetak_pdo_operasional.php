<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<?php
function penyebut($nilai) {
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " ". $huruf[$nilai];
  } else if ($nilai <20) {
    $temp = penyebut($nilai - 10). " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
  }     
  return $temp;
}

function terbilang($nilai) {
  if($nilai<0) {
    $hasil = "minus ". trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }         
  return $hasil;
}

?>

<table width="100%" border="0" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td align="center" style="font-size:16px" colspan="3">
      <b>PT. MSM CONSULTANTS</b>
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:16px" colspan="3">
      <b>PENGAJUAN DANA OPERASIONAL (PDO)</b>
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:16px" colspan="3">
      &nbsp;
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:16px" colspan="3">
      &nbsp;
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:12px" width="20%">
      No. PDO
    </td>
    <td align="left" style="font-size:12px" width="2%">
      :
    </td>
    <td align="left" style="font-size:12px">
      <?= $pdo_header['kd_pdo']; ?>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:12px">
      Tanggal
    </td>
    <td align="left" style="font-size:12px">
      :
    </td>
    <td align="left" style="font-size:12px">
      <?= date('d F Y', strtotime($pdo_header['tgl_pdo'])); ?>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:12px">
      Area/Sub Area
    </td>
    <td align="left" style="font-size:12px">
      :
    </td>
    <td align="left" style="font-size:12px">
      <?= $pdo_header['kd_area'].'/'.$pdo_header['nm_area']; ?>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:12px">
      Proyek
    </td>
    <td align="left" style="font-size:12px">
      :
    </td>
    <td align="left" style="font-size:12px">
      -
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:12px">
      Keterangan
    </td>
    <td align="left" style="font-size:12px">
      :
    </td>
    <td align="left" style="font-size:12px">
      <?= $pdo_header['keterangan']; ?>
    </td>
  </tr>
</table>


<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
 
  <tr style="font-size:12px">
    <td width="3%" align="center">No</td>
    <td width="30%" align="center">Keperluan</td>
    <td width="5%" align="center">Qty</td>
    <td width="10%" align="center">Satuan</td>
    <td width="10%" align="center">Harga</td>
    <td width="10%" align="center">Jumlah</td>
    <td width="22%" align="center">Keterangan</td>
  </tr>
  <?php $totalhpp=0; $i=1;?>
<?php foreach($pdo_detail as $pdo): ?>
    
<?php $totalhpp = $totalhpp+$pdo['nilai'];  ?>
  <tr style="font-size:12px">
    <td width="3%"><?= $i++; ?></td>
    <td width="40%"><?= $pdo['nm_acc']; ?></td>
    <td width="7%"><?= $pdo['qty']; ?></td>
    <td width="10%"><?= $pdo['satuan']; ?></td>
    <td width="10%" align="right"><?= number_format($pdo['harga'],2,',','.'); ?></td>
    <td width="10%" align="right"><?= number_format($pdo['nilai'],2,',','.'); ?></td>
    <td width="10%"><?= $pdo['uraian']; ?></td>


  </tr>
<?php endforeach; ?>
<tr style="font-size:12px">
    <td colspan="5" align="right">TOTAL PDO Rp.</td>
    <td width="10%" align="right"><?= number_format($totalhpp,2,',','.'); ?></td>
    <td width="10%"></td>
  </tr>
  
</table>
<br />
<table width="100%" border="0" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td align="center" style="font-size:12px" colspan="3">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px"> Diajukan oleh
    </td>
    <td align="center" style="font-size:12px"> Diketahui oleh
    </td>
    <td align="center" style="font-size:12px"> Disetujui oleh
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="3">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="3">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="3">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="3">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="3">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="3">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px">(<?= $ttd['mengajukan']; ?>)
    </td>
    <td align="center" style="font-size:12px"> (<?= $ttd['mengetahui']; ?>)
    </td>
    <td align="center" style="font-size:12px"> (<?= $ttd['menyetujui']; ?>)
    </td>
  </tr>
</table>
<table width="100%" border="0" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td align="center" style="font-size:12px" colspan="3">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="3">
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:12px" width="20%">
      Jumlah yang diajukan
    </td>
    <td align="right" style="font-size:12px" width="2%">
      :
    </td>
    <td align="left" style="font-size:12px" width="78%">
      Rp <?= number_format($totalhpp,2,',','.'); ?> (<?= ucwords(terbilang($totalhpp)).' Rupiah' ?>)
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:12px" width="20%">
      Jadwal pembayaran
    </td>
    <td align="right" style="font-size:12px" width="2%">
      :
    </td>
    <td align="left" style="font-size:12px" width="78%">
      
    </td>
  </tr>
   <?php if($pdo_header['s_transfer']=='1'){ ?>
    <tr>
    <td align="left" style="font-size:12px" width="20%">
      Transfer ke
    </td>
    <td align="right" style="font-size:12px" width="2%">
      :
    </td>
    <td align="left" style="font-size:12px" width="78%">
      <?= $ttd['nm_bank1'].' ('.$ttd['rekening1']. ') an.' .$ttd['nama_rekening1'];; ?> ()
    </td>
  </tr>
  <?php }else{ ?>
    <tr>
    <td align="left" style="font-size:12px" width="20%">
      Transfer ke
    </td>
    <td align="right" style="font-size:12px" width="2%">
      :
    </td>
    <td align="left" style="font-size:12px" width="78%">
      LS
    </td>
  </tr>
  <?php } ?>
  </table>