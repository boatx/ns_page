<?php

class Admin_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    function login($username, $password)
    {
        $query = $this->db->get_where('users', array('login'=>$username, 'password'=>$password));
        if ($query->num_rows()==0) return false;
        else
        {
            $result = $query->result();
            $first_row = $result[0];
            $userid = $first_row->id;
            return $userid;
        }
    }

}
