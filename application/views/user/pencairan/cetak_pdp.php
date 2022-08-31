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
    <td align="center" style="font-size:18px;" colspan="8">
      <b>PENCAIRAN DANA PROJECT</b>
      <br>
      <b>AREA <?= $pdp_header['nm_area']; ?></b>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" colspan="2">
      No. Pencairan
    </td>
    <td align="center" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" width="2%">
      :
    </td>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="5">
      <?= $pdp_header['nomor']; ?>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" colspan="2">
      Tanggal Pencairan
    </td>
    <td align="center" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" width="2%">
      :
    </td>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="5">
      <?= date('d F Y', strtotime($pdp_header['tgl_cair'])); ?>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" colspan="2">
      Nama Pekerjaan
    </td>
    <td align="center" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" width="2%">
      :
    </td>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="5">
      Terlampir
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" colspan="2">
      Pelaksana
    </td>
    <td align="center" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" width="2%">
      :
    </td>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="5">
      <?= $pdp_header['nm_perusahaan']; ?>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" colspan="2">
      Lokasi
    </td>
    <td align="center" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" width="2%">
      :
    </td>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="5">
      <?= $pdp_header['nm_sub_area']; ?>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" colspan="2">
      Tahun Pelaksanaan
    </td>
    <td align="center" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" width="2%">
      :
    </td>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="5">
      <?= $pdp_header['thn_anggaran']; ?>
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" colspan="2">
      Jumlah dana yang dicairkan
    </td>
    <td align="center" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" width="2%">
      :
    </td>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="5">
      Rp <?= number_format($pdp_header['nilai'],2,',','.'); ?>
    </td>
  </tr>
  <tr >
    <td align="left" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" colspan="2">
      
    </td>
    <td align="center" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" width="2%">
      
    </td>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="5">
      (<?= ucwords(terbilang($pdp_header['nilai'])).' Rupiah' ?>)
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="8">
      &nbsp;
    </td>
  </tr>
  <tr>
    <td align="left" style="font-size:13px;border-bottom:solid 1px white;" colspan="8">
      Rincian :
    </td>
  </tr>
  <tr>
    <td width="5%" align="center" style="font-size:13px;border-right:solid 1px white;border-bottom:solid 1px white;" >
    </td>
    <td align="center" style="font-size:13px;border-bottom:solid 1px white;" colspan="6">
      <!-- TABEL -->
      <table width="100%" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
        <tr style="font-size:12px">
          <td width="25%" align="center" bgcolor="#DCDCDC" >Nama Pekerjaan</td>
          <td width="15%" align="center" bgcolor="#DCDCDC" >Nama Instansi</td>
          <td width="10%" align="center" bgcolor="#DCDCDC" >N. Bruto</td>
          <td width="10%" align="center" bgcolor="#DCDCDC" >PPN</td>
          <td width="10%" align="center" bgcolor="#DCDCDC" >PPH</td>
          <td width="10%" align="center" bgcolor="#DCDCDC" >INFAQ</td>
          <td width="10%" align="center" bgcolor="#DCDCDC" >ADM. BANK</td>
          <td width="10%" align="center" bgcolor="#DCDCDC" >N. Netto</td>
        </tr>
        <?php 
          $totalbruto =0; 
          $totalppn   =0; 
          $totalpph   =0; 
          $totalinfaq =0; 
          $totalnetto =0; 
          $totaladm   =0;
          $i=1;
        ?>
        <?php foreach($pdp_detail as $pdp): ?>
            
        <?php 
              $totalbruto = $totalbruto+$pdp['nilai_bruto'];
              $totalppn   = $totalppn+$pdp['ppn'];
              $totalpph   = $totalpph+$pdp['pph'];
              $totalinfaq = $totalinfaq+$pdp['infaq'];
              $totaladm   = $totaladm+$pdp['adm'];
              $potongan   = $pdp['infaq']+$pdp['pph']+$pdp['ppn']+$pdp['adm'];
              $netto      = $pdp['nilai_bruto']-$potongan;
              $totalnetto = $totalnetto+$netto;  
        ?>
          <tr style="font-size:12px">
            <td width="25%"><?= $pdp['nm_paket_proyek'].' '.$pdp['jns_cair']; ?></td>
            <td width="15%"><?= $pdp['nm_dinas']; ?></td>
            <td width="10%" align="right"><?= number_format($pdp['nilai_bruto'],2,',','.'); ?></td>
            <td width="10%" align="right"><?= number_format($pdp['ppn'],2,',','.'); ?></td>
            <td width="10%" align="right"><?= number_format($pdp['pph'],2,',','.'); ?></td>
            <td width="10%" align="right"><?= number_format($pdp['infaq'],2,',','.'); ?></td>
            <td width="10%" align="right"><?= number_format($pdp['adm'],2,',','.'); ?></td>
            <td width="10%" align="right"><?= number_format($netto,2,',','.'); ?></td>
          </tr>
        <?php endforeach; ?>
        <tr style="font-size:12px">
          <td colspan="2" align="right">Jumlah</td>
          <td width="10%" align="right"><?= number_format($totalbruto,2,',','.'); ?></td>
          <td width="10%" align="right"><?= number_format($totalppn,2,',','.'); ?></td>
          <td width="10%" align="right"><?= number_format($totalpph,2,',','.'); ?></td>
          <td width="10%" align="right"><?= number_format($totalinfaq,2,',','.'); ?></td>
          <td width="10%" align="right"><?= number_format($totaladm,2,',','.'); ?></td>
          <td width="10%" align="right"><?= number_format($totalnetto,2,',','.'); ?></td>
        </tr>
      </table>
      <!-- END TABEL -->
    </td>
    <td width="5%" align="center" style="font-size:16px;border-left:solid 1px white;border-bottom:solid 1px white;" >
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
      &nbsp;1. AM <?= ucwords(strtolower($pdp_header['nm_area'])); ?><br>
      &nbsp;2. Bag. Marketing<br>
      &nbsp;3. Arsip Kantor Area <?= ucwords(strtolower($pdp_header['nm_area'])); ?><br>
    </td>
    <td align="left" style="font-size:12px"></td>
    <td align="left" style="font-size:12px"></td>
  </tr>
  </table>