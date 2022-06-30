<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-print"></i>
             Realisasi Proyek Per Area </h3>
           </div>
           <div class="d-inline-block float-right">
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>
         
         <div class="form-group">
          <div class="col-md-12" align="right">
            <button  name="submit" id="butcetak"  class="btn btn-dark btn-sm"><i class="fa fa-print"></i> Cetak</button>
            <button  name="submit" id="butexport"  class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Export</button>
          </div>
         </div>
         <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th>#id</th>
                      <th>Area</th>
                      <th>APBD</th>
                      <th>SPK</th>
                      <th>PDP</th>
                      <th>PDO</th>
                      <th>SPJ</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
           </div>
      </div>
      <!-- /.box-body -->
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script>
  // $("#proyek").addClass('menu-open');
  $("#laporan_realisasi_proyek> a").addClass('active');
</script>
<script>
  $(document).ready(function(){


    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('laporan_pq/datatable_json/')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "nm_area", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "apbd", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "spk", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "pdp", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "pdo", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "spj", 'searchable':true, 'orderable':false}
    ]
  });

    
$('#butcetak').on('click', function() {
    var url = '<?= base_url() ?>'+'laporan_pq/cetak_pq_pdo_spj_per_area/1/Laporan Realisasi Proyek';
    window.open(url, '_blank');
});

$('#butexport').on('click', function() {
      var url = '<?= base_url() ?>'+'laporan_pq/cetak_pq_pdo_spj_per_area/0/Laporan Realisasi Proyek'; 
    window.open(url, '_blank');
});

  }); 
</script>