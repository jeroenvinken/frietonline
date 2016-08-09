<?php

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('login');
        $logins = $query->result();
        return $logins;
    }

    function getByUsernameAndPassword($gebruikersnaam,$wachtwoord) {
       $this->db->where('gebruikersnaam', $gebruikersnaam);
       $this->db->where('wachtwoord', $wachtwoord);
        $query = $this->db->get('login');
        return $query->row();
    }

    

    

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('login');
        return $query->row();
    }

    function insert($login) {
        $this->db->insert('login', $login);
        return $this->db->insert_id();
    }

    function update($login) {
        $this->db->where('id', $login->id);
        $this->db->update('login', $login);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('login');
    }

}

?>