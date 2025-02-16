<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>CI Starter | Login</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/Ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/iCheck/square/blue.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/animate/animate.min.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/noty/noty.css" >
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/noty/themes/metroui.css" > 
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
    			<a href="<?php echo base_url(); ?>"><b>CI </b>Starter</a>
			</div>
   			<div class="login-box-body">
   				<p class="login-box-msg"><?php echo $this->lang->line('login_subheading'); ?></p>
				<?php if($this->session->flashdata("message")){?>
					<div class="alert alert-info">      
						<?php echo $this->session->flashdata("message")?>
					</div>
				<?php } ?>
				<?php echo form_open('admin/login', 'data-url="'.base_url('auth/login_ajax').'" ')?>
					<div class="form-group has-feedback">
						<input type="text" name="identity" class="form-control" value="<?= set_value('identity')?>" placeholder="<?php echo get_phrase('email'); ?>" autofocus>
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						<?php echo form_error('email'); ?>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" name="password" value="<?= set_value('password')?>"  placeholder="<?php echo get_phrase('password'); ?>">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						<?php echo form_error('password'); ?>
					</div>
					<div class="form-group has-feedback">
						<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
						<label><?php echo $this->lang->line('login_remember_label'); ?></label>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<button type="submit" name="submit" class="btn <?php echo setting_all('buttons'); ?> btn-block btn-flat"> <?php echo get_phrase('login'); ?></button>
						</div>
					</div>
				<?php echo form_close();?>
				<br>
				<a href="#" data-toggle="modal" data-target="#forgot"> <?php echo $this->lang->line('login_forgot_password'); ?></a><br>
 			</div>
 		</div>
		<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('forgot_password_subheading'); ?></h4>
					</div>
					<?php echo form_open('#')?>
						<div class="modal-body">
							<div class="form-group">
								<label class="col-sm-2 col-sm-2 control-label"><?php echo $this->lang->line('forgot_password_email_identity_label'); ?></label>
								<?php echo form_error('email'); ?>
								<div class="col-sm-10">
									<input type="text" name="email" value="<?= set_value('email')?>"  class="form-control"><br>
								</div>
							</div><br><br><br>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-flat btn-default" data-dismiss="modal"><?php echo $this->lang->line('forgot_password_modal_close_btn'); ?></button>
							<button type="submit" name="submit" class="btn btn-flat <?php echo setting_all('buttons'); ?>"><?php echo $this->lang->line('forgot_password_submit_btn'); ?></button>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
 
 		<script src="<?php echo base_url();?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
 		<script src="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/admin/plugins/iCheck/icheck.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/noty/noty.js"></script>
   		<script src="<?php echo base_url(); ?>assets/js/init.js"></script>
   		<script src="<?php echo base_url(); ?>assets/ajax/login.js"></script>
         
		<script>
			$(function () {
				$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%'
				});
			});
		</script>
	</body>
</html>
