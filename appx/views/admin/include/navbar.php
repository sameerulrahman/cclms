<!-- <aside class="main-sidebar">
 		<section class="sidebar">
 			<div class="user-panel">
				<div class="pull-left image">
                    <img data-src="<?php /* echo load_image($this->ion_auth->user()->row()->profile_image, 'files/profiles', 'user'); ?>" class="img-circle lazy user-loader">
 				</div>
				<div class="pull-left info">
					<p>
                        <?php
                            echo $this->ion_auth->user()->row()->first_name;
                            echo "  "; 
                            echo $this->ion_auth->user()->row()->last_name;
                        ?>
					</p>
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>			
 			<ul class="sidebar-menu" data-widget="tree">
				<li class="header"><?php echo get_phrase('main_navigation'); ?></li>
                <li class="<?php  echo ($this->uri->segment(2) == 'home') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url().'admin/home/'?>">
                        <i class="fa fa-dashboard"></i>
                        <span> <?php echo get_phrase('dashboard'); ?></span>
                    </a>
                </li>
				<li class="<?php  echo ($this->uri->segment(2) == 'edit_user') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url().'admin/edit_user/'.$this->ion_auth->user()->row()->id;?>">
                        <i class="fa fa-user"></i>
                        <span><?php echo get_phrase('profile'); ?></span>
                    </a>
				</li>

                <?php  if ($this->ion_auth->is_admin()): ?>	  
                <li class="<?php  echo ($this->uri->segment(2) == 'users') ? 'active' : ''; ?>" >
                    <a href="<?php echo base_url().'settings/users'?>">
                        <i class="fa fa-users"></i>
                        <span><?php echo get_phrase('users'); ?></span>
                        <span class="pull-right-container">
                            <?php $count = $this->Admin_model->record_count('users');?>
                            <small class="label label-primary pull-right"><?php echo $count; ?></small>
                        </span>
                    </a>
                </li>
                <?php endif; ?>	

		    	<?php  if ($this->ion_auth->is_admin()): ?>	  
				<li class="<?php  echo ($this->uri->segment(2) == 'change') ? 'active' : ''; ?>">
					<a href="<?php echo base_url().'settings/change/'?>">
                        <i class="fa fa-cogs"></i>
                        <span><?php echo get_phrase('settings'); ?></span>
					</a>
			    </li>
			    <?php endif; ?>

                <?php  if ($this->ion_auth->is_admin()): ?>	  
				<li class="<?php  echo ($this->uri->segment(1) == 'language') ? 'active' : ''; ?>">
					<a href="<?php echo base_url().'language/'?>">
                        <i class="fa fa-language"></i>
                        <span><?php echo get_phrase('languages'); ?></span>
					</a>
			    </li>
			    <?php endif; */ ?>
			</ul>
		</section>
 	</aside>
	 -->

<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="<?php echo base_url().'admin/home' ?>" class="brand-link">
        <!--begin::Brand Image-->
        <img
            src="<?php echo load_image($this->ion_auth->user()->row()->profile_image, 'files/profiles', 'user'); ?>"
            alt="Admin Logo"
            class="brand-image rounded-circle opacity-75 shadow"
        />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">
            <?php
                echo $this->ion_auth->user()->row()->first_name;
                echo "  "; 
                echo $this->ion_auth->user()->row()->last_name;
            ?>
        </span>
        <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            role="menu"
            data-accordion="false"
        >
            <li class="nav-item <?php echo ($this->uri->segment(2) == 'home') ? 'menu-open' : ''; ?>">
                <a href="<?php echo base_url().'admin/home/'?>" class="nav-link <?php echo ($this->uri->segment(2) === 'home') ? 'active' : ''; ?>">
                    <i class="nav-icon bi bi-speedometer"></i>
                    <p><?php echo ucfirst(get_phrase('dashboard')); ?></p>
                </a>
            </li>

            <li class="nav-item <?php echo ($this->uri->segment(2) == 'edit_user') ? 'menu-open' : ''; ?>">
                <a href="<?php echo base_url().'admin/edit_user/'.$this->ion_auth->user()->row()->id;?>" class="nav-link <?php echo ($this->uri->segment(2) === 'edit_user') ? 'active' : ''; ?>">
                    <i class="nav-icon bi bi-record-circle-fill"></i>
                    <p><?php echo ucfirst(get_phrase('profile')); ?></p>
                </a>
            </li>
            <li class="nav-item <?php echo ($this->uri->segment(2) == 'leads') ? 'menu-open' : ''; ?>">
                <a href="<?php echo base_url().'admin/leads'; ?>" class="nav-link <?php echo ($this->uri->segment(2) === 'leads') ? 'active' : ''; ?>">
                    <i class="nav-icon bi bi-clipboard-fill"></i>
                    <p>Leads</p>
                </a>
            </li>
            <?php  if ($this->ion_auth->is_admin()): ?>	 
            <li class="nav-item <?php echo ($this->uri->segment(2) == 'users') ? 'menu-open' : ''; ?>">
                <a href="<?php echo base_url().'settings/users'; ?>" class="nav-link <?php echo ($this->uri->segment(2) === 'users') ? 'active' : ''; ?>">
                    <i class="nav-icon bi bi-star-half"></i>
                    <?php $count = $this->Admin_model->record_count('users');?>
                    <p><?php echo ucfirst(get_phrase('users')); ?></p>
                    <p class="pull-right"><?php echo $count; ?></p>
                </a>
            </li>

            <li class="nav-item <?php echo ($this->uri->segment(2) == 'change') ? 'menu-open' : ''; ?>">
                <a href="<?php echo base_url().'settings/change/'; ?>" class="nav-link <?php echo ($this->uri->segment(2) === 'settings') ? 'active' : ''; ?>">
                    <i class="nav-icon bi bi-ui-checks-grid"></i>
                    <p><?php echo ucfirst(get_phrase('settings')); ?></p>
                </a>
            </li>

            <li class="nav-item <?php echo ($this->uri->segment(2) == 'language') ? 'menu-open' : ''; ?>">
                <a href="<?php echo base_url().'language/'; ?>" class="nav-link <?php echo ($this->uri->segment(2) === 'languages') ? 'active' : ''; ?>">
                    <i class="nav-icon bi bi-table"></i>
                    <p><?php echo ucfirst(get_phrase('languages')); ?></p>
                </a>
            </li>
            <?php endif; ?>	
        </ul>
        <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->