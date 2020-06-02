<?php

class ReservedTables_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ReservedTables_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
    }

    public function saveTable() {
        $data['title'] = 'Save Table';
        $data['user'] = $this->session->all_userdata();

        $this->load->view('templates/header', $data);
        $this->load->view('reservedTables/saveTable', $data);
        $this->load->view('templates/footer', $data);
    }

    public function saveTableNotes() {
        $validate = $this->validateReservation();
        if ($validate == "") {
            $gotData = array(
                'diner_name' => $this->input->post('diner_name'),
                'diner_phone' => $this->input->post('diner_phone'),
                'order_date' => $this->input->post('order_date'),
                'order_time' => $this->input->post('order_time'),
                'diners_number' => $this->input->post('diners_number'),
                'location' => $this->input->post('location'),
            );

            $info = $this->ReservedTables_model->setReservation($gotData);
            $reservation_number = $this->ReservedTables_model->getReservationNumber();

            if ($info == NULL) {
                $data['info'] = array("message" => $reservation_number[0]['MAX(order_number)']);
            } else {
                $data['info'] = array("message" => $info);
            }
            print_r($data['info']['message']);
        } else {
            echo $validate;
        }
    }

    public function validateReservation() {
        if ($_POST) {
            $error = "";
            if (!$_POST['diner_name'] || !$_POST['diner_phone'] || !$_POST['order_date'] || !$_POST['order_time'] || !$_POST['location']) {
                $error.="אין להשאיר שדות ריקים" . '<br>';
            }
            if (!preg_match("/^[א-ת ]*$/", $_POST['diner_name'])) {
                $error.="שם המזמין יכול להכיל אותיות בשפה העברית בלבד" . '<br>';
            }
            if (!preg_match("/^[0-9]*$/", $_POST['diner_phone']) || strlen($_POST['diner_phone']) != 10) {
                $error.="טלפון המזמין יכול להכיל 10 ספרות " . '<br>';
            }
            $orderDate = $_POST['order_date'];
            $today = date('Y-m-d');
            if ($orderDate < $today) {
                $error.="מועד ההזמנה חלף" . '<br>';
            }
            if ($orderDate==$today && $_POST['order_time']<time()){
                $error.="שעת ההזמנה חלפה" . '<br>';
            }
        }
        return $error;
    }

    public function tablesToChoose() {
        $data['title'] = 'Tables To Choose';
        $data['user'] = $this->session->all_userdata();
        $data['reservation_number'] = $this->input->get('reservation_number');
        $data['location'] = $this->input->get('location');
        $data['notes'] = $this->input->get('notes');
        $diners_number = $this->input->get('diners_number');
        if($this->input->get('currentTblNumber')){
            $data['currentTblNumber'] = $this->input->get('currentTblNumber');
        }
        
        if ($diners_number > 0 && $diners_number <= 2) {
            $data['diners_number'] = 2;
        }
        if ($diners_number >= 3 && $diners_number <= 4) {
            $data['diners_number'] = 4;
        }
        if ($diners_number >= 5 && $diners_number <= 6) {
            $data['diners_number'] = 6;
        }
        if ($diners_number > 6) {
            $data['diners_number'] = 8;
        }
        $data['relevant_tables'] = $this->ReservedTables_model->getRelevantTables($data['location'], $data['diners_number']);

        $this->load->view('templates/header', $data);
        $this->load->view('reservedTables/tablesToChoose', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tablesToChooseNotes() {
        $validate = $this->validateTable();
        if ($validate == "") {
            $gotData = array(
                'reservation_number' => $this->input->post('reservation_number'),
                'table_number' => $this->input->post('reservedTableNumber'),
                'notes' => $this->input->post('writeNotes'),
            );
            $info = $this->ReservedTables_model->setReservationTableNumber($gotData);
            if ($info == NULL) {
                $data['info'] = array("message" => "ההזמנה בוצעה");
            } else {
                $data['info'] = array("message" => $info);
            }
            print_r($data['info']['message']);
        } else {
            echo $validate;
        }
    }

    public function validateTable() {
        if ($_POST) {
            $error = "";
            if ($_POST['writeNotes']) {
                if (!preg_match("/^[0-9א-ת .,!?]*$/", $_POST['writeNotes'])) {
                    $error.="ההערות יכולות להכיל אותיות בשפה העברית בלבד" . '<br>';
                }
            }
        }
        return $error;
    }

    public function reservedTablesList() {
        $data['title'] = 'Reserved Tables List';
        $data['user'] = $this->session->all_userdata();
        $data['notExist'] = array("message" => "");
        $data['reservedTablesByDate'] = "";
        $data['pickedDate'] = date('Y-m-d');
        if (!$this->input->get('pickedDate')) {
            $data['reservedTablesByDate'] = $this->ReservedTables_model->reservedTablesByDate($data['pickedDate']);
        } else {
            $data['pickedDate'] = $this->input->get('pickedDate');
            $list = $this->ReservedTables_model->reservedTablesByDate($data['pickedDate']);
            if ($list) {
                $data['reservedTablesByDate'] = $list;
            } else {
                $data['notExist'] = array("message" => "לא קיימות הזמנות במועד זה");
            }
        }
        $this->load->view('templates/header', $data);
        $this->load->view('reservedTables/reservedTables', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editReservation() {
        $data['title'] = 'Reserved Tables List';
        $data['user'] = $this->session->all_userdata();
        $data['order_number']=$this->input->get('order_number');
        $data['order_info']=$this->ReservedTables_model->getResInfo($data['order_number']);

        $this->load->view('templates/header', $data);
        $this->load->view('reservedTables/editReservation', $data);
        $this->load->view('templates/footer', $data);
    }
    
    public function editResservationNotes(){
        $validate = $this->validateEditReservation();
        if ($validate == "") {
            $gotData = array(
                'diner_name' => $this->input->post('new_diner_name'),
                'diner_phone' => $this->input->post('new_diner_phone'),
                'order_date' => $this->input->post('new_order_date'),
                'order_time' => $this->input->post('new_order_time'),
                'diners_number' => $this->input->post('new_diners_number'),
                'location' => $this->input->post('new_location'),
                'order_number' => $this->input->post('order_number'),
            );

            $info = $this->ReservedTables_model->editReservation($gotData);

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

     public function validateEditReservation() {
        if ($_POST) {
            $error = "";
            if (!$_POST['new_diner_name'] || !$_POST['new_diner_phone'] || !$_POST['new_order_date'] || !$_POST['new_order_time'] || !$_POST['new_location']) {
                $error.="אין להשאיר שדות ריקים" . '<br>';
            }
            if (!preg_match("/^[א-ת ]*$/", $_POST['new_diner_name'])) {
                $error.="שם המזמין יכול להכיל אותיות בשפה העברית בלבד" . '<br>';
            }
            if (!preg_match("/^[0-9]*$/", $_POST['new_diner_phone']) || strlen($_POST['new_diner_phone']) != 10) {
                $error.="טלפון המזמין יכול להכיל 10 ספרות " . '<br>';
            }
            $orderDate = new DateTime($_POST['new_order_date']);
            $today = new DateTime();
            if ($orderDate < $today) {
                $error.="מועד ההזמנה עבר" . '<br>';
            }
        }
        return $error;
    }
}
