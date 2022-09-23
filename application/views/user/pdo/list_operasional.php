<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<style type="text/css">
 .tabs {
    display: inline-block;
    margin-left: 40px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>

    <div class="card">
      <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-list"></i>
             PDO Operasional </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('cpdo/add_operasional'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>  
          </div>
        </div>
    </div>
    <div class="card">
            
            
            <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th width="5%">No.</th>
                      <th>Kode</th>
                      <th>Area</th>
                      <th>Tanggal PDO</th>
                      <th>Keterangan</th>
                      <th>Nilai</th>
                      <th width="10%"><?= trans('action') ?></th>
                    </tr>
                  </thead>
                </table>
              </div>


      
    </div>
  </section>  
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  // $("#proyek").addClass('menu-open');
  $("#pq").addClass('active');
</script>
<script>
  
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('cpdo/datatable_json_operasional')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "no", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "kode_pdo", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "area", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "tgl_pdo", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "keterangan", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>




