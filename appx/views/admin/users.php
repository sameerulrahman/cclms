<!-- <div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php /* echo get_phrase('users'); ?>
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
							<?php echo form_close(); */ ?>
						</div>
           			</div>
          		</div>
        	</div>
       	</div>
    </section>
</div> -->
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

      <!--begin::App Main-->
      <main class="app-main">
	  	<?php if($message):?>
			<div class="alert alert-info alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-info"></i> <?php echo ucfirst(get_phrase('notification')); ?>!</h4>
				<div id="infoMessage"><?php echo $message;?></div>
			</div>
		<?php endif;?>
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0"><?php echo ucfirst(get_phrase('users')); ?> <?php echo ucfirst(get_phrase('management')); ?></h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <!-- <li class="breadcrumb-item"><a href="<?php // echo base_url(); ?>">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?php // echo ucfirst(get_phrase('users_management')); ?></li> -->
				  <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#addUserModal">Add User</button>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <!-- <div class="card-header"><h3 class="card-title">Bordered Table</h3></div> -->
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered" id="usersTable" style="border-top:1px solid rgba(0, 0, 0, 0.3);">
                      <thead>
                        <tr>
                          	<th style="width: 10px">#</th>
						  	<th><?php echo ucfirst(get_phrase('profile_picture')); ?></th>
							<th><?php echo ucfirst(get_phrase('full_name')); ?></th>
							<th><?php echo ucfirst(get_phrase('email')); ?></th>
							<!-- <th><?php /* echo ucfirst(get_phrase('username')); */ ?></th> -->
							<th><?php echo ucfirst(get_phrase('company')); ?></th>
							<th><?php echo ucfirst(get_phrase('phone')); ?></th>
							<th><?php echo ucfirst(get_phrase('created_on')); ?></th>
							<th><?php echo ucfirst(get_phrase('status')); ?></th>
							<th><?php echo ucfirst(get_phrase('last_login')); ?></th>
							<!-- <th><?php /* echo ucfirst(get_phrase('groups')); */ ?></th> -->
							<th><?php echo ucfirst(get_phrase('action')); ?></th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $serial = 1;
					  	foreach ($users as $user): ?>
                        	<tr class="align-middle">
								<td><?php echo $serial++; ?></td>
								<td><img src="<?php echo load_image($user->profile_image, 'files/profiles', 'user'); ?>" class="direct-chat-img lazy user-thumb-loader" alt="User Image"></td>
								<td><?php echo $user->first_name.' '.$user->last_name ?> </td>
								<td><?php echo $user->email; ?> </td>
								<!-- <td><?php // echo $user->username; ?> </td> -->
								<td><?php echo $user->company; ?> </td>
								<td><?php echo $user->phone; ?> </td>
								<td><?php echo date('F j, Y',$user->created_on); ?> </td>
								<td>
									<?php echo ($user->active == 1) ? 'Active' : 'Inactive'; ?>
								</td>
								<td><?php echo !empty($user->last_login) ? date('F j, Y', $user->last_login) : 'Not Logged In'; ?></td>
								<!-- <td>
									<?php /* foreach ($user->groups as $group):?>
										<small class="label label-default"><?php echo  $group->name;?></small>
									<?php endforeach */ ?>
								</td> -->
								<td>
									<a href="<?php echo base_url().'admin/edit_user/'.$user->id; ?>" class="btn btn-primary btn-sm">Edit</a>
									<a href="javascript:void(0);" onclick="confirmDeactivation(<?php echo $user->id; ?>)" class="btn btn-danger btn-sm">Deactivate</a>
								</td>
							</tr>
							<?php endforeach; ?>
							<!-- <div class="modal  fade" id="deactive<?php // echo $user->id; ?>">
								<div class="modal-dialog">
									<div class="modal-content" style="margin-top:100px;">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" style="text-align:center;"><?php // echo get_phrase('are_you_sure_you_want_to_deactivate_this_user'); ?> ?</h4>
										</div>
										<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
											<a href="<?php // echo base_url();?>admin/deactivate/<?php // echo $user->id; ?>" class="btn btn-danger" ><?php // echo get_phrase('yes'); ?></a>
											<button type="button" class="btn btn-info" data-dismiss="modal"><?php // echo get_phrase('no'); ?></button>
										</div>
									</div>
								</div>
							</div> -->
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
<div id="addUserModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo ucfirst(get_phrase('add_user')); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php echo form_open('settings/users'); ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo ucfirst(get_phrase('first_name')); ?><b style="color:red">*</b></label>
                    <div class="col-sm-9">
                        <?php echo form_input($first_name, '', 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo ucfirst(get_phrase('last_name')); ?><b style="color:red">*</b></label>
                    <div class="col-sm-9">
                        <?php echo form_input($last_name, '', 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo ucfirst(get_phrase('company')); ?><b style="color:red">*</b></label>
                    <div class="col-sm-9">
                        <?php echo form_input($company, '', 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo ucfirst(get_phrase('email')); ?><b style="color:red">*</b></label>
                    <div class="col-sm-9">
                        <?php echo form_input($email, '', 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo ucfirst(get_phrase('phone')); ?></label>
                    <div class="col-sm-9">
                        <?php echo form_input($phone, '', 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo ucfirst(get_phrase('new_password')); ?><b style="color:red">*</b></label>
                    <div class="col-sm-9">
                        <?php echo form_password($password, '', 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?php echo ucfirst(get_phrase('confirm_password')); ?><b style="color:red">*</b></label>
                    <div class="col-sm-9">
                        <?php echo form_password($password_confirm, '', 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" name="submit" class="btn btn-primary"><?php echo ucfirst(get_phrase('save')); ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
	function confirmDeactivation(userId) {
		if (confirm("Are you sure you want to deactivate this user?")) {
			window.location.href = "<?php echo base_url(); ?>admin/deactivate/" + userId;
		}
	}
</script>
