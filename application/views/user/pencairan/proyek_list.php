<!-- DataTables -->
<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">  -->

<style type="text/css">
    .green1 {
  background-color: #BFD834 !important;
}

   .green2 {
  background-color: #72CC50 !important;
}
   .green3 {
  background-color: #019875 !important;
}
.green5 {
  background-color: #00AEAD !important;
}
.green4 {
  background-color: #00A896 !important;
}

</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"> 
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
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; <?= trans('proyek_list') ?></h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->Check_operation_permission('add')): ?>
            <button class="btn btn-success btn-sm" id="button"><i class="fa fa-check"></i> Detail </button>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="display" style="width:100%">
          <thead>
            <tr>
              <th>No.</th>
              <th>Area</th>
              <th>Sub Area</th>
              <th>Proyek</th>
              <th>Paket Pekerjaan</th>
              <th>Pagu</th>
              <th>Nilai</th>
              <th width="5%" class="text-right"></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>  
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

<!-- <script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script> -->
<script>
  // $("#proyek").addClass('menu-open');
  $("#pencairan> a").addClass('active');
</script>
<script>
  
  //---------------------------------------------------
  // var table = $('#na_datatable').DataTable( {
  //   "processing": true,
  //   "serverSide": false,
  //   "ajax": "<?=base_url('proyek/datatable_json')?>",
  //   "order": [[0,'asc']],
  //   "columnDefs": [
  //   { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
  //   { "targets": 1, "name": "area", 'searchable':true, 'orderable':false},
  //   { "targets": 2, "name": "proyek", 'searchable':true, 'orderable':false},
  //   { "targets": 3, "name": "perusahaan", 'searchable':true, 'orderable':false},
  //   { "targets": 4, "name": "dinas", 'searchable':true, 'orderable':false},
  //   { "targets": 5, "name": "jnspagu", 'searchable':false, 'orderable':false},
  //   { "targets": 6, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
  //   ]
  // });




  /* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:100px;">'+
         '<tr>'+
            '<td><b>No</b></td>'+
            '<td>: '+d.kd_proyek+'</td>'+
             '<td><b>Proyek</b></td>'+
            '<td>: '+d.nm_jns_proyek+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td width="15%"><b>Area</b></td>'+
            '<td width="35%">: '+d.nm_area+'</td>'+
            '<td width="15%"><b>Sub Proyek</b></td>'+
            '<td width="35%">: '+d.nm_jns_sub_proyek+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Sub Area</b></td>'+
            '<td>: '+d.nm_sub_area+'</td>'+
             '<td><b>Nama Paket</b></td>'+
            '<td>: '+d.nm_paket_proyek+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Tahun Anggaran</b></td>'+
            '<td>: '+d.thn_anggaran+'</td>'+
             '<td><b>Perusahaan</b></td>'+
            '<td>: '+d.nm_perusahaan+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td><b>PPH</b></td>'+
            '<td>: '+d.jns_pph+'</td>'+
             '<td><b>Dinas</b></td>'+
            '<td>: '+d.nm_dinas+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td><b>Pagu</b></td>'+
            '<td>: '+d.nm_jns_pagu+'</td>'+
             '<td><b>LOC</b></td>'+
            '<td>: '+d.loc+' %</td>'+
        '</tr>'+
         '<tr>'+
            '<td><b>Nilai</b></td>'+
            '<td>: '+d.nilai+'</td>'+
             '<td><b>Catatan</b></td>'+
            '<td>: '+d.catatan+'</td>'+
        '</tr>'+
      
        
    '</table>';
}
 
$(document).ready(function() {
    var table = $('#na_datatable').DataTable( {
        "processing":   true,
        "serverSide":   false,
        "ajax"      : "<?=base_url('pencairan/datatable_json')?>",
        "order"     : [[0, 'asc']],
        "columns": [
            { "data": "row_num"  },
            { "data": "nm_area"  },
            { "data": "nm_sub_area"  },
            { "data": "nm_jns_proyek"},
            { "data": "nm_paket_proyek" },
            { "data": "nm_jns_pagu"},
            { "data": "nilai"},
            { "className" :  'dt-control', "orderable" : false, "data" : null, "defaultContent": ''},
        ],
    "createdRow": function( row, data, dataIndex ) {
        if ( data.status_cair == "1" ) {        
            $(row).addClass('green1');
        }else if ( data.status_cair == "2" ) {        
            $(row).addClass('green2');
        }else if ( data.status_cair == "3" ) {        
            $(row).addClass('green3');
        }else if ( data.status_cair >= 4 && data.status_cair <= 15){
            $(row).addClass('green4');
        }else if ( data.status_cair == "100" ){
            $(row).addClass('green5');
        }
    }
        
    } );



    // t.on( 'order.dt search.dt', function () {
    //     t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    //         cell.innerHTML = i+1;
    //     } );
    // } ).draw();
     
    // Add event listener for opening and closing details
    $('#na_datatable tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

    $('#na_datatable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('#button').click( function () {
    var id_proyek = table.rows('.selected').data()[0].id_proyek;
    window.location.href = "<?=base_url('pencairan/detail/')?>"+id_proyek;
    } );

    $('#button1').click( function () {
    var id_proyek = table.rows('.selected').data()[0].id_proyek;
    window.location.href = "<?=base_url('pencairan/batal/')?>"+id_proyek;
    } );


} );
</script>




