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
    <td width="10%" style="text-align:left"><b>Rekening</b></td>
    <td width="2%" style="text-align:left"><b>:</b></td>
    <td colspan="2" width="88%" style="text-align:left"><b><?= $rekening['no_acc'].' - '.$rekening['nm_acc']; ?></b></td>
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
        <th width="2%" align="center"><b>No.</th>
        <th width="8%" align="center"><b>Nomor</b> </th>
        <th width="6%" align="center"><b>Tanggal</b></th>
		<th width="8%" align="center"><b>Proyek</b> </th>
        <th width="40%" align="center"><b>Uraian</b></th>
        <th width="10%" align="center"><b>Penerimaan</b></th>
        <th width="10%" align="center"><b>Pengeluaran</b></th>
        <th width="10%" align="center"><b>Saldo</b></th>
        
  </tr>
</thead>

        <?php if($bulan==''): ?>
                    <tr>
                        <td align="center"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Saldo Awal</td>
                        <td align="right" ></td>
                        <td align="right" ></td>
                        <td align="right" ><?= number_format($lalu['saldo'],2,',','.'); ?></td>
                    </tr>
        <?php elseif($bulan==2): ?>
                    <tr>
                        <td align="center"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Saldo Awal</td>
                        <td align="right" ></td>
                        <td align="right" ></td>
                        <td align="right" ><?= number_format($lalu['saldo'],2,',','.'); ?></td>
                    </tr>
        <?php else: ?>
                    <tr>
                        <td align="center"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Saldo Lalu</td>
                        <td align="right" ></td>
                        <td align="right" ></td>
                        <td align="right" ><?= number_format($lalu['saldo'],2,',','.'); ?></td>
                    </tr>
        <?php endif; ?>
  <?php 
      $terima = 0;
      $keluar   = 0;
      $subtotal   = $lalu['saldo'];
      $i=0;
  ?>
  
<?php foreach($list as $list): ?>
          
    <?php 
        
            if($list['urut']!=8){
                $subtotal = $subtotal+$list['terima']-$list['keluar'];
            }else{
                
            }
?>
    
                
                
                <?php if($list['urut']==9): ?>
                    <tr>
                        <td align="center"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?= $list['keterangan']; ?></td>
                        <td align="right" ><?= number_format($list['terima'],2,',','.'); ?></td>
                        <td align="right" ><?= number_format($list['keluar'],2,',','.'); ?></td>
                        <td align="right" ><?= number_format($subtotal,2,',','.'); ?></td>
                    </tr>
                <?php elseif($list['urut']==8): ?>
                    <tr>
                        <td align="center"><?= ++$i; ?></td>
                        <td><?= $list['nomor']; ?></td>
                        <td align="center"><?= $list['tanggal']; ?></td>
                        <td><?= $list['kd_proyek']; ?></td>
                        <td><?= $list['keterangan']; ?></td>
                        <td align="right" ></td>
                        <td align="right" ></td>
                        <td align="right" ></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td align="center"><?= ++$i; ?></td>
                        <td><?= $list['nomor']; ?></td>
                        <td align="center"><?= $list['tanggal']; ?></td>
                        <td><?= $list['kd_proyek']; ?></td>
                        <td><?= $list['keterangan']; ?></td>
                        <td align="right" ><?= number_format($list['terima'],2,',','.'); ?></td>
                        <td align="right" ><?= number_format($list['keluar'],2,',','.'); ?></td>
                        <td align="right" ><?= number_format($subtotal,2,',','.'); ?></td>
                    </tr>
                <?php endif; ?>
          
        
<?php endforeach; ?>
<tfoot>
          <tr>
            <td colspan="7"><b>Saldo akhir</td>
            <td align="right" ><?= number_format($subtotal,2,',','.'); ?></td>
          </tr>
        </tfoot>
</table>