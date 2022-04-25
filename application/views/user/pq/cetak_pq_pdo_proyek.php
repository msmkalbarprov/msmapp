<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td colspan="2">
      Nama Pekerjaan
    </td>
    <td colspan="2" align="center"><?= $proyek['nm_paket_proyek']; ?></td>
  </tr>
  <tr>
    <td colspan="2">
      Nilai Pagu
    </td>
    <td colspan="2" align="center"><?= number_format($proyek['nilai_pagu'],2,',','.'); ?></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" style="background: black;color: white;border-right:white;">
    </td>
    <td align="center" style="background: black;border-right:white; color: white;">Nilai PQ</td>
    <td align="center" style="background: black;border-left:white;color: white;">Realisasi PDO</td>
  </tr>
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
      PPh <?= $proyek['jns_pph'] ?>  
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
  <?php $titipan = $pqproyek['titipan_net']; ?>
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
            <?php if($pqproyek['ppl']!=0 || $pqproyek['ppl']!=0.00): ?>
              <?php $nilai_pl = $pqproyek['ppl']; ?>
              <?= number_format($nilai_pl,2,',','.'); ?>
            <?php else: ?>
              <?php $nilai_pl = $pqproyek['npl']; ?>
              <?= number_format($nilai_pl,2,',','.'); ?>
            <?php endif; ?>
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

</table>