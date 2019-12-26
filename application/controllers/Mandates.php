<?php
class Mandates extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('mandates_map');
        }

        public function view()
        {
                $this->load->helper('url');
                $data['title'] = "Mandate";
                $this->load->view('templates/header', $data);
                $this->load->view('mandates/map', $data);
                $this->load->view('templates/footer', $data);

        }

        public function map()
        {
                $this->load->model('mandates_map');
                $data["baden_wuerttemberg"] = $this->mandates_map->getByState("baden_wuerttemberg");
                $data["bayern"] = $this->mandates_map->getByState("bayern");
                $data["hessen"] = $this->mandates_map->getByState("hessen");
                $data["berlin"] = $this->mandates_map->getByState("berlin");
                $data["brandenburg"] = $this->mandates_map->getByState("brandenburg");
                $data["bremen"] = $this->mandates_map->getByState("bremen");
                $data["hamburg"] = $this->mandates_map->getByState("hamburg");
                $data["mecklenburg_vorpommern"] = $this->mandates_map->getByState("mecklenburg_vorpommern");
                $data["niedersachsen"] = $this->mandates_map->getByState("niedersachsen");
                $data["nordrhein_westfalen"] = $this->mandates_map->getByState("nordrhein_westfalen");
                $data["rheinland_pfalz"] = $this->mandates_map->getByState("rheinland_pfalz");
                $data["saarland"] = $this->mandates_map->getByState("saarland");
                $data["sachsen"] = $this->mandates_map->getByState("sachsen");
                $data["sachsen_anhalt"] = $this->mandates_map->getByState("sachsen_anhalt");
                $data["schleswig_holstein"] = $this->mandates_map->getByState("schleswig_holstein");
                $data["thueringen"] = $this->mandates_map->getByState("thueringen");

                $data["landesparlament"] = $this->mandates_map->getState();
                $data["bundestag"] = $this->mandates_map->getCountry();
                $data["europaparlament"] = $this->mandates_map->getEu();

                $data['total_mandates'] = $this->mandates_map->getTotalMandates();
                $data['ep_mandates'] = $this->mandates_map->getEpMandates();
                $data['bt_mandates'] = $this->mandates_map->getBtMandates();
                $data['lt_mandates'] = $this->mandates_map->getLtMandates();
                $data['local_mandates'] = $this->mandates_map->getLocalMandates();
                $data['users']  = $this->mandates_map->getUsers();
                $data['files']  = $this->mandates_map->getFiles();

                //echo var_dump($data["markers"]);

                $this->load->helper('url');
                $data['title'] = "Mandate";
                $this->load->view('templates/header', $data);
                $this->load->view('mandates/map', $data);
                $this->load->view('templates/footer', $data);

        }

        public function single($id = 0) {
                $this->load->model('mandates_single');
                $data["title"] = "Mandatsträger";
                $data['data'] = $this->mandates_single->getData($id);
                $this->load->view('templates/header', $data);
                if ($data['data'] != False) {
                        $this->load->view('mandates/single', $data);
                } else {
                        $this->load->view('mandates/single_error', $data);
                }
                
                $this->load->view('templates/footer', $data);
        }

        public function list($state = '') {
                $this->load->helper('form');
                $this->load->model('mandates_list');
                $data['data'] = $this->mandates_list->getList($state);

                $data['title'] = "Mandate";
                $this->load->view('templates/header', $data);
                $this->load->view('mandates/list', $data);
                $this->load->view('templates/footer', $data);
        }

        public function stats() {
                $this->load->model('mandates_stats');
                $data['total_mandates'] = $this->mandates_stats->getTotalMandates();
                $data['ep_mandates'] = $this->mandates_stats->getEpMandates();
                $data['ep_mandates_rel'] = 100*($data['ep_mandates']/$data['total_mandates']);
                $data['bt_mandates'] = $this->mandates_stats->getBtMandates();
                $data['bt_mandates_rel'] = 100*($data['bt_mandates']/$data['total_mandates']);
                $data['lt_mandates'] = $this->mandates_stats->getLtMandates();
                $data['lt_mandates_rel'] = 100*($data['lt_mandates']/$data['total_mandates']);
                $data['local_mandates'] = $this->mandates_stats->getLocalMandates();
                $data['local_mandates_rel'] = 100*($data['local_mandates']/$data['total_mandates']);
                $data['by_state'] = $this->mandates_stats->getMandatesByState();
                $data['by_institution'] = $this->mandates_stats->getMandatesByInstitution();
                $data['by_list'] = $this->mandates_stats->getMandatesByList();
                $data['by_group'] = $this->mandates_stats->getMandatesByGroup();

                $data['title'] = "Statistik";
                $this->load->view('templates/header', $data);
                $this->load->view('mandates/stats', $data);
                $this->load->view('templates/footer', $data);
        }
}

