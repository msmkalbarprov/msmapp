<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table border="0" width="100%">
  <tr>
    <td colspan="4" style="text-align:center"><h3>PT. MURFA SURYA MAHARDIKA<br>REGISTER PENGIRIMAN DANA PROYEK</h3></td>
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
        <th align="center" rowspan="2"><b>No. Transfer</th>
        <th width="5%" align="center" rowspan="2"><b>Tgl. Transfer</b> </th>
        <th width="20%" align="center" rowspan="2"><b>Keterangan</b></th>
        <th align="center" rowspan="2"><b>Nilai</b></th>
        <th align="center" colspan="3"><b>Pajak/Potongan</b></th>
        <th align="center" rowspan="2"><b>Netto</b></th>
        <th align="center" rowspan="2"><b>Rek. Tujuan</b></th>
        
  </tr>
  <tr style="background: #CACACA;">
    <th align="center"><b>PL</b></th>
    <th align="center"><b>Potongan Pendapatan</b></th>
    <th align="center"><b>Adm. Bank</b></th>
  </tr>
</thead>
  <?php 
      $total_bruto  = 0;
      $total_pl     = 0;
      $total_pp     = 0;
      $total_adm    = 0;
      $total_netto  = 0;
  ?>
<?php foreach($register_pdp_transfer as $register_pdp_transfer): ?>
          
          <?php $netto = $register_pdp_transfer['nilai']-($register_pdp_transfer['pl']+$register_pdp_transfer['pp']+$register_pdp_transfer['ab']); ?>      
          <tr>
            <td><?= $register_pdp_transfer['nm_area']; ?></td>
            <td><?= $register_pdp_transfer['kd_proyek']; ?></td>
            <td><?= $register_pdp_transfer['no_transfer']; ?></td>
            <td><?= $register_pdp_transfer['tgl_transfer']; ?></td>
            <td><?= $register_pdp_transfer['keterangan']; ?></td>
            <td align="right" ><?= number_format($register_pdp_transfer['nilai'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($register_pdp_transfer['pl'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($register_pdp_transfer['pp'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($register_pdp_transfer['ab'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($netto,2,',','.'); ?></td>
            <td align="right" ><?= $register_pdp_transfer['kd_rekening']; ?></td>
          </tr>

          <?php 
            $total_bruto  = $total_bruto+$register_pdp_transfer['nilai'];
            $total_pl     = $total_pl+$register_pdp_transfer['pl'];
            $total_pph    = $total_pp+$register_pdp_transfer['pp'];
            $total_adm    = $total_adm+$register_pdp_transfer['ab'];
            $total_netto  = $total_netto+$netto; 
          ?>

        
<?php endforeach; ?>

      <tr>
        <td colspan="5" align="center">
          Total Biaya
        </td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_bruto,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_pl,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_pp,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_adm,2,',','.'); ?></td>
        <td align="right" style="background: #CACACA;"><?= number_format($total_netto,2,',','.'); ?></td>
        <td align="right">&nbsp;</td>
      </tr>

</table>