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

        $partials = array('header' => 'main_header', 'content' => 'admin', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function series_beheren() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'Series beheren';
        
        $this->load->model('serie_model');
        $series = $this->serie_model->getAll();
        $data['series'] = $series;

        $partials = array('header' => 'main_header', 'content' => 'series_beheren/admin_series', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function update_serie() {
        $serie->id = $this->input->post('id');
        $serie->naam = $this->input->post('naam');
        $serie->omschrijving = $this->input->post('omschrijving');
        //$serie->prijs = $this->input->post('prijs');
        //$serie->promoprijs = $this->input->post('promoprijs');
        $serie->fotopad = $this->input->post('fotopad');

        $this->load->model('serie_model');
        if ($serie->id == 0) {
            $id = $this->serie_model->insert($serie);
        } else {
            $this->serie_model->update($serie);
        }

        echo $id;
    }
    
    public function delete_serie() {
        $id = $this->input->get('id');

        $this->load->model('serie_model');
        echo $this->serie_model->delete($id);
    }
    
    public function read_serie() {
        
        $id = $this->input->get('id');

        $this->load->model('serie_model');
        $serie = $this->serie_model->get($id);

        echo json_encode($serie);
    }
    
    public function stoelen_beheren() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'Stoelen beheren';
        
        $this->load->model('stoel_model');
        $stoelen = $this->stoel_model->getAll();
        $data['stoelen'] = $stoelen;

        $partials = array('header' => 'main_header', 'content' => 'stoelen_beheren/admin_stoelen', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function update_stoel() {
        $stoel->id = $this->input->post('id');
        $stoel->naam = $this->input->post('naam');
        $stoel->omschrijving = $this->input->post('omschrijving');
        //$stoel->prijs = $this->input->post('prijs');
        //$stoel->promoprijs = $this->input->post('promoprijs');
        $stoel->fotopad = $this->input->post('fotopad');

        $this->load->model('stoel_model');
        if ($stoel->id == 0) {
            $id = $this->stoel_model->insert($stoel);
        } else {
            $this->stoel_model->update($stoel);
        }

        echo $id;
    }
    
    public function delete_stoel() {
        $id = $this->input->get('id');

        $this->load->model('stoel_model');
        echo $this->stoel_model->delete($id);
    }
    
    public function read_stoel() {
        
        $id = $this->input->get('id');

        $this->load->model('stoel_model');
        $stoel = $this->stoel_model->get($id);

        echo json_encode($stoel);
    }

}