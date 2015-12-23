<?php

class Kleur_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('kleur');
        return $query->result();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('kleur');
        return $query->row();
    }

    function getAllByKleurpalletId($kleurpalletId) {
        $this->db->where('kleurpalletId', $kleurpalletId);
        $query = $this->db->get('kleur');
        return $query->result();
    }

    function getWithInfo($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('kleur');
        $kleur = $query->row();

        if ($kleur != null) {
            $this->load->model('kleurpallet_model');
            $kleur->kleurpallet = 
                    $this->kleurpallet_model->get($kleur->kleurpalletId);
        }
        return $kleur;
    }

}

?>