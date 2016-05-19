<?php

class Bezoeker_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('bezoeker');
        $bezoekers = $query->result();
        return $bezoekers;
    }

    function getBezoekersVandaag() {
        $this->db->order_by('id', 'asc');
        $where = "bezoekdatum > '" . date('Y-m-d 00:00:00') . "' AND " . "bezoekdatum < '" . date('Y-m-d 23:59:59') . "'";
        $this->db->where($where);
        $query = $this->db->get('bezoeker');
        $bezoekers = $query->result();
        return $bezoekers;
    }

    function getBezoekersByYmdDate($date) {
        $this->db->order_by('id', 'asc');
       
        $date1 = str_replace('-', '/', $date);
        $endOfDay = date('Y-m-d 23:59:59', strtotime($date1));

        $where = "bezoekdatum > '" . $date . "' AND " . "bezoekdatum < '" . $endOfDay . "'";
        $this->db->where($where);
        $query = $this->db->get('bezoeker');
        $bezoekers = $query->result();
        return $bezoekers;
    }

    function getLastBezoeker() {
        $this->db->order_by('id', 'desc');
        $this->db->limit('1');
        $query = $this->db->get('bezoeker');
        return $query->row();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bezoeker');
        return $query->row();
    }

    function insert($bezoeker) {
        $this->db->insert('bezoeker', $bezoeker);
        return $this->db->insert_id();
    }

    function update($bezoeker) {
        $this->db->where('id', $bezoeker->id);
        $this->db->update('bezoeker', $bezoeker);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('bezoeker');
    }

}

?>