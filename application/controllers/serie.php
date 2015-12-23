<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Serie extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index($serieId) {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'Serie';

        // eerst kijken of de serie subrubrieken heeft.
        $this->load->model('serie_model');
        $series = $this->serie_model->getAllSubrubriekenBySerieId($serieId);

        if (count($series) != 0) {
            // heeft subrubrieken
            $data['series'] = $series;

            $partials = array('header' => 'main_header', 'content' => 'index', 'footer' => 'main_footer');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->load->model('stoel_model');
            $stoelen = $this->stoel_model->getAllBySerieId($serieId);
            $data['stoelen'] = $stoelen;

            $partials = array('header' => 'main_header', 'content' => 'serie', 'footer' => 'main_footer');
            $this->template->load('main_master', $partials, $data);
        }
    }

}
