<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Samenstellen extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        $data['title'] = global_bedrijfsnaam . ' - Broodje samenstellen';
        $data['pagina'] = 'broodje_samenstellen';
        
        $this->load->model('menuitem_model');
        $menuitems = $this->menuitem_model->getAllComponentsForSamenstellen();
        $data['menuitems'] = $menuitems;
        
        $partials = array('header' => 'main_header', 'content' => 'broodje_samenstellen', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }   
}
