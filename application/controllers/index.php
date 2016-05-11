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

        $this->load->model('tekst_model');
        $teksten = $this->tekst_model->getAllByPage("home.php");
        $data['teksten'] = $teksten;

        $partials = array('header' => 'main_header', 'content' => 'index', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
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
        $data['pagina'] = 'index';

        $this->load->model('tekst_model');
        $teksten = $this->tekst_model->getAllByPage("kaart.php");
        $data['teksten'] = $teksten;

        $partials = array('header' => 'main_header', 'content' => 'kaart', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    

}
