<?php

class MealManaging_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insideTables() {
        $query = $this->db->query("select * from tables where location='בפנים'");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    public function outsideTables() {
        $query = $this->db->query("select * from tables where location='בחוץ'");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    public function checkExistingOrder($table_number) {
        $query = $this->db->query("select * from orders where table_number='" . $table_number . "' and payment_status='לא שולם'");
        if ($query) {
            return true;
        }
        return false;
    }

    public function creatOrder($table_number) {

        $this->db->query("insert into orders (payment_status, table_number) values('לא שולם'," . $table_number . " )");
        $this->db->query("update tables set availability='בהמתנה' where table_number='" . $table_number . "'");
        $query = $this->db->query("select * from orders where table_number='" . $table_number . "' and payment_status='לא שולם'");

        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    public function getOrderInfo($table_number) {
        $query = $this->db->query("select * from orders where table_number='" . $table_number . "' and payment_status='לא שולם'");

        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    public function closingOrder($table_number) {
        $this->db->query("update orders set payment_status='שולם' where table_number='" . $table_number . "'");
        $this->db->query("update tables set availability='פנוי' where table_number='" . $table_number . "'");
    }

    public function getTableInfo($table_number) {
        $query = $this->db->query("select * from tables where table_number='" . $table_number . "'");

        if ($query) {
            return $query->result_array();
        }
    }

    public function occupidTable($table_number, $order_number) {
        $this->db->query("update tables set availability='תפוס' where table_number='" . $table_number . "'");
        $this->db->query("update iteminorder set sent='נשלח' where order_number='" . $order_number . "'");

    }

    public function setItemInOrder($data) {
        $this->db->query("insert into itemInOrder (order_number, item_name, notes, sent) values('" . $data['order_number'] . "','" . $data['item_name'] . "','" . $data['notes'] . "','לא נשלח' )");
        $item_number = $this->db->query("select MAX(item_number) from itemInOrder");
        if ($item_number) {
            return $item_number->result_array();
        }
        return false;
    }

    public function getOrderItems($order_number) {
        $query = $this->db->query("select * from itemInOrder where order_number='" . $order_number . "'");

        if ($query) {
            return $query->result_array();
        }
        return false;
    }
    public function deleteItem($itemToDelete){
        $this->db->query("delete from iteminorder where item_number='".$itemToDelete."'");
    }
    public function getBarmanOrdersNumbers(){
        $query = $this->db->query("select distinct orders.order_number from menu inner join iteminorder on menu.item_name=iteminorder.item_name inner join orders on orders.order_number=iteminorder.order_number where executer='ברמן' and sent='נשלח' ORDER BY time ASC");

        if ($query) {
            return $query->result_array();
        }
        return false;
    }
     public function getBarmanOrders(){
         $query = $this->db->query("select * from menu inner join iteminorder on menu.item_name=iteminorder.item_name inner join orders on orders.order_number=iteminorder.order_number where executer='ברמן' and sent='נשלח'");

        if ($query) {
            return $query->result_array();
        }
        return false;  
     }
      public function getShefOrdersNumbers(){
          $query = $this->db->query("select distinct orders.order_number from menu inner join iteminorder on menu.item_name=iteminorder.item_name inner join orders on orders.order_number=iteminorder.order_number where executer='טבח' and sent='נשלח' ORDER BY time ASC");

        if ($query) {
            return $query->result_array();
        }
        return false;
      }
    public function getShefOrders(){
     $query = $this->db->query("select * from menu inner join iteminorder on menu.item_name=iteminorder.item_name inner join orders on orders.order_number=iteminorder.order_number where executer='טבח' and sent='נשלח'");

        if ($query) {
            return $query->result_array();
        }
        return false;   
    }
    public function orderComplete($orderNumber){
        $this->db->query("update iteminorder set sent='בוצע' where order_number='".$orderNumber." and sent='נשלח'");
    }
    public function getOrderSum($order_number){
        $query = $this->db->query("select sum(price) from menu inner join iteminorder on menu.item_name=iteminorder.item_name where order_number='".$order_number."'");

        if ($query) {
            return $query->result_array();
        }
        return false;
    }
    public function clear($order_number, $table_number){
        $this->db->query("delete from iteminorder where order_number='".$order_number."'");
        $this->db->query("delete from orders where order_number='".$order_number."'");
        $this->db->query("update tables set availability='פנוי' where table_number='" . $table_number . "'");

    }

}
