  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
    <style type="text/css">
.select2-container .select2-selection {
  height: 37px; 
}
    </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-list"></i>
             List PQ Operasional </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pq'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  kembali</a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <?php $this->load->view('admin/includes/_messages.php') ?>
         
    
      
      <!-- datatable -->
      
        <div class="col-md-12">
          <div class="card-body table-responsive">
            <table id="na_datatable" class="table table-bordered table-striped" width="100%">
              <thead>
                <tr>
                  <th>#No</th>
                  <th>Kode PQ Operasional</th>
                  <th>Proyek</th>
                  <th>Item</th>
                  <th>Uraian</th>
                  <th>Volume</th>
                  <th>Satuan</th>
                  <th>Harga</th>
                  <th>Total</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
       


      </div>
      <!-- /.box-body -->
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script>
  $("#pq> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    $('.select2').select2()

    var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('pq/datatable_json_operasional_view/').$this->uri->segment(3);?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "kd_item", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "nm_paket_proyek", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "nm_item", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "uraian", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "volume", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "satuan", 'searchable':true, 'orderable':false},
    { "targets": 7, "name": "harga", 'searchable':true, 'orderable':false},
    { "targets": 8, "name": "total", 'searchable':true, 'orderable':false}
    ]
  });





    // SAVE
$('#butsave').on('click', function() {
    var kd_proyek     = $('#projek').val();
    var kd_item       = $('#item_op').val();
    var uraian        = $('#uraian').val();
    var volume        = $('#volume').val();
    var satuan        = $('#satuan').val();
    var harga         = number($('#harga').val());
    var total         = number($('#total').val());
    var area          = $('#area').val();

    
    if(kd_item!="" && volume!="" && harga!="" && total!="" && area!=""){
      $("#butsave").attr("disabled", "disabled");
      $.ajax({
        url: "<?php echo base_url("pq/add_operasional");?>",
        type: "POST",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          type:1,
          area:area,
          kd_proyek:kd_proyek,
          kd_item :kd_item,
          uraian:uraian,
          volume:volume,
          satuan:satuan,
          harga:harga,
          total:total
        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            $("#butsave").removeAttr("disabled");
            $('#fupForm').find('input:text').val('');
            $("#success").show();
            $('#success').html('Data Berhasil ditambahkan !'); 
            $('#na_datatable').DataTable().ajax.reload();
            reset();
          }
          else if(dataResult.statusCode==201){
             alert("Error !");
          }
          
        }
      });
    }
    else{
      alert('Please fill all the field !');
    }
  });

  }); 

function reset(){
    $('input[name="uraian"]').val('')
    $('input[name="volume"]').val('')
    $('input[name="satuan"]').val('')
    $('input[name="harga"]').val(0)
    $('input[name="total"]').val(0)
    $('input[name="area"]').val('')
  }

document.getElementById("volume").onmouseup = function() {hitung_total()};
document.getElementById("volume").onkeyup   = function() {hitung_total()};

document.getElementById("harga").onkeyup   = function() {hitung_total()};

function hitung_total() {
  var harga     = number(document.getElementById("harga").value);
  var volume    = number(document.getElementById("volume").value);
  let totalrow = 0;

  totalrow = harga*volume;
  $('[name="total"]').val(number_format(totalrow,"2",",",".")).trigger('change');
}



</script>