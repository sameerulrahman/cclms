<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Leads_model');
        $this->load->model('Crud_model');
    }
    public function create() {
        $data['institutes'] = $this->Crud_model->get('institutes');
        $data['courses'] = $this->Leads_model->courses();
        $data['classes'] = $this->Leads_model->classes();
        $this->load->view('admin/leads_form',$data); // Load the view
    }
    public function store() {
        $data = [
            'name'               => $this->input->post('name'),
            'address'            => $this->input->post('address'),
            'phone_number'       => $this->input->post('phone_number'),
            'school'             => $this->input->post('school'),
            'class'              => $this->input->post('class'),
            'student_notes'      => $this->input->post('student_notes'),
            'preferred_institute'=> $this->input->post('preferred_institute'),
            'preferred_course'   => $this->input->post('preferred_course'),
            'institute_id'       => $this->input->post('preferred_institute'),
            'status'             => (!empty($this->input->post('preferred_institute'))) ? 1 : 0 
        ];

        if ($this->Leads_model->insert_lead($data)) {
            $this->session->set_flashdata('success', 'Details submitted successfully.');
            redirect('leads/student_form');
        } else {
            echo "Failed to submit lead.";
        }
    }
    public function update_lead($id) {
        $data = [
            'name'               => $this->input->post('name'),
            'address'            => $this->input->post('address'),
            'phone_number'       => $this->input->post('phone_number'),
            'school'             => $this->input->post('school'),
            'class'              => $this->input->post('class'),
            'preferred_institute'=> $this->input->post('preferred_institute'),
            'preferred_course'   => $this->input->post('preferred_course'),
            'institute_id'       => $this->input->post('preferred_institute'),
            'status'             => $this->input->post('status')
        ];

        if ($this->Leads_model->update_lead($id,$data)) {
            $this->session->set_flashdata('success', 'Details updated successfully.');
            redirect('admin/leads');
        } else {
            $this->session->set_flashdata('failure', 'Details updating failed.');
            redirect('admin/leads');
        }
    }
}