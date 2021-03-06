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
        if ($this->isAdmin()) {
            $data['title'] = global_bedrijfsnaam;
            $data['pagina'] = 'admin index';

            $partials = array('header' => 'admin_header', 'content' => 'admin', 'footer' => 'main_footer');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->noAccess();
        }
    }

    public function menuitems_beheren() {
        if ($this->isAdmin()) {
            $data['title'] = global_bedrijfsnaam;
            $data['pagina'] = 'admin menuitems beheren';

            // ophalen alles producten
            $this->load->model('menuitem_model');
            $producten = $this->menuitem_model->getAll();
            $data['producten'] = $producten;

            $partials = array('header' => 'admin_header', 'content' => 'admin_productenbeheren', 'footer' => 'main_footer');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->noAccess();
        }
    }

    public function editMenuItemNaam() {
        if ($this->isAdmin()) {
            $id = $this->input->get('id');
            $naam = $this->input->get('naam');

            // ophalen alles producten
            $this->load->model('menuitem_model');
            $product = $this->menuitem_model->get($id);
            $product->naam = $naam;
            $this->menuitem_model->update($product);
        } else {
            $this->noAccess();
        }
    }
    public function editMenuItemPrijs() {
        if ($this->isAdmin()) {
            $id = $this->input->get('id');
            $prijs = $this->input->get('prijs');

            // ophalen alles producten
            $this->load->model('menuitem_model');
            $product = $this->menuitem_model->get($id);
            $product->prijs = $prijs;
            $this->menuitem_model->update($product);
        } else {
            $this->noAccess();
        }
    }
    
    public function editMenuItemVlees() {
        if ($this->isAdmin()) {
            $id = $this->input->get('id');
            $value = $this->input->get('value');

            
            $this->load->model('menuitem_model');
            $product = $this->menuitem_model->get($id);
            $product->vlees = $value;
            $this->menuitem_model->update($product);
        } else {
            $this->noAccess();
        }
    }
    public function editMenuItemVis() {
        if ($this->isAdmin()) {
            $id = $this->input->get('id');
            $value = $this->input->get('value');

            
            $this->load->model('menuitem_model');
            $product = $this->menuitem_model->get($id);
            $product->vis = $value;
            $this->menuitem_model->update($product);
        } else {
            $this->noAccess();
        }
    }
    public function editMenuItemPikantheid() {
        if ($this->isAdmin()) {
            $id = $this->input->get('id');
            $value = $this->input->get('pikantheid');

            
            $this->load->model('menuitem_model');
            $product = $this->menuitem_model->get($id);
            $product->pikantheid = $value;
            $this->menuitem_model->update($product);
        } else {
            $this->noAccess();
        }
    }
    
    

    public function deletemenuitembyid() {
        if ($this->isAdmin()) {
            $id = $this->input->get('id');

            $this->load->model('menuitem_model');
            $this->menuitem_model->delete($id);
        } else {
            $this->noAccess();
        }
    }

    public function menuitems_aanmaken() {
        if ($this->isAdmin()) {
            $data['title'] = global_bedrijfsnaam;
            $data['pagina'] = 'admin menuitems aanmaken';

            // ophalen alles producten + categorien
            $this->load->model('categorie_model');
            $categorieen = $this->categorie_model->getAll();
            $data['categorien'] = $categorieen;

            $partials = array('header' => 'admin_header', 'content' => 'admin_productenaanmaken', 'footer' => 'main_footer');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->noAccess();
        }
    }

    public function teksten_beheren() {
        if ($this->isAdmin()) {
            $data['title'] = global_bedrijfsnaam;
            $data['pagina'] = 'Teksten bewerken';

            $this->load->model('tekst_model');
            $teksten = $this->tekst_model->getAll();
            $data['teksten'] = $teksten;

            $partials = array('header' => 'admin_header', 'content' => 'admin_teksten', 'footer' => 'admin_footer');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->noAccess();
        }
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
        if (!$this->session->userdata('admin')) {
            return false;
        } else {
            return $this->session->userdata('admin');
        }
    }

    public function noAccess($foutmelding = "") {

        $data['title'] = global_bedrijfsnaam;
        $data['pagina'] = 'admin login';
        
        $data['foutmelding'] = $foutmelding;

        $partials = array('header' => 'admin_header', 'content' => 'admin_login', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function grafieken() {
        if ($this->isAdmin()) {
            $data['title'] = global_bedrijfsnaam . '';
            $data['pagina'] = 'admin grafieken';

            $this->load->model('tekst_model');
            $teksten = $this->tekst_model->getAll();
            $data['teksten'] = $teksten;

            $partials = array('header' => 'admin_header', 'content' => 'admin_grafieken', 'footer' => 'main_footer');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->noAccess();
        }
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

    public function login() {
        $data['title'] = global_bedrijfsnaam;
        $data['pagina'] = 'Admin - Algemeen';
        $username = $this->input->post('naam');
        $password = $this->input->post('wachtwoord');

        $this->load->model('login_model');
        $login = $this->login_model->getByUsernameAndPassword($username, $password);

        if ($login != null) {
            $this->session->set_userdata('admin', true);
            $this->index();
        } else {
// Geen toegang
            $this->noAccess('Verkeerde login gegevens!');
        }
    }

    public function uitloggen() {
        $this->session->set_userdata('admin', false);
        $this->noAccess();
    }

    public function nieuwmenuitemtoevoegen() {
        $naam = $this->input->post('naam');
        $omschrijving = $this->input->post('omschrijving');
        $prijs = $this->input->post('prijs');
        $categorieNaam = $this->input->post('categorie');

        $this->load->model('categorie_model');
        $cat = $this->categorie_model->getByName($categorieNaam);

        if ($cat == null) {
            // categorie bestaat nog niet dus toevoegen
            $newcat = new stdClass();
            $newcat->naam = $categorieNaam;
            $newcatId = $this->categorie_model->insert($newcat);

            $newcat->id = $newcatId;
            $cat = $newcat;
        }

        $vlees = $this->input->post('vlees');
        $vis = $this->input->post('vis');
        $pikant = $this->input->post('pikant');

        $newprod = new stdClass();
        $newprod->naam = $naam;
        $newprod->omschrijving = $omschrijving;
        $newprod->prijs = $prijs;
        $newprod->categorieId = $cat->id;
        $newprod->vlees = $vlees;
        $newprod->vis = $vis;
        $newprod->pikantheid = $pikant;

        $this->load->model('menuitem_model');
        $this->menuitem_model->insert($newprod);

        $data['title'] = "Product toegevoegd!";
        $data['toegevoegd'] = $newprod->naam . ' is toegevoegd!';

        $partials = array('header' => 'admin_header', 'content' => 'admin_productenaanmaken', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

}
