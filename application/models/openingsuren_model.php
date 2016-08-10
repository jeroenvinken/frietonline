<?php

class Openingsuren_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('openingsuren');
        $openingsurens = $query->result();
        return $openingsurens;
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('openingsuren');
        return $query->row();
    }    

    function insert($openingsuren) {
        $this->db->insert('openingsuren', $openingsuren);
        return $this->db->insert_id();
    }

    function update($openingsuren) {
        $this->db->where('id', $openingsuren->id);
        $this->db->update('openingsuren', $openingsuren);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('openingsuren');
    }

}

?>