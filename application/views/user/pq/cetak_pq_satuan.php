<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td style="background: black;color: white;border:solid black 1px;" colspan="4" width="20%">
      Informasi Pekerjaan :
    </td>
    <td colspan="2" style="background: black;color: white;border:solid black 1px;" width="80%">
    </td>
  </tr>
  <tr>
    <td colspan="4">
      Nama Pekerjaan
    </td>
    <td colspan="2" align="center"><?= $proyek['nm_paket_proyek']; ?></td>
  </tr>
  <tr>
    <td colspan="4">
      Tahun Anggaran
    </td>
    <td colspan="2" align="center"><?= $proyek['thn_anggaran']; ?></td>
  </tr>
  <tr>
    <td colspan="4">
      Provinsi/Kab/Kota
    </td>
    <td colspan="2" align="center"><?= $proyek['nm_area']; ?></td>
  </tr>
  <tr>
    <td colspan="4">
      Nama SKPD
    </td>
    <td colspan="2" align="center"><?= $proyek['nm_dinas']; ?></td>
  </tr>
  <tr>
    <td colspan="4">
      Nilai Pagu
    </td>
    <td colspan="2" align="center"><?= number_format($proyek['nilai_pagu'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="4">
      Nama Perusahaan
    </td>
    <td colspan="2" align="center"><?= $proyek['nm_perusahaan']; ?></td>
  </tr>
  <tr>
    <td colspan="4">
      Masa Kontrak
    </td>
    <td colspan="2" align="center"><?= $proyek['masa_kontrak']; ?> bulan</td>
  </tr>
  <tr>
    <td colspan="4">
      Lama Pekerjaan
    </td>
    <td colspan="2" align="center"><?= $proyek['lama_pekerjaan']; ?> bulan</td>
  </tr>
  <tr>
    <td colspan="4" align="center" style="background: black;color: white;border-right:white;">
      A. PENDAPATAN
    </td>
    <td align="center" style="background: black;border-right:white; color: white;">Rp</td>
    <td align="center" style="background: black;border-left:white;color: white;">%</td>
  </tr>
  <tr>
    <td colspan="6" >
      1. PENDAPATAN GROSS
    </td>
  </tr>
  <tr>
    <td width="3%">
      &nbsp;
    </td>
    <td colspan="3">
      Nilai SPK
    </td>
    <td align="right"><?= number_format($proyek['nilai_spk'],2,',','.'); ?></td>
    <td align="right"><?= number_format(100,2,',','.'); ?></td>
  </tr>

  <?php $ppn = $pqproyek['ppn']*-1; ?>

  <tr>
    <td width="3%">
      &nbsp;
    </td>
    <td colspan="3">
      PPN
    </td>
    <td align="right" style="color: red"><?= number_format($ppn,2,',','.'); ?></td>
    <td align="right"><?= number_format(11,2,',','.'); ?></td>
  </tr>

  <?php $pph = $pqproyek['pph']*-1; ?>

  <tr>
    <td width="3%">
      &nbsp;
    </td>
    <td colspan="3">
      PPh <?= $proyek['jns_pph'] ?>  
    </td>
    <td align="right" style="color: red"><?= number_format($pph,2,',','.'); ?></td>
    <td align="right"></td>
  </tr>
  <tr>
    <td width="3%">
      &nbsp;
    </td>
    <td colspan="3">
      Pajak Lainnya (Infaq, SP3)
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php $titipan = $pqproyek['titipan_net']*-1; ?>
  <tr>
    <td width="3%">
      &nbsp;
    </td>
    <td colspan="3">
      Potongan Pendapatan (Titipan)
    </td>
    <td align="right" style="color: red"><?= number_format($titipan,2,',','.'); ?></td>
    <td align="right"></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">
      2. PENDAPATAN NETT
    </td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($pqproyek['pendapatan_nett'],2,',','.'); ?></td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($pqproyek['pendapatan_nett']/$proyek['nilai_spk']*100,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">
      3. PL
    </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="3%">
      &nbsp;
    </td>
    <td colspan="3">
      Biaya Partner Lokal
    </td>
    <td align="right" style="color: red">
            <?php if($pqproyek['ppl']!=0 || $pqproyek['ppl']!=0.00): ?>
              <?php $nilai_pl = $pqproyek['ppl']*-1; ?>
              <?= number_format($nilai_pl,2,',','.'); ?>
            <?php else: ?>
              <?php $nilai_pl = $pqproyek['npl']*-1; ?>
              <?= number_format($nilai_pl,2,',','.'); ?>
            <?php endif; ?>
      </td>
    <td align="right"><?= number_format($pqproyek['persen_pl'],2,',','.'); ?></td>
  </tr>

<?php $sub_total_a=$pqproyek['sub_total_a']; ?>

  <tr>
    <td colspan="4" align="center">
      SUB TOTAL A
    </td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($sub_total_a,2,',','.'); ?></td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($sub_total_a/$proyek['nilai_spk']*100,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="6">
      &nbsp;
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="background: black;color: white;border-right:white;">
      B. BIAYA HPP PROJECT
    </td>
    <td colspan="2" style="background: black;border-right:white;border-left:white; color: white;" align="center">Keterangan</td>
    <td align="center" style="background: black;border-right:white; color: white;">Rp</td>
    <td align="center" style="background: black;border-left:white;color: white;">%</td>
  </tr>
  <?php $totalhpp=0; ?>
<?php foreach($hpp as $hpp): ?>

  <?php $totalhpp = $totalhpp+$hpp['nilai_hpp'];  ?> 
    
    <?php if($hpp['kd_item'] == '5010201'): ?>
      <tr>
          <td width="3%">
            a.
          </td>
          <td>
            HPP - Produk / HW / SW
          </td>
          <td colspan="2"><?= $hpp['keterangan'] ?></td>

          <td align="right" style="color: red"><?= number_format($hpp['nilai_hpp']*-1,2,',','.'); ?></td>
          <td align="right"><?= number_format($hpp['nilai_hpp']/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
        </tr>
        <?php elseif ($hpp['kd_item'] == '5010202'): ?>
          <tr>
              <td width="3%">
                b.
              </td>
              <td>
                HPP - Tenaga Kerja Langsung
              </td>
              <td colspan="2"><?= $hpp['keterangan'] ?></td>
              <td align="right" style="color: red"><?= number_format($hpp['nilai_hpp']*-1,2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['nilai_hpp']/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
            </tr>
          <?php elseif ($hpp['kd_item'] == '5010203'): ?>
          <tr>
              <td width="3%">
                c.
              </td>
              <td>
                HPP - Biaya Pengiriman/Angkut
              </td>
              <td colspan="2"><?= $hpp['keterangan'] ?></td>
              <td align="right" style="color: red"><?= number_format($hpp['nilai_hpp']*-1,2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['nilai_hpp']/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
            </tr>
        <?php elseif ($hpp['kd_item'] == '5010204'): ?>
          <tr>
              <td width="3%">
                d.
              </td>
              <td>
                HPP - Jasa Pihak Lain
              </td>
              <td colspan="2"><?= $hpp['keterangan'] ?></td>
              <td align="right" style="color: red"><?= number_format($hpp['nilai_hpp']*-1,2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['nilai_hpp']/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
            </tr>

      <?php elseif ($hpp['kd_item'] == '5010205'): ?>
          <tr>
              <td width="3%">
                e.
              </td>
              <td>
                HP Sistem - Transport dan Akomodasi Projek
              </td>
              <td colspan="2"><?= $hpp['keterangan'] ?></td>
              <td align="right" style="color: red"><?= number_format($hpp['nilai_hpp']*-1,2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['nilai_hpp']/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
            </tr>
          
      <?php else: ?>    
          <tr>
              <td width="3%">
                f.
              </td>
              <td>
                HP Sistem - Administrasi Projek
              </td>
              <td colspan="2"><?= $hpp['keterangan'] ?></td>
              <td align="right" style="color: red"><?= number_format($hpp['nilai_hpp']*-1,2,',','.'); ?></td>
              <td align="right"><?= number_format($hpp['nilai_hpp']/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
            </tr>
      <?php endif; ?>
    <?php endforeach; ?>

  <tr>
    <td colspan="4" align="center">
      SUB TOTAL B

      <?php $sub_total_b=$totalhpp*-1;?>
    </td>
    <td align="right" style="background: black;color: white;"><?= number_format($sub_total_b,2,',','.'); ?></td>
    <td align="right" style="background: black;color: white;"><?= number_format($sub_total_b/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="background: black;color: white;">
      C. BIAYA OPERASIONAL
    </td>
    <td style="background: black;border-right:white; color: white;" align="center">Keterangan</td>
    <td style="background: black;border-right:white; color: white;" align="center">HO Area</td>
    <td align="center" style="background: black;border-right:white; color: white;">Rp</td>
    <td align="center" style="background: black;border-left:white;color: white;">%</td>
  </tr>

  <!-- operasional -->
  <?php $totalop=0; ?>
<?php foreach($operasional as $operasional): ?>

  <?php $totalop = $totalop+$operasional['nilai_op'];  ?> 
  <?php if($operasional['kd_item'] == '50401'): ?>
      <tr>
        <td colspan="5">
          1. BIAYA MANAJEMEN 
        </td>
      </tr>
      <tr>
        <td width="3%" align="center">
          a.
        </td>
        <td>
          Gaji dan Tunjangan
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="6">
          2. BIAYA KANTOR 
        </td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50402'): ?>
      <tr>
        <td width="3%" align="center">
          a.
        </td>
        <td>
          Biaya Transportasi dan Kendaraan
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50403'): ?>
      <tr>
        <td width="3%" align="center">
          b.
        </td>
        <td>
          Biaya Pos, Pengiriman - Operasional
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50404'): ?>
      <tr>
        <td width="3%" align="center">
          c.
        </td>
        <td>
          Biaya Penyusutan
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50405'): ?>
      <tr>
        <td width="3%" align="center">
          d.
        </td>
        <td>
          Biaya Amortisasi
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50406'): ?>
      <tr>
        <td width="3%" align="center">
          e.
        </td>
        <td>
          Biaya Pelatihan & Rekreasi
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50407'): ?>
      <tr>
        <td width="3%" align="center">
          f.
        </td>
        <td>
            Jasa Profesional
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
<?php elseif ($operasional['kd_item'] == '50408'): ?>
    <tr>
        <td width="3%" align="center">
          g.
        </td>
        <td>
            Biaya Rumah Tangga
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50409'): ?>
      <tr>
        <td width="3%" align="center">
          h.
        </td>
        <td>
            Biaya Operasional Lain-Lain
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50410'): ?>
      <tr>
        <td width="3%" align="center">
          i.
        </td>
        <td>
            Biaya Alat Tulis Kantor
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50411'): ?>
      <tr>
        <td width="3%" align="center">
          j.
        </td>
        <td>
            Biaya Sewa
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50412'): ?>
      <tr>
        <td width="3%" align="center">
          k.
        </td>
        <td>
            Biaya Perbaikan & Pemeliharaan
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50413'): ?>
      <tr>
        <td width="3%" align="center">
          l.
        </td>
        <td>  
            Biaya Asuransi
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50414'): ?>
      <tr>
        <td width="3%" align="center">
          m.
        </td>
        <td>
            Pajak & Denda Pajak
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50415'): ?>
      <tr>
        <td width="3%" align="center">
          n.
        </td>
        <td>
            Biaya Bank dan Bunga Pinjaman
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <?php elseif ($operasional['kd_item'] == '50416'): ?>
      <tr>
        <td width="3%" align="center">
          o.
        </td>
        <td>
            Biaya Administrasi dan Umum Lain-lain
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($operasional['nilai_op']*-1,2,',','.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>

      <tr>
        <td colspan="6">&nbsp;</td>
      </tr>
      <?php endif; ?>
    <?php endforeach; ?>

      <tr>
        <td colspan="6">
          3. BIAYA MARKETING
        </td>
      </tr>
      <tr>
        <td width="3%" align="center">
          a.
        </td>
        <td>
          Biaya Marketing
        </td>
        <td>&nbsp;</td>
        <td align="right" style="color: red"><?= number_format($marketing['nilai_op']*-1,2,',','.'); ?></td>
        <td colspan="2">&nbsp;</td>
      </tr>

      <?php $sub_total_c = ($marketing['nilai_op']*-1)+($totalop*-1);  ?>
      <tr>
        <td colspan="3" align="center">
          SUB TOTAL C
        </td>
        <td align="right" style="background: black;color: white;border-right:white;"><?= number_format($sub_total_c,2,',','.'); ?></td>
        <td align="right" style="background: black;color: white;border-right:white;"></td>
        <td align="right" style="background: black;color: white;border-right:white;"></td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
      </tr>

      <?php $lr_operasional = $sub_total_a+$sub_total_b;  ?>
  <tr>
    <td colspan="4" align="center" style="background: black;color: white;">
      D.LABA RUGI OPERASIONAL
    </td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($lr_operasional,2,',','.'); ?></td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format(($lr_operasional)/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center" style="background: black;color: white;">
      E.MANAJEMEN HO 15%
    </td>
    <td align="right" style="background: black;border-right: white; color: white;"><?= number_format($pqproyek['nalokasi_ho']*-1,2,',','.'); ?></td>
    <td align="right" style="background: black;border-left: white; color: white;"><?= number_format(15,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>

  <?php $lr_setelah_ho = $lr_operasional+($pqproyek['nalokasi_ho']*-1);  ?>

  <tr>
    <td colspan="4" align="center" style="background: black;color: white;">
      F.LABA RUGI SETELAH HO
    </td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($lr_setelah_ho,2,',','.'); ?></td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($lr_setelah_ho/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
  </tr>
  
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>

  <?php $distribusi_ho_area_tiap_projek = ($pqproyek['pendapatan_nett']/$pendapatan_area['pendapatannetarea'])*$sub_total_c; ?>
  <tr>
    <td colspan="4" align="left" style="background: black;border-bottom: white;border-top: white;color: white;">
      Distribusi HO area ke tiap projek
    </td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($distribusi_ho_area_tiap_projek,2,',','.'); ?></td>
    <td align="right" style="background: black;border-right:white; color: white;"><?= number_format($distribusi_ho_area_tiap_projek/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
  </tr>

  <?php $tot_biaya_per_projek = $distribusi_ho_area_tiap_projek+($pqproyek['nalokasi_ho']*-1)+$sub_total_b+$nilai_pl; ?>

  <tr>
    <td colspan="4" align="left" style="background: black;border-bottom: white;color: white;">
      Total  Biaya Per Proyek
    </td>
    <td align="right" style="background: black;border-right:white;border-bottom:white;border-top: white; color: white;">
      <?= number_format($tot_biaya_per_projek,2,',','.'); ?>
    </td>
    <td align="right" style="background: black;border-right:white;border-bottom:white;border-top:white; color: white;"><?= number_format($tot_biaya_per_projek/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
  </tr>

  <tr>
    <td colspan="4" align="left" style="background: black;border-top: white;border-right: white;color: white;">
      Laba Rugi per Proyek (Setelah Distribusi HO Area)
    </td>
    <td align="right" style="background: black;border-right:white;border-bottom:white; color: white;">
      <?= number_format(($pqproyek['pendapatan_nett']+$tot_biaya_per_projek),2,',','.'); ?>
    </td>
    <td align="right" style="background: black;border-right:white;border-bottom:white;border-top:white; color: white;"><?= number_format(($pqproyek['pendapatan_nett']+$tot_biaya_per_projek )/$pqproyek['pendapatan_nett']*100,2,',','.'); ?></td>
  </tr>
</table>