
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
	
	<link rel="stylesheet" href="<?= base_url()?>vendor/bootstrap.css">
	
	
  <!-- Content Wrapper. Contains page content -->
 
 <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
	
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-print"></i>
				Cetak Realisasi Rencana Anggaran Pelaksana (RAP)</h3>
           </div>
           <div class="d-inline-block float-right">
          </div>
        </div>
		
		
        <div class="card-body">
         
         <!-- For Messages -->
         <?php $this->load->view('admin/includes/_messages.php') ?>
    
				<div class="row" style="margin:10px">
			
					<div class="col-md-12">
					
						<div class="form-group">
							<label class="col-sm-1 control-label input-sm">Tahun</label>
							
									  <div class="col-md-2">
										<select name="thn_ang" id="thn_ang" class="form-control" required>
										  <option value="">No Selected</option>
										  <option value="<?= date('Y')-1;?>"><?= date('Y')-1;?></option>
										  <option value="<?= date('Y')?>"><?= date('Y')?></option>
										  <option value="<?= date('Y')+1;?>"><?= date('Y')+1;?></option>
										</select>
									</div>
								
							</div>

					 </div>
				 </div>



			<div class="row" style="margin:10px">
			
				<div class="col-md-12">
					
						<div class="form-group">
							<label class="col-sm-1 control-label input-sm">Area</label>
							<div class="col-md-6">
										<select name="cbarea" id="cbarea" class="form-control input-sm" style="width:100%;">
										</select>
							</div>
						
						</div>
						
				</div>
			</div>
			




				<div class="row" style="margin:10px">
					<div class="col-md-12">
					
						<div class="form-group">
							<label class="col-sm-1 control-label input-sm">Proyek</label>

							<div class="col-sm-6">
										<select name="cbproyek" id="cbproyek" class="form-control input-sm" style="width:100%;">
										</select>
										
							</div>
							
						</div>
							
					</div>
				</div>



		  
		  
		  <div class="row" style="margin:20px">
						<div class="col-sm-12" align="left" >
							<div class="col-sm-1">&nbsp;</div>
							
							<div class="col-sm-6" align="left" >  
								<div class="form-group">
									<div class="btn-group btn-group-sm" id="print" style="bottom:5px;">
										<a href="#" class="btn" style="background-color: #C98474; color: white;" id="search"><i class="icon fa fa-search"></i> Preview</a>
											<div class="btn-group">
											<a href="#" class="btn dropdown-toggle" data-toggle="dropdown" style="font-size:14px;background-color: #18978F; color: white;">
											<i class="icon fa fa-print"></i>
											Cetak <span class="caret"></span></a>
											<ul class="dropdown-menu" role="menu">
											  <li><a href="#" class="tombol-print" id="print-pdf" style="color:#EB1D36;margin-left:20px"><i class="icon fa fa-file-pdf-o fa-lg"></i>&nbsp;&nbsp;Pdf</a></li><hr>
											  <li><a href="#" class="tombol-print" id="print-excel" style="color:green;margin-left:20px"><i class="icon fa fa-file-excel-o fa-lg"></i>&nbsp;&nbsp;Excel</a></li>
											</ul>
										  </div>
										</div> 
								</div> 
							</div> 
						</div>				
					</div>	
		  
		  
		<div class="row">

			<div class="col-md-12">
				<div class="box-body my-form-body">

					<!--  -->
					<div id="treeview-mdbootstrap">
						
					</div>
					

					<!--  -->



					<div id="tree_parameter">
						
					</div>
				</div>
			</div>
	    </div>		  
		  
		 
      </div>
      <!-- /.box-body -->
    </div>
  </section> 
</div>
  <script>
  
</script>
<script>

$(document).ready(function(){


$('#cbarea').select2({
	placeholder: 'Pilih Area'
});


$('#cbproyek').select2({
	placeholder: 'Pilih Proyek'
});

$('#thn_ang').select2({
	placeholder: 'Pilih Tahun'
});


	$('#thn_ang').on('change', function(){

		var carea		= $('#cbarea').val();
		var ctahun		= $('#thn_ang').val();
		
			$.ajax({
					  type: 'POST',
					  url: "<?php echo base_url(); ?>laporan-Realisasi/list-area",
						
					  data:{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ctahun},
					  
					  success: function(data){
						$("#cbarea").html(data);
					  }
			});		
			

	});		



	$('#cbarea').on('change', function(){ 

		var carea		= $('#cbarea').val();
		var ctahun		= $('#thn_ang').val();
		
			$.ajax({
				  type: 'POST',
				  url: "<?php echo base_url(); ?>laporan-Realisasi/list-proyek",
					
				  data:{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ctahun,carea},
				  
				  success: function(data){
					$("#cbproyek").html(data);
				  }
			});		

	});	


        $(document).on("click", "#search", function() {
			var ctahun 			= $('#thn_ang').val(); 
        	var carea 			= $('#cbarea').val();
        	var cproyek 		= $('#cbproyek').val();
			var ctipe			= 'priv';
			
			if (ctahun == '') {
        		swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'Tahun tidak boleh kosong',
						});
        	}else if (carea == '') {
        		swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'Area tidak boleh kosong',
						});
        	}else if (cproyek == null || cproyek == '') {
        		swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'Proyek tidak boleh kosong',
						});
        	}else{
        		
        		$("#treeview-mdbootstrap").html('<center><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="42" width="42"></center>');
			  	$.ajax({
					  url: '<?php echo base_url('laporan-realisasi-rap-prev'); ?>',
					  type: 'POST',
					   data:{'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',ctahun,carea,cproyek,ctipe},
					  success: function(data){
					  	$("#treeview-mdbootstrap").html(data);
					  }
				  });
        	}

		  });


        $(document).on("click", ".tombol-print", function() {
			var id 				= $(this).attr("id");
        	var ctahun 			= $('#thn_ang').val(); 
        	var carea 			= $('#cbarea').val();
        	var cproyek 		= $('#cbproyek').val();
			  
			var cproyek  = cproyek.replace(/\//g,'12345678909')
			
			
        	if (ctahun == '') {
        		swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'Tahun tidak boleh kosong',
						});
        	}else if (carea == '') {
        		swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'Area tidak boleh kosong',
						});
        	}else if (cproyek == null || cproyek == '') {
        		swal.fire({
						  icon: 'warning',
						  title: 'PERINGATAN!',
						  text: 'Proyek tidak boleh kosong',
						});
        	}else{
				
				
			  	if (id == 'print-pdf') {
			  		window.open('<?php echo base_url('laporan-realisasi-rap-pdf'); ?>/'+ctahun+'/'+carea+'/'+cproyek+'/pdf', '_blank');	
			  	}else{
					window.open('<?php echo base_url('laporan-realisasi-rap-excel'); ?>/'+ctahun+'/'+carea+'/'+cproyek+'/excel', '_blank');
			  	}
        	}

		  });


});		

</script>