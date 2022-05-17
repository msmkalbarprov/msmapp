<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;font-size: 12px;" cellspacing="2" cellpadding="3">
  
  <!-- Laporan marketing -->
<thead>
  <tr style="background: #CACACA;">
        <th align="center" rowspan="2"><b>Nama Area</b> </th>
        <th align="center" colspan="8"><b>Tahap Lelang</b></th>
  </tr>

  <tr style="background: #CACACA;">
        <th align="center" width="10%"><b>Target</b></th>
        <th align="center" width="10%"><b>Renja</b></th>
        <th align="center" width="10%"><b>APBD</b></th>
        <th align="center" width="10%"><b>APBD-P</b></th>
        <th align="center" width="10%"><b>PRASPK</b></th>
        <th align="center" width="10%"><b>SPK</b></th>
        <th align="center" width="10%"><b>Tanggal</b></th>
        <th align="center" width="10%"><b>Pencairan</b></th>
  </tr>
</thead>
  <?php 
      $total_target =0;
      $total_renja  =0;
      $total_apbd   =0;
      $total_apbdp  =0;
      $total_praspk =0;
      $total_spk    =0; 
  ?>
<?php foreach($proyek as $proyek): ?>

  <?php 
    $total_target     = $total_target+$proyek['target'];  
    $total_renja      = $total_renja+$proyek['renja'];  
    $total_apbd       = $total_apbd+$proyek['apbd'];  
    $total_apbdp      = $total_apbdp+$proyek['apbdp'];  
    $total_praspk     = $total_praspk+$proyek['praspk'];  
    $total_spk        = $total_spk+$proyek['spk'];  
    
  ?> 
      <tr>
        <td>
          <?= $proyek['nm_area']; ?>
        </td>
        <td align="right" ><?= number_format($proyek['target'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($proyek['renja'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($proyek['apbd'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($proyek['apbdp'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($proyek['praspk'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($proyek['spk'],2,',','.'); ?></td>
        <td align="right" ><?php if( $proyek['tglspk'] == 0 || $proyek['tglspk']=='0000-00-00') :
          echo "-";
        else:
          echo $proyek['tglspk'];
          endif; ?></td>
          <td align="right" >-</td>
      </tr>
<?php endforeach; ?>

      <tr>
        <td align="center">
          Total Biaya
        </td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_target,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_renja,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_apbd,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_apbdp,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_praspk,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_spk,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"></td>
        <td align="right" style="background: black;color: white;border-right:white;"></td>
      </tr>

</table>