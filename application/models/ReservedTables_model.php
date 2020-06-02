<?php

class ReservedTables_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function setReservation($data) {
        $this->db->db_debug = FALSE;
        $error = NULL;
        if (!$this->db->query("insert into reserved_tables (diner_name, diner_phone, order_date, order_time, diners_number, location, table_number, notes) values('" . $data['diner_name'] . "', '" . $data['diner_phone'] . "', '" . $data['order_date'] . "', '" . $data['order_time'] . "', '" . $data['diners_number'] . "', '" . $data['location'] . "', '0', ' ')")) {
            $error = $this->db->error();
        }
        return $error;
    }

    public function getReservationNumber() {
        $reservation_number = $this->db->query("select MAX(order_number) from reserved_tables");
        if ($reservation_number) {
            return $reservation_number->result_array();
        }
    }

    public function getRelevantTables($location, $diners_number) {
        $query = $this->db->query("select * from tables where location='" . $location . "' and diners_number='" . $diners_number . "'");

        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    public function setReservationTableNumber($data) {
        $this->db->db_debug = FALSE;
        $error = NULL;
        if (!$this->db->query("update reserved_tables set table_number='" . $data['table_number'] . "', notes='" . $data['notes'] . "' where order_number='" . $data['reservation_number'] . "'")) {
            $error = $this->db->error();
        }
        return $error;
    }

    public function reservedTablesByDate($data) {
        $query = $this->db->query("select * from reserved_tables where order_date='" . $data . "' ORDER BY order_time ASC");

        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    public function getResInfo($data) {
        $query = $this->db->query("select * from reserved_tables where order_number='" . $data . "'");

        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function editReservation($data) {
        $this->db->db_debug = FALSE;
        $error = NULL;

        if (!$this->db->query("UPDATE reserved_tables SET order_date = '" . $data['order_date'] . "', order_time = '" . $data['order_time'] . "', diner_name = '" . $data['diner_name'] . "', diner_phone = '" . $data['diner_phone'] . "', diners_number = '" . $data['diners_number'] ."', location = '" . $data['location'] . "' WHERE order_number = '" . $data['order_number'] . "'")) {
            $error = $this->db->error();
        }
        return $error;
    }

}
