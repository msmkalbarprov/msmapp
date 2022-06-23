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
             SPJ Pegawai</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('spj_pegawai/add'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a> 
            <a href="#" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#largeModal"><i class="fa fa-print"></i> Cetak SPJ</a>
          </div>
        </div>
    </div>
    <div class="card">
            
            
            <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th width="5%">No.</th>
                      <th>No. SPJ</th>
                      <th>Area</th>
                      <th>Tanggal SPJ</th>
                      <th>Nama</th>
                      <th>Keterangan</th>
                      <th>Nilai</th>
                      <th width="10%"><?= trans('action') ?></th>
                    </tr>
                  </thead>
                </table>
              </div>


      
    </div>

    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Cetak SPJ</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                      <label for="item_hpp" class="control-label">Bulan</label>
                        <select name="bulan"  id="bulan" class="form-control" required>
                          <option value="">No Selected</option>
                          <option value="1">Januari</option>
                          <option value="2">Februari</option>
                          <option value="3">Maret</option>
                          <option value="4">April</option>
                          <option value="5">Mei</option>
                          <option value="6">Juni</option>
                          <option value="7">Juli</option>
                          <option value="8">Agustus</option>
                          <option value="9">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                        </select> 
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                      <label for="item_hpp" class="control-label">Tahun</label>
                        <select name="tahun"  id="tahun" class="form-control" required>
                          <option value="">No Selected</option>
                          <option value="<?= date("Y")-1; ?>"><?= date("Y")-1; ?></option>
                          <option value="<?= date("Y"); ?>"><?= date("Y"); ?></option>
                          <option value="<?= date("Y")+1; ?>"><?= date("Y")+1; ?></option>
                        </select> 
                </div>
            </div>
          </div>
          <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="kd_pegawai" class="control-label">Pegawai</label>
                      <select name="kd_pegawai"  id="kd_pegawai" class="form-control" required>
                        <option value="">No Selected</option>
                      </select> 

                  </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="area" class="control-label">Area</label>
                      <select name="area"  id="area" class="form-control" required>
                        <option value="">No Selected</option>
                      </select> 

                  </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            <button name="but_cetak" id="but_cetak"  class="btn btn-primary btn-sm"> cetak </button>
          </div>
        </div>
      </div>
    </div>


  </section>  
</div>



<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  // $("#proyek").addClass('menu-open');
  
</script>
<script>
  get_pegawai();
  $("#spj_pegawai").addClass('active');
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('spj_pegawai/datatable_json')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "no", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "no_spj", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "kd_area", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "tgl_spj", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "nama", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "keterangan", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 7, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });

  function get_pegawai() {
    $.ajax({
          url : "<?php echo site_url('spj_pegawai/get_pegawai_by_area_cetak');?>",
          method : "POST",
          data : {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
          async : true,
          dataType : 'json',
          success: function(data){
              $('select[name="kd_pegawai"]').empty();
              $('select[name="kd_pegawai"]').append('<option value="">No Selected</option>');
              $.each(data, function(key, value) {
                  $('select[name="kd_pegawai"]').append('<option value="'+ value.kd_pegawai +'">'+ value.nama +'</option>');
              });

          }
      });
}
$('#kd_pegawai').change(function(){ 
    var kd_pegawai = $(this).val();
  get_area_by_user(kd_pegawai);
});


function get_area_by_user(kd_pegawai) {
    $.ajax({
          url : "<?php echo site_url('spj_pegawai/get_area_by_user');?>",
          method : "POST",
          data : {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
            id:kd_pegawai},
          async : true,
          dataType : 'json',
          success: function(data){
              $('select[name="area"]').empty();
              $('select[name="area"]').append('<option value="">No Selected</option>');
              $.each(data, function(key, value) {
                  $('select[name="area"]').append('<option value="'+ value.kd_area +'">'+ value.nm_area +'</option>');
              });

          }
      });
}

$('#but_cetak').on('click', function() {
  var kd_pegawai        = $('#kd_pegawai').val();
  var bulan             = $('#bulan').val();
  var tahun             = $('#tahun').val();
  var area              = $('#area').val();

      var url = '<?= base_url() ?>'+'spj_pegawai/cetak_spj_pegawai/'+kd_pegawai+'/'+area+'/'+bulan+'/'+tahun+'/0/Laporan SPJ';   
    window.open(url, '_blank');

});

</script>




