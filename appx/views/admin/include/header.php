<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="<?= base_url()?>files/web_images/<?php echo web_image('favicon'); ?>">
	<title>CI Starter |  </title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/select2/dist/css/select2.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/pace/pace.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<style>

		img.user-thumb-loader {
			width: 35px; 
			height: 35px; 
			background-image: url('<?php echo base_url("files/web_images/" . web_image("user-thumb-loader")); ?>');
			background-repeat: no-repeat;
			background-position: 50% 50%;
		}

		img.user-loader {
			width: 50%; 
			height: 50%; 
			background-image: url('<?php echo base_url("files/web_images/" . web_image("user-loader")); ?>');
			background-repeat: no-repeat;
			background-position: 50% 50%;
		}

	</style>
</head>
<body class="hold-transition <?php echo setting_all('skin'); ?> <?php echo setting_all('sidebar'); ?> sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<a href="<?php echo base_url();?>" class="logo">
			<span class="logo-mini"><b>C</b>I</span>
			<span class="logo-lg">CI Starter</span>
		</a>
		<nav class="navbar navbar-static-top">
			<a href="#"  class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  							<img data-src="<?php echo load_image($this->ion_auth->user()->row()->profile_image, 'files/profiles', 'user-thumb'); ?>" class="user-image lazy user-thumb-loader">
							<span class="hidden-xs">
								<?php
									echo $this->ion_auth->user()->row()->first_name;
									echo "  "; 
									echo $this->ion_auth->user()->row()->last_name;
								?>
							</span>
						</a>
						<ul class="dropdown-menu">
 							<li class="user-header">
								<img src="<?php echo base_url() ?>files/profiles/<?php echo $this->ion_auth->user()->row()->profile_image; ?>" class="img-circle" alt="User Image">
								<p>
									<?php
										echo $this->ion_auth->user()->row()->first_name;
										echo "  "; 
										echo $this->ion_auth->user()->row()->last_name;
									?>
									<small>Member since Nov. 2012</small>
								</p>
							</li>
 							<li class="user-footer">
								<div class="pull-left">
									<a href="<?php echo base_url().'admin/edit_user/'.$this->ion_auth->user()->row()->id;?>" class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
									<a href="<?= base_url().'admin/logout'?>" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	