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
            <h3 class="card-title">
             Pemindahbukuan</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('transfer_bud/add'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>  Tambah</a>
          </div>
        </div>
      <!-- /.box-body -->
      <div class="card-body">
         <?php $this->load->view('admin/includes/_messages.php') ?>
           <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th>#id</th>
                      <th>Rek. Asal</th>
                      <th>Rek. Tujuan</th>
                      <th>Tgl. Transfer</th>
                      <th>Keterangan</th>
                      <th>Nilai</th>
                      <th>Potongan</th>
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
  $("#transfer_bud> a").addClass('active');
</script>
<script type="text/javascript">


    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('transfer_bud/datatable_json/')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "rek_asal", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "rek_tujuab", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "tgl_transfer", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "keterangan", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
  </script>