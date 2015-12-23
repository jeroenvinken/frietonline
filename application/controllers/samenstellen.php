<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Samenstellen extends CI_Controller {   

    public function __construct() {
        parent::__construct();
        //$this->load->helper('json');
        $this->load->helper('notation');
        $this->load->helper('url');
        $this->load->helper('form');       
    }
    
    public function index($stoelId) {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'samenstellen';        
        
        $this->load->model('stoel_model');
        $stoel = $this->stoel_model->get($stoelId);
        $data['stoel'] = $stoel;
        
        $this->load->model('optie_model');
        //$stoelOpties = $this->optie_model->getAllWithOnderdelen();
        $stoelOpties = $this->optie_model->getAllFromStoelWithOnderdelen($stoelId);
        $data['stoelOpties'] = $stoelOpties;

        $partials = array('header' => 'main_header', 'content' => 'samenstellen', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function index_OUD($stoelId) {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'samenstellen';        
        
        $this->load->model('stoel_model');
        $stoel = $this->stoel_model->get($stoelId);
        $data['stoel'] = $stoel;
        
        // ARMSTEUN TABEL
        $this->load->model('armsteun_model');
        $var = $this->armsteun_model->getAllByStoelId($stoelId);
        $data['armsteunOpties'] = $var;
        
        // HOOFDSTEUN TABEL
        $this->load->model('hoofdsteun_model');
        $var = $this->hoofdsteun_model->getAllByStoelId($stoelId);
        $data['hoofdsteunOpties'] = $var;
        
        // ONDERSTEL TABEL
        $this->load->model('onderstel_model');
        $var = $this->onderstel_model->getAllByStoelId($stoelId);
        $data['onderstelOpties'] = $var;
        
        // STOF TABEL
        $this->load->model('stof_model');
        $var = $this->stof_model->getAllByStoelId($stoelId);
        $data['stofOpties'] = $var;
        
        // WIELEN TABEL
        $this->load->model('wielen_model');
        $var = $this->wielen_model->getAllByStoelId($stoelId);
        $data['wielenOpties'] = $var;
        
        // ZITDIEPTE TABEL
        $this->load->model('zitdiepte_model');
        $var = $this->zitdiepte_model->getAllByStoelId($stoelId);
        $data['zitdiepteOpties'] = $var;
        
        // ZITKANTEL TABEL
        $this->load->model('zitkantel_model');
        $var = $this->zitkantel_model->getAllByStoelId($stoelId);
        $data['zitkantelOpties'] = $var;

        $partials = array('header' => 'main_header', 'content' => 'samenstellen', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function prijs() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'samenstellen';    
        
        // GETS
        $optieOnderdelenIds = $this->input->get('optieOnderdelenIds');
        $stoelId = $this->input->get('stoelId');       
                
        $this->load->model('stoel_model');
        $stoel = $this->stoel_model->get($stoelId);
        $data['stoel'] = $stoel;
        
        $this->load->model('optieonderdeel_model');
        $gekozenOptieOnderdelen = null;
        /*foreach ($optieOnderdelenIds as $value) {
            // ids overlopen en opvragen
            $optieOnderdelen = $this->optieonderdeel_model->get($value);
        }*/
        for ($i = 0; $i < count($optieOnderdelenIds); $i++) {
            if (!($optieOnderdelenIds[$i]) == 0) {
                $gekozenOptieOnderdelen[] = $this->optieonderdeel_model->get($optieOnderdelenIds[$i]);
            }            
        }
        
        if (count($gekozenOptieOnderdelen) == 0) {
            $gekozenOptieOnderdelen = null;
        }
        
        $data['gekozenOptieOnderdelen'] = $gekozenOptieOnderdelen;
        
        $this->load->view('prijs', $data);

        //$partials = array('header' => 'main_header', 'content' => 'samenstellen', 'footer' => 'main_footer');
        //$this->template->load('main_master', $partials, $data);
    }
    
    
    public function prijs_OUD() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'samenstellen';    
        
        // GETS
        $armsteunId = $this->input->get('armsteunId');
        $hoofdsteunId = $this->input->get('hoofdsteunId');
        $onderstelId = $this->input->get('onderstelId');
        $stofId = $this->input->get('stofId');     
        $wielenId = $this->input->get('wielenId');       
        $zitdiepteId = $this->input->get('zitdiepteId');       
        $zitkantelId = $this->input->get('zitkantelId');
        $kleurId = $this->input->get('kleurId');
        $stoelId = $this->input->get('stoelId');       
                
        $this->load->model('stoel_model');
        $stoel = $this->stoel_model->get($stoelId);
        $data['stoel'] = $stoel;
        
        // ARMSTEUN TABEL
        $this->load->model('armsteun_model');
        $var = $this->armsteun_model->get($armsteunId);
        $data['armsteun'] = $var;
        
        // HOOFDSTEUN TABEL
        $this->load->model('hoofdsteun_model');
        $var = $this->hoofdsteun_model->get($hoofdsteunId);
        $data['hoofdsteun'] = $var;
        
        // ONDERSTEL TABEL
        $this->load->model('onderstel_model');
        $var = $this->onderstel_model->get($onderstelId);
        $data['onderstel'] = $var;
        
        // STOF TABEL
        $this->load->model('stof_model');
        $var = $this->stof_model->get($stofId);
        $data['stof'] = $var;
        
        // WIELEN TABEL
        $this->load->model('wielen_model');
        $var = $this->wielen_model->get($wielenId);
        $data['wielen'] = $var;
        
        // ZITDIEPTE TABEL
        $this->load->model('zitdiepte_model');
        $var = $this->zitdiepte_model->get($zitdiepteId);
        $data['zitdiepte'] = $var;
        
        // ZITKANTEL TABEL
        $this->load->model('zitkantel_model');
        $var = $this->zitkantel_model->get($zitkantelId);
        $data['zitkantel'] = $var;
        
        // KLEUR TABEL
        $this->load->model('kleur_model');
        $var = $this->kleur_model->getWithInfo($kleurId);
        $data['kleur'] = $var;
        
        $this->load->view('prijs', $data);

        //$partials = array('header' => 'main_header', 'content' => 'samenstellen', 'footer' => 'main_footer');
        //$this->template->load('main_master', $partials, $data);
    }
    
    public function getstofkleurpallet() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'samenstellen';    
        
        // GETS        
        $stofId = $this->input->get('stofId');             
        $stoelId = $this->input->get('stoelId');       
                
        // GET KLEURPALLETEN VAN STOFID
        $this->load->model('stofkleurpallet_model');
        $stofkleurpalletten = $this->stofkleurpallet_model->getAllByStofIdWithInfo($stofId);
        $data['stofkleurpalletten'] = $stofkleurpalletten; 
        
        $this->load->view('kleurpalletten', $data);        
    }
    
    public function getkleurpalletkleuren() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'samenstellen';    
        
        // GETS        
        $kleurpalletId = $this->input->get('kleurpalletId');             
        $stoelId = $this->input->get('stoelId');       
                
        // GET KLEURPALLETEN VAN STOFID
        $this->load->model('kleur_model');
        $kleuren = $this->kleur_model->getAllByKleurpalletId($kleurpalletId);
        $data['kleuren'] = $kleuren; 
        
        $this->load->view('kleuren', $data);

        //$partials = array('header' => 'main_header', 'content' => 'samenstellen', 'footer' => 'main_footer');
        //$this->template->load('main_master', $partials, $data);
    }
    
    public function toonomschrijving() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'samenstellen';    
        
        // GETS        
        $optienaam = $this->input->get('optienaam');
                
        // GET OMSCHRIJVING 
        $this->load->model('optie_model');
        $optie = $this->optie_model->getByNaam($optienaam);
        $data['optie'] = $optie; 
        
        $this->load->view('omschrijving', $data);

        //$partials = array('header' => 'main_header', 'content' => 'samenstellen', 'footer' => 'main_footer');
        //$this->template->load('main_master', $partials, $data);
    }
    
}