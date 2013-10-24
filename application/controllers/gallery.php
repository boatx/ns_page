<?php

class Gallery extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','directory'));
    }

    public function index()
    {
        $dirs = directory_map('./assets/gallery');
        $data['maps']=[];

        foreach (array_keys($dirs) as $i)
        {
            $org=$dirs[$i]['orginals'];
            if (isset($org) && sizeof($org) > 0)
            {
                $data['maps'][] = array('name'=>str_replace("_"," ",$i),'url_name'=>$i,'cover'=>$org[0]);
            }
        }

        $data['title']='Galeria';

        $this->load->view('templates/header', $data);
        $this->load->view('gallery/index',$data);
        $this->load->view('templates/footer');
    }

    public function subgallery($name)
    {
        $dname = './assets/gallery/' . $name . '/orginals';
        $dir = directory_map($dname);
        $data['title'] = 'Galeria ' . $name;
        $data['maps'] = $dir;
        $data['name'] = $name;
        $this->load->view('templates/header',$data);
        $this->load->view('gallery/subgal',$data);
        $this->load->view('templates/footer');
    }

    public function __create_dirs($name)
    {
        $dir_main = 'assets/gallery/' . $name;
        $dir_org = $dir_main . '/orginals';
        $dir_th = $dir_main . '/thumbs';
        $status = mkdir($dir_main,0755);
        if ($status)
        {
            $status = mkdir($dir_org,0755);
        }

        if ($status)
        {
            $status = mkdir($dir_th,0755);
        }
        return $status;
    }

    public function __rm($array,$path)
    {
        foreach (array_keys($array) as $i)
        {
            if(is_array($array[$i])
            {
                if (sizeof($array[$i]) > 0)
                {
                    __rm($array[$i],$path . $i . '/');
                }
                else
                {
                    rmdir($path . $i);
                }
            }
            else
            {
                unlink($path . $i);
            }
        }
        rmdir($path);
    }

    public function remove_subgallery($name)
    {
        $dir_main = 'assets/gallery/' . $name;
        if (is_dir($dir_main))
        {
            $dirs = directory_map($dname);
            __rm($dirs,$dir_main . '/');
        }
    }

    public function create_subgallery()
    {
        $this->load->library(array('session','form_validation'));
        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }

        $this->load->helper('form');

        $data['title']='Create a news gallery';

        $this->form_validation->set_rules('name','Nazwa Galerii','required');

        if ($this->form_validation->run() === FALSE)
        {
            //$this->load->view('templates/admin_header', $data);
            $this->load->view('gallery/manage');
            $this->load->view('templates/footer');
        }
        else
        {
            $name = str_replace(" ","_",$this->input->post('name'));
            $status = $this->__create_dirs($name);
            if ($status)
            {
                $this->load->view('gallery/success');
            }
            else
            {
                //$this->load->view('templates/admin_header', $data);
                $this->load->view('gallery/manage');
                $this->load->view('templates/footer');
            }
        }

    }
}
