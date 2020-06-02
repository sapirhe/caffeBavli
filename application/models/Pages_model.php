<?php

class Pages_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getStatisticsSections($date) {

        $query = $this->db->query("select count(iteminorder.item_name), section from menu inner join iteminorder on menu.item_name=iteminorder.item_name inner join orders on iteminorder.order_number=orders.order_number where payment_status='שולם' and  time>='" . $date . "' group by section");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function getStatisticsIncoming30($date) {
        $query = $this->db->query("select sum(menu.price), time, CAST(time AS DATE) from menu inner join iteminorder on menu.item_name=iteminorder.item_name inner join orders on iteminorder.order_number=orders.order_number where payment_status='שולם' and  CAST(time AS DATE)>='" . $date . "' group by CAST(time AS DATE)");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function getStatisticsIncomingYear($date) {
        $query = $this->db->query("select sum(menu.price), time, CAST(time AS DATE), month(CAST(time AS DATE)) AS month from menu inner join iteminorder on menu.item_name=iteminorder.item_name inner join orders on iteminorder.order_number=orders.order_number where payment_status='שולם' and  CAST(time AS DATE)>='" . $date . "' group by month ");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function getLeastSoldItems($date) {
        $query = $this->db->query("select count(iteminorder.item_name), iteminorder.item_name from iteminorder inner join orders on iteminorder.order_number=orders.order_number where payment_status='שולם' and  CAST(time AS DATE)>='" . $date . "' group by iteminorder.item_name ASC LIMIT 10");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function getMostSoldItems($date) {
        $query = $this->db->query("select count(iteminorder.item_name), iteminorder.item_name from iteminorder inner join orders on iteminorder.order_number=orders.order_number where payment_status='שולם' and  CAST(time AS DATE)>='" . $date . "' group by iteminorder.item_name DESC LIMIT 10");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

}
