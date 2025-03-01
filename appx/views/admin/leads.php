<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

      <!--begin::App Main-->
      <main class="app-main">
	  	<?php /* if($message):?>
			<div class="alert alert-info alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-info"></i> <?php echo ucfirst(get_phrase('notification')); ?>!</h4>
				<div id="infoMessage"><?php echo $message;?></div>
			</div>
		<?php endif; */ ?>
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0"><?php echo ucfirst(get_phrase('lead')); ?> <?php echo ucfirst(get_phrase('management')); ?></h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <!-- <li class="breadcrumb-item"><a href="<?php // echo base_url(); ?>">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?php // echo ucfirst(get_phrase('users_management')); ?></li> -->
				  <!-- <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#addLeadModal">Add Lead</button> -->
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
                    <table class="table table-bordered" id="leadsTable" style="border-top:1px solid rgba(0, 0, 0, 0.3);">
                      <thead>
                        <tr>
                          	<th style="width: 10px">#</th>
						  	<th><?php echo ucfirst(get_phrase('name')); ?></th>
							<th><?php echo ucfirst(get_phrase('address')); ?></th>
							<th><?php echo ucfirst(get_phrase('phone')); ?></th>
							<th><?php echo ucfirst(get_phrase('school')); ?></th>
							<th><?php echo ucfirst(get_phrase('class')); ?></th>
							<th><?php echo ucfirst(get_phrase('preferred')); ?> <?php echo ucfirst(get_phrase('institute')); ?></th>
							<th><?php echo ucfirst(get_phrase('preferred')); ?> <?php echo ucfirst(get_phrase('course')); ?></th>
							<th><?php echo ucfirst(get_phrase('status')); ?></th>
							<th><?php echo ucfirst(get_phrase('notes')); ?></th>
							<th><?php echo ucfirst(get_phrase('action')); ?></th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $serial = 1;
					  	foreach ($leads as $lead): ?>
                        	<tr class="align-middle">
								<td><?php echo $serial++; ?></td>
								<td><?php echo $lead['name']; ?> </td>
								<td><?php echo $lead['address']; ?> </td>
								<td><?php echo $lead['phone_number']; ?> </td>
								<td><?php echo $lead['school']; ?> </td>
								<td><?php foreach ($classes as $key => $value) {
                                    if ($lead['class'] == $key) {
                                        echo $value;
                                    }
                                } ?> </td>
								<td><?php foreach ($institutes as $institute) {
                                    if ($lead['preferred_institute'] == $institute['id']) {
                                        echo $institute['company'];
                                    }
                                } ?> </td>
								<td><?php foreach ($courses as $key => $value) {
                                    if ($lead['preferred_course'] == $key) {
                                        echo $value;
                                    }
                                } ?> </td>
								<td><?php foreach ($statuses as $key => $value) {
                                    if ($lead['status'] == $key) {
                                        echo $value;
                                    }
                                } ?> </td>
                                <td><?php echo $lead['student_notes']; ?> </td>
								<td>
									<a href="<?php echo base_url().'admin/edit_lead/'.$lead['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
								</td>
							</tr>
							<?php endforeach; ?>
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
<!-- <div id="addLeadModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php /* echo ucfirst(get_phrase('add_user')); ?></h4>
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
                <?php echo form_close(); */ ?>
            </div>
        </div>
    </div>
</div> -->

<script>
    $(document).ready(function() {
        $('#leadsTable').DataTable({
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