<div class="form-background">
  <div class="login-box">
    <div class="login-logo">
      <h2><a href="<?= base_url('admin'); ?>"><?= $this->general_settings['application_name']; ?></a></h2>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"><?= trans('signin_to_start_your_session') ?></p>

        <?php $this->load->view('admin/includes/_messages.php') ?>
        
        <?php echo form_open(base_url('admin/auth/login'), 'class="login-form" '); ?>
          <div class="form-group has-feedback">
            <input type="text" name="username" id="name" class="form-control" placeholder="<?= trans('username') ?>" >
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="<?= trans('password') ?>" >
          </div>
          
	
		<div class="form-group has-feedback col-6">
              
                <select name="thn_ang" id="thn_ang" class="form-control" required>
                  <option value="" disabled selected >Tahun Anggaran</option>
                  <option value="<?= date('Y')-1;?>"><?= date('Y')-1;?></option>
                  <option value="<?= date('Y')?>"><?= date('Y')?></option>
                  <option value="<?= date('Y')+1;?>"><?= date('Y')+1;?></option>
                </select>
            </div>
		  
		  <div class="row">
            <div class="col-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> <?= trans('remember_me') ?>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat" value="<?= trans('signin') ?>">
            </div>
            <!-- /.col -->
          </div>
        <?php echo form_close(); ?>

     <!--  -->
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
</div>
   

	
	<script type="text/javascript">
	
	$(document).ready(function() {	
		 $(function() {
			  $("#tgl_pdo").datepicker({
			  	minViewMode: 2,
	         	format: 'yyyy',
			    onSelect: function(dateText) {
			   //   display("Selected date: " + dateText + ", Current Selected Value= " + this.value);
			     // $(this).change();
			    }
			  }).on("change", function() { 
			    
			  });
		});
	});
	

	
	</script>		  
