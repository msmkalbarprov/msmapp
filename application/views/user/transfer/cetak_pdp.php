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

<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td align="left" style="font-size:16px;border-bottom:solid 1px white;border-right:solid 1px white;" colspan="4">
      <b>To : PT. MSM CONSULTANTS</b>
    </td>
    <td align="right" style="font-size:16px;border-bottom:solid 1px white;border-left:solid 1px white;border-right:solid 1px black;" colspan="4">
      <b>From : Kantor Area <?= ucwords(strtolower($transfer_header['nm_area'])); ?></b>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:16px;" colspan="8">
      <b>UB. Finance & Accounting Jakarta : (021) 384.0412</b>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;border-right:solid 1px white;" colspan="4">
    </td>
    <td align="right" style="font-size:13px;border-bottom:solid 1px white;border-left:solid 1px white;" colspan="2">
      <b>Tanggal</b>
    </td>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;border-left:solid 1px white;" colspan="2">
      <b>: <?= date('d F Y', strtotime($transfer_header['tgl_transfer'])); ?></b>
    </td>
  </tr>
  
  <tr>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;border-right:solid 1px white;" colspan="4">
    </td>
    <td width="20%" align="right" style="font-size:13px;border-bottom:solid 1px white;border-left:solid 1px white;" colspan="2">
      <b>Nomor</b>
    </td>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;border-left:solid 1px white;" colspan="2">
      <b>: <?= $transfer_header['no_transfer']; ?></b>
    </td>
  </tr>

  <tr>
    <td align="center" style="font-size:18px;" colspan="8">
      <b>PENGIRIMAN DANA PROJECT</b>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;" colspan="8">
      Sehubungan dengan adanya pencairan proyek di Area <b><?= ucwords(strtolower($transfer_header['nm_area'])); ?></b>, dengan ini saya sampaikan bahwa dana pencairan project tersebut telah ditransfer ke <b>Pak Ruslan</b>. Dengan rincian sbb :
    </td>
  </tr>
  

  <tr>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="8">
      &nbsp;
    </td>
  </tr>

  <tr>
    <td width="5%" align="center" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" >
    </td>
    <td align="center" style="font-size:13px;border-bottom:solid 1px white;" colspan="6">
      <!-- TABEL -->
      <table width="100%" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
        <tr style="font-size:12px">
          <td width="35%" align="center" bgcolor="#DCDCDC" >No. Pencairan (PDP)</td>
          <td width="10%" align="center" bgcolor="#DCDCDC" >Nilai Pencairan</td>
          <td width="10%" align="center" bgcolor="#DCDCDC" >Potongan</td>
          <td width="10%" align="center" bgcolor="#DCDCDC" >Nilai Netto</td>
        </tr>
        <?php 
          $totalbruto =0; 
          $totalpotongan =0; 
          $totalnetto =0; 
          $i=1;
        ?>
        <?php foreach($transfer_detail as $pdp): ?>
            
        <?php 
              $totalbruto = $totalbruto+$pdp['nilai'];
              $totalpotongan = $totalpotongan+$pdp['potongan'];
              $totalnetto = $totalnetto+($pdp['nilai']-$pdp['potongan']);  
        ?>
          <tr style="font-size:12px">
            <td width="25%"><?= $pdp['no_cair']; ?></td>
            <td width="10%" align="right"><?= number_format($pdp['nilai'],2,',','.'); ?></td>
            <td width="10%" align="right"><?= number_format($pdp['potongan'],2,',','.'); ?></td>
            <td width="10%" align="right"><?= number_format($pdp['nilai']-$pdp['potongan'],2,',','.'); ?></td>
          </tr>
        <?php endforeach; ?>
        <tr style="font-size:12px">
          <td align="right">Jumlah</td>
          <td width="10%" align="right"><?= number_format($totalbruto,2,',','.'); ?></td>
          <td width="10%" align="right"><?= number_format($totalpotongan,2,',','.'); ?></td>
          <td width="10%" align="right"><?= number_format($totalnetto,2,',','.'); ?></td>
        </tr>
      </table>
      <!-- END TABEL -->
    </td>
    <td width="5%" align="center" style="font-size:16px;border-left:solid 1px white;border-bottom:solid 1px white;" >
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;" colspan="8">
        &nbsp;&nbsp;Jumlah uang yang ditransfer : Rp <?= number_format($transfer_header['nilai_netto'],2,',','.'); ?> (<?= ucwords(terbilang($transfer_header['nilai_netto'])).' Rupiah' ?>)
        <br>&nbsp;
    </td>
  </tr>

  <tr>
    <td colspan="8">
        <table width="100%" border="0" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
          <tr>
            <td align="center" style="font-size:12px" colspan="3">
            </td>
          </tr>
          <tr>
            <td align="center" width="33%" style="font-size:12px">
            </td>
            <td align="center" width="34%" style="font-size:12px"> Mengetahui
            </td>
            <td align="center" width="33%"style="font-size:12px">
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
            <td align="center" style="font-size:12px">
            </td>
            <td align="center" style="font-size:12px"> (<?= $ttd['mengetahui']; ?>)
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>


<table width="100%" border="0" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td align="left" style="font-size:12px">
      Tembusan Kepada Yth :<br>
      &nbsp;1. AM <?= ucwords(strtolower($transfer_header['nm_area'])); ?><br>
      &nbsp;2. Bag. Marketing<br>
      &nbsp;3. Arsip Kantor Area <?= ucwords(strtolower($transfer_header['nm_area'])); ?><br>
    </td>
    <td align="left" style="font-size:12px"></td>
    <td align="left" style="font-size:12px"></td>
  </tr>
  </table>