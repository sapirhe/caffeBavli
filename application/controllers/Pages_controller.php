<?php

class Pages_controller  extends CI_Controller {
    //put your code here
     public function __construct()
        {
                parent::__construct();
                $this->load->model('Login_model');
                $this->load->helper('url_helper');
                $this->load->helper('form');
                $this->load->library('session');
        }
        
     public function HomePage(){
        $data['title']="Home page";
        $data['user']=$this->session->all_userdata();
        $this->load->view('templates/header',$data);
        $this->load->view('pages/HomePage',$data);
        $this->load->view('templates/footer',$data); 
         
     } 
     public function editMenu(){
        $data['title'] =' Edit Menu';
        $data['user']=$this->session->all_userdata();
        
        $this->load->view('templates/header',$data);
        $this->load->view('pages/editMenu', $data);
        $this->load->view('templates/footer', $data);
    }
    public function foodCalorieAPI(){
        $data['title'] ='Food Calorie Data';
        $data['user']=$this->session->all_userdata();
        
        $this->load->view('templates/header',$data);
        $this->load->view('pages/foodCalorieAPI', $data);
        $this->load->view('templates/footer', $data);
    }
    public function employeesManagement(){
        $data['title'] ='Employees Management';
        $data['user']=$this->session->all_userdata();
        
        $this->load->view('templates/header',$data);
        $this->load->view('pages/employeesManagement', $data);
        $this->load->view('templates/footer', $data);
    }
}