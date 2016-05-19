<?php

class Bezoekerhit_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('bezoekerhit');
        $bezoekerhits = $query->result();
        return $bezoekerhits;
    }

    function getBezoekersVandaag() {
        $this->db->order_by('id', 'asc');
        $where = "bezoekdatum > '" . date('Y-m-d 00:00:00') . "' AND " . "bezoekdatum < '" . date('Y-m-d 23:59:59') . "'";
        $this->db->where($where);
        $query = $this->db->get('bezoekerhit');
        $bezoekerhits = $query->result();
        return $bezoekerhits;
    }

    function getBezoekersByYmdDate($date) {
        $this->db->order_by('id', 'asc');
       
        $date1 = str_replace('-', '/', $date);
        $endOfDay = date('Y-m-d 23:59:59', strtotime($date1));

        $where = "bezoekdatum > '" . $date . "' AND " . "bezoekdatum < '" . $endOfDay . "'";
        $this->db->where($where);
        $query = $this->db->get('bezoekerhit');
        $bezoekerhits = $query->result();
        return $bezoekerhits;
    }

    function getLastBezoeker() {
        $this->db->order_by('id', 'desc');
        $this->db->limit('1');
        $query = $this->db->get('bezoekerhit');
        return $query->row();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bezoekerhit');
        return $query->row();
    }

    function insert($bezoekerhit) {
        $this->db->insert('bezoekerhit', $bezoekerhit);
        return $this->db->insert_id();
    }

    function update($bezoekerhit) {
        $this->db->where('id', $bezoekerhit->id);
        $this->db->update('bezoekerhit', $bezoekerhit);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('bezoekerhit');
    }

}

?>