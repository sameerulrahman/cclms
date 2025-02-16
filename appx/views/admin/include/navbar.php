<aside class="main-sidebar">
 		<section class="sidebar">
 			<div class="user-panel">
				<div class="pull-left image">
                    <img data-src="<?php echo load_image($this->ion_auth->user()->row()->profile_image, 'files/profiles', 'user'); ?>" class="img-circle lazy user-loader">
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
			    <?php endif; ?>
			</ul>
		</section>
 	</aside>
	