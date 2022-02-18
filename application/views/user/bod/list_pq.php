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
          <h3 class="card-title"><i class="fa fa-list"></i>List PQ Proyek</h3>
        </div>
      </div>
    </div>
    <div class="card">
   

            <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <!-- <th width="5%">#<?= trans('id') ?></th> -->
                      <th>Proyek</th>
                      <th>SPK</th>
                      <th>Titipan</th>
                      <th>PL</th>
                      <th>Pend. Nett</th>
                      <th width="10%">Nilai HPP</th>
                      <th width="3%"><?= trans('action') ?></th>
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
    "ajax": "<?=base_url('bod/datatable_json')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "kd_pqproyek", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "SPK", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "titipan", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "pl", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "sub_total_a", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>




