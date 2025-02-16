<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		$this->output->enable_profiler(FALSE);
		$this->load->model('Crud_model');
		$this->load->model('Admin_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load(array('ion_auth','auth'));
    }

    public function index(){

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
            $data['title'] = 'Language Management';

            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/include/navbar');
            $this->load->view('admin/language');
            $this->load->view('admin/include/footer');
        }

    }

    function change($language = 'english', $redirect_uri_1 = false, $redirect_uri_2 = false, $redirect_uri_3 = false)
	{
        $this->session->set_userdata('language', $language);
        
        if($redirect_uri_1 == false):
            redirect(base_url(), 'refresh');
        elseif($redirect_uri_1 != false && $redirect_uri_2 == false ):
            redirect(base_url($redirect_uri_1));
        elseif($redirect_uri_2 != false && $redirect_uri_3 == false ):
            redirect(base_url($redirect_uri_1.'/'.$redirect_uri_2));
        elseif($redirect_uri_3 != false):
            redirect(base_url($redirect_uri_1.'/'.$redirect_uri_2.'/'.$redirect_uri_3));
        endif;
 	}

    public function phrase($action = "", $param = null){

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
            if($action == 'add_phrase'):

                $phrase = $this->input->post('phrase');
                $this->form_validation->set_rules('phrase', 'Phrase', 'trim|required|alpha_dash');

                if($this->form_validation->run() == TRUE):
                    $data['phrase'] = $phrase;
                    $this->Crud_model->add('languages', $data);
                endif;
                $this->session->set_flashdata('message', 'Phrase successfully added');

            elseif($action == 'edit_phrase'):

                $id = $this->input->post('id');
                $language = $this->input->post('language');
                $translation =  $this->input->post('translation');
                $data[$language] = $translation;

                $this->Crud_model->update('languages', 'id', $id, $data);
                //$this->session->set_flashdata('message', 'Phrase successfully updated');
            
            elseif($action == 'delete'):

                $this->Crud_model->delete('languages', 'id', $param);
                $this->session->set_flashdata('message', 'Phrase successfully deleted');
                
            endif;
            redirect('language/', 'refresh');
         }
    }

    public function language_manage($action = "", $param = null){

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
            if($action == "add_language"):

                $language = $this->input->post('language');
                $this->form_validation->set_rules('language', 'Language', 'trim|required|alpha');

                if($this->form_validation->run() == TRUE):
                
                    $this->load->dbforge();
                    $field = array(
                        $language => array('type' => 'LONGTEXT')
                    );
                    $this->dbforge->add_column('languages', $field);
                else:
                    $this->session->set_flashdata('message_error', validation_errors());
                endif;

            elseif($action == 'delete_language'):

                $this->load->dbforge();
                $this->dbforge->drop_column('languages', $param);

            endif;
            redirect('language/', 'refresh');
        }
    }
}
