<?php

class Optieonderdeel_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('optieonderdeel');
        return $query->result();
    }  
    
    function getAllByOptieId($optieId) {
        $this->db->order_by('id', 'asc');
        $this->db->where('optieId', $optieId);
        $query = $this->db->get('optieonderdeel');
        return $query->result();
    } 
    
    function getAllFromStoelByOptieId($optieId, $stoelId) {
        $this->db->order_by('id', 'asc');
        $this->db->where('optieId', $optieId);
        $query = $this->db->get('optieonderdeel');
        $optieonderdelen = $query->result();
        $this->load->model('stoeloptieonderdeel_model');
        
        $x = 0;
        foreach ($optieonderdelen as $value) {
            //$stoelOptieOnderdelen = $this->stoeloptieonderdeel_model->getAllFromOptieByStoelId($stoelId, $optieId);
            $antw = $this->stoeloptieonderdeel_model->zitOptieOnderdeelBijStoel($stoelId, $value->id);
            /*if (count($stoelOptieOnderdelen) == 0 || $stoelOptieOnderdelen == null) {
                $optieonderdelen = null;
                //unset($optieonderdelen[$x]);
            }*/
            if (!$antw) {                
                unset($optieonderdelen[$x]);
            }
            $x++;
        }
        
        return $optieonderdelen;
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('optieonderdeel');
        return $query->row();
    }

    function getByNaam($naam) {
        $this->db->where('naam', $naam);
        $query = $this->db->get('optieonderdeel');
        return $query->row();
    }
    
    function insert($optieonderdeel) {
        $this->db->insert('optieonderdeel', $optieonderdeel);
        return $this->db->insert_id();
    }

}

?>