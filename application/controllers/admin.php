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

    public function series_beheren() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'Series beheren';

        $this->load->model('serie_model');
        $series = $this->serie_model->getAllHoofdRubrieken();
        $data['series'] = $series;

        $partials = array('header' => 'admin_header', 'content' => 'series_beheren/admin_series', 'footer' => 'admin_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function stoelen_beheren() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'Stoelen beheren';

        //$this->load->model('stoel_model');
        //$stoelen = $this->stoel_model->getLastAmount(8);
        //$data['stoelen'] = $stoelen;

        $this->load->model('stoel_model');
        $stoelen = $this->stoel_model->getAll();
        $data['stoelen'] = $stoelen;

        $partials = array('header' => 'admin_header', 'content' => 'stoelen_beheren/admin_stoelen', 'footer' => 'admin_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function serie_bewerken($id) {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'Series bewerken';

        $this->load->model('serie_model');
        $serie = $this->serie_model->getWithSubs($id);
        $data['serie'] = $serie;

        $this->load->model('serie_model');
        $alleSeries = $this->serie_model->getAll();
        $data['alleSeries'] = $alleSeries;

        $partials = array('header' => 'admin_header', 'content' => 'series_beheren/admin_serie_bewerken', 'footer' => 'admin_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function serie_toevoegen() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'Series bewerken';

        //$this->load->model('serie_model');
        //$serie = $this->serie_model->getWithSubs($id);
        //$data['serie'] = $serie;

        $this->load->model('serie_model');
        $alleSeries = $this->serie_model->getAll();
        $data['alleSeries'] = $alleSeries;

        $partials = array('header' => 'admin_header', 'content' => 'series_beheren/admin_serie_bewerken', 'footer' => 'admin_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function update_serie() {
        $serie = new stdClass();
        $serie->id = $this->input->post('id');
        $id = $serie->id;
        $serie->naam = $this->input->post('naam');
        $naam = $serie->naam;
        $serie->omschrijving = $this->input->post('omschrijving');
        $serie->hoofdrubriekId = $this->input->post('hoofdrubriek');

        // foto        
        $fotonaam = ($id) . " - " . $naam;

        if ($id == 0) {
            $this->load->model('serie_model');
            $lastSerie = $this->serie_model->getLastSerie();
            if ($lastSerie == null) {
                $lastId = 0;
            } else {
                $lastId = $lastSerie->id;
            }
            $fotonaam = ($lastId + 1) . " - " . $naam;
        }

        // fileupload
        $config['upload_path'] = 'application/images/series';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '10000000000000';
        $config['file_name'] = $fotonaam; // dit vervangt automatisch spaties door _ !!!!
        $config['overwrite'] = TRUE;
        //$config['max_width'] = '1024';
        //$config['max_height'] = '768';
        //$this->load->library('upload', $config);
        //$artikelFoto = new stdClass();
        $count = count($_FILES['userfile']['size']);
        foreach ($_FILES as $key => $value) {
            for ($s = 0; $s <= $count - 1; $s++) {
                $_FILES['userfile']['name'] = $value['name'][$s];
                $_FILES['userfile']['type'] = $value['type'][$s];
                $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                $_FILES['userfile']['error'] = $value['error'][$s];
                $_FILES['userfile']['size'] = $value['size'][$s];
                $config['upload_path'] = 'application/images/series';

                $this->load->library('upload', $config);
                $this->upload->do_upload();

                //zoek extensie
                $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.

                if (isset($upload_data) && $upload_data != null) {
                    $file_ext = $upload_data['file_ext'];
                    if ($file_ext != '' && $file_ext != null) {
                        // PAS OP ALS GE EEN JPG EN PNG ETC UPLOAD DAN KOMT DA NI GOED IN DE MAP / DATABASE
                        if ($s == 0) {
                            $serie->fotopad = "images/series/" . str_replace(' ', '_', $fotonaam) . '' . $file_ext;
                        } else {
                            // voor meerdere fotos, voorzie een extra tabel. HIER KOM JE ENKEL IN BIJ DE 2e etc foto
                            //$artikelFoto->artikelId = $lastId + 1;
                            //$artikelFoto->imagePath = "images/artikels/" . str_replace(' ', '_', $fotonaam) . '' . $s . $file_ext;
                            //$this->artikelfoto_model->insert($artikelFoto);
                        }
                    }
                }
            }
        }



        $this->load->model('serie_model');
        if ($serie->id == 0) {
            $id = $this->serie_model->insert($serie);
        } else {
            $this->serie_model->update($serie);
        }
        $serie = null;
        $serie = $this->serie_model->getWithSubs($id);
        $data['serie'] = $serie;
        $data['title'] = 'Serie aangepast';

        $this->load->model('serie_model');
        $alleSeries = $this->serie_model->getAll();
        $data['alleSeries'] = $alleSeries;

        $data['aangepast'] = "Het artikel is aangepast!";
        $partials = array('header' => 'admin_header', 'content' => 'series_beheren/admin_serie_bewerken', 'footer' => 'admin_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function zoekstoelenbyinput() {
        $input = $this->input->get('input');

        $this->load->model('stoel_model');
        $stoelen = $this->stoel_model->getAllByInput($input);
        $data['stoelen'] = $stoelen;

        $this->load->view('stoelen_beheren/admin_stoelen_zoeken', $data);
    }

    public function stoel_bewerken($id) {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'Series bewerken';

        $this->load->model('stoel_model');
        $stoel = $this->stoel_model->get($id);
        $data['stoel'] = $stoel;

        $this->load->model('serie_model');
        $alleSeries = $this->serie_model->getAll();
        $data['alleSeries'] = $alleSeries;
        
        $this->load->model('optie_model');
        $alleOpties = $this->optie_model->getAllWithOnderdelen();
        $data['alleOpties'] = $alleOpties;
        
        $this->load->model('stoeloptieonderdeel_model');
        $alleToegewezenOptieOnderdelen = $this->stoeloptieonderdeel_model->getAllByStoelId($id);
        $data['alleToegewezenOptieOnderdelen'] = $alleToegewezenOptieOnderdelen;

        $partials = array('header' => 'admin_header', 'content' => 'stoelen_beheren/admin_stoel_bewerken', 'footer' => 'admin_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function stoel_toevoegen() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'Series bewerken';

        //$this->load->model('serie_model');
        //$serie = $this->serie_model->getWithSubs($id);
        //$data['serie'] = $serie;

        $this->load->model('serie_model');
        $alleSeries = $this->serie_model->getAll();
        $data['alleSeries'] = $alleSeries;
        
        $this->load->model('optie_model');
        $alleOpties = $this->optie_model->getAllWithOnderdelen();
        $data['alleOpties'] = $alleOpties;
        
        
        $data['alleToegewezenOptieOnderdelen'] = array();

        $partials = array('header' => 'admin_header', 'content' => 'stoelen_beheren/admin_stoel_bewerken', 'footer' => 'admin_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function update_stoel() {
        $stoel = new stdClass();
        $stoel->id = $this->input->post('id');
        $id = $stoel->id;
        $stoel->naam = $this->input->post('naam');
        $naam = $stoel->naam;
        $stoel->omschrijving = $this->input->post('omschrijving');
        $stoel->serieId = $this->input->post('hoofdrubriek');
        $stoel->prijs = $this->input->post('prijs');
        $stoel->promoprijs = $this->input->post('promoprijs');
        $stoel->youtubeLink = $this->input->post('youtubelink');
        $stoel->pdfPath = $this->input->post('pdfpath');
        $stoel->spotlight = $this->input->post('spotlight');
        $stoel->archief = $this->input->post('archief');



        // foto        
        $fotonaam = ($id) . " - " . $naam;

        if ($id == 0) {
            $this->load->model('stoel_model');
            $lastSerie = $this->stoel_model->getLastStoel();
            if ($lastSerie == null) {
                $lastId = 0;
            } else {
                $lastId = $lastSerie->id;
            }
            $fotonaam = ($lastId + 1) . " - " . $naam;
        }

        
        // pdf uploaden
        $config2['upload_path'] = 'application/files/stoelen';
        $config2['allowed_types'] = 'pdf|PDF';
        $config2['max_size'] = '10000000000000';
        $config2['file_name'] = $fotonaam; // dit vervangt automatisch spaties door _ !!!!
        $config2['overwrite'] = TRUE;
        //$config['overwrite'] = TRUE;
        //$config['max_width'] = '1024';
        //$config['max_height'] = '768';
        //$this->load->library('upload', $config);
        //$artikelFoto = new stdClass();        


        $this->load->library('upload', $config2);
        $this->upload->initialize($config2);
        $this->upload->do_upload('filepdf');

        //zoek extensie
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.

        if (isset($upload_data) && $upload_data != null) {
            $file_ext = $upload_data['file_ext'];
            if ($file_ext != '' && $file_ext != null) {
                // PAS OP ALS GE EEN JPG EN PNG ETC UPLOAD DAN KOMT DA NI GOED IN DE MAP / DATABASE

                $stoel->pdfPath = "files/stoelen/" . str_replace(' ', '_', $fotonaam) . '' . $file_ext;
            }
        }

// foto uploaden
        $config['upload_path'] = 'application/images/stoelen';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
        $config['max_size'] = '10000000000000';
        $config['file_name'] = $fotonaam; // dit vervangt automatisch spaties door _ !!!!
        $config['overwrite'] = TRUE;
        $files = $_FILES;
        $count = count($_FILES['userfile']['size']);

        for ($s = 0; $s <= $count - 1; $s++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$s];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$s];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$s];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$s];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$s];
            $config['upload_path'] = 'application/images/stoelen';

            //$this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload();

            //zoek extensie
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.

            if (isset($upload_data) && $upload_data != null) {
                $file_ext = $upload_data['file_ext'];
                if ($file_ext != '' && $file_ext != null) {
                    // PAS OP ALS GE EEN JPG EN PNG ETC UPLOAD DAN KOMT DA NI GOED IN DE MAP / DATABASE
                    if ($s == 0) {
                        $stoel->fotopad = "images/stoelen/" . str_replace(' ', '_', $fotonaam) . '' . $file_ext;
                    } else {
                        // voor meerdere fotos, voorzie een extra tabel. HIER KOM JE ENKEL IN BIJ DE 2e etc foto
                        //$artikelFoto->artikelId = $lastId + 1;
                        //$artikelFoto->imagePath = "images/artikels/" . str_replace(' ', '_', $fotonaam) . '' . $s . $file_ext;
                        //$this->artikelfoto_model->insert($artikelFoto);
                    }
                }
            }
        }



        /* $config['upload_path'] = 'application/files/stoelen/';
          $path=$config['upload_path'];
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|PDF';
          $config['max_size'] = '10000000000000';
          $config['file_name'] = $fotonaam; // dit vervangt automatisch spaties door _ !!!!
          $config['overwrite'] = TRUE;
          $this->load->library('upload');
          foreach ($_FILES as $fieldname => $fileObject) {  //fieldname is the form field name
          if (!empty($fileObject['filepdf'])) {
          $this->upload->initialize($config);
          if (!$this->upload->do_upload($fieldname)) {
          $errors = $this->upload->display_errors();
          flashMsg($errors);
          } else {
          // Code After Files Upload Success GOES HERE
          }
          }
          } */

        $this->load->model('stoel_model');
        if ($stoel->id == 0) {
            $id = $this->stoel_model->insert($stoel);
        } else {
            $this->stoel_model->update($stoel);
        }
        $stoel = null;
        $stoel = $this->stoel_model->get($id);
        $data['stoel'] = $stoel;
        $data['title'] = 'Stoel aangepast';

        $this->load->model('serie_model');
        $alleSeries = $this->serie_model->getAll();
        $data['alleSeries'] = $alleSeries;

        $data['aangepast'] = "De stoel is aangepast!";
        $partials = array('header' => 'admin_header', 'content' => 'stoelen_beheren/admin_stoel_bewerken', 'footer' => 'admin_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    
    
    public function verwijderoptieonderdeelvanstoel() {
        $stoelOptieOnderdeelId = $this->input->get('stoelOptieOnderdeelId');
        $this->load->model('stoeloptieonderdeel_model');
        $this->stoeloptieonderdeel_model->delete($stoelOptieOnderdeelId);
        
        return "succes";
    }
    
    public function voegoptieonderdeelaanstoeltoe() {
        $optieOnderdeelId = $this->input->get('optieOnderdeelId');
        $stoelId = $this->input->get('stoelId');
        $optieId = $this->input->get('optieId');
        
        $stoeloptieonderdeel = new stdClass();
        $stoeloptieonderdeel->optieOnderdeelId = $optieOnderdeelId;
        $stoeloptieonderdeel->stoelId = $stoelId;
        $stoeloptieonderdeel->optieId = $optieId;

        $this->load->model('stoeloptieonderdeel_model');
        $id = $this->stoeloptieonderdeel_model->insert($stoeloptieonderdeel);        
        
        $alleToegewezenOptieOnderdelen = $this->stoeloptieonderdeel_model->getAllFromOptieByStoelId($stoelId, $optieId);
        $data['opties'] = $alleToegewezenOptieOnderdelen;        

        $this->load->view('stoelen_beheren/admin_stoelen_opties', $data);
    }    
    
    public function voegnieuweoptieonderdeelaanstoeltoe() {
        $optieNaam = $this->input->get('optieNaam');
        $optiePrijs = $this->input->get('optiePrijs');
        $optiePromoPrijs = $this->input->get('optiePromoPrijs');
        $stoelId = $this->input->get('stoelId');
        $optieId = $this->input->get('optieId');
        
        $optieonderdeel = new stdClass();
        $optieonderdeel->naam = $optieNaam;
        $optieonderdeel->prijs = $optiePrijs;
        $optieonderdeel->promoPrijs = $optiePromoPrijs;
        $optieonderdeel->optieId = $optieId;
        
        $this->load->model('optieonderdeel_model');
        $optieOnderdeelId = $this->optieonderdeel_model->insert($optieonderdeel);     
        
        $stoeloptieonderdeel = new stdClass();
        $stoeloptieonderdeel->optieOnderdeelId = $optieOnderdeelId;
        $stoeloptieonderdeel->stoelId = $stoelId;
        $stoeloptieonderdeel->optieId = $optieId;

        $this->load->model('stoeloptieonderdeel_model');
        $id = $this->stoeloptieonderdeel_model->insert($stoeloptieonderdeel);        
        
        $alleToegewezenOptieOnderdelen = $this->stoeloptieonderdeel_model->getAllFromOptieByStoelId($stoelId, $optieId);
        $data['opties'] = $alleToegewezenOptieOnderdelen;        

        $this->load->view('stoelen_beheren/admin_stoelen_opties', $data);
    }

    
    public function laadtoegewezenstoelopties() {
        
        // niet gebruikt nog niet
        $optieId = $this->input->get('optieId');
        $stoelId = $this->input->get('stoelId');

        $this->load->model('stoeloptieonderdeel_model');
        $alleToegewezenOptieOnderdelen = $this->stoeloptieonderdeel_model->getAllFromOptieByStoelId($stoelId, $optieId);
        $data['opties'] = $alleToegewezenOptieOnderdelen;

        $this->load->view('stoelen_beheren/admin_stoelen_opties', $data);
    }
    
    
    
    
    
    
    
    
    

    public function update_serie_DIA() {
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

    public function stoelen_beheren_OUD() {
        $data['title'] = 'Buromas - Bureaustoelen';
        $data['pagina'] = 'Stoelen beheren';

        $this->load->model('stoel_model');
        $stoelen = $this->stoel_model->getAll();
        $data['stoelen'] = $stoelen;

        $partials = array('header' => 'main_header', 'content' => 'stoelen_beheren/admin_stoelen', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function update_stoel_OUD() {
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
