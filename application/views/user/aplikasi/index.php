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
            <h3 class="card-title"> <i class="fa fa-list"></i>
             List Dinas </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('aplikasi/add'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>  Tambah</a>
          </div>
        </div>
      <!-- /.box-body -->
    </div>
    <div class="card card-default">
      <div class="card-body">
         <?php $this->load->view('admin/includes/_messages.php') ?>
           <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th>Kode Sub Proyek</th>
                      <th>Nama Sub Proyek</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
           </div>
      </div>
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script>
  // $("#proyek").addClass('menu-open');
  $("#aplikasi> a").addClass('active');
</script>
<script type="text/javascript">


    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('aplikasi/datatable_json/')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "kode", 'searchable':true, 'orderable':false},
    { "targets": 1, "name": "nama", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
  </script>