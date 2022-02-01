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
             Rincian Proyek</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('proyek'); ?>" class="btn btn-primary"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <p><?= $proyek['nm_area']; ?></p>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="sub_area" class="control-label"><?= trans('sub_area') ?></label>
              <p><?= $proyek['nm_sub_area']; ?></p>
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="jenis_proyek" class="control-label"><?= trans('jenis_proyek') ?></label>
                <p><?= $proyek['nm_jns_proyek']; ?></p>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="jenis_sub_proyek" class="control-label"><?= trans('jenis_sub_proyek') ?></label>
              <p><?= $proyek['nm_jns_sub_proyek']; ?></p>
          </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="perusahaan" class="control-label"><?= trans('perusahaan') ?></label>
                <p><?= $proyek['nm_perusahaan']; ?></p>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="dinas" class="control-label"><?= trans('nm_dinas') ?></label>
              <p><?= $proyek['nm_dinas']; ?></p>
          </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="thn_ang" class="control-label">Tahun Anggaran</label>
                <p><?= $proyek['thn_anggaran']; ?></p>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            &nbsp;
          </div>
          </div>
         </div>

      </div>
      <div class="card-footer">
         <div class="row">
          <div class="col-md-12">
            <div class="card-body table-responsive">
              <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th>#id</th>
                    <th>jenis pagu</th>
                    <th>tipe proyek</th>
                    <th>tanggal</th>
                    <th>tanggal selesai</th>
                    <th>Nilai</th>
                    <th>no dokumen</th>
                    <th>Dokumen</th>
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
  <script>
  // $("#proyek").addClass('menu-open');
  $("#proyek> a").addClass('active');
</script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  // $("#proyek").addClass('menu-open');
  $("#proyek> a").addClass('active');
</script>
<script>
  
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('ProyekController/datatable_json_rincian/'.$proyek["id_proyek"])?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "nm_jns_pagu", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "tipe_proyek", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "no_dokumen", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "tanggal", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "tanggal2", 'searchable':false, 'orderable':false},
    { "targets": 6, "name": "nilai", 'searchable':false, 'orderable':false,'width':'100px'},
    { "targets": 7, "name": "dokumen", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>