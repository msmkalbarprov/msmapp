  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

    <style>
        .loader {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: inline-block;
  border-top: 4px solid #000;
  border-right: 4px solid transparent;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}
.loader::after {
  content: '';  
  box-sizing: border-box;
  position: absolute;
  left: 0;
  top: 0;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  border-left: 4px solid #FF3D00;
  border-bottom: 4px solid transparent;
  animation: rotation 0.5s linear infinite reverse;
}
@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
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
             Posting Jurnal Transaksi</h3>
           </div>
           <div class="d-inline-block float-right">
          </div>
        </div>
      <!-- /.box-body -->
    </div>
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <?php echo form_open(base_url('posting/posting/'), 'class="form-horizontal" id="myform"' )?> 
           <div class="row">
           <div class="col-md-3">
                &nbsp;
           </div>
            <div class="col-md-6">
              <div class="card-body table-responsive">
                    <div class="input-group ">
                        <input type="text" class="form-control" id="lastupdate" name="lastupdate" value="Posting jurnal terakhir pada <?= $data_posting['posting_jurnal']; ?>" placeholder="last Update" aria-label="last Update" aria-describedby="basic-addon2" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit" id="submit">Posting</button>
                        </div>
                    </div>
              </div>
            </div>
            <div class="col-md-3">
                &nbsp;
           </div>
           </div>
           <?php echo form_close(); ?>

  </section> 
  <div align="center" id="spinner">
    <span class="loader"></span>    
    <p>Proses posting jurnal .... </p>          
    </div>
  

</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script>
  // $("#proyek").addClass('menu-open');
  $("#dinas> a").addClass('active');
</script>
<script type="text/javascript">
    $('#spinner').hide();
    $('#myform').on('submit', function(ev) {
        $('#spinner').show();
    });
  </script>