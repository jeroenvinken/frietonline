<?php

class Stoeloptieonderdeel_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('stoeloptieonderdeel');
        return $query->result();
    }  
    
    function getAllByStoelId($stoelId) {
        $this->db->order_by('id', 'asc');
        $this->db->where('stoelId', $stoelId);
        $query = $this->db->get('stoeloptieonderdeel');
        $stoelOptieOnderdelen = $query->result();
        $this->load->model('optieonderdeel_model');
        $this->load->model('optie_model');
        
        foreach ($stoelOptieOnderdelen as $value) {
            $value->optieOnderdeel = $this->optieonderdeel_model->get($value->optieOnderdeelId);
            //$value->optie = $this->optie_model->get($value->optieId);
        }
        
        return $stoelOptieOnderdelen;
    } 
    
    function getAllFromOptieByStoelId($stoelId, $optieId) {
        /*$this->db->select('so.id soid, so.optieOnderdeelId sooptieOnderdeelId, so.stoelId sostoelId');        
        $this->db->from('stoeloptieonderdeel as so');
        $this->db->join('optieonderdeel as od', 'od.id = so.optieId');        
        $this->db->where('od.optieId', $optieId);  
        $this->db->where('stoeloptieonderdeel.stoelId', $stoelId); 
        $query = $this->db->get();
        $stoelOptieOnderdelen = $query->result();
        // custom sql 
        /*$this->db->select('SELECT so.id soid, so.optieOnderdeelId sooptieOnderdeelId, so.stoelId sostoelId FROM stoeloptieonderdeel so INNER JOIN optieonderdeel od ON so.optieOnderdeelId = od.id WHERE so.stoelId = ' . $stoelId . ' AND od.optieId = ' . $optieId . ';');
        $query = $this->db->get();        
        $stoelOptieOnderdelen = $query->result();*/
        
        
        /*$stoelOptieOnderdelen = $this->getAllByStoelId($stoelId);
        
        
        $this->load->model('optieonderdeel_model');
        
        $x = 0;
        foreach ($stoelOptieOnderdelen as $value) {
            $onderdeel = $this->optieonderdeel_model->get($value->optieOnderdeelId);
            if ($onderdeel->optieId != $optieId) {
                //unset($stoelOptieOnderdelen[$x]);
            }
            $x++;
        }
        
        return $stoelOptieOnderdelen;*/
        
        $this->db->order_by('id', 'asc');
        $this->db->where('stoelId', $stoelId);
        $this->db->where('optieId', $optieId);
        $query = $this->db->get('stoeloptieonderdeel');
        $stoelOptieOnderdelen = $query->result();
        $this->load->model('optieonderdeel_model');
        
        foreach ($stoelOptieOnderdelen as $value) {
            $value->optieOnderdeel = $this->optieonderdeel_model->get($value->optieOnderdeelId);
        }
        
        return $stoelOptieOnderdelen;
    } 
    
    function zitOptieOnderdeelBijStoel($stoelId, $optieOnderdeelId) {
        $this->db->order_by('id', 'asc');
        $this->db->where('stoelId', $stoelId);
        $this->db->where('optieOnderdeelId', $optieOnderdeelId);
        $query = $this->db->get('stoeloptieonderdeel');
        $stoelOptieOnderdelen = $query->result();
        
        if ($stoelOptieOnderdelen == NULL || count($stoelOptieOnderdelen) == 0) 
        {
            return FALSE;
        } else {
            return TRUE;
        }
        
        return TRUE;
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('stoeloptieonderdeel');
        return $query->row();
    }    
    
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('stoeloptieonderdeel');
    }
    
    function insert($stoeloptieonderdeel) {
        $this->db->insert('stoeloptieonderdeel', $stoeloptieonderdeel);
        return $this->db->insert_id();
    }

}

?>