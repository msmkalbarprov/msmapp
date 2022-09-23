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
             Cetak Jurnal</h3>
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
              <label for="thn_ang" class="control-label">Tahun Anggaran</label>
                <select name="thn_ang" id="thn_ang" class="form-control" required>
                  <option value="">No Selected</option>
                  <option value="<?= date('Y')-1;?>"><?= date('Y')-1;?></option>
                  <option value="<?= date('Y')?>"><?= date('Y')?></option>
                  <option value="<?= date('Y')+1;?>"><?= date('Y')+1;?></option>
                </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bulan" class="control-label">Bulan</label>
                <select name="bulan" id="bulan" class="form-control" required>
                  <option value="">No Selected</option>
                  <option value="0">Semua</option>
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
          <div class="col-md-4">
            <div class="form-group">
              <label for="jns_jurnal" class="control-label">Jenis Jurnal</label>
                <select name="jns_jurnal" id="jns_jurnal" class="form-control" required>
                  <option value="">No Selected</option>
                  <option value="0">Semua</option>
                  <option value="1">Transaksi</option>
                  <option value="2">Penyusutan</option>
                </select>
            </div>
          </div>
         </div>


        <div class="form-group">
          <div class="col-md-12" align="right">
            <button  name="submit" id="butview"  class="btn btn-dark btn-sm"><i class="fa fa-television"></i> Preview</button>
            <button  name="submit" id="butcetak"  class="btn btn-primary btn-sm"><i class="fa fa-television"></i> PDF</button>
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
  $("#laporan_pdo>register_pdo> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    
$('#butcetak').on('click', function() {
    var tahun = document.getElementById("thn_ang").value;
    var bulan = document.getElementById("bulan").value;
    var jns_jurnal = document.getElementById("jns_jurnal").value;
    if(tahun==''){
      alert('Silahkan pilih tahun anggaran')
      return
    }
    if(bulan==''){
      alert('Silahkan bulan tahun anggaran')
      return
    }
    if(jns_jurnal==''){
      alert('Silahkan jenis jurnal tahun anggaran')
      return
    }
    var url = '<?= base_url() ?>'+'jurnal/cetak_jurnal_umum/'+tahun+'/1/'+bulan+'/'+jns_jurnal; 
    window.open(url, '_blank');
});

$('#butexport').on('click', function() {
    var jns_jurnal = document.getElementById("jns_jurnal").value;
    var tahun = document.getElementById("thn_ang").value;
    var bulan = document.getElementById("bulan").value;
    if(tahun==''){
      alert('Silahkan pilih tahun anggaran')
      return
    }
    if(bulan==''){
      alert('Silahkan bulan tahun anggaran')
      return
    }
    if(jns_jurnal==''){
      alert('Silahkan jenis jurnal tahun anggaran')
      return
    }
    var url = '<?= base_url() ?>'+'jurnal/cetak_jurnal_umum/'+tahun+'/0/'+bulan+'/'+jns_jurnal; 
    window.open(url, '_blank');
});

$('#butview').on('click', function() {
    var jns_jurnal = document.getElementById("jns_jurnal").value;
    var tahun = document.getElementById("thn_ang").value;
    var bulan = document.getElementById("bulan").value;
    if(tahun==''){
      alert('Silahkan pilih tahun anggaran')
      return
    }
    if(bulan==''){
      alert('Silahkan bulan tahun anggaran')
      return
    }
    if(jns_jurnal==''){
      alert('Silahkan jenis jurnal tahun anggaran')
      return
    }
    var url = '<?= base_url() ?>'+'jurnal/cetak_jurnal_umum/'+tahun+'/2/'+bulan+'/'+jns_jurnal; 
    window.open(url, '_blank');
});

  }); 
</script>