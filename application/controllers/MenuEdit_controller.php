<?php

class MenuEdit_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MenuEdit_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
    }

    public function updateMenu() {
        $data['title'] = 'Update Menu';
        $data['user'] = $this->session->all_userdata();
        $data['breakfast'] = $this->MenuEdit_model->getBreakfast();
        $data['sandwiches'] = $this->MenuEdit_model->getSandwiches();
        $data['toasts'] = $this->MenuEdit_model->getToasts();
        $data['salads'] = $this->MenuEdit_model->getSalads();
        $data['lunch'] = $this->MenuEdit_model->getLunch();
        $data['deserts'] = $this->MenuEdit_model->getDeserts();
        $data['drinks'] = $this->MenuEdit_model->getDrinks();

        $this->load->view('templates/header', $data);
        $this->load->view('editMenu/updateMenu', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addItem() {
        $data['title'] = 'Add Item';
        $data['user'] = $this->session->all_userdata();

        $this->load->view('templates/header', $data);
        $this->load->view('editMenu/addItem', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addItemNotes() {
        $validate = $this->validateNewItem();
        if ($validate == "") {
            $gotData = array(
                'item_name' => $this->input->post('item_name'),
                'description' => $this->input->post('description'),
                'price' => $this->input->post('price'),
                'executer' => $this->input->post('execType'),
                'section' => $this->input->post('section'),
            );

            $info = $this->MenuEdit_model->setItem($gotData);

            if ($info == NULL) {
                $data['info'] = array("message" => "1");
            } else {
                $data['info'] = array("message" => "הפריט קיים בתפריט");
            }
            echo $data['info']['message'];
        } else {
            echo $validate;
        }
    }

    public function validateNewItem() {
        if ($_POST) {
            $error = "";
            if (!$_POST['item_name'] || !$_POST['price'] || !$_POST['execType'] || !$_POST['section']) {
                $error.="אין להשאיר שדות ריקים, מלבד התיאור" . '<br>';
            }
            if (!preg_match("/^[א-ת ]*$/", $_POST['item_name'])) {
                $error.="שם המנה יכול להכיל אותיות בשפה העברית בלבד" . '<br>';
            }
            if ($_POST['description']) {
                if (!preg_match("/^[0-9א-ת .,!()-]*$/", $_POST['description'])) {
                    $error.="תיאור המנה לא יכול להכיל אותיות בשפה האנגלית " . '<br>';
                }
            }
            if (!preg_match("/^[0-9 ]*$/", $_POST['price'])) {
                $error.="מחיר המנה יכול להכיל ספרות בלבד" . '<br>';
            }
        }
        return $error;
    }

    public function deleteItem() {
        $itemToDelete = $this->input->get('item_name');
        $this->MenuEdit_model->deleteItem($itemToDelete);
        redirect('MenuEdit_controller/updateMenu');
    }

    public function editItem() {
        $data['title'] = 'Edit Item';
        $data['user'] = $this->session->all_userdata();
        $itemToEdit = $this->input->get('item_name');
        $data['itemToEdit'] = $this->MenuEdit_model->itemToEdit($itemToEdit);

        $this->load->view('templates/header', $data);
        $this->load->view('editMenu/editItem', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editItemNotes() {
        $validate = $this->validateEditItem();
        if ($validate == "") {
            $c_item_name = $this->input->post('c_item_name');
            $new_item_name = $this->input->post('new_item_name');
            $new_description = $this->input->post('new_description');
            $new_price = $this->input->post('new_price');
            $new_execType = $this->input->post('new_execType');
            $new_section = $this->input->post('new_section');


            $check = $this->MenuEdit_model->editItem($c_item_name, $new_item_name, $new_description, $new_price, $new_execType, $new_section);
            if ($check == NULL) {
                echo "1";
            } else {
                echo "לא ניתן לשמור את השינויים";
            }
        } else {
            echo $validate;
        }
    }

    public function validateEditItem() {
        if ($_POST) {
            $error = "";
            if (!$_POST['new_item_name'] || !$_POST['new_price']) {
                $error.="אין להשאיר שדות ריקים, מלבד התיאור" . '<br>';
            }
            if (!preg_match("/^[א-ת ]*$/", $_POST['new_item_name'])) {
                $error.="שם המנה יכול להכיל אותיות בשפה העברית בלבד" . '<br>';
            }
            if ($_POST['new_description']) {
                if (!preg_match("/^[0-9א-ת ,.!()-]*$/", $_POST['new_description'])) {
                    $error.="תיאור המנה לא יכול להכיל אותיות בשפה האנגלית " . '<br>';
                }
            }
            if (!preg_match("/^[0-9 .]*$/", $_POST['new_price'])) {
                $error.="מחיר המנה יכול להכיל ספרות בלבד" . '<br>';
            }
        }
        return $error;
    }

}
