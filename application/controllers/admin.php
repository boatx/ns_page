<?php

class Admin extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('form', 'url'));
    }

    public function go()
    {
        $this->form_validation->set_rules('username','Nazwa Uzytkownika','required');
        $this->form_validation->set_rules('password','Haslo','required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('admin/login');
            $this->load->view('templates/footer');
        }
        else
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $results = $this->admin_model->login($username,$password);

            if ($results==false) redirect('admin');
            else
            {
                $this->session->set_userdata(array('userid'=>$results));
                redirect('admin');
            }
        }
    }

    public function logout()
    {
        $this->session->set_userdata(array('userid'=>''));  
        redirect('admin');
    }

    public function index()
    {
        if ($this->session->userdata('userid'))
        {
            $this->load->view('templates/admin_header');
            $this->load->view('admin/panel');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->load->view('templates/header');
            $this->load->view('admin/login');
            $this->load->view('templates/footer');
        }

    }

}
