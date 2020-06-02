<?php

class EmployeesManagement_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EmployeesManagement_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
    }

    public function editEmployees() {
        $data['title'] = 'Employees List';
        $data['user'] = $this->session->all_userdata();
        $data['employees'] = $this->EmployeesManagement_model->getEmployees();

        $this->load->view('templates/header', $data);
        $this->load->view('employeesManagement/editEmployees', $data);
        $this->load->view('templates/footer', $data);
    }

    public function employeeEdit() {
        $data['title'] = 'Edit Employee';
        $data['user'] = $this->session->all_userdata();
        $employee_number = $this->input->get('employee_number');
        $data['employeeToEdit'] = $this->EmployeesManagement_model->getEmployeeToEdit($employee_number);

        $this->load->view('templates/header', $data);
        $this->load->view('employeesManagement/employeeEdit', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editEmployeeNotes() {
        $validate = $this->validateEditEmployee();
        if ($validate == "") {
            $gotData = array(
                'user_number' => $this->input->post('employee_number'),
                'id' => $this->input->post('new_id'),
                'first_name' => $this->input->post('new_first_name'),
                'last_name' => $this->input->post('new_last_name'),
                'etype' => $this->input->post('new_etype'),
                'phone' => $this->input->post('new_phone'),
            );

            $info = $this->EmployeesManagement_model->editEmployee($gotData);

            if ($info == NULL) {
                $data['info'] = array("message" => "1");
            } else {
                $data['info'] = array("message" => $info);
            }
            print_r($data['info']['message']);
        } else {
            echo $validate;
        }
    }

    public function validateEditEmployee() {
        if ($_POST) {
            $error = "";
            if (!$_POST['new_id'] || !$_POST['new_first_name'] || !$_POST['new_last_name'] || !$_POST['new_phone']) {
                $error.="אין להשאיר שדות ריקים" . '<br>';
            }
            if (!preg_match("/^[0-9 ]*$/", $_POST['new_id'])) {
                $error.="תעודת הזהות יכולה להכיל ספרות בלבד" . '<br>';
            }
            if ($_POST['new_id']) {
                if (strlen($_POST['new_id']) != 9) {
                    $error.="תעודת הזהות חייבת להכיל 9 ספרות" . '<br>';
                }
            }
            if (!preg_match("/^[א-ת ]*$/", $_POST['new_first_name'])) {
                $error.="השם הפרטי יכול להכיל אותיות בשפה העברית בלבד" . '<br>';
            }
            if (!preg_match("/^[א-ת ]*$/", $_POST['new_last_name'])) {
                $error.="שם המשפחה יכול להכיל אותיות בשפה העברית בלבד" . '<br>';
            }
            if (!preg_match("/^[0-9 ]*$/", $_POST['new_phone'])) {
                $error.="מספר הטלפון יכול להכיל מספרים בלבד" . '<br>';
            }
            if ($_POST['new_phone']) {
                if (strlen($_POST['new_phone']) != 10) {
                    $error.="מספר הטלפון חייב להכיל 10 ספרות" . '<br>';
                }
            }
        }
        return $error;
    }
    
    public function editPassword() {
        $data['title'] = 'Edit Password';
        $data['user'] = $this->session->all_userdata();
        $userToEdit=$this->input->get('user_number');
        $data['employeeToEdit'] = $this->EmployeesManagement_model->getEmployeeToEdit($userToEdit);

        $this->load->view('templates/header', $data);
        $this->load->view('employeesManagement/editPassword', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editPasswordNotes() {
        $gotData = array(
            'user_number' => $this->input->post('employee_number'),
            'password' =>  md5($this->input->post('new_password')),
            'passwordConf' =>  md5($this->input->post('new_passwordConf')),
        );

        $info = $this->EmployeesManagement_model->editPassword($gotData);

        if ($info == NULL) {
            $data['info'] = array("message" => "1");
        } else {
            $data['info'] = array("message" => $info);
        }
        print_r($data['info']['message']);
    }

}
