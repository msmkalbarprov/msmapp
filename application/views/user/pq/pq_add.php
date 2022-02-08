  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
    <style type="text/css">
      .title .rupiah { float:right }
    </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-plus"></i>
             Tambah Project Qualifying(PQ) Proyek </h3>
           </div>
           <div class="d-inline-block float-right">
            <a href="<?= base_url('pq'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  <?= trans('proyek_list') ?></a>
          </div>
        </div>
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>

         <?php echo form_open(base_url('pq/add'), 'class="form-horizontal"');  ?> 
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="projek" class="control-label">Proyek</label>
                <select name="projek" id ="projek" class="form-control" required>
                <option value="">No Selected</option>
                <?php foreach($data_mprojek as $projek): ?>
                      <option value="<?= $projek['kd_proyek']; ?>"><?= $projek['kd_proyek'].' - '.$projek['nm_paket_proyek']; ?></option>
                  <?php endforeach; ?>
                </select>

            </div>
          </div>
          <div class="col-md-3">
           <div class="form-group">
            <label for="area" class="control-label"><?= trans('area') ?></label>
              <input type="text" name="area" id="area" class="form-control" readonly>
          </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="sub_area" class="control-label"><?= trans('sub_area') ?></label>
              <input type="text" name="subarea" id="subarea" class="form-control" readonly>
            </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="jenis_proyek" class="control-label"><?= trans('jenis_proyek') ?></label>
              <input type="text" name="jnsproyek" id="jnsproyek" class="form-control" readonly>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            </div>
          </div>
          <div class="col-md-3">
           <div class="form-group">
            <label for="jenis_sub_proyek" class="control-label"><?= trans('jenis_sub_proyek') ?></label>
              <input type="text" name="jnssubproyek" id="jnssubproyek" class="form-control" readonly>
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="perusahaan" class="control-label"><?= trans('perusahaan') ?></label>
                <input type="text" name="perusahaan" id="perusahaan" class="form-control" readonly>
            </div>
          </div>
         </div>
         <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="jns_pph" class="control-label">Tipe Pengadaan</label>
              <input type="text" name="tipeproyek" id="tipeproyek" class="form-control" readonly>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="thn_ang" class="control-label">Tahun Anggaran</label>
                <input type="text" name="thn_ang" id="thn_ang" class="form-control" readonly>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
            <label for="dinas" class="control-label"><?= trans('nm_dinas') ?></label>
              <input type="text" name="dinas" id="dinas" class="form-control" readonly>
          </div>
          </div>
         </div>

         <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="nilai" class="control-label">Nama Paket pekerjaan</label>
              <input type="text" name="paketproyek" class="form-control" id="paketproyek" placeholder="Nama Paket pekerjaan" readonly>
          </div>
          </div>
         </div>
         <div class="row">
            <div class="col-md-6">
              <h6><b>Pendapatan</b></h6>
              <hr>
            </div>
            <div class="col-md-6">
              <h6><b>Perhitungan Nett Profit</b></h6>
              <hr>
            </div>
          </div>
         <div class="row">
           <div class="col-md-6">
            <table width="100%" border="0">
               <tr>
                 <td width="50%">Nilai SPK</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilaispk" style="background:none;border: none;" id="nilaispk" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">PPN</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><input type="text" name="nilaippn" style="background:none;border: none;" id="nilaippn" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">PPH</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;"><input type="text" name="nilaipph" style="background:none;border: none;" id="nilaipph" class="form-control" readonly></td>
               </tr>
                <tr>
                 <td width="50%"><b>Pend. Nett</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"> <input type="text" name="nilaipend_nett" style="background:none;border: none;" id="nilaipend_nett" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">Titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"> <input type="text" name="titipan" style="background:none;border: none;" id="titipan" class="form-control" readonly></td>
               </tr>
               <tr>
                 <td width="50%">PPH titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><span id="nilaispk"></span></td>
               </tr>
               <tr>
                 <td width="50%">PPN titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;"><span id="nilaispk"></span></td>
               </tr>
               <tr>
                 <td width="50%"><b>Pend. Nett setelah titipan</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><span id="nilaispk"></span></td>
               </tr>
             </table>
           </div>
           <div class="col-md-6">
            <table width="100%" border="0">
               <tr>
                 <td width="50%">Pend. Nett setelah titipan</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><span id="nilaispk"></span></td>
               </tr>
               <tr>
                 <td width="50%">Biaya Partner Lokal (PL)</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;" ><span id="nilaipph"></span></td>
               </tr>
                <tr>
                 <td width="50%"><b>Pendapatan Nett Setelah (PL)</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><span id="nilaipend_nett"></span></td>
               </tr>
               <tr>
                 <td width="50%">Total Biaya (PQ Detail)</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;"><span id="nilaispk"></span></td>
               </tr>
               <tr>
                 <td width="50%">Nett Profit</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><span id="nilaispk"></span></td>
               </tr>
               <tr>
                 <td width="50%">Alokasi HO</td>
                 <td width="5%">:</td>
                 <td width="45%" align="right" style="border-bottom: grey solid 1px;"><span id="nilaispk"></span></td>
               </tr>
               <tr>
                 <td width="50%"><b>Net Profit setelah Alokasi HO</b></td>
                 <td width="5%">:</td>
                 <td width="45%" align="right"><span id="nilaispk"></span></td>
               </tr>
             </table>
           </div>
         </div>



          

         
        <div class="form-group">
          <div class="col-md-12">
            <input type="submit" name="submit" value="Simpan" class="btn btn-primary pull-right">
          </div>
        </div>
        <?php echo form_close( ); ?>
      </div>
      <!-- /.box-body -->
    </div>
     <div class="card card-default">
      <div class="card-body">
           <div class="row">
            <div class="col-md-12">
              <div class="card-body table-responsive">
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <tr>
                      <th>#id</th>
                      <th>Jenis Item</th>
                      <th>Nama</th>
                      <th>Uraian</th>
                      <th>Volume</th>
                      <th>Satuan</th>
                      <th>Volume 2</th>
                      <th>Satuan 2</th>
                      <th>Harga</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
           </div>
      </div>
    </div>
  </section> 
</div>
<!-- <script type="text/javascript" src="<?php echo base_url().'assets/dist/js/jquery-3.3.1.js'?>"></script> -->
  <script>
  // $("#proyek").addClass('menu-open');
  $("#pq> a").addClass('active');
</script>
<script>
  $(document).ready(function(){
    
  $('#projek').change(function(){ 
                var idprojek=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('pq/get_projek');?>",
                    method : "POST",
                    data : {
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id: idprojek},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                      $.each(data, function(key, value) {
                        $('[name="area"]').val(value.nm_area).trigger('change');
                        $('[name="subarea"]').val(value.nm_sub_area).trigger('change');
                        $('[name="jnsproyek"]').val(value.nm_jns_proyek).trigger('change');
                        $('[name="jnssubproyek"]').val(value.nm_jns_sub_proyek).trigger('change');
                        $('[name="perusahaan"]').val(value.nm_perusahaan).trigger('change');
                        $('[name="dinas"]').val(value.nm_dinas).trigger('change');
                        $('[name="tipeproyek"]').val(value.nm_sub_area).trigger('change');
                        $('[name="paketproyek"]').val(value.nm_paket_proyek).trigger('change');
                        $('[name="thn_ang"]').val(value.thn_anggaran).trigger('change');
                        var spk = value.nilai;
                        var ppn = (10/100)*((100/110)*spk);
                        $('[name="nilaispk"]').val(number_format(spk,"2",",",".")).trigger('change');
                        if (value.jns_pph==22){
                          var nilai_pph = (1.5/100)*((100/110)*spk);
                          var nilai_ppn=ppn;
                        }else if (value.jns_pph==23){
                          var nilai_pph = (2/100)*((100/110)*spk);
                          var nilai_ppn=ppn;
                        }else if (value.jns_pph==21){
                          var nilai_pph = (50/100)*((5/110)*spk);
                          nilai_ppn=0;
                        }

                        var pend_nett = spk-nilai_pph-nilai_ppn;

                        $('[name="nilaippn"]').val(number_format(nilai_ppn,"2",",",".")).trigger('change');
                        $('[name="nilaipph"]').val(number_format(nilai_ppn,"2",",",".")).trigger('change');
                        $('[name="nilaipend_nett"]').val(number_format(pend_nett,"2",",",".")).trigger('change');

                      });

                        // $('select[name="subarea"]').empty();
                        // $('select[name="subarea"]').append('<option value="">No Selected</option>');
                        // $.each(data, function(key, value) {
                        //     $('select[name="subarea"]').append('<option value="'+ value.kd_subarea +'">'+ value.nm_subarea +'</option>');
                        // });

                    }
                });
                return false;
          });

  }); 
</script>