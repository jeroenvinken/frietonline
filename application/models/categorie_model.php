<?php

class Categorie_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('id', 'asc');

        $query = $this->db->get('categorie');
        $categorien = $query->result();        
        return $categorien;
    }
    
    function getAllByCategorieId($catId) {
        $this->db->order_by('id', 'asc');
        $this->db->where('categeorieId =', $catId);

        $query = $this->db->get('categorie');
        $categorien = $query->result();
        return $categorien;
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('categorie');
        return $query->row();
    }

    function insert($categorie) {
        $this->db->insert('categorie', $categorie);
        return $this->db->insert_id();
    }

    function update($categorie) {
        $this->db->where('id', $categorie->id);
        $this->db->update('categorie', $categorie);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('categorie');
    }

}

?>