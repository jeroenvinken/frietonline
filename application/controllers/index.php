<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        $data['title'] = global_bedrijfsnaam . ' - Home';
        $data['pagina'] = 'index';
        
        // bezoeker in database zetten
        $this->bezoeker();

        $this->load->model('tekst_model');
        $teksten = $this->tekst_model->getAllByPage("home.php");
        $data['teksten'] = $teksten;
        
        $this->load->model('openingsuren_model');
        $openingsuren = $this->openingsuren_model->getAll();
        $data['openingsuren'] = $openingsuren;
         
         
        $partials = array('header' => 'main_header', 'content' => 'index', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function bezoeker() {
        // check voor nieuwe bezoeker
        $this->load->model('bezoeker_model');
        $this->load->model('bezoekerhit_model');
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $bezoeker = new stdClass();
        $bezoeker->ip = $ip;
        $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')) + 7200); // 2uur bijtellen voor server
        $bezoeker->bezoekdatum = $date; //date('Y-m-d H:i:s a');
        if ($this->session->userdata('bezocht') == null || $this->session->userdata('bezocht') == 0) {
            $id = $this->bezoeker_model->insert($bezoeker);
            $this->session->set_userdata('bezocht', $id);
        }

        // bezoeker ook toevoegen aan totaal aantal bezoekers = hits
        $id = $this->bezoekerhit_model->insert($bezoeker);
    }

    public function lars() {
        $data['title'] = global_bedrijfsnaam . ' - Lars';
        $data['pagina'] = 'index';

        $this->load->model('tekst_model');
        $teksten = $this->tekst_model->getAllByPage("lars.php");
        $data['teksten'] = $teksten;

        $partials = array('header' => 'main_header', 'content' => 'Lars', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function contact() {
        $data['title'] = global_bedrijfsnaam . ' - Contact';
        $data['pagina'] = 'index';

        $this->load->model('tekst_model');
        $teksten = $this->tekst_model->getAllByPage("info.php");
        $data['teksten'] = $teksten;

        $partials = array('header' => 'main_header', 'content' => 'contact', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function kaart() {
        $data['title'] = global_bedrijfsnaam . ' - Kaart';
        $data['pagina'] = 'kaart';


        $this->load->model('tekst_model');
        $teksten = $this->tekst_model->getAllByPage("kaart.php");
        $data['teksten'] = $teksten;

        $this->load->model('menuitem_model');
        $producten = $this->menuitem_model->getAll();
        $data['producten'] = $producten;


        $partials = array('header' => 'main_header', 'content' => 'kaart', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

}
