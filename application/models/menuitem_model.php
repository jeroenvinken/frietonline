<?php

class Menuitem_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('id', 'asc');

        $query = $this->db->get('menuitem');
        $producten = $query->result();
        return $producten;
    }
    
    function getAllByCategorieId($catId) {
        $this->db->order_by('id', 'asc');
        $this->db->where('categeorieId =', $catId);

        $query = $this->db->get('menuitem');
        $menuitems = $query->result();
        return $menuitems;
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('menuitem');
        return $query->row();
    }

    function insert($menuitem) {
        $this->db->insert('menuitem', $menuitem);
        return $this->db->insert_id();
    }

    function update($menuitem) {
        $this->db->where('id', $menuitem->id);
        $this->db->update('menuitem', $menuitem);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('menuitem');
    }

}

?>