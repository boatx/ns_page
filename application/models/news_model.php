<?php

class News_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_pages($pages_rows)
    {
        if (!isset($pages_rows))
        {
            $pages_rows=1;
        }
        $rows = $this->db->count_all_results('news');
        $last = ceil($rows/$pages_rows);
        return $last;
    }

    public function get_news($pagenum=1,$pages=1)
    {
        $this->db->order_by("date", "desc"); 
        $query = $this->db->get('news',$pages,($pagenum-1)*$pages);
        return $query->result_array();
    }

    public function get_news_by_id($id)
    {
        $query = $this->db->get_where('news', array('id' => $id));
        return $query->result_array();
    }

    public function get_news_by_slug($slug)
    {
        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->result_array();
    }

    public function set_news()
    {
        $this->load->helper('url');

        $slug=url_title($this->input->post('title'),'dash',TRUE);

        $data=array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

        return $this->db->insert('news',$data);
    }

    public function update_news($id)
    {
        $data=array(
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text')
        );

        $this->db->where('id', $id);
        return $this->db->update('news', $data);
    }

    public function delete_news($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('news');
    }
}
