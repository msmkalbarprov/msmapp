<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

Informasi Pekerjaan :
<table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td colspan="4">
      Nama Pekerjaan
    </td>
    <?php foreach($proyek as $proyek): ?>
    <td colspan="2" align="center"><?= $proyek['thn_anggaran']; ?></td>
    <?php endforeach; ?>
  </tr>



  <tr>
    <td colspan="4">
      Provinsi/Kab/Kota
    </td>
    <?php foreach($proyek as $proyek): ?>
    <td colspan="2" align="center"><?= $proyek['nm_area']; ?></td>
    <?php endforeach; ?>
  </tr>

</table>