<?php

class Pages_controller extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Pages_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
    }

    public function HomePage() {
        $data['title'] = "Home page";
        $data['user'] = $this->session->all_userdata();
        $this->load->view('templates/header', $data);
        $this->load->view('pages/HomePage', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editMenu() {
        $data['title'] = ' Edit Menu';
        $data['user'] = $this->session->all_userdata();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/editMenu', $data);
        $this->load->view('templates/footer', $data);
    }

    public function foodCalorieAPI() {
        $data['title'] = 'Food Calorie Data';
        $data['user'] = $this->session->all_userdata();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/foodCalorieAPI', $data);
        $this->load->view('templates/footer', $data);
    }

    public function employeesManagement() {
        $data['title'] = 'Employees Management';
        $data['user'] = $this->session->all_userdata();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/employeesManagement', $data);
        $this->load->view('templates/footer', $data);
    }

    public function statistics() {
        $data['title'] = 'Statistics';
        $data['user'] = $this->session->all_userdata();

        $month = date('Y-m-d', strtotime('-30 days'));
        $year = date('Y-m-d', strtotime('-365 days'));
        $data['sectionPie30'] = $this->Pages_model->getStatisticsSections($month);
        $data['sectionPieYear'] = $this->Pages_model->getStatisticsSections($year);
        $data['IncomingCahrt30'] = $this->Pages_model->getStatisticsIncoming30($month);
        $data['IncomingCahrtYear'] = $this->Pages_model->getStatisticsIncomingYear($year);
        $sum30Incoming = 0;
        foreach ($data['IncomingCahrt30'] as $row) {
            $sum30Incoming+=$row['sum(menu.price)'];
        }
        $data['avgIncomig30'] = $sum30Incoming / 30;
        $sumYearIncoming = 0;
        foreach ($data['IncomingCahrtYear'] as $row) {
            $sumYearIncoming+=$row['sum(menu.price)'];
        }
        $data['avgIncomigYear'] = $sumYearIncoming / 365;
        $data['leastSoldItems30'] = $this->Pages_model->getLeastSoldItems($month);
        $data['mostSoldItems30'] = $this->Pages_model->getMostSoldItems($month);
        $data['leastSoldItemsYear'] = $this->Pages_model->getLeastSoldItems($year);
        $data['mostSoldItemsYear'] = $this->Pages_model->getMostSoldItems($year);


        $this->load->view('templates/header', $data);
        $this->load->view('pages/statistics', $data);
        $this->load->view('templates/footer', $data);
    }

    public function session_expired() {
        $data['title'] = 'Session Expired';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/session_expired', $data);
        $this->load->view('templates/footer', $data);
    }

}
