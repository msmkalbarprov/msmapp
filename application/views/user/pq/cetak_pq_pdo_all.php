<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td colspan="2">
      Nama Area
    </td>
    <td colspan="2" align="center"><?= $header_operasional['nm_area']; ?></td>
  </tr>


  <!-- PROYEK -->
  <tr>
    <td colspan="4" >
      1. PENDAPATAN GROSS
    </td>
  </tr>
  <?php $ppn = $pqproyek['ppn']; ?>

  <tr>
    <td colspan="2">
      PPN
    </td>
    <td align="right" ><?= number_format($ppn,2,',','.'); ?></td>
    <td align="right" ><?= number_format($pencairan['ppn'],2,',','.'); ?></td>
  </tr>

  <?php $pph = $pqproyek['pph']; ?>

  <tr>
    <td colspan="2">
      PPh
    </td>
    <td align="right" ><?= number_format($pph,2,',','.'); ?></td>
    <td align="right" ><?= number_format($pencairan['pph'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="2">
      Pajak Lainnya (Infaq, SP3)
    </td>
    <td align="right"><?= number_format($pqproyek['infaq'],2,',','.'); ?></td>
    <td align="right"><?= number_format($pencairan['infaq'],2,',','.'); ?></td>
  </tr>
  <?php $titipan = $pqproyek['titip']; ?>
  <tr>
    <td colspan="2">
      Potongan Pendapatan (Titipan)
    </td>
    <td align="right" ><?= number_format($titipan,2,',','.'); ?></td>
    <td align="right"></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
<?php foreach($titip_pl as $titip_pl): ?>

  <?php if($titip_pl['no_acc'] == '5020501'): ?>
      <?php 
        $netto_pencairan  = $pencairan['netto']-$titip_pl['nilai']; 
        $nett             = $netto_pencairan;
      ?>
        <tr>
          <td colspan="2">
            2. PENDAPATAN NETT
          </td>
          <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($pqproyek['pendapatan_nett'],2,',','.'); ?></td>
          <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($nett ,2,',','.'); ?></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        
    
  <?php elseif ($titip_pl['no_acc'] == '5020101'): ?>
    <tr>
    <td colspan="2">
      3. PL
    </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
      Biaya Partner Lokal
    </td>
    <td align="right" >
              <?php $nilai_pl = $pqproyek['pl']; ?>
              <?= number_format($nilai_pl,2,',','.'); ?>
      </td>
    <td align="right"><?= number_format($titip_pl['nilai'],2,',','.'); ?></td>
  </tr>
  <?php $sub_total_a=$pqproyek['sub_total_a']; ?>

  <tr>
    <td colspan="2" align="center">
      Pendapatan Nett setelah PL
    </td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($sub_total_a,2,',','.'); ?></td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($nett-$titip_pl['nilai'],2,',','.'); ?></td>
  </tr>

  <?php endif; ?> 
<?php endforeach; ?>

  


  <tr>
    <td colspan="4">
      &nbsp;
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="background: black;color: white;border-right:white;">
      B. BIAYA HPP PROJECT
    </td>
    <td align="center" style="background: black;border-right:white; color: white;">Rp</td>
    <td align="center" style="background: black;border-left:white;color: white;">%</td>
  </tr>
  <?php 
    $totalhpp=0; 
    $totalhpp_pdo=0; 
  ?>
<?php foreach($hpp as $hpp): ?>

  <?php 
    $totalhpp = $totalhpp+$hpp['nilai_hpp'];  
    $totalhpp_pdo = $totalhpp_pdo+$hpp['pdo'];

  ?> 
    
    <?php if($hpp['kd_item'] == '5010201'): ?>
      <tr>
          <td width="3%">
            a.
          </td>
          <td>
            <?= $hpp['nama_map']; ?>
          </td>

          <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
          <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
        </tr>
        <?php elseif ($hpp['kd_item'] == '5010202' && $hpp['keterangan']==''): ?>
          <tr>
              <td width="3%">
                b.
              </td>
              <td>
                <?= $hpp['nama_map']; ?>
              </td>
              <td align="right" ></td>
              <td align="right"></td>
            </tr>
          <?php elseif ($hpp['kd_item'] == '5010202' && $hpp['keterangan']!=''): ?>
          <tr>
              <td width="3%">
                
              </td>
              <td>
                <?= $hpp['nama_map'] ?>
              </td>
              <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
            </tr>
          <?php elseif ($hpp['kd_item'] == '5010203'): ?>
          <tr>
              <td width="3%">
                c.
              </td>
              <td>
                HPP - Biaya Pengiriman/Angkut
              </td>
              <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
            </tr>
       <?php elseif ($hpp['kd_item'] == '5010204'): ?>
          <tr>
              <td width="3%">
                d.
              </td>
              <td>
                HPP - Jasa Pihak Lain
              </td>
              <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
            </tr>

      <?php elseif ($hpp['kd_item'] == '5010205'): ?>
          <tr>
              <td width="3%">
                e.
              </td>
              <td>
                HP Sistem - Transport dan Akomodasi Projek
              </td>
              <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
            </tr>
          
      <?php else: ?>    
          <tr>
              <td width="3%">
                f.
              </td>
              <td>
                HP Sistem - Administrasi Projek
              </td>
              <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
            </tr>
      <?php endif; ?> 
    <?php endforeach; ?>

  <tr>
    <td colspan="2" align="center">
      SUB TOTAL B

      <?php $sub_total_b=$totalhpp;?>
      <?php $sub_total_b_a=$totalhpp_pdo;?>
    </td>
    <td align="right" style="background: black;color: white;"><?= number_format($sub_total_b,2,',','.'); ?></td>
    <td align="right" style="background: black;color: white;"><?= number_format($sub_total_b_a,2,',','.'); ?></td>
  </tr>
  <!-- OPERASIONAL -->
  <tr>
    <td  align="center" style="background: black;color: white;border-right:white;" colspan="2">
    </td>
    <td align="center" style="background: black;border-right:white; color: white;">Nilai PQ</td>
    <td align="center" style="background: black;border-right:white; color: white;">Realisasi PDO</td>
  </tr>
  

  <!-- operasional -->
  <?php $totalop=0;$totalpdo=0; ?>
<?php foreach($operasional as $operasional): ?>

  <?php 
    $totalop    = $totalop+$operasional['nilai_op'];  
    $totalpdo   = $totalpdo+$operasional['nilai_pdo'];  
  ?> 
  <?php if($operasional['kd_item'] == '50401'): ?>
     
      <tr>
        
        <td colspan="2">
          Gaji dan Tunjangan
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>

  <?php elseif ($operasional['kd_item'] == '50402'): ?>
      <tr>
       
        <td colspan="2">
          Biaya Transportasi dan Kendaraan
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50403'): ?>
      <tr>
       
        <td colspan="2">
          Biaya Pos, Pengiriman - Operasional
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50404'): ?>
      <tr>
       
        <td colspan="2">
          Biaya Penyusutan
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50405'): ?>
      <tr>
        
        <td colspan="2">
          Biaya Amortisasi
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50406'): ?>
      <tr>
        
        <td colspan="2">
          Biaya Pelatihan & Rekreasi
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50407'): ?>
      <tr>
        
        <td colspan="2">
            Jasa Profesional
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50408'): ?>
    <tr>
        
        <td colspan="2">
            Biaya Rumah Tangga
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50409'): ?>
      <tr>
       
        <td colspan="2">
            Biaya Operasional Lain-Lain
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50410'): ?>
      <tr>
        
        <td colspan="2">
            Biaya Alat Tulis Kantor
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50411'): ?>
      <tr>
      
        <td colspan="2">
            Biaya Sewa
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50412'): ?>
      <tr>
       
        <td colspan="2">
            Biaya Perbaikan & Pemeliharaan
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50413'): ?>
      <tr>
       
        <td colspan="2">  
            Biaya Asuransi
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50414'): ?>
      <tr>
        
        <td colspan="2">
            Pajak & Denda Pajak
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50415'): ?>
      <tr>
        
        <td colspan="2">
            Biaya Bank dan Bunga Pinjaman
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50416'): ?>
      <tr>
       
        <td colspan="2">
            Biaya Administrasi dan Umum Lain-lain
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
      </tr>
      <?php endif; ?>
    <?php endforeach; ?>

     
      <tr>
        
        <td colspan="2">
          Biaya Marketing
        </td>
        <td align="right" ><?= number_format($marketing['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($marketing['nilai_pdo'],2,',','.'); ?></td>
      </tr>

      <?php 
        $sub_total_c  = ($marketing['nilai_op'])+($totalop);  
        $sub_total_ca = ($marketing['nilai_pdo'])+($totalpdo);
      ?>
      <tr>
        <td  align="center" colspan="2">
          Total Biaya
        </td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($sub_total_c,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($sub_total_ca,2,',','.'); ?></td>
      </tr>

</table>