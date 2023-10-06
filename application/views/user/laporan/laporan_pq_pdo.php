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
             Cetak PQ VS PDO VS SPJ </h3>
           </div>
           <div class="d-inline-block float-right">
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>
         <div class="row">
          <div class="col-md-4">
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

          <div class="col-md-4">
            <div class="form-group">
              <label for="proyek" class="control-label">PQ Proyek</label>
                <select name="projek"  id="projek" class="form-control" required>
                  <option value="">No Selected</option>
                </select>                
            </div>
          </div>

          <div class="col-md-4">
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
            <button  name="submit" id="butcetak"  class="btn btn-primary btn-sm"><i class="fa fa-television"></i> Cetak</button>
            <button  name="submit" id="butexport"  class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Export</button>
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
  $("#laporan_pq> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    
$('#butcetak').on('click', function() {
    var projek  = document.getElementById("projek").value;
    var area    = document.getElementById("area").value;
    var proyek  = projek.replace(/\//g,'')
    var tahun   = document.getElementById("thn_ang").value;

    if (projek=='all'){
      var url = '<?= base_url() ?>'+'laporan_pq_proyek/cetak_pq_pdo_all/'+area+'/'+tahun+'/1/Laporan PQ VS PDO VS SPJ'; 
    }else{
      var url = '<?= base_url() ?>'+'laporan_pq_proyek/cetak_pq_pdo_proyek/'+proyek+'/'+tahun+'/1/Laporan PQ VS PDO VS SPJ';   
    }

    
    window.open(url, '_blank');
});

$('#butexport').on('click', function() {
    var projek  = document.getElementById("projek").value;
    var area    = document.getElementById("area").value;
    var proyek  = projek.replace(/\//g,'')
    var tahun   = document.getElementById("thn_ang").value;

    if (projek=='all'){
      var url = '<?= base_url() ?>'+'laporan_pq_proyek/cetak_pq_pdo_all/'+area+'/'+tahun+'/0/Laporan PQ VS PDO VS SPJ'; 
    }else{
      var url = '<?= base_url() ?>'+'laporan_pq_proyek/cetak_pq_pdo_proyek/'+proyek+'/'+tahun+'/0/Laporan PQ VS PDO VS SPJ';   
    }
    window.open(url, '_blank');
});

$('#area').change(function(){ 
    var kodearea=$(this).val();
    $.ajax({
        url : "<?php echo site_url('cpdo/get_pq_projek_by_area');?>",
        method : "POST",
        data : {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          id: kodearea},
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="projek"]').empty();
            $('select[name="projek"]').append('<option value="">No Selected</option>');
            $('select[name="projek"]').append('<option value="all">ALL</option>');
            $.each(data, function(key, value) {
                $('select[name="projek"]').append('<option value="'+ value.kd_pqproyek +'">'+ value.kd_pqproyek +' '+value.nm_paket_proyek +'</option>');
            });

        }
    });
    return false;
});


$('#projek').change(function(){ 
    var idproyek    = $(this).val();
    if(idproyek=='all'){
      document.getElementById("thn_ang").disabled = false;
    }else{
      document.getElementById("thn_ang").value='-';
      document.getElementById("thn_ang").disabled = true;
    }

    return false;
});

  }); 
</script>