<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<table border="0" width="100%">
  <tr>
    <td colspan="4" style="text-align:center"><h3>PT. MURFA SURYA MAHARDIKA<br>(BUKU BESAR)</h3></td>
  </tr>
  <tr>
    <td colspan="4" style="text-align:center">&nbsp;</td>
  </tr>
<?php if($area['kd_area'] != 0): ?>
    <tr>
        <td width="10%" style="text-align:left"><b>Area</b></td>
        <td width="2%" style="text-align:left"><b>:</b></td>
        <td colspan="2" width="88%" style="text-align:left"><b><?= $area['kd_area'].' - '.$area['nm_area']; ?></b></td>
  </tr>
<?php endif; ?>
  <tr>
    <td width="10%" style="text-align:left"><b>Periode</b></td>
    <td width="2%" style="text-align:left"><b>:</b></td>
    <td colspan="2" width="88%" style="text-align:left"><b><?= $bulan.' '.$tahun; ?></b></td>
  </tr>
</table>
<?php foreach($list_acc as $list_akun): ?>
    <p>
        <?= $list_akun->no_acc .' - '.$list_akun->nm_acc ; ?>
    </p>
    <table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;font-size: 12px;" cellspacing="2" cellpadding="3">
    <thead>
        <tr style="background: #CACACA;">
                <th align="center" width="5%"><b>No.</th>
                <th align="center" width="15%"><b>Nomor</b> </th>
                <th align="center" width="5%"><b>Tanggal</b></th>
                <th align="center" width="10%"><b>Area</b></th>
                <th align="center" width="10%"><b>Sub Area</b></th>
                <th align="center" width="10%"><b>Kode Project</b></th>
                <th align="center" width="5%"><b>Kode Divisi</b></th>
                <th align="center" width="25%"><b>uraian</b></th>
                <th align="center" width="10%"><b>Kredit</b></th>
                <th align="center" width="10%"><b>debet</b></th>
                
        </tr>
        </thead>
    <?php 
        $i=0;
        foreach($list as $listjurnal): ?>
        
        <?php if($list_akun->no_acc == $listjurnal->no_acc): ?>
            <tr>
                <td style="font-size:10px ;" align="center"><?= ++$i; ?></td>
                <td style="font-size:10px ;"><?= $listjurnal->no_voucher; ?></td>
                <td style="font-size:10px ;"><?= $listjurnal->tgl_voucher; ?></td>
                <td style="font-size:10px ;"><?= $listjurnal->kd_area; ?> - <?= $listjurnal->nm_area; ?></td>
                <td style="font-size:10px ;"><?= $listjurnal->subarea; ?></td>
                <td style="font-size:10px ;" align="center"><?= $listjurnal->kd_project; ?></td>
                <td style="font-size:10px ;" align="center"><?= $listjurnal->kd_divisi; ?></td>
                <td style="font-size:10px ;"><?= $listjurnal->uraian; ?></td>
                <td style="font-size:10px ;" align="right" ><?= number_format($listjurnal->kredit,2,',','.'); ?></td>
                <td style="font-size:10px ;" align="right" ><?= number_format($listjurnal->debet,2,',','.'); ?></td>
            </tr>
        <?php endif; ?>    
    <?php endforeach; ?>        
    </table>
<?php endforeach; ?>
<!-- <table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;font-size: 12px;" cellspacing="2" cellpadding="3">
<thead>
  <tr style="background: #CACACA;">
        <th align="center" width="5%"><b>No.</th>
        <th align="center" width="15%"><b>Nomor</b> </th>
        <th align="center" width="10%"><b>Tanggal</b></th>
        <th align="center" width="10%"><b>Area</b></th>
        <th align="center" width="15%"><b>Akun</b></th>
        <th align="center" width="25%"><b>Uraian</b></th>
        <th align="center" width="10%"><b>Kredit</b></th>
        <th align="center" width="10%"><b>debet</b></th>
        
  </tr>
</thead>

  <?php 
      $terima = 0;
      $keluar   = 0;
      $i=0;
  ?>
  
<?php foreach($list as $list): ?>
          
    
          
        
<?php endforeach; ?>
</table> -->