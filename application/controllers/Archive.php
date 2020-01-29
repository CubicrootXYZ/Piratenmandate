<?php
class Archive extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('mandates_map');
        }

        public function list() {
            $this->load->helper('form');
            $this->load->model('archive_list');
            $data['states'] = $this->archive_list->getStates();
            $data['errors'] = '';
            $data['topics'] = $this->archive_list->getTopics();
            $data['title'] = "Archiv";
            $data['data'] = $this->archive_list->getList();

            $this->load->view('templates/header', $data);
            $this->load->view('archive/list', $data);
            $this->load->view('templates/footer', $data);
        }

        public function dossier($id = 0) {
                $this->load->model('archive_list');
                $data['data'] = $this->archive_list->getDossier($id);

                if (isset($data['data']['title'])) {
                        $data['title'] = $data['data']['title'];
                } else {
                        $data['title'] = 'Dossier';
                }
                if ($id == 0 ||$data['data'] == False) {
                        show_404();
                } else {
                        $this->load->view('templates/header', $data);
                        $this->load->view('archive/dossier', $data);
                        $this->load->view('templates/footer', $data);  
                }
        }


}

