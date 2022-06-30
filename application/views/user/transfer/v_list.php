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
            List Validasi Transfer Dana Pencairan</h3>
           </div>
           <div class="d-inline-block float-right">
          </div>
        </div>
    </div>
    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>

        <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
    <div class="card">
            
            
            <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th width="5%">No.</th>
                      <th>No Transfer</th>
                      <th>Tanggal Transfer</th>
                      <th>Area</th>
                      <th>Keterangan</th>
                      <th>Bruto</th>
                      <th>Potongan</th>
                      <th>Netto</th>
                      <th width="10%"><?= trans('action') ?></th>
                    </tr>
                  </thead>
                </table>
              </div>


      
    </div>


    <div class="modal fade bd-example-modal-sm" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                 <h3 class="modal-title">Validasi PDP</h3>
 
            </div>
            <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label for="dinas" class="control-label">No. transfer</label>
                        <input type="text" name="no_transfer" id="no_transfer" class="form-control"  readonly >
                    </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label for="dinas" class="control-label">Tanggal Validasi <small>(sesuai rekening koran)</small></label>
                        <input type="date" name="tgl_validasi" id="tgl_validasi" class="form-control"  >
                    </div>
                    </div>
                 </div>
 
            </div>
            <div class="modal-footer">
                <button name="butsave" id="butsave"  class="btn btn-success btn-sm"> Validasi </button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


  </section>  
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  // $("#proyek").addClass('menu-open');
  $("#transfer").addClass('active');
</script>
<script>
  
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('v_transfer/datatable_json')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "no", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "kode_pdo", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "area", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "tgl_pdo", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "bruto", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "potongan", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "netto", 'searchable':true, 'orderable':false},
    { "targets": 7, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });

  $('#na_datatable').on('click', '.btnvalidasi', function() {
    notransfer = $(this).data('notransfer')

    $('#no_transfer').val(notransfer);

        $('#largeModal').modal("show");
  });


  
    // SAVE
$('#butsave').on('click', function() {
    var no_transfer        = $('#no_transfer').val();
    var tgl_validasi       = $('#tgl_validasi').val();
    
   
    if(tgl_validasi==""){
      alert('Tanggal tidak boleh kosong')
      return;
    }
  
    if(no_transfer==""){
      alert('Nomor Transfer tidak boleh kosong')
      return;
    }

      
      $.ajax({
        url: "<?php echo base_url("v_transfer/validasi/");?>",
        type: "POST",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          no_transfer:no_transfer,
          tgl_validasi:tgl_validasi

        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            document.getElementById("tgl_validasi").value = '';
            document.getElementById("no_transfer").value='';
            $('#largeModal').modal('toggle');
            $("#error").hide();
            // $("#success").show();
            // $('#error').html('Berhasil di validasi');
            alert('berhasil divalidasi');
            location.reload();
          }
          else if(dataResult.statusCode==201){
            // $("#error").show();
            $("#success").hide();
            alert('Gagal divalidasi');
            // $('#error').html('Gagal validasi');
          }
        }
      });
    
  });

</script>




