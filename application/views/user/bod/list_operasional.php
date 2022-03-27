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
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; </h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->Check_operation_permission('add')): ?>


            
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="card">
            <div class="card-body table-responsive">
                <table id="na_datatable3" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th width="2%">#<?= trans('id') ?></th>
                      <th width="10%">Kode</th>
                      <th width="63%">Area</th>
                      <th width="15%">Nilai</th>
                      <th width="10%" class="text-right"><?= trans('action') ?></th>
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
  




  var table = $('#na_datatable3').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('bod/datatable_json_pq_op')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "kode", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "nm_area", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>




