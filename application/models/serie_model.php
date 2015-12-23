<?php

class Serie_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('serie');
        return $query->result();                
    }
    
    function getAllHoofdRubrieken()
    {
        $this->db->order_by('id', 'asc');
        $this->db->where('hoofdrubriekId', 0);
        $query = $this->db->get('serie');
        return $query->result();                
    }
    
    function getAllHoofdRubriekenNotEmpty()
    {
        $this->db->order_by('id', 'asc');
        $this->db->where('hoofdrubriekId', 0);
        $query = $this->db->get('serie');
        $hoofdseries = $query->result();    
        
        foreach ($hoofdseries as $value) {
            // kijken of er ergens in de structuur stoelen zijn :(
        }
    }
    
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('serie');
        return $query->row();                   
    }   
    
    function getLastSerie()
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit('1');
        $query = $this->db->get('serie');
        return $query->row();                   
    }
    
    function getWithSubs($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('serie');          
        $serie = $query->row();        
        $serie->subrubrieken = $this->getAllSubrubriekenBySerieId($id);
        return $serie;
    } 
    
    function getAllSubrubriekenBySerieId($id){
        //gogogogo
        $this->db->order_by('id', 'asc');
        $this->db->where('hoofdrubriekId', $id);
        $query = $this->db->get('serie');
        return $query->result();      
    }
    
    function getAllWithNoHoofdrubriek(){
        //gogogogo
        $this->db->order_by('id', 'asc');
        $this->db->where('hoofdrubriekId', 0);
        $query = $this->db->get('serie');
        return $query->result();      
    }
            
    function insert($serie) {
        $this->db->insert('serie', $serie);
        return $this->db->insert_id();
    }

    function update($serie) {
        $this->db->where('id', $serie->id);
        $this->db->update('serie', $serie);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('serie');
    }

}

?>