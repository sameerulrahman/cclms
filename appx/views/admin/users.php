<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo get_phrase('users'); ?>
			<small><?php echo get_phrase('management'); ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> <?php echo get_phrase('home'); ?></a></li>
			<li class="active"><?php echo get_phrase('users_management'); ?></li>
 		</ol>
	</section>
    <section class="content">
     	<div class="row">
			<div class="col-md-12">
				<?php if($message):?>
				<div class="alert alert-info alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-info"></i> <?php echo get_phrase('notification'); ?>!</h4>
					<div id="infoMessage"><?php echo $message;?></div>
				</div>
				<?php endif;?>	
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#users" data-toggle="tab"><?php echo get_phrase('users'); ?></a></li>
						<li><a href="#addUser" data-toggle="tab"><?php echo get_phrase('add_users'); ?></a></li>
					</ul>
           			<div class="tab-content">
            			<div class="active tab-pane" id="users">
							<div class="box-body table-responsive no-padding">
								<table id="tableUsers" class="table responsive table-hover">
									<thead>
										<tr>
											<th><?php echo get_phrase('profile_picture'); ?></th>
											<th><?php echo get_phrase('full_name'); ?></th>
 											<th><?php echo get_phrase('email'); ?></th>
											<th><?php echo get_phrase('username'); ?></th>
											<th><?php echo get_phrase('company'); ?></th>
											<th><?php echo get_phrase('phone'); ?></th>
											<th><?php echo get_phrase('created_on'); ?></th>
											<th><?php echo get_phrase('status'); ?></th>
											<th><?php echo get_phrase('last_login'); ?></th>
											<th><?php echo get_phrase('groups'); ?></th>
											<th><?php echo get_phrase('action'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($users as $user): ?>
											<tr>
												<td><img class="direct-chat-img lazy user-thumb-loader" data-src="<?php echo load_image($user->profile_image, 'files/profiles', 'user-thumb'); ?>"></td>
												<td><?php echo $user->first_name.' '.$user->last_name ?> </td>
 												<td><?php echo $user->email; ?> </td>
												<td><?php echo $user->username; ?> </td>
												<td><?php echo $user->company; ?> </td>
												<td><?php echo $user->phone; ?> </td>
												<td><?php echo date('F/j/Y',$user->created_on); ?> </td>
												<td>
													<?php echo ($user->active) ?
													'
													<a href="#" data-toggle="modal" data-target="#deactive'.$user->id.'" > <small class="label label-info"><i class="fa fa-check-square"></i> Active </small></a>
													'
													: anchor("admin/activate/". $user->id, '<small class="label label-danger"><i class="fa fa-times-circle"></i> Inactive </small>'); ?>
												</td>
												<td><?php echo date('F/j/Y',$user->last_login); ?></td>
												<td>
													<?php foreach ($user->groups as $group):?>
														<small class="label label-default"><?php echo  $group->name;?></small>
													<?php endforeach?>
												</td>
												<td>
													<a href="<?php echo base_url().'admin/edit_user/'.$user->id; ?>">
														<button title="Edit" class="btn btn-success btn-xs">
															<i class="fa fa-edit"></i>
														</button>
													</a>
													<a href="#" onclick="confirm_modal('<?php echo base_url().'settings/delete_user/'.$user->id; ?>')">
														<button title="Delete" class="btn btn-danger btn-xs">
															<i class="fa fa-trash-o "></i>
														</button>
													</a>
												</td>
											</tr>
											<div class="modal  fade" id="deactive<?php echo $user->id; ?>">
												<div class="modal-dialog">
													<div class="modal-content" style="margin-top:100px;">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" style="text-align:center;"><?php echo get_phrase('are_you_sure_you_want_to_deactivate_this_user'); ?> ?</h4>
														</div>
														<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
															<a href="<?php echo base_url();?>admin/deactivate/<?php echo $user->id; ?>" class="btn btn-danger" ><?php echo get_phrase('yes'); ?></a>
															<button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('no'); ?></button>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</tbody>
								</table> 
							</div>
     					 </div>
						<div class="tab-pane" id="addUser">
							<?php echo form_open('settings/users');?>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('first_name'); ?><b style="color:red">*</b></label>
									<div class="col-sm-10">
										<?php echo form_input($first_name);?><br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('last_name'); ?><b style="color:red">*</b></label>
									<div class="col-sm-10">
										<?php echo form_input($last_name);?><br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('company'); ?><b style="color:red">*</b></label>
									<div class="col-sm-10">
										<?php echo form_input($company);?><br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('email'); ?><b style="color:red">*</b></label>
									<div class="col-sm-10">
										<?php echo form_input($email);?><br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('phone'); ?></label>
									<div class="col-sm-10">
										<?php echo form_input($phone);?><br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('new_password'); ?><b style="color:red">*</b></label>
									<div class="col-sm-10">
										<?php echo form_input($password);?><br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label"><?php echo get_phrase('confirm_password'); ?><b style="color:red">*</b></label>
									<div class="col-sm-10">
										<?php echo form_input($password_confirm);?><br>
									</div>
								</div>
								<button type="submit" name="submit" class="btn btn-flat <?php echo setting_all('buttons'); ?>"><?php echo get_phrase('save'); ?></button>
							<?php echo form_close();?>
						</div>
           			</div>
          		</div>
        	</div>
       	</div>
    </section>
</div>
 