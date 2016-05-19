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
    
    public function grafieken() {
        $data['title'] = global_bedrijfsnaam . ' - Bureaustoelen';
        $data['pagina'] = 'Teksten bewerken';

        $this->load->model('tekst_model');
        $teksten = $this->tekst_model->getAll();
        $data['teksten'] = $teksten;

        $partials = array('header' => 'admin_header', 'content' => 'admin_grafieken', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function grafiekbezoekersperuur() {
        if ($this->isAdmin()) {
            $this->load->model('bezoeker_model');
            $this->load->model('bezoekerhit_model');
            $bezoekers = $this->bezoeker_model->getBezoekersVandaag();
            $bezoekersall = $this->bezoeker_model->getAll();
            $bezoekerhits = $this->bezoekerhit_model->getBezoekersVandaag();
            $bezoekerhitsall = $this->bezoekerhit_model->getAll();
            $lastbezoeker = $this->bezoeker_model->getLastBezoeker();

            // bezoekers gisteren opvragen
            $date = date('Y-m-d 00:00:00');
            $date1 = str_replace('-', '/', $date);
            $yesterday = date('Y-m-d 00:00:00', strtotime($date1 . "-1 days"));
            $bezoekersGisteren = $this->bezoeker_model->getBezoekersByYmdDate($yesterday);

            // totaal bezoekers
            $lastbezoekerhit = $this->bezoekerhit_model->getLastBezoeker();

            $data['bezoekers'] = $bezoekers;
            $data['bezoekerhitsvandaag'] = $bezoekerhits;
            $data['bezoekersall'] = $bezoekersall;
            $data['bezoekerhitsall'] = $bezoekerhitsall;
            $data['lastbezoeker'] = $lastbezoeker;
            $data['bezoekersGisteren'] = $bezoekersGisteren;

            $data['lastbezoekerhit'] = $lastbezoekerhit;
            $this->load->view('admin_grafiek_ajax', $data);
        } else {
            $this->noAccess();
        }
    }
    
}
