<?php

class Stofkleurpallet_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('stofkleurpallet');
        return $query->result();                
    }
    
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('stofkleurpallet');
        return $query->row();                   
    }
    
    function getAllByStofIdWithInfo($stofId)    {
        $this->db->where('stofId', $stofId);
        $query = $this->db->get('stofkleurpallet');
        $stofkleurpalletten = $query->result(); 
        $this->load->model('kleurpallet_model');
        foreach ($stofkleurpalletten as $stofkleurpallet) {
            $stofkleurpallet->kleurpallet = $this->kleurpallet_model->get($stofkleurpallet->kleurpalletId);
        }
        
        return $stofkleurpalletten;               
    }
    

}

?>