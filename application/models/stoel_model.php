<?php

class Stoel_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('stoel');
        return $query->result();                
    }
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('stoel');
        return $query->row();                   
    }  
    
    function getLastStoel()
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit('1');
        $query = $this->db->get('stoel');
        return $query->row();                   
    }

    function getAllBySerieId($serieId)
    {
        $this->db->where('serieId', $serieId);
        $query = $this->db->get('stoel');
        return $query->result();                 
    } 
        
    function getLastAmount($amount)
    {
        $this->db->order_by('id', 'asc');
        $this->db->limit($amount);
        $query = $this->db->get('stoel');
        return $query->result();                 
    }
    
    function getAllByInput($input) {
        $this->db->order_by('id', 'desc');
        //$this->db->where('archief =', 0);

        $where = '(naam LIKE "%' . $input . '%" OR omschrijving LIKE "%' . $input . '%")';
        $this->db->where($where);
        $this->db->where('archief =', 0);

        $query = $this->db->get('stoel');
        $stoelen = $query->result();       

        return $stoelen;
    }
    
    function insert($stoel) {
        $this->db->insert('stoel', $stoel);
        return $this->db->insert_id();
    }

    function update($stoel) {
        $this->db->where('id', $stoel->id);
        $this->db->update('stoel', $stoel);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('stoel');
    }
}

?>