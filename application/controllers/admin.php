<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'index';

        //$this->load->model('serie_model');
        //$series = $this->serie_model->getAll();
        //$data['series'] = $series;

        $partials = array('header' => 'admin_header', 'content' => 'admin', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function teksten_beheren() {
        $data['title'] = global_bedrijfsnaam . ' - Bureaustoelen';
        $data['pagina'] = 'Teksten bewerken';

        $this->load->model('tekst_model');
        $teksten = $this->tekst_model->getAll();
        $data['teksten'] = $teksten;

        $partials = array('header' => 'admin_header', 'content' => 'admin_teksten', 'footer' => 'admin_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function tekstenaanpassen() {
        $this->load->model('tekst_model');
        $teksten = $this->tekst_model->getAll();
        if ($this->isAdmin()) {
            foreach ($teksten as $tekst) {
                $tekst->tekst = $this->input->post(str_replace(' ', '', $tekst->naam));
                $tekst->tekstgrootte = $this->input->post(str_replace(' ', '', $tekst->naam . "tekstgrootte"));
                $this->tekst_model->update($tekst);
                
            }
         
            $data['bewerkt'] = 'Tekst is aangepast!';
            $this->index(true);
        } else {
            $this->noAccess();
        }
    }
    public function isAdmin() {
        return true;
    }
}
