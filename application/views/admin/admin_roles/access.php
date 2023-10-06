<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="card card-default color-palette-bo">
            <div class="card-header">
              <div class="d-inline-block">
                  <h3 class="card-title"> <i class="fa fa-edit"></i>
                  &nbsp; <?= $title ?> </h3>
              </div>
              <div class="d-inline-block float-right">
                <a href="#" onclick="window.history.go(-1); return false;" class="btn btn-primary pull-right"><i class="fa fa-reply mr5"></i> <?= trans('back') ?></a>
              </div>
            </div>
            <div class="card-body">
            	<div class="col-md-12">
                    <h3 class="box-title">
                        <span class="mr5">Role/Peran : </span> 
						<?=strtoupper($record['admin_role_title'])?>
                    </h3>
                </div>
            </div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-2">
						MENU
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-4">
								SUB MENU
							</div>
							<div class="col-md-8 pull-right">
								<span class="pull-right">
									AKSES
								</span>
							</div>
						</div>
							
					</div>
					<div class="col-md-1">
						&nbsp;
					</div>
					<div class="col-md-5">
						Permission
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<?php foreach($modules as $kk => $module): ?>
								
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2 pb-3">
												<?php if($module['kode']=='M'): ?>
													<strong class="f-16"><?= $module['module_name']?></strong>
												<?php endif; ?>
											</div>
											<div class="col-md-4">
											<div class="row">
												<div class="col-md-4 pb-3">
													<?php if($module['kode']=='S'): ?>
														<?= $module['module_name']?>
													<?php endif; ?>
												</div>
												<div class="col-md-8 ">
														<div class="col-md-12 pb-3">	
															<span class="pull-right">
																<input type='checkbox'
																class='tgl tgl-ios tgl_checkbox checkbox_menu'
																data-module='<?= $module['jenis_id'] ?>'
																data-role='1'
																id='cb_<?=$module['id']?>' 
																<?php if (in_array($module['jenis_id'], $access)) echo 'checked="checked"';?>
																/>
																<label class='tgl-btn' for='cb_<?=$module['id']?>'></label> 
															</span>
														</div>
												</div>
											</div>
											
											</div>
											<div class="col-md-1">
												&nbsp;
											</div>
											<div class="col-md-5">
											<?php foreach(explode("|",$module['operation']) as $k => $operation):?>
													<?php if($operation != ''): ?>
														<div class="row mb-3">
															<span class="pull-right">
																<input type='checkbox'
																class='tgl tgl-ios tgl_checkbox checkbox_permission'
																data-module='<?= $module['controller_name'] ?>'
																data-operation='<?= $operation; ?>'
																data-jenis_id='<?= $module['jenis_id'] ?>'
																id='cb_<?=$module['id'].$operation?>' 
																<?php if (in_array($module['controller_name'].'/'.$operation, $permission)) echo 'checked="checked"';?>
																/>
																<label class='tgl-btn' for='cb_<?=$module['id'].$operation?>'></label> 
															</span>
															<span class="mt-15 pl-3">
																<?=ucwords($operation)?>
															</span>
														</div>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
											<hr style="margin:7px 0px;" />
										</div> 
									</div>
								
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<script>
$("body").on("change",".checkbox_menu",function(){
	$.post('<?=base_url("admin/admin_roles/set_access")?>',
	{
		'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		module : $(this).data('module'),
		// operation : $(this).data('operation'),
		admin_role_id : <?=$record['admin_role_id']?>,
		status : $(this).is(':checked')==true?1:0
	},
	function(data){
		$.notify("Status Changed Successfully", "success");
	});
});

$("body").on("change",".checkbox_permission",function(){
	$.post('<?=base_url("admin/admin_roles/set_permission")?>',
	{
		'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
		module : $(this).data('module'),
		operation : $(this).data('operation'),
		jenis_id : $(this).data('jenis_id'),
		admin_role_id : <?=$record['admin_role_id']?>,
		status : $(this).is(':checked')==true?1:0
	},
	function(data){
		$.notify("Status Changed Successfully", "success");
	});
});
</script>


