<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td colspan="2">
      Nama Area
    </td>
    <td colspan="3" align="center"><?= $header_operasional['nm_area']; ?></td>
  </tr>


  <!-- PROYEK -->
  <tr>
    <td colspan="5" >
      1. PENDAPATAN GROSS
    </td>
  </tr>
  <?php $ppn = $pqproyek['ppn']; ?>
  <?php 
    if($ppn==0){
      $persenppn=0;
    }else if($ppn!=0 && $pencairan['ppn']==0){
      $persenppn=0;
    }else{
      $persenppn=$pencairan['ppn']/$ppn*100;
    } 
  ?>

  <tr>
    <td colspan="2">
      PPN
    </td>
    <td align="right" ><?= number_format($ppn,2,',','.'); ?></td>
    <td align="right" ><?= number_format($pencairan['ppn'],2,',','.'); ?></td>
    <td align="right" ><?= number_format($persenppn,2,',','.'); ?></td>
  </tr>

  <?php $pph = $pqproyek['pph']; ?>
  <?php 
    if($pph==0){
      $persenpph=0;
    }else if($pph!=0 && $pencairan['pph']==0){
      $persenpph=0;
    }else{
      $persenpph=$pencairan['pph']/$pph*100;
    } 
  ?>
  <tr>
    <td colspan="2">
      PPh
    </td>
    <td align="right" ><?= number_format($pph,2,',','.'); ?></td>
    <td align="right" ><?= number_format($pencairan['pph'],2,',','.'); ?></td>
    <td align="right" ><?= number_format($persenpph,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="2">
      Pajak Lainnya (Infaq, SP3)
      <?php 
    if($pqproyek['infaq']==0){
      $persen_infaq=0;
    }else if($pqproyek['infaq']!=0 && $pencairan['infaq']==0){
      $persen_infaq=0;
    }else{
      $persen_infaq=$pencairan['infaq']/$pqproyek['infaq']*100;
    } 
  ?>
    </td>
    <td align="right"><?= number_format($pqproyek['infaq'],2,',','.'); ?></td>
    <td align="right"><?= number_format($pencairan['infaq'],2,',','.'); ?></td>
    <td align="right"><?= number_format($persen_infaq,2,',','.'); ?></td>
  </tr>
  <?php $titipan = $pqproyek['titip']; ?>
  <tr>
    <td colspan="2">
      Potongan Pendapatan (Titipan)
    </td>
    <td align="right" ><?= number_format($titipan,2,',','.'); ?></td>
    <td align="right"></td>
    <td align="right"></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
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

            <?php 
            if($pqproyek['pendapatan_nett']==0){
              $persennett=0;
            }else if($pqproyek['pendapatan_nett']!=0 && $nett==0){
              $persennett=0;
            }else{
              $persennett=$nett/$pqproyek['pendapatan_nett']*100;
            } 
          ?>

          </td>
          <td align="right" style="background: #B9C0C5; color: #000;"><?= number_format($pqproyek['pendapatan_nett'],2,',','.'); ?></td>
          <td align="right" style="background: #B9C0C5; color: #000;"><?= number_format($nett ,2,',','.'); ?></td>
          <td align="right" style="background: #B9C0C5; color: #000;"><?= number_format($persennett ,2,',','.'); ?></td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>
        
    
  <?php elseif ($titip_pl['no_acc'] == '5020101'): ?>
    <tr>
    <td colspan="2">
      3. PL
    </td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
      Biaya Partner Lokal
    </td>
    <td align="right" >
              <?php $nilai_pl = $pqproyek['pl']; ?>
              <?= number_format($nilai_pl,2,',','.'); ?>
      </td>
    <?php 
        if($nilai_pl==0){
          $persenpl=0;
        }else if($nilai_pl!=0 && $titip_pl['nilai']==0){
          $persenpl=0;
        }else{
          $persenpl=$titip_pl['nilai']/$nilai_pl*100;
        } 
      ?>

    <td align="right"><?= number_format($titip_pl['nilai'],2,',','.'); ?></td>
    <td align="right"><?= number_format($persenpl,2,',','.'); ?></td>
  </tr>
  <?php $sub_total_a=$pqproyek['sub_total_a']; ?>

  <tr>
    <td colspan="2" align="center">
      Pendapatan Nett setelah PL
      <?php 
      $net_s_pl = $nett-$titip_pl['nilai'];

        if($sub_total_a==0){
          $persen_subtotala=0;
        }else if($sub_total_a!=0 && $net_s_pl==0){
          $persen_subtotala=0;
        }else{
          $persen_subtotala=$net_s_pl/$sub_total_a*100;
        } 
      ?>
    </td>
    <td align="right" style="background: #B9C0C5; color: #000;"><?= number_format($sub_total_a,2,',','.'); ?></td>
    <td align="right" style="background: #B9C0C5; color: #000;"><?= number_format($nett-$titip_pl['nilai'],2,',','.'); ?></td>
    <td align="right" style="background: #B9C0C5; color: #000;"><?= number_format($persen_subtotala,2,',','.'); ?></td>
  </tr>

  <?php endif; ?> 
<?php endforeach; ?>

  


  <tr>
    <td colspan="5">
      &nbsp;
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="background: #B9C0C5;color: #000;">
      B. BIAYA HPP PROJECT
    </td>
    <td colspan="3" align="center" style="background: #B9C0C5; color: #000;"></td>
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
          <?php 

                  if($hpp['nilai_hpp']==0){
                    $persen_hpp1=0;
                  }else if($hpp['nilai_hpp']!=0 && $hpp['pdo']==0){
                    $persen_hpp1=0;
                  }else{
                    $persen_hpp1=$hpp['pdo']/$hpp['nilai_hpp']*100;
                  } 
                ?>

          <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
          <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
          <td align="right"><?= number_format($persen_hpp1,2,',','.'); ?></td>
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
              <td align="right"></td>
            </tr>
          <?php elseif ($hpp['kd_item'] == '5010202' && $hpp['keterangan']!=''): ?>
          <tr>
              <td width="3%">
                
              </td>
              <td>
                <?= $hpp['nama_map'] ?>
              </td>
              <?php 

                  if($hpp['nilai_hpp']==0){
                    $persen_hpp2=0;
                  }else if($hpp['nilai_hpp']!=0 && $hpp['pdo']==0){
                    $persen_hpp2=0;
                  }else{
                    $persen_hpp2=$hpp['pdo']/$hpp['nilai_hpp']*100;
                  } 
                ?>
              <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
              <td align="right"><?= number_format($persen_hpp2,2,',','.'); ?></td>
            </tr>
          <?php elseif ($hpp['kd_item'] == '5010203'): ?>
          <tr>
              <td width="3%">
                c.
              </td>
              <td>
                HPP - Biaya Pengiriman/Angkut
              </td>
              <?php 

                  if($hpp['nilai_hpp']==0){
                    $persen_hpp3=0;
                  }else if($hpp['nilai_hpp']!=0 && $hpp['pdo']==0){
                    $persen_hpp3=0;
                  }else{
                    $persen_hpp3=$hpp['pdo']/$hpp['nilai_hpp']*100;
                  } 
                ?>
              <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
              <td align="right"><?= number_format($persen_hpp3,2,',','.'); ?></td>
            </tr>
       <?php elseif ($hpp['kd_item'] == '5010204'): ?>
          <tr>
              <td width="3%">
                d.
              </td>
              <td>
                HPP - Jasa Pihak Lain
              </td>
              <?php 

                  if($hpp['nilai_hpp']==0){
                    $persen_hpp4=0;
                  }else if($hpp['nilai_hpp']!=0 && $hpp['pdo']==0){
                    $persen_hpp4=0;
                  }else{
                    $persen_hpp4=$hpp['pdo']/$hpp['nilai_hpp']*100;
                  } 
                ?>
              <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
              <td align="right"><?= number_format($persen_hpp4,2,',','.'); ?></td>
            </tr>

      <?php elseif ($hpp['kd_item'] == '5010205'): ?>
          <tr>
              <td width="3%">
                e.
              </td>
              <td>
                HP Sistem - Transport dan Akomodasi Projek
              </td>
              <?php 

                  if($hpp['nilai_hpp']==0){
                    $persen_hpp5=0;
                  }else if($hpp['nilai_hpp']!=0 && $hpp['pdo']==0){
                    $persen_hpp5=0;
                  }else{
                    $persen_hpp5=$hpp['pdo']/$hpp['nilai_hpp']*100;
                  } 
                ?>
              <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
              <td align="right"><?= number_format($persen_hpp5,2,',','.'); ?></td>
            </tr>
          
      <?php else: ?>    
          <tr>
              <td width="3%">
                f.
              </td>
              <td>
                HP Sistem - Administrasi Projek
              </td>
              <?php 

                  if($hpp['nilai_hpp']==0){
                    $persen_hpp6=0;
                  }else if($hpp['nilai_hpp']!=0 && $hpp['pdo']==0){
                    $persen_hpp6=0;
                  }else{
                    $persen_hpp6=$hpp['pdo']/$hpp['nilai_hpp']*100;
                  } 
                ?>
              <td align="right" ><?= number_format($hpp['nilai_hpp'],2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['pdo'],2,',','.'); ?></td>
              <td align="right"><?= number_format($persen_hpp6,2,',','.'); ?></td>
            </tr>
      <?php endif; ?> 
    <?php endforeach; ?>

  <tr>
    <td colspan="2" align="center">
      SUB TOTAL B

      <?php $sub_total_b=$totalhpp;?>
      <?php $sub_total_b_a=$totalhpp_pdo;?>

      <?php 

        if($sub_total_b==0){
          $persentotal=0;
        }else if($sub_total_b!=0 && $sub_total_b_a==0){
          $persentotal=0;
        }else{
          $persentotal=$sub_total_b_a/$sub_total_b*100;
        } 
      ?>


    </td>
    <td align="right" style="background: #B9C0C5;color: #000;"><?= number_format($sub_total_b,2,',','.'); ?></td>
    <td align="right" style="background: #B9C0C5;color: #000;"><?= number_format($sub_total_b_a,2,',','.'); ?></td>
    <td align="right" style="background: #B9C0C5;color: #000;"><?= number_format($persentotal,2,',','.'); ?></td>
  </tr>
  <!-- OPERASIONAL -->
  <tr>
    <td  align="center" style="background: #B9C0C5;color: #000;" colspan="2">C. OPERASIONAL
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
        
        <td colspan="2">
          Gaji dan Tunjangan
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>

  <?php elseif ($operasional['kd_item'] == '50402'): ?>
      <tr>
       
        <td colspan="2">
          Biaya Transportasi dan Kendaraan
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50403'): ?>
      <tr>
       
        <td colspan="2">
          Biaya Pos, Pengiriman - Operasional
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50404'): ?>
      <tr>
       
        <td colspan="2">
          Biaya Penyusutan
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50405'): ?>
      <tr>
        
        <td colspan="2">
          Biaya Amortisasi
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50406'): ?>
      <tr>
        
        <td colspan="2">
          Biaya Pelatihan & Rekreasi
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50407'): ?>
      <tr>
        
        <td colspan="2">
            Jasa Profesional
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50408'): ?>
    <tr>
        
        <td colspan="2">
            Biaya Rumah Tangga
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50409'): ?>
      <tr>
       
        <td colspan="2">
            Biaya Operasional Lain-Lain
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50410'): ?>
      <tr>
        
        <td colspan="2">
            Biaya Alat Tulis Kantor
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50411'): ?>
      <tr>
      
        <td colspan="2">
            Biaya Sewa
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50412'): ?>
      <tr>
       
        <td colspan="2">
            Biaya Perbaikan & Pemeliharaan
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50413'): ?>
      <tr>
       
        <td colspan="2">  
            Biaya Asuransi
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50414'): ?>
      <tr>
        
        <td colspan="2">
            Pajak & Denda Pajak
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50415'): ?>
      <tr>
        
        <td colspan="2">
            Biaya Bank dan Bunga Pinjaman
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50416'): ?>
      <tr>
       
        <td colspan="2">
            Biaya Administrasi dan Umum Lain-lain
        </td>
        <td align="right" ><?= number_format($operasional['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($operasional['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>
      <?php endif; ?>
    <?php endforeach; ?>

     
      <tr>
        
        <td colspan="2">
          Biaya Marketing
        </td>
        <td align="right" ><?= number_format($marketing['nilai_op'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($marketing['nilai_pdo'],2,',','.'); ?></td>
        <td align="right" ><?= number_format($persent_operasional,2,',','.'); ?></td>
      </tr>

      <?php 
        $sub_total_c  = ($marketing['nilai_op'])+($totalop);  
        $sub_total_ca = ($marketing['nilai_pdo'])+($totalpdo);
      ?>
      <tr>
        <td  align="center" colspan="2">
          Total Biaya
        </td>
        <?php 

        if($sub_total_c==0){
          $persentotalc=0;
        }else if($sub_total_c!=0 && $sub_total_ca==0){
          $persentotalc=0;
        }else{
          $persentotalc=$sub_total_ca/$sub_total_c*100;
        } 
      ?>

        <td align="right" style="background: #B9C0C5;color: #000;"><?= number_format($sub_total_c,2,',','.'); ?></td>
        <td align="right" style="background: #B9C0C5;color: #000;"><?= number_format($sub_total_ca,2,',','.'); ?></td>
        <td align="right" style="background: #B9C0C5;color: #000;"><?= number_format($persentotalc,2,',','.'); ?></td>
      </tr>

</table>