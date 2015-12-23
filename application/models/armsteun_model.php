<?php

class Armsteun_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('armsteun');
        return $query->result();                
    }
    
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('armsteun');
        return $query->row();                   
    }
    
    function getAllByStoelId($stoelId)
    {
        $this->db->where('stoelId', $stoelId);
        $query = $this->db->get('armsteun');
        return $query->result();                  
    }
    

}

?>