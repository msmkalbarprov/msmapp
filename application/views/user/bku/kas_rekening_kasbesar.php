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
        <th align="center"><b>No.</th>
        <th align="center"><b>Nomor</b> </th>
        <th align="center"><b>Tanggal</b></th>
        <th align="center"><b>Area</b></th>
        <th align="center"><b>Divisi</b></th>
        <th align="center"><b>Uraian</b></th>
        <th align="center"><b>Penerimaan</b></th>
        <th align="center"><b>Pengeluaran</b></th>
        <th align="center"><b>Saldo</b></th>
        
  </tr>
</thead>

 <?php if($cjenis=='0'): ?>
   

					<?php if($bulan==''): ?>
								<tr>
									<td align="center"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>Saldo Awal</td>
									<td align="right" ></td>
									<td align="right" ></td>
									<td align="right" ><?= $lalu['saldo']; ?></td>
								</tr>
					<?php elseif($bulan==2): ?>
								<tr>
									<td align="center"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>Saldo Awal</td>
									<td align="right" ></td>
									<td align="right" ></td>
									<td align="right" ><?= $lalu['saldo']; ?></td>
								</tr>
					<?php else: ?>
								<tr>
									<td align="center"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>Saldo Lalu</td>
									<td align="right" ></td>
									<td align="right" ></td>
									<td align="right" ><?= $lalu['saldo']; ?></td>
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
									<td><?= $list['nm_area']; ?></td>
									<td><?= $list['divisi']; ?></td>
									<td><?= $list['keterangan']; ?></td>
									<td align="right" ><?= $list['terima']; ?></td>
									<td align="right" ><?= $list['keluar']; ?></td>
									<td align="right" ><?= $subtotal; ?></td>
								</tr>
							<?php elseif($list['urut']==8): ?>
								<tr>
									<td align="center"><?= ++$i; ?></td>
									<td><?= $list['nomor']; ?></td>
									<td><?= $list['tanggal']; ?></td>
									<td><?= $list['nm_area']; ?></td>
									<td><?= $list['divisi']; ?></td>
									<td><?= $list['keterangan']; ?></td>
									<td align="right" ></td>
									<td align="right" ></td>
									<td align="right" ></td>
								</tr>
							<?php else: ?>
								<tr>
									<td align="center"><?= ++$i; ?></td>
									<td><?= $list['nomor']; ?></td>
									<td><?= $list['tanggal']; ?></td>
									<td><?= $list['nm_area']; ?></td>
									<td><?= $list['divisi']; ?></td>
									<td><?= $list['keterangan']; ?></td>
									<td align="right" ><?= $list['terima']; ?></td>
									<td align="right" ><?= $list['keluar']; ?></td>
									<td align="right" ><?= $subtotal; ?></td>
								</tr>
							<?php endif; ?>
					  
					
			<?php endforeach; ?>
			<tfoot>
					  <tr>
						<td colspan="8"><b>Saldo akhir</td>
						<td align="right" ><?= $subtotal; ?></td>
					  </tr>
					</tfoot>
		
		
<?php else: ?>		



				<?php if($bulan==''): ?>
								<tr>
									<td align="center"></td>
									<td></td>
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
									<td><?= $list['nm_area']; ?></td>
									<td><?= $list['divisi']; ?></td>
									<td><?= $list['keterangan']; ?></td>
									<td align="right" ><?= number_format($list['terima'],2,',','.'); ?></td>
									<td align="right" ><?= number_format($list['keluar'],2,',','.'); ?></td>
									<td align="right" ><?= number_format($subtotal,2,',','.'); ?></td>
								</tr>
							<?php elseif($list['urut']==8): ?>
								<tr>
									<td align="center"><?= ++$i; ?></td>
									<td><?= $list['nomor']; ?></td>
									<td><?= $list['tanggal']; ?></td>
									<td><?= $list['nm_area']; ?></td>
									<td><?= $list['divisi']; ?></td>
									<td><?= $list['keterangan']; ?></td>
									<td align="right" ></td>
									<td align="right" ></td>
									<td align="right" ></td>
								</tr>
							<?php else: ?>
								<tr>
									<td align="center"><?= ++$i; ?></td>
									<td><?= $list['nomor']; ?></td>
									<td><?= $list['tanggal']; ?></td>
									<td><?= $list['nm_area']; ?></td>
									<td><?= $list['divisi']; ?></td>
									<td><?= $list['keterangan']; ?></td>
									<td align="right" ><?= number_format($list['terima'],2,',','.'); ?></td>
									<td align="right" ><?= number_format($list['keluar'],2,',','.'); ?></td>
									<td align="right" ><?= number_format($subtotal,2,',','.'); ?></td>
								</tr>
							<?php endif; ?>
					  
					
			<?php endforeach; ?>
			<tfoot>
					  <tr>
						<td colspan="8"><b>Saldo akhir</td>
						<td align="right" ><?= number_format($subtotal,2,',','.'); ?></td>
					  </tr>
					</tfoot>





<?php endif; ?>		
		
</table>