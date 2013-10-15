<?php

class News extends CI_Controller {

    //public $news_per_page;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->helper(array('url','date'));
    }

    private function __ind($pagenum=1,$news_per_page=3,$title="Newsy")
    {
        $data['pages'] = $this->news_model->get_pages($news_per_page);
        $data['page_num'] = intval($pagenum);
        $data['news'] = $this->news_model->get_news($pagenum,$news_per_page);
        $data['title']= $title;

        return $data;
    }


    public function view($slug)
    {
        $data['news'] = $this->news_model->get_news_by_slug($slug);
        $data['title'] = $slug;
        $data['no_pag'] = True;
        $this->load->helper('simple_pag');
        $this->load->view('templates/header', $data);
        $this->load->view('news/index',$data);
        $this->load->view('templates/footer');
    }

    public function index($pagenum=1)
    {
        $news_per_page=3;
        $data = $this->__ind($pagenum,$news_per_page,'Newsy');
        if(empty($data['news']))
        {
            show_404();
        }

        $this->load->helper('simple_pag');
        $this->load->view('templates/header', $data);
        $this->load->view('news/index',$data);
        $this->load->view('templates/footer');
    }

    public function view_edit($num)
    {
        echo $num;
        //$this->edit($num,3);
    }

    public function create()
    {
        $this->load->library(array('session','form_validation'));
        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }

        $this->load->helper('form');

        $data['title']='Create a news item';

        $this->form_validation->set_rules('title','Tytul','required');
        $this->form_validation->set_rules('text','Tresc','required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->news_model->set_news();
            $this->load->view('news/success');
        }

    }

    public function edit($pagenum=1)
    {
        $news_per_page=3;
        $this->load->library(array('session','form_validation'));
        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }

        $news_per_page=3;
        $data = $this->__ind($pagenum,$news_per_page,'Newsy Edycja');
        if(empty($data['news']))
        {
            show_404();
        }

        $this->load->helper('simple_pag');
        $this->load->view('templates/admin_header', $data);
        $this->load->view('news/edit_index',$data);
        $this->load->view('templates/footer');
    }

    public function edit_news($id)
    {
        $this->load->library(array('session','form_validation'));
        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }

        $news_data = $this->news_model->get_news_by_id($id);
        $data['title'] = 'Edycja Newsu - ' . $news_data[0]['title']; 

        $this->load->helper('form');


        $this->form_validation->set_rules('title','Tytul','required');
        $this->form_validation->set_rules('text','Tresc','required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('news/edit_news',$news_data[0]);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->news_model->update_news($news_data[0]['id']);
            redirect('news/edit');
        }
    }

    public function delete_news($id)
    {
        $this->load->library(array('session','form_validation'));
        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }
        $this->news_model->delete_news($id);
        redirect('news/edit');
    }

}
