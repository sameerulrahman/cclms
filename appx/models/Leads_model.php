<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_lead($data) {
        return $this->db->insert('leads', $data);
    }
    public function courses() {
        $courses = [
            0 => "Web Development",
            1 => "Data Science",
            2 => "Digital Marketing",
            3 => "Graphic Design",
            4 => "Cyber Security"
        ];
        return $courses;
    }
    public function lead_status() {
        $status = [
            0 => "Active",
            1 => "Allocated",
            2 => "Lost"
        ];
        return $status;
    }
    public function classes() {
        $classes = [
            0  => 'First Standard',
            1  => 'Second Standard',
            2  => 'Third Standard',
            3  => 'Fourth Standard',
            4  => 'Fifth Standard',
            5  => 'Sixth Standard',
            6  => 'Seventh Standard',
            7  => 'Eighth Standard',
            8  => 'Ninth Standard',
            9  => 'Tenth Standard',
            10 => 'Eleventh Standard',
            11 => 'Twelfth Standard',
            12 => 'Diploma',
            13 => 'Undergraduate',
            14 => 'Graduate',
            15 => 'PostGraduate'
        ];
        return $classes;
    }
    public function get_all_leads() {
        if(!$this->ion_auth->in_group('admin')){
            $this->db->where('preferred_institute', $this->session->userdata('institute_id'));
        }
        $query = $this->db->get('leads');
        return $query->result_array();
    }
    public function update_lead($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('leads', $data);
    }
}