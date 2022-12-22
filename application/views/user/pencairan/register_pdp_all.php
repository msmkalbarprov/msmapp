<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table border="0" width="100%">
  <tr>
    <td colspan="4" style="text-align:center"><h3>PT. MURFA SURYA MAHARDIKA<br>REGISTER PENCAIRAN DANA PROYEK</h3></td>
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
<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;font-size: 10px;" cellspacing="2" cellpadding="3">
<thead>
  <tr style="background: #CACACA;">
        <th align="center" rowspan="2"><b>Area</th>
        <th align="center" rowspan="2"><b>Kopek</th>
        <th align="center" rowspan="2"><b>No. PDP</th>
        <th align="center" rowspan="2"><b>Tgl. PDP</b> </th>
        <th align="center" rowspan="2"><b>Keterangan</b></th>
        <th align="center" rowspan="2"><b>Nilai</b></th>
        <th align="center" colspan="6"><b>Pajak/Potongan</b></th>
        <th align="center" rowspan="2"><b>Netto</b></th>
        <th align="center" rowspan="2"><b>Rek. Tujuan</b></th>
        
  </tr>
  <tr style="background: #CACACA;">
    <th align="center"><b>PPN</b></th>
    <th align="center"><b>PPH 21</b></th>
    <th align="center"><b>PPH 22</b></th>
    <th align="center"><b>PPH 23</b></th>
    <th align="center"><b>Infaq</b></th>
    <th align="center"><b>Adm. Bank</b></th>
  </tr>
</thead>
  <?php 
      $total_bruto = 0;
      $total_ppn   = 0;
      $total_pph21 = 0;
      $total_pph22 = 0;
      $total_pph23 = 0;
      $total_infaq = 0;
      $total_adm   = 0;
      $total_netto = 0;
  ?>
<?php foreach($register_pdp as $register_pdp): ?>
          
          <?php $netto = $register_pdp['nilai']-($register_pdp['ppn']+$register_pdp['pph21']+$register_pdp['pph22']+$register_pdp['pph23']+$register_pdp['infaq']+$register_pdp['adm']); ?>      
          <tr>
            <td><?= $register_pdp['nm_area']; ?></td>
            <td><?= $register_pdp['kd_proyek']; ?></td>
            <td><?= $register_pdp['nomor']; ?></td>
            <td><?= $register_pdp['tgl_cair']; ?></td>
            <td><?= $register_pdp['keterangan'].'<br>'.$register_pdp['nm_paket_proyek']; ?></td>
            <td align="right" ><?= number_format($register_pdp['nilai'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($register_pdp['ppn'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($register_pdp['pph21'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($register_pdp['pph22'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($register_pdp['pph23'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($register_pdp['infaq'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($register_pdp['adm'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($netto,2,',','.'); ?></td>
            <td align="right" ><?= $register_pdp['rek_cair']; ?></td>
          </tr>

          <?php 
            $total_bruto  = $total_bruto+$register_pdp['nilai'];
            $total_ppn    = $total_ppn+$register_pdp['ppn'];
            $total_pph21  = $total_pph21+$register_pdp['pph21'];
            $total_pph22  = $total_pph22+$register_pdp['pph22'];
            $total_pph23  = $total_pph23+$register_pdp['pph23'];
            $total_infaq  = $total_infaq+$register_pdp['infaq'];
            $total_adm    = $total_adm+$register_pdp['adm'];
            $total_netto  = $total_netto+$netto; 
          ?>

        
<?php endforeach; ?>

      <tr>
        <td colspan="5" align="center">
          Total Biaya
        </td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_bruto,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_ppn,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_pph21,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_pph22,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_pph23,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_infaq,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_adm,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_netto,2,',','.'); ?></td>
        <td align="right">&nbsp;</td>
      </tr>

</table>