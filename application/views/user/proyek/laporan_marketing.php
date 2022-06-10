<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;font-size: 12px;" cellspacing="2" cellpadding="3">
  
  <!-- Laporan marketing -->
<thead>
  <tr style="background: #CACACA;">
        <th align="center" rowspan="2"><b>Nama Area</b> </th>
        <th align="center" rowspan="2"><b>Nama Sub</b> Area  </th>
        <th align="center" rowspan="2"><b>Nama Pekerjaan</b> </th>
        <th align="center" colspan="8"><b>Tahap</b></th>
  </tr>

  <tr style="background: #CACACA;">
        <th align="center" width="6%"><b>Target</b></th>
        <th align="center" width="6%"><b>Renja</b></th>
        <th align="center" width="6%"><b>APBD</b></th>
        <th align="center" width="6%"><b>APBD-P</b></th>
        <th align="center" width="6%"><b>PRASPK</b></th>
        <th align="center" width="6%"><b>SPK</b></th>
        <th align="center" width="6%"><b>Pencairan</b></th>
        <th align="center" width="6%"><b>Sisa</b></th>
  </tr>
</thead>
  <?php 
      $total_target =0;
      $total_renja  =0;
      $total_apbd   =0;
      $total_apbdp  =0;
      $total_praspk =0;
      $total_spk    =0; 
      $total_cair   =0;
      $subtotal_cair=0;
  ?>
<?php foreach($proyek as $proyek_list): ?>
      
      <?php $total_cair        = $total_cair+$proyek_list['cair']; ?>

      <?php if($proyek_list['pagu']==6) : 
        $total_spk        = $total_spk+$proyek_list['spk']; 
      ?>
          <tr>
            <td><?= $proyek_list['nm_area']; ?></td>
            <td><?= $proyek_list['nm_sub_area']; ?></td>
            <td><?= $proyek_list['nm_paket_proyek']; ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['spk'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['cair'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['spk']-$proyek_list['cair'],2,',','.'); ?></td>
          </tr>

          <?php $subtotal_cair = $subtotal_cair+($proyek_list['spk']-$proyek_list['cair']); ?>

      <?php elseif ($proyek_list['pagu']==5) : 
        $total_praspk     = $total_praspk+$proyek_list['praspk'];
      ?>
          <tr>
            <td><?= $proyek_list['nm_area']; ?></td>
            <td><?= $proyek_list['nm_sub_area']; ?></td>
            <td><?= $proyek_list['nm_paket_proyek']; ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['praspk'],2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['cair'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['praspk']-$proyek_list['cair'],2,',','.'); ?></td>
          </tr>
          <?php $subtotal_cair = $subtotal_cair+($proyek_list['praspk']-$proyek_list['cair']); ?>

      <?php elseif ($proyek_list['pagu']==4) : 
        $total_apbdp      = $total_apbdp+$proyek_list['apbdp'];
      ?>
          <tr>
            <td><?= $proyek_list['nm_area']; ?></td>
            <td><?= $proyek_list['nm_sub_area']; ?></td>
            <td><?= $proyek_list['nm_paket_proyek']; ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['apbdp'],2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['cair'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['apbdp']-$proyek_list['cair'],2,',','.'); ?></td>
            <?php $subtotal_cair = $subtotal_cair+($proyek_list['apbdp']-$proyek_list['cair']); ?>
      <?php elseif ($proyek_list['pagu']==3) : 
        $total_apbd       = $total_apbd+$proyek_list['apbd'];
      ?>
          <tr>
            <td><?= $proyek_list['nm_area']; ?></td>
            <td><?= $proyek_list['nm_sub_area']; ?></td>
            <td><?= $proyek_list['nm_paket_proyek']; ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['apbd'],2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['cair'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['apbd']-$proyek_list['cair'],2,',','.'); ?></td>
          </tr>
          <?php $subtotal_cair = $subtotal_cair+($proyek_list['apbd']-$proyek_list['cair']); ?>
        <?php elseif ($proyek_list['pagu']==2) : 
          $total_renja      = $total_renja+$proyek_list['renja'];
        ?>
          <tr>
            <td><?= $proyek_list['nm_area']; ?></td>
            <td><?= $proyek_list['nm_sub_area']; ?></td>
            <td><?= $proyek_list['nm_paket_proyek']; ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['renja'],2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['cair'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['renja']-$proyek_list['cair'],2,',','.'); ?></td>
          </tr>
          <?php $subtotal_cair = $subtotal_cair+($proyek_list['renja']-$proyek_list['cair']); ?>
        <?php elseif ($proyek_list['pagu']==1) : 
          $total_target     = $total_target+$proyek_list['target'];  
        ?>
          <tr>
            <td><?= $proyek_list['nm_area']; ?></td>
            <td><?= $proyek_list['nm_sub_area']; ?></td>
            <td><?= $proyek_list['nm_paket_proyek']; ?></td>
            <td align="right" ><?= number_format($proyek_list['target'],2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['cair'],2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['target']-$proyek_list['cair'],2,',','.'); ?></td>
          </tr>
          <?php $subtotal_cair = $subtotal_cair+($proyek_list['target']-$proyek_list['cair']); ?>
        <?php elseif ($proyek_list['pagu']==0) : ?>
          <tr>
            <td><?= $proyek_list['nm_area']; ?></td>
            <td><?= $proyek_list['nm_sub_area']; ?></td>
            <td><?= $proyek_list['nm_paket_proyek']; ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format(0,2,',','.'); ?></td>
            <td align="right" ><?= number_format($proyek_list['cair'],2,',','.'); ?></td>
            <td align="right" ><?= number_format(0-$proyek_list['cair'],2,',','.'); ?></td>
          </tr>
          <?php $subtotal_cair = $subtotal_cair+(0-$proyek_list['cair']); ?>
        <?php endif; ?>        
<?php endforeach; ?>

      <tr>
        <td colspan="3" align="center">
          Total Biaya
        </td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_target,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_renja,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_apbd,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_apbdp,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_praspk,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_spk,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($total_cair,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($subtotal_cair,2,',','.'); ?></td>
      </tr>

</table>