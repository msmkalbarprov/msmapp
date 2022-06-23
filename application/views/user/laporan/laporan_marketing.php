  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-print"></i>
             Laporan Marketing </h3>
           </div>
           <div class="d-inline-block float-right">
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label"><?= trans('area') ?></label>
                <select name="area" id ="area" class="form-control" required>
                <option value="">No Selected</option>
                <?php foreach($data_area as $area): ?>
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="area" class="control-label">Filter I</label>
                <select name="filter" id ="filter" class="form-control" required>
                  <option value="">No Selected</option>
                  <option value="none">Tanpa filter</option>
                  <option value="subproyek">Sub Proyek</option>
                  <option value="perusahaan">Perusahaan</option>
                </select>

            </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="filter2" class="control-label">Filter II</label>
                <select name="filter2" id ="filter2" class="form-control" required>
                  <option value="">No Selected</option>
                </select>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="thn_ang" class="control-label">Tahun Anggaran</label>
                <select name="thn_ang" id="thn_ang" class="form-control" required>
                  <option value="">No Selected</option>
                  <option value="<?= date('Y')-1;?>"><?= date('Y')-1;?></option>
                  <option value="<?= date('Y')?>"><?= date('Y')?></option>
                  <option value="<?= date('Y')+1;?>"><?= date('Y')+1;?></option>
                </select>
            </div>
          </div>
         </div>


        <div class="form-group">
          <div class="col-md-12" align="center">
            <button  name="submit" id="butcetak"   class="btn btn-primary btn-sm"><i class="fa fa-television"></i> Cetak</button>
            <button  name="submit" id="butexport"   class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Export</button>
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
  $("#laporan_marketing> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    
$('#butcetak').on('click', function() {
  var area    = document.getElementById("area").value;
    var tahun   = document.getElementById("thn_ang").value;
    var filter  = document.getElementById("filter").value;
    var filter2 = document.getElementById("filter2").value;
    if(tahun==''){
      alert('Silahkan pilih tahun anggaran')
      return
    }
    if(filter==''){
      alert('Silahkan pilih filter I')
      return
    }

    var url = '<?= base_url() ?>'+'laporan_marketing/cetak_marketing/'+area+'/'+tahun+'/1/'+filter+'/'+filter2+'/Laporan Marketing'; 
    window.open(url, '_blank');
});

$('#butexport').on('click', function() {
    var area    = document.getElementById("area").value;
    var tahun   = document.getElementById("thn_ang").value;
    var filter  = document.getElementById("filter").value;
    var filter2 = document.getElementById("filter2").value;
    if(tahun==''){
      alert('Silahkan pilih tahun anggaran')
      return
    }
    if(filter==''){
      alert('Silahkan pilih filter I')
      return
    }
      var url = '<?= base_url() ?>'+'laporan_marketing/cetak_marketing/'+area+'/'+tahun+'/0/'+filter+'/'+filter2+'/Laporan Marketing'; 
    
    window.open(url, '_blank');
});

$('#filter2').change(function(){ 
  var filter2 = $(this).val();
  if (filter2=='none'){
    document.getElementById("butcetak").disabled=true;
    document.getElementById("butexport").disabled=true;
  }else{
    document.getElementById("butcetak").disabled=false;
    document.getElementById("butexport").disabled=false;
  }
});

$('#filter').change(function(){ 
    var filter1 = $(this).val();
    var kd_area = $('#area').val();
    if (filter1=='none'){
      document.getElementById("filter2").disabled=true;
    }else{
      document.getElementById("filter2").disabled=false;
      $.ajax({
          url : "<?php echo site_url('laporan_marketing/get_filter1');?>",
          method : "POST",
          data : {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
            id:kd_area,filter1:filter1},
          async : true,
          dataType : 'json',
          success: function(data){
              $('select[name="filter2"]').empty();
              $('select[name="filter2"]').append('<option value="">No Selected</option>');
              $.each(data, function(key, value) {
                  $('select[name="filter2"]').append('<option value="'+ value.kode +'">'+ value.nama +'</option>');
              });

          }
      });
    }
    
});



  }); 
</script>