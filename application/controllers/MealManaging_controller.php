<?php

class MealManaging_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MealManaging_model');
        $this->load->model('MenuEdit_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
    }

    public function tablesMap() {
        $data['title'] = 'Tables Map';
        $data['user'] = $this->session->all_userdata();
        $data['outsideTables'] = $this->MealManaging_model->outsideTables();
        $data['insideTables'] = $this->MealManaging_model->insideTables();

        $this->load->view('templates/header', $data);
        $this->load->view('mealManaging/tablesMap', $data);
        $this->load->view('templates/footer', $data);
    }

    public function takingOrder() {
        $data['title'] = 'Taking Order';
        $data['user'] = $this->session->all_userdata();
        $data['table_number'] = $this->input->get('table_number');
        $data['table_info'] = $this->MealManaging_model->getTableInfo($data['table_number']);
        if ($data['table_info'][0]['availability'] == "פנוי") {
            $data['order_info'] = $this->MealManaging_model->creatOrder($data['table_number']);
        } else {
            $data['order_info'] = $this->MealManaging_model->getOrderInfo($data['table_number']);
        }
        $order_sum = $this->MealManaging_model->getOrderSum($data['order_info'][0]['order_number']);
        if ($order_sum) {
            $data['orderSum'] = $order_sum;
        }
        if ($this->input->get('tab_id')) {
            $data['tab_id'] = $this->input->get('tab_id');
        }
        $data['breakfast'] = $this->MenuEdit_model->getBreakfast();
        $data['sandwiches'] = $this->MenuEdit_model->getSandwiches();
        $data['toasts'] = $this->MenuEdit_model->getToasts();
        $data['salads'] = $this->MenuEdit_model->getSalads();
        $data['lunch'] = $this->MenuEdit_model->getLunch();
        $data['deserts'] = $this->MenuEdit_model->getDeserts();
        $data['drinks'] = $this->MenuEdit_model->getDrinks();
        $data['items_in_order'] = $this->MealManaging_model->getOrderItems($data['order_info'][0]['order_number']);

        $this->load->view('templates/header', $data);
        $this->load->view('mealManaging/takingOrder', $data);
        $this->load->view('templates/footer', $data);
    }

    public function saveOrder() {
        $gotData = array(
            'order_number' => $this->input->post('order_number'),
            'item_name' => $this->input->post('item_name'),
            'notes' => $this->input->post('notes'),
        );

        $itemNumber = $this->MealManaging_model->setItemInOrder($gotData);
        $data['tab_id'] = $this->input->post('tab_id');
        echo $data['tab_id'];
    }

    public function deleteItemOrder() {
        $itemToDelete = $this->input->post('item_number_to_delete');
        $data['tab_id'] = $this->input->post('tab_id');
        $this->MealManaging_model->deleteItem($itemToDelete);
        echo $data['tab_id'];
    }

    public function preparation() {
        $table_number = $this->input->get('table_number');
        $order_number = $this->input->get('order_number');
        $info = $this->MealManaging_model->occupidTable($table_number, $order_number);
        redirect('MealManaging_controller/tablesMap');
    }

    public function closingOrder() {
        $table_number = $this->input->get('table_number');
        $this->MealManaging_model->closingOrder($table_number);
        redirect('MealManaging_controller/tablesMap');
    }

    public function ordersToPreper() {
        $data['title'] = 'Orders To Preper';
        $data['user'] = $this->session->all_userdata();
        $data['barmanOrders'] = $this->MealManaging_model->getBarmanOrders();
        $data['shefOrders'] = $this->MealManaging_model->getShefOrders();
        $data['barmanOrdersNumbers'] = $this->MealManaging_model->getBarmanOrdersNumbers();
        $data['shefOrdersNumbers'] = $this->MealManaging_model->getShefOrdersNumbers();

        $this->load->view('templates/header', $data);
        $this->load->view('mealManaging/ordersToPreper', $data);
        $this->load->view('templates/footer', $data);
    }

    public function orderComplete() {
        $orderNumber = $this->input->get('order_number');
        $this->MealManaging_model->orderComplete($orderNumber);
        redirect('MealManaging_controller/ordersToPreper');
    }

    public function clear() {
        $orderNumber = $this->input->get('order_number');
        $tableNumber = $this->input->get('table_number');
        $this->MealManaging_model->clear($orderNumber, $tableNumber);
        redirect('MealManaging_controller/tablesMap');
    }

    public function payment() {
        $data['title'] = 'Orders To Preper';
        $data['user'] = $this->session->all_userdata();
        $data['orderNumber'] = $this->input->get('order_number');
        $data['order_sum'] = $this->MealManaging_model->getOrderSum($data['orderNumber']);
        $data['table_number'] = $this->input->get('table_number');

        $this->load->view('templates/header', $data);
        $this->load->view('mealManaging/paymentPage', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getMailForReceipt() {
        $data['title'] = 'Send Reciept';
        $data['user'] = $this->session->all_userdata();
        $data['total']=$this->input->get('total');
        $data['order_number']=$this->input->get('order_number');
        $data['table_number']=$this->input->get('table_number');

        $this->load->view('templates/header', $data);
        $this->load->view('mealManaging/getMailForReciept', $data);
        $this->load->view('templates/footer', $data);
    }

    public function validateMailNotes() {
        if ($_POST) {
            $error = "";
            if ($_POST['emailForReceipt'] && !filter_var($_POST['emailForReceipt'], FILTER_VALIDATE_EMAIL)) {
                $error .= "האימייל אינו תקין" . '<br>';
            }
        }
        if ($error == "") {
            echo "1";
        } else {
            echo $error;
        }
    }

    public function sendReceipt() {
        $emailForReceipt = $this->input->get('emailForReceipt');
        $total=$this->input->get('total');
        $order_number=$this->input->get('order_number');
        $table_number=$this->input->get('table_number');
        $to = $emailForReceipt;
        $subject = "קפה בבלי - קבלה מיום ".date('Y-m-d');

        $message = "
<html>
<head>
<title>קפה בבלי - קבלה מיום ". date('d-m-y') ."</title>
</head>
<body>
<div style='text-align: center; border: 5px double red;'>
<h2>קפה בבלי - קבלה מיום ". date('d-m-y') ."</h2>
<h5>תודה שביקרת ב'קפה בבלי', שמחנו לארח אותך!</h5>
<p>
סך התשלום שהתקבל: <b>".$total. " ש''ח</b><br>
</P>
<h5>נשמח לראותך שוב בקרוב,<br>קפה בבלי (:</h5>
</div>
</body>
</html>
";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: caffebavli@gmail.com';

        mail($to, $subject, $message, $headers);
        
        redirect("MealManaging_controller/payment?table_number=" . $table_number . "&order_number=" . $order_number);
        
    }

}
