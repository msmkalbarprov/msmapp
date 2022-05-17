<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td >
      Nama Area
    </td>
    <td colspan="3" align="center"><?= $header_operasional['nm_area']; ?></td>
  </tr>
  <tr>
    <td >
      Kode PQ
    </td>
    <td colspan="3" align="center"><?= $header_operasional['kode']; ?></td>
  </tr>
  
  <tr>
    <td  align="center" style="background: #B9C0C5;color: #000;">
    </td>
    <td align="center" style="background: #B9C0C5; color: #000;">Nilai PQ</td>
    <td align="center" style="background: #B9C0C5; color: #000;">Realisasi PDO</td>
    <td align="center" style="background: #B9C0C5; color: #000;">%</td>
  </tr>
  

  <!-- operasional -->
  <?php $totalop=0;$totalpdo=0; ?>
<?php foreach($operasional as $operasional): ?>

  <?php 
    $totalop    = $totalop+$operasional['nilai_op'];  
    $totalpdo   = $totalpdo+$operasional['nilai_pdo'];  
  ?> 

  <?php 

        if($operasional['nilai_op']==0){
          $persent_operasional=0;
        }else if($operasional['nilai_op']!=0 && $operasional['nilai_pdo']==0){
          $persent_operasional=0;
        }else{
          $persent_operasional=$operasional['nilai_pdo']/$operasional['nilai_op']*100;
        } 
      ?>

  <?php if($operasional['kd_item'] == '50401'): ?>
     
      <tr>
        
        <td>
          Gaji dan Tunjangan
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>

  <?php elseif ($operasional['kd_item'] == '50402'): ?>
      <tr>
       
        <td>
          Biaya Transportasi dan Kendaraan
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50403'): ?>
      <tr>
       
        <td>
          Biaya Pos, Pengiriman - Operasional
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50404'): ?>
      <tr>
       
        <td>
          Biaya Penyusutan
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50405'): ?>
      <tr>
        
        <td>
          Biaya Amortisasi
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50406'): ?>
      <tr>
        
        <td>
          Biaya Pelatihan & Rekreasi
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50407'): ?>
      <tr>
        
        <td>
            Jasa Profesional
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50408'): ?>
    <tr>
        
        <td>
            Biaya Rumah Tangga
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50409'): ?>
      <tr>
       
        <td>
            Biaya Operasional Lain-Lain
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50410'): ?>
      <tr>
        
        <td>
            Biaya Alat Tulis Kantor
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50411'): ?>
      <tr>
      
        <td>
            Biaya Sewa
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50412'): ?>
      <tr>
       
        <td>
            Biaya Perbaikan & Pemeliharaan
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50413'): ?>
      <tr>
       
        <td>  
            Biaya Asuransi
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50414'): ?>
      <tr>
        
        <td>
            Pajak & Denda Pajak
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50415'): ?>
      <tr>
        
        <td>
            Biaya Bank dan Bunga Pinjaman
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50416'): ?>
      <tr>
       
        <td>
            Biaya Administrasi dan Umum Lain-lain
        </td>
        <td align="right"><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
      <?php endif; ?>
    <?php endforeach; ?>

     
      <tr>
        
        <td>
          Biaya Marketing
        </td>
        <td align="right"><?= number_format($marketing['nilai_op'],2,',','.'); ?></td>
        <td align="right"><?= number_format($marketing['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>

      <?php 
        $sub_total_c  = ($marketing['nilai_op'])+($totalop);  
        $sub_total_ca = ($marketing['nilai_pdo'])+($totalpdo);
      ?>
      <tr>
        <td  align="center">
          Total Biaya
           <?php 

        if($sub_total_c==0){
          $persentotalc=0;
        }else if($sub_total_c!=0 && $sub_total_ca==0){
          $persentotalc=0;
        }else{
          $persentotalc=$sub_total_ca/$sub_total_c*100;
        } 
      ?>
        </td>
        <td align="right" style="background: #B9C0C5;color: #000;"><?= number_format($sub_total_c,2,',','.'); ?></td>
        <td align="right" style="background: #B9C0C5;color: #000;"><?= number_format($sub_total_ca,2,',','.'); ?></td>
        <td align="right" style="background: #B9C0C5;color: #000;"><?= number_format($persentotalc,2,',','.'); ?></td>
      </tr>

</table>