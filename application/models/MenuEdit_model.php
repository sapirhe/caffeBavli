<?php

class MenuEdit_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function setItem($data) {
        $this->db->db_debug = FALSE;
        $error = NULL;
        if (!$this->db->insert('menu', $data)) {
            $error = $this->db->error();
        }

        return $error;
    }

    function getBreakfast() {

        $query = $this->db->query("select * from menu where section='בוקר' order by item_name ASC");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function getSandwiches() {

        $query = $this->db->query("select * from menu where section='כריכים' order by item_name ASC");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function getToasts() {

        $query = $this->db->query("select * from menu where section='טוסטים' order by item_name ASC");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function getSalads() {

        $query = $this->db->query("select * from menu where section='סלטים' order by item_name ASC");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function getLunch() {

        $query = $this->db->query("select * from menu where section='צהריים' order by item_name ASC");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function getDeserts() {

        $query = $this->db->query("select * from menu where section='קינוחים' order by item_name ASC");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function getDrinks() {

        $query = $this->db->query("select * from menu where section='שתיה' order by item_name ASC");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function deleteItem($itemToDelete) {
        $this->db->query("delete  from menu where item_name='" . $itemToDelete . "");
    }

    function itemToEdit($itemToEdit) {
        $query = $this->db->query("select * from menu where item_name='" . $itemToEdit . "");
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    function editItem($c_item_name, $new_item_name, $new_description, $new_price, $new_execType, $new_section) {
        $this->db->db_debug = FALSE;
        $error = NULL;

        if (!$this->db->query("UPDATE menu SET item_name = '" . $new_item_name . "', description = '" . $new_description . "', price = '" . $new_price . "', executer = '" . $new_execType . "', section = '" . $new_section . "' WHERE item_name = '" . $c_item_name."'" )) {
            $error = $this->db->error();
        }

        return $error;
    }

    function editName($nameToEdit, $c_item_name) {
        $this->db->query("update menu set item_name='" . $nameToEdit . "' where item_name='" . $c_item_name . "'");
    }

    function editDescription($descriptionToEdit, $c_item_name) {
        $this->db->query("update menu set description='" . $descriptionToEdit . "' where item_name='" . $c_item_name . "'");
    }

    function editPrice($priceToEdit, $c_item_name) {
        $this->db->query("update menu set price='" . $priceToEdit . "' where item_name='" . $c_item_name . "'");
    }

    function editExecuter($new_execType, $c_item_name) {
        $this->db->query("update menu set executer='" . $new_execType . "' where item_name='" . $c_item_name . "'");
    }

    function editSection($new_section, $c_item_name) {
        $this->db->query("update menu set section='" . $new_section . "' where item_name='" . $c_item_name . "'");
    }

}
