<?php

class Menuitem_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('categorieId', 'asc');

        $query = $this->db->get('menuitem');
        $producten = $query->result();

        $this->load->model('categorie_model');
        foreach ($producten as $product) {
            $product->categorie = $this->categorie_model->get($product->categorieId);
        }
        return $producten;
    }

    function getAllByCategorieId($catId) {
        $this->db->order_by('id', 'asc');
        $this->db->where('categorieId =', $catId);

        $query = $this->db->get('menuitem');
        $menuitems = $query->result();
        return $menuitems;
    }

    function getAllForKaart() {
        $this->db->order_by('categorieId', 'asc');
        $this->db->where('categorieId != 0');
        
        $query = $this->db->get('menuitem');
        $producten = $query->result();


        $this->load->model('categorie_model');
        $teller = 0;
        foreach ($producten as $product) {
            $product->categorie = $this->categorie_model->get($product->categorieId);
            if($product->categorie->hoofdcategorieId != null) {
                unset($product[$teller]);
            }
            $teller++;
        }
        return $producten;
    }
    
    // Get all data for putting together the greatest sandwich of all time
    function getAllComponentsForSamenstellen() {
        $producten = new stdClass();
        $producten->broodjes = $this->getAllByCategorieId(1);
        $producten->groenten = $this->getAllByCategorieId(2);
        $producten->snacks = $this->getAllByCategorieId(3);
        $producten->beleg = $this->getAllByCategorieId(4);
        return $producten;
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