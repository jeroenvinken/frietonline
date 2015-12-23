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
        $data['title'] = 'Frietonline - home';
        $data['pagina'] = 'index';
        
        /*$this->load->model('serie_model');
        $series = $this->serie_model->getAllWithNoHoofdrubriek();
        $data['series'] = $series;*/

        $partials = array('header' => 'main_header', 'content' => 'index', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    } 
}