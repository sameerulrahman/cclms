<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo get_phrase('profile'); ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> <?php echo get_phrase('home'); ?> </a></li>
			<li class="active"><?php echo get_phrase('profile'); ?></li>
		</ol>
	</section>
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<?php if($this->session->flashdata("message")):?>
					<div class="alert alert-info alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-info"></i> <?php echo get_phrase('notification'); ?>!</h4>
						<?php echo $this->session->flashdata("message")?> 
					</div>
				<?php endif;?>	
			</div>
		</div>
		<?php if(validation_errors()):?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> <?php echo get_phrase('error'); ?>!</h4>
              <?php echo validation_errors(); ?> 
            </div>
		<?php endif;?>		
      	<div class="row">
      	  	<div class="col-md-3">
				<div class="box <?php echo setting_all('box_headers'); ?>">
					<div class="box-body box-profile">
 						<img data-src="<?php echo load_image($profile_image, 'files/profiles', 'user'); ?>" class="profile-user-img img-responsive img-circle lazy user-loader">
						<h3 class="profile-username text-center"><?php echo $full_name; ?></h3>
						<p class="text-muted text-center">Software Engineer</p>
					</div>
 				</div>
        	</div>
        	<div class="col-md-9">
         		<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#profile" data-toggle="tab"><?php echo get_phrase('user_profile'); ?></a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane " id="profile">
							<?php echo form_open_multipart(uri_string());?>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('first_name'); ?></label>
									<div class="col-sm-10">
										<?php echo form_input($first_name);?><br>
									</div>
								</div>				 
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('last_name'); ?></label>
									<div class="col-sm-10">
										<?php echo form_input($last_name);?><br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"> <?php echo get_phrase('phone'); ?></label>
									<div class="col-sm-10">
										<?php echo form_input($phone);?><br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('profile_picture'); ?></label>
									<div class="col-sm-10">
										<?php echo form_input($userfile);?><br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('new_password'); ?></label>
									<div class="col-sm-10">
										<?php echo form_input($password);?><br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('confirm_profile'); ?></label>
									<div class="col-sm-10">
										<?php echo form_input($password_confirm);?><br>
									</div>
								</div>
                  				<?php if ($this->ion_auth->is_admin()): ?>
                  				<div class="form-group">
                       				<div class="col-sm-offset-2 col-sm-10">
                        			   <label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('user_groups'); ?></label>
                       				   <div class="checkbox">
											<?php foreach ($groups as $group): 
												$gID=$group['id'];
												$checked = null;
												$item = null;
												foreach($currentGroups as $grp) {
													if ($gID == $grp->id) {
														$checked= ' checked="checked"';
													break;
													}
												}
											?>
											<label>
												<input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
												<?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>&nbsp;
											</label> 
											<?php endforeach?>
                         				 </div>
                       				 </div>
                     			</div>
               				    <?php endif ?>
								<?php echo form_hidden('id', $user->id);?>
								<?php echo form_hidden($csrf); ?>
               					<button type="submit" name="submit" class="btn btn-flat <?php echo setting_all('buttons'); ?>"><?php echo get_phrase('save'); ?></button>
              				<?php echo form_close();?>
              			</div>
           		 	</div>
		        </div>
 	        </div>
 	    </div>
    </section>
</div>
 