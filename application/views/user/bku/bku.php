<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table border="0" width="100%">
  <tr>
    <td colspan="4" style="text-align:center"><h3>PT. MURFA SURYA MAHARDIKA<br>(BUKU KAS UMUM)</h3></td>
  </tr>
  <tr>
    <td colspan="4" style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" style="text-align:left"><b>Area</b></td>
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
        <th align="center"><b>No.</th>
        <th align="center"><b>Nomor</b> </th>
        <th align="center"><b>Tanggal</b></th>
        <th align="center"><b>Uraian</b></th>
        <th align="center"><b>Penerimaan</b></th>
        <th align="center"><b>Pengeluaran</b></th>
        <th align="center"><b>Saldo</b></th>
        
  </tr>
</thead>
  <?php 
      $terima = 0;
      $keluar   = 0;
      $subtotal   = 0;
      $i=0;
  ?>
<?php foreach($list_bku as $list_bku): ?>
          
          <?php $subtotal = $subtotal+$list_bku['terima']-$list_bku['keluar']; ?>

          <?php if ($list_bku['posisi']=='H'): ?>
                  <tr>
                    <td align="center"><?= ++$i; ?></td>
                    <td><?= $list_bku['nomor']; ?></td>
                    <td><?= $list_bku['tgl_cair']; ?></td>
                    <td><?= $list_bku['keterangan']; ?></td>
                    <td align="right" ><?= number_format($list_bku['terima'],2,',','.'); ?></td>
                    <td align="right" ><?= number_format($list_bku['keluar'],2,',','.'); ?></td>
                    <td align="right" ><?= number_format($subtotal,2,',','.'); ?></td>
                  </tr>
          <?php elseif ($list_bku['posisi']=='HD'): ?>
                  <tr style="border-bottom-style: dashed;border-top-style: solid !important;border-bottom-color: grey 0px;">
                    <td align="center"><?= ++$i; ?></td>
                    <td><?= $list_bku['nomor']; ?></td>
                    <td><?= $list_bku['tgl_cair']; ?></td>
                    <td><?= $list_bku['keterangan']; ?></td>
                    <td align="right" ></td>
                    <td align="right" ></td>
                    <td align="right" ></td>
                  </tr>
          <?php else: ?>
                  <tr style="border-bottom-style: dashed;border-color: grey;">
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><?= $list_bku['keterangan']; ?></td>
                      <td align="right" ><?= number_format($list_bku['terima'],2,',','.'); ?></td>
                      <td align="right" ><?= number_format($list_bku['keluar'],2,',','.'); ?></td>
                      <td align="right" ><?= number_format($subtotal,2,',','.'); ?></td>
                    </tr>
          <?php endif ?>      
          
        
<?php endforeach; ?>
<tfoot>
          <tr>
            <td colspan="7">&nbsp;</td>
          </tr>
        </tfoot>
</table>