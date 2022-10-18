<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
<style type="text/css">
  .select2-container .select2-selection {
    height: 37px; 
  }

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
             Jurnal Umum</h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('jurnal/add'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a> 
            <!-- <a href="#" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#largeModal"><i class="fa fa-print"></i> Cetak SPJ</a> -->
          </div>
        </div>
    </div>
    <div class="card">
            
            
            <div class="card-body table-responsive">
                <table id="jurnal_umum" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th width="5%">No.</th>
                      <th>No. Voucher</th>
                      <th>Tanggal Voucher</th>
                      <th>Area</th>
                      <th>Keterangan</th>
                      <th>Debet</th>
                      <th>Kredit</th>
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
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<script>
  // $("#proyek").addClass('menu-open');
  
</script>
<script>
  $('.select2').select2()
  get_pegawai();
  $("#jurnal").addClass('active');
  //---------------------------------------------------
  var table = $('#jurnal_umum').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('jurnal/datatable_json')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "no", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "no_voucher", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "tgl_voucher", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "kd_area", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "keterangan", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "debet", 'searchable':false, 'orderable':false},
    { "targets": 5, "name": "kredit", 'searchable':false, 'orderable':false},
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


      $.ajax({
          url : "<?php echo site_url('spj_pegawai/get_ttd');?>",
          method : "POST",
          data : {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
          async : true,
          dataType : 'json',
          success: function(data){
              $('select[name="ttd_spj"]').empty();
              $('select[name="ttd_spj"]').append('<option value="">No Selected</option>');
              $.each(data, function(key, value) {
                  $('select[name="ttd_spj"]').append('<option value="'+ value.nama +'">'+ value.nama +'</option>');
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
  var ttd                = $('#ttd_spj').val();

  alert(ttd);

      var url = '<?= base_url() ?>'+'spj_pegawai/cetak_spj_pegawai/'+kd_pegawai+'/'+area+'/'+bulan+'/'+tahun+'/'+ttd+'/0/Laporan SPJ';   
    window.open(url, '_blank');

});

</script>




