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
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; List Project Qualifying(PQ) Proyek</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->Check_operation_permission('add')): ?>


            <a href="<?= base_url('pq/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?= trans('pq_add') ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th width="5%">#<?= trans('id') ?></th>
              <th>Kode PQ</th>
              <th>Perusahaan</th>
              <th>Pekerjaan</th>
              <th>Status</th>
              <th>Nilai PQ</th>
              <th width="100" class="text-right"><?= trans('action') ?></th>
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
    "ajax": "<?=base_url('pq/datatable_json')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "perusahaan", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "pekerjaan", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "status", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>




