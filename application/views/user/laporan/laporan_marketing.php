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
             Cetak PQ Proyek </h3>
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
                  <?php if($area['kd_area'] == $this->session->userdata('kd_area')): ?>
                    <option value="<?= $area['kd_area']; ?>" selected><?= $area['nm_area']; ?></option>
                    <?php else: ?>
                      <option value="<?= $area['kd_area']; ?>"><?= $area['nm_area']; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
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
  $("#laporan_marketing> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    
$('#butcetak').on('click', function() {
    var area = document.getElementById("area").value;
    var tahun = document.getElementById("thn_ang").value;
    if(tahun==''){
      alert('Silahkan pilih tahun anggaran')
      return
    }
    var url = '<?= base_url() ?>'+'laporan_marketing/cetak_marketing/'+area+'/'+tahun+'/1/Laporan Marketing'; 
    window.open(url, '_blank');
});

$('#butexport').on('click', function() {
    var area = document.getElementById("area").value;
    var tahun = document.getElementById("thn_ang").value;
    if(tahun==''){
      alert('Silahkan pilih tahun anggaran')
      return
    }
    var url = '<?= base_url() ?>'+'laporan_marketing/cetak_marketing/'+area+'/'+tahun+'/0/Laporan Marketing'; 
    window.open(url, '_blank');
});

  }); 
</script>