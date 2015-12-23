<?php

class Optie_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('optie');
        return $query->result();
    }
    
    function getAllWithOnderdelen() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('optie');
        $opties = $query->result();
        $this->load->model('optieonderdeel_model');
        
        foreach ($opties as $optie) {
            $optie->onderdelen = $this->optieonderdeel_model->getAllByOptieId($optie->id);
        }
        
        return $opties;
    }
    
    function getAllFromStoelWithOnderdelen($stoelId) {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('optie');
        $opties = $query->result();
        $this->load->model('optieonderdeel_model');        
        
        $x = 0;
        foreach ($opties as $optie) {
            $optie->onderdelen = $this->optieonderdeel_model->getAllFromStoelByOptieId($optie->id, $stoelId);
            //unset als onderdelen leeg is
            if (count($optie->onderdelen) == 0 || $optie->onderdelen == null) {
                unset($opties[$x]);
            }
            $x++;
        }
        
        return $opties;
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('optie');
        return $query->row();
    }

    function getByNaam($naam) {
        $this->db->where('naam', $naam);
        $query = $this->db->get('optie');
        return $query->row();
    }

}

?>