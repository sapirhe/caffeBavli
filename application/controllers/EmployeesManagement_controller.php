<?php

class EmployeesManagement_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EmployeesManagement_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
    }
    public function editEmployees(){
        $data['title'] = 'Tables Map';
        $data['user'] = $this->session->all_userdata();

        $this->load->view('templates/header', $data);
        $this->load->view('employeesManagement/editEmployees', $data);
        $this->load->view('templates/footer', $data);
    }
}


