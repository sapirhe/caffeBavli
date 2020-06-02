<?php

class EmployeesManagement_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function getEmployees(){
        $query = $this->db->query("select * from users ORDER BY user_number ASC");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }
    
    function getEmployeeToEdit($employee_number){
        $query = $this->db->query("select * from users where user_number=".$employee_number);
        if ($query) {
            return $query->result_array();
        }
        return false;
    }
    
    function editEmployee($data){
        $this->db->db_debug = FALSE;
        $error = NULL;

        if (!$this->db->query("UPDATE users SET id = '" . $data['id'] . "', first_name = '" . $data['first_name'] . "', last_name = '" . $data['last_name'] . "', type = '" . $data['etype'] . "', phone = '" . $data['phone'] . "' WHERE user_number = '" . $data['user_number'] . "'")) {
            $error = $this->db->error();
        }
        return $error;
    }
    
    function editPassword($data){
        $this->db->db_debug = FALSE;
        $error = NULL;

        if (!$this->db->query("UPDATE users SET password = '" . $data['password'] . "', passwordConf = '" . $data['passwordConf'] . "' WHERE user_number = '" . $data['user_number'] . "'")) {
            $error = $this->db->error();
        }
        return $error;
    }
}