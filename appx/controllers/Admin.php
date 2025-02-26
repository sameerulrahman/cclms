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

class Admin extends CI_Controller {
	
	function __construct()
	{
        parent::__construct(); 
		$this->load->model('Admin_model');	
		$this->load->helper('file');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load(array('ion_auth','auth'));
    }

	/**
	 * Admin home page aka dashboard
	 */
	public function index()
	{	
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/login', 'refresh');
		}
		else if (!$this->ion_auth->in_group('members'))  
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{	
			$this->data['title'] = $this->lang->line('login_heading');

			// render page
			$this->load->view('admin/include/header');
			$this->load->view('admin/include/navbar');
			$this->load->view('admin/dashboared');
			$this->load->view('admin/include/footer');
		}
	}
	
	/**
	 * Log the user in
	 */
	public function login()
	{
		$this->data['title'] = $this->lang->line('login_heading');

		// validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() === TRUE)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect( base_url().'admin/', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('admin/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			
			$this->load->view('admin/login',$data);
 		}
	}

	/**
	 * Log the user out
	 */
	public function logout()
	{
		$data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('admin/login', 'refresh');
	}
	
	/**
	 * Edit users
	 */
    public function edit_user($id = "")
	{
		$title = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('admin', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{  
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				// profile pic configration
				$config['upload_path']   = './files/profiles/';
				$config['allowed_types'] = "gif|jpg|jpeg|png";
				$config['max_size']      = 0;
				$this->load->library('upload', $config);

				// check if upload is success
				if($this->upload->do_upload('userfile'))
				{
					$data = array('upload_data' => $this->upload->data());

					//Resize user profile picture squire
					$img_config['image_library'] = 'gd2';
					$img_config['source_image'] = './files/profiles/'.$this->upload->data('file_name');
					$img_config['maintain_ratio'] = FALSE;
					$img_config['width'] = 124;
					$img_config['height'] = 124;
	
					$this->load->library('image_lib');
					$this->image_lib->initialize($img_config);
					$this->image_lib->resize();
					
					//Resize user profile picture thumb
					// $img_config2['image_library'] = 'gd2';
					// $img_config2['source_image'] = './files/profiles/'.$this->upload->data('file_name');
					// $img_config2['maintain_ratio'] = FALSE;
					// $img_config2['create_thumb'] = TRUE;
					// $img_config2['new_image'] = './files/profiles/thumb/'.$this->upload->data('file_name');
					// $img_config2['width'] = 35;
					// $img_config2['height'] = 35;
	
					// $this->image_lib->initialize($img_config2);
					// $this->image_lib->resize();
				}
				else
				{	
					// display if there is error
					$data['message'] = array('message' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
					$this->load->view('admin/include/header');
					$this->load->view('admin/profile', $data);
					$this->load->view('admin/include/footer');		
				}
				if($this->upload->data('file_name'))
				{	
					// get the pic name
					$profile_image = $this->upload->data('file_name');
				}
				else
				{
					// if there is no new file assign it to the old one
					$profile_image = $this->ion_auth->user()->row()->profile_image;
				}
			
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone'),
					'profile_image'	 => $profile_image,
				);
				
				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					// Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData))
					{
						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp)
						{
							$this->ion_auth->add_to_group($grp, $id);
						}
					}
				}

				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data))
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->messages());

					if($this->ion_auth->user()->row()->id == $id)
					{
						// redirect to profile page 
						redirect('admin/edit_user/'.$id,'refresh');
					}
					else
					{
						// redirect to users page
						redirect('settings/users/', 'refresh');
					}
				}
				else
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->errors());

					redirect('settings/users/', 'refresh');
				}

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'class'  => 'form-control',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'class'  => 'form-control',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'class'  => 'form-control',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'class'  => 'form-control',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['userfile'] = array(
			'name' => 'userfile',
			'id'   => 'userfile',
			'type' => 'file',
			'class'  => 'form-control'
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			'class'  => 'form-control'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			'class'  => 'form-control'
		);
		$this->data['profile_image'] = $user->profile_image;
		$this->data['full_name'] = $user->first_name.' '.$user->last_name;

		$this->load->view('admin/include/header');
		$this->load->view('admin/include/navbar');
		$this->load->view('admin//profile',$this->data);
		$this->load->view('admin/include/footer');
	}
	 
	/**
	 * Deactivate users
	 */
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$this->ion_auth->deactivate($id);
		$this->session->set_flashdata('message', $this->ion_auth->errors());
		$this->session->set_flashdata('message', 'User Deactivated Successfuly');
		redirect('settings/users', 'refresh');
 	}
	
	
	/**
	 * Activate users
	 */
	public function activate($id, $code = FALSE)
	{
		if ($code !== FALSE)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', 'User account activated successfuly');
			redirect("settings/users", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}


    /**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')){
			return TRUE;
		}
			return FALSE;
	}

	public function get_all_leads(){
		$data['leads'] = $this->Admin_model->get_all_leads();
		$this->load->view('admin/include/header');
		$this->load->view('admin/include/navbar');
		$this->load->view('admin/leads',$data);
		$this->load->view('admin/include/footer');
	}
	
}