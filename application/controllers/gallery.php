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
        $data['maps']= array();

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


    public function manage_gallery($errors=array())
    {
        $this->load->library(array('session','form_validation'));
        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }

        $this->load->helper('form');
        $data['title'] ='Manage gallery';
        $data['errors'] = $errors;
        $data['maps'] =  directory_map('./assets/gallery',1);
        $this->load->view('templates/admin_header', $data);
        $this->load->view('gallery/manage');
        $this->load->view('templates/footer');

    }

    public function manage_subgallery($name,$error=array())
    {
        $this->load->library(array('session','form_validation'));
        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }
        $this->load->helper('form');

        $dname = './assets/gallery/' . $name . '/orginals';
        $dir = directory_map($dname);
        $data['title'] = 'csmclsm ' . $name;
        $data['maps'] = $dir;
        $data['name'] = $name;
        $data['error'] = $error;
        $this->load->view('templates/admin_header', $data);
        $this->load->view('gallery/manage_subgal',$data);
        $this->load->view('templates/footer');
    }

    public function create_subgallery()
    {
        $this->load->library(array('session','form_validation'));
        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }

        $this->load->helper('form');

        $this->form_validation->set_rules('name','Nazwa Galerii','required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->manage_gallery();
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
                $this->manage_gallery();
            }
        }

    }

    public function rm_image($gallery_name, $img_name)
    {
        $this->load->library('session');
        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }

        $dir_main = 'assets/gallery/' . $gallery_name;
        $file1 = $dir_main . '/orginals/' . $img_name;
        $file2 = $dir_main . '/thumbs/' . $img_name;

        if (is_file($file1))
        {
            unlink($file1);
        }

        if (is_file($file2))
        {
            unlink($file2);
        }

        $this->manage_subgallery($gallery_name);
    }

    public function rm_subgallery($name)
    {
        $this->load->library('session');
        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }

        $dir_main = 'assets/gallery/' . $name;
        if (is_dir($dir_main))
        {
            $dirs = directory_map($name);
			var_dump($dirs);
        }
    }

    public function make_thumb($gallery_name, $img_name)
    {
        $config['image_library'] = 'ImageMagick';
        $config['library_path'] = '/usr/bin';
        $config['source_image'] = './assets/gallery/' . $gallery_name . '/orginals/' . $img_name;
        $config['new_image'] = './assets/gallery/' . $gallery_name . '/thumbs/' . $img_name;
        $config['thumb_marker'] = '';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 100;
        $config['height'] = 100;

        $this->load->library('image_lib', $config);

        if (!$this->image_lib->resize())
        {
            $error = array('error' => $this->image_lib->display_errors());
            //unlink($config['upload_path'] . $data['file_name']);
            $this->manage_gallery($error);

        }
        else
        {
            $this->manage_subgallery($gallery_name);
        }
    }

    public function upload_image()
    {
        $this->load->library(array('session','form_validation'));
        $this->load->helper('form');

        if (!$this->session->userdata('userid'))
        {
            redirect('admin');
        }

        $config['upload_path'] = './assets/gallery/' . $this->input->post('gallery_name') . '/orginals/';
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['max_size'] = '100';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';
        $this->load->library('upload', $config);


        if (!$this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->manage_subgallery('historia',$error);

        }
        else
        {

            $data = $this->upload->data();
            $this->make_thumb($this->input->post('gallery_name'),$data['file_name']);
        }
    }

}
