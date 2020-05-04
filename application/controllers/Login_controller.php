<?php

class Login_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
    }

    public function login() {
        $data['title'] = 'Sign in';
        $data['user'] = NULL;

        $this->load->view('templates/header', $data);
        $this->load->view('login/login', $data);
        $this->load->view('templates/footer', $data);
    }

    public function auth() {
        $validate = $this->validateSignIn();
        if ($validate == "") {
            $data = array(
                'id' => $this->input->post('id'),
                'password' => md5($this->input->post('password')),
            );
            $result = $this->Login_model->auth($data);

            if ($result == false) {
                $data['user'] = NULL;
                $data['message'] = array("message" => "המשתמש לא נמצא");
            } else {
                $data['user'] = $result;
                $this->session->set_userdata($data);
                $data['message'] = array("message" => "1");
            }
            echo $data['message']['message'];
        } else {
            echo $validate;
        }
    }

    public function logout() {
        $data = array(
            'id',
            'password'
        );
        $this->session->unset_userdata($data);
        redirect("Login_controller/login");
    }

    public function addNewEmployee() {
        $data['title'] = 'New employee';
        $data['user']=$this->session->all_userdata();
        
        $this->load->view('templates/header',$data);
        $this->load->view('employeesManagement/addNewEmployee', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addNewEmployeeNotes() {
        $validate = $this->validateNewEmployee();
        if ($validate == "") {
            $gotData = array(
                'id' => $this->input->post('id'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'type' => $this->input->post('etype'),
                'password' => md5($this->input->post('password')),
                'passwordConf' => md5($this->input->post('passwordConf')),
                'phone' => $this->input->post('phone'),
            );

            $info = $this->Login_model->setUser($gotData);

            if ($info == NULL) {
                $data['info'] = array("message" => "1");
            } else {
                $data['info'] = array("message" => "העובד קיים במערכת");
            }
            echo $data['info']['message'];
        } else {
            echo $validate;
        }
    }

    public function validateNewEmployee() {
        if ($_POST) {
            $error = "";
            if (!$_POST['id'] || !$_POST['first_name'] || !$_POST['last_name'] || !$_POST['etype'] || !$_POST['password'] || !$_POST['passwordConf'] || !$_POST['phone']) {
                $error.="אין להשאיר שדות ריקים" . '<br>';
            }
            if (!preg_match("/^[0-9 ]*$/", $_POST['id'])) {
                $error.="תעודת הזהות יכולה להכיל ספרות בלבד" . '<br>';
            }
            if ($_POST['id']) {
                if (strlen($_POST['id']) != 9) {
                    $error.="תעודת הזהות חייבת להכיל 9 ספרות" . '<br>';
                }
            }
            if (!preg_match("/^[א-ת ]*$/", $_POST['first_name'])) {
                $error.="השם הפרטי יכול להכיל אותיות בשפה העברית בלבד" . '<br>';
            }
            if (!preg_match("/^[א-ת ]*$/", $_POST['last_name'])) {
                $error.="שם המשפחה יכול להכיל אותיות בשפה העברית בלבד" . '<br>';
            }
            if (!preg_match("/^[0-9 ]*$/", $_POST['phone'])) {
                $error.="מספר הטלפון יכול להכיל מספרים בלבד" . '<br>';
            }
            if ($_POST['phone']) {
                if (strlen($_POST['phone']) != 10) {
                    $error.="מספר הטלפון חייב להכיל 10 ספרות" . '<br>';
                }
            }
        }
        return $error;
    }

    public function validateSignIn() {
        if ($_POST) {
            $error = "";
            if (!$_POST['id'] || !$_POST['password']) {
                $error.="אין להשאיר שדות ריקים" . '<br>';
            }
            if (!preg_match("/^[0-9 ]*$/", $_POST['id'])) {
                $error.="תעודת הזהות יכולה להכיל ספרות בלבד" . '<br>';
            }
            if ($_POST['id']) {
                if (strlen($_POST['id']) != 9) {
                    $error.="תעודת הזהות חייבת להכיל 9 ספרות" . '<br>';
                }
            }
        }
        return $error;
    }

}
