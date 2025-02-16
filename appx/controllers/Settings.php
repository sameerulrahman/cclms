<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  ci_starter
*
* Author: Kenean Alemayehu
*         keneanalemayehu50@gmail.com
*
* Repository: https://github.com/kenean-50/ci_starter
*
* Created:  03.14.2018
*
*/

class settings extends CI_Controller {
	
	function __construct()
	{
        parent::__construct(); 
		$this->load->model('Admin_model');	 
		$this->lang->load('auth');
     }
	 
	public function index () {
		
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			$data['title'] = 'settings';

			$this->load->view('admin/include/header');
			$this->load->view('admin/include/navbar');
			$this->load->view('admin/settings');
			$this->load->view('admin/include/footer');
		}
	}
	
	/**
	 * Add new image and placement
	 */
	public function add_image() {
		
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin())  
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			$config['upload_path']   = './files/web_images/';
			$config['allowed_types'] = "gif|jpg|jpeg|png";
			$config['max_size']		 = 0;
			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('userfile')){
				
				$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
				$this->load->view('admin/include/header');
				$this->load->view('admin/settings', $error);
				$this->load->view('admin/include/footer');
					
			}else{
				
				$data = array('upload_data' => $this->upload->data());
				$file_detail = array(
					'image_name' => $this->upload->data('file_name'),
					'placement'  => $this->input->post('placement')
					); 
				$this->Admin_model->upload('web_images', $file_detail);
				$this->session->set_flashdata('messagePr', 'Image uploaded successfully.');
				redirect( base_url().'settings/change/', 'refresh');
			}
		}
	}
	
	/**
	 * Change image
	 */
	public function change_image()
	{
		
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin())  
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			$config['upload_path']   = './files/web_images/';
			$config['allowed_types'] = "gif|jpg|jpeg|png";
			$config['max_size']		 = 0;
			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('userfile')){
				
				$error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
				$this->load->view('admin/include/header');
				$this->load->view('admin/settings', $error);
				$this->load->view('admin/include/footer');
					
			}else{
				
				$data = array('upload_data' => $this->upload->data());
				$image_name = array('image_name' => $this->upload->data('file_name')); 
				$this->Admin_model->update_row('images', 'id', $this->input->post('id'), $image_name);
				$this->session->set_flashdata('messagePr', 'Image updated successfully.');
				redirect('settings/', 'refresh');
			}
		}	
	}

	/**
	 * Delete image
	 */
	public function delete_image($id = '') 
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin())  
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			$this->Admin_model->delete_row('images', 'id', $id);
			$this->session->set_flashdata('messagePr' ,  'Image placement deleted successfully');
			redirect( base_url().'settings/change/', 'refresh');
		}
		
	}
		
	/**
	 * Create a new user
	 */
	public function users()
	{
		$this->data['title'] = $this->lang->line('create_user_heading');


		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('admin', 'refresh');
		}

		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');
		if ($identity_column !== 'email')
		{
			$this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
		}
		else
		{
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
		}
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
 		$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$email = strtolower($this->input->post('email'));
			$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone'),
 				'pic_name' => 'user.png'
			);
		}
		if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data))
		{
			// check to see if we are creating the user
			// redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("settings/users", 'refresh');
		}
		else
		{
			// display the create user form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array(
				'name' => 'first_name',
				'id' => 'first_name',
				'type' => 'text',
				'class'  => 'form-control',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name' => 'last_name',
				'id' => 'last_name',
				'type' => 'text',
				'class'  => 'form-control',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['identity'] = array(
				'name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'class'  => 'form-control',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['email'] = array(
				'name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'class'  => 'form-control',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array(
				'name' => 'company',
				'id' => 'company',
				'type' => 'text',
				'class'  => 'form-control',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone'] = array(
				'name' => 'phone',
				'id' => 'phone',
				'type' => 'text',
				'class'  => 'form-control',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['password'] = array(
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'class'  => 'form-control',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array(
				'name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'class'  => 'form-control',
				'value' => $this->form_validation->set_value('password_confirm'),
			);

             
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->load->view('admin/include/header');
			$this->load->view('admin/include/navbar');
			$this->load->view('admin/users', $this->data);
			$this->load->view('admin/include/footer');
		}
	}
	
	/**
	 * Delete user
	 */
	public function delete_user($id = "")
	{
		
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin())  
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			$this->ion_auth->delete_user($id);
			$this->session->set_flashdata('message' ,  'Account deleted successfully');
			redirect(base_url().'settings/users', 'refresh');
		}	
	}
	
	/**
	 * Create a new group
	 */
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('settings/change/', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'trim|required|alpha_dash');

		if ($this->form_validation->run() === TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if ($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('messagePr', $this->ion_auth->messages());
				redirect("settings/change/", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->load->view('admin/include/header');
			$this->load->view('admin/settings', $data);
			$this->load->view('admin/include/footer');
		}
	}

	/**
	 * Delete group
	 */
	public function delete_group($id = '') 
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin())  
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{	
			// Delete row having the same id as the passed in
			$this->Admin_model->delete_row('groups', 'id', $id);
			// Set success message in flashdata
			$this->session->set_flashdata('messagePr' ,  'Group deleted successfully');
			// Redirect user to settings page
			redirect( base_url().'settings/change/', 'refresh');
		}
		
	}

	/**
	 * Sidebar setting (collapse or not)
	 */
	public function sidebar()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin())  
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			// Check to see if current value is 1 (for collapse) or 0 (for default) 
			$status = $this->Admin_model->get_single_col('settings', 'name', 'sidebar', 'status');
			// Assign it to new vlaue depending on the previous one
			($status) ? $data = array('status' => '0') : $data = array('status' => '1');
			// Update database
			$this->Admin_model->update_row('settings', 'name', 'sidebar', $data);
		}
	}

	public function theme($skin = "", $box_headers="", $buttons="")
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin())  
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			$data1 = array('value' => $skin);
			$this->Admin_model->update_row('settings', 'name', 'skin', $data1);
			$data2 = array('value' => $box_headers);
			$this->Admin_model->update_row('settings', 'name', 'box_headers', $data2);
			$data3 = array('value' => $buttons);
			$this->Admin_model->update_row('settings', 'name', 'buttons', $data3);
		}
	}
}