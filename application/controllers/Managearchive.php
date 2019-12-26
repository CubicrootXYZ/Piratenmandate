

<?php
//array(1) { ["upload_data"]=> array(14) { ["file_name"]=> string(36) "bdad8d2642da56985c4afdc414be77ed.jpg" ["file_type"]=> string(10) "image/jpeg" ["file_path"]=> string(22) "/var/www/html/uploads/" ["full_path"]=> string(58) "/var/www/html/uploads/bdad8d2642da56985c4afdc414be77ed.jpg" ["raw_name"]=> string(32) "bdad8d2642da56985c4afdc414be77ed" ["orig_name"]=> string(24) "the-road-815297_1920.jpg" ["client_name"]=> string(24) "the-road-815297_1920.jpg" ["file_ext"]=> string(4) ".jpg" ["file_size"]=> float(962.28) ["is_image"]=> bool(true) ["image_width"]=> int(1920) ["image_height"]=> int(1280) ["image_type"]=> string(4) "jpeg" ["image_size_str"]=> string(26) "width="1920" height="1280"" } } 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Managearchive extends Auth_Controller
{
 
    public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

    public function upload() {
        $this->load->model('manage_archive');
        $data['states'] = $this->manage_archive->getStates();
        $data['errors'] = '';
        $data['topics'] = $this->manage_archive->getTopics();
        $data['title'] = "Akte anlegen";
        $error = false;
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'pdf|jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 2000;
        $config['max_height']           = 2000;
        $config['encrypt_name']           = true;
        
        $this->load->library('upload', $config);

        $this->form_validation->set_rules('title', 'Titel', 'required|max_length[40]');
        $error = !$this->form_validation->run();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $val = $this->manage_archive->validateForm($this->input->post('state_name'), $this->input->post('topic'));
            $data['errors'] = $val['errors'];

            if (!$val['validation']) {
                $error = true;
            }
        }
        

        if ($this->ion_auth->logged_in() && $error == true) {
            //$data['errors'] = '';
            $this->load->view('templates/header', $data);
            $this->load->view('manage_archive/upload', $data);
            $this->load->view('templates/footer', $data);
        } else if ($this->ion_auth->logged_in() && $error == false) {
            if ( ! $this->upload->do_upload('userfile'))
            {
                    $errors = array('error' => $this->upload->display_errors());
                    $data['errors'] .= $errors['error'];
                    $this->load->view('templates/header', $data);
                    $this->load->view('manage_archive/upload', $data);
                    $this->load->view('templates/footer', $data);
            }
            else
            {
                    $upload_data = array('upload_data' => $this->upload->data());
                    if ($this->manage_archive->insert($upload_data, $val['state_id'], $val['topic_id'])) {
                        $data['show_message'] = 'Akte erfolgreich angelegt.';
                        $this->load->view('templates/header', $data);
                        $this->load->view('success', $data);
                        $this->load->view('templates/footer', $data);
                    } else {
                        $data['show_message'] = 'Fehler beim Eintragen in die Datenbank.';
                        $this->load->view('templates/header', $data);
                        $this->load->view('fail', $data);
                        $this->load->view('templates/footer', $data);
                    }
                    
            }
        } else {
            show_404();
        }
    }

    public function delete($id = 0) {
        $this->load->model('manage_archive');
        $data['title'] = "Akte löschen";

        $inserted_by = $this->manage_archive->getDossierUser($id);

        if ($inserted_by == $this->ion_auth->get_user_id() || $this->ion_auth->in_group(['admin', 'superuser'])) {
            $res = $this->manage_archive->delete($id);

            if ($res == True) {
                $data['show_message'] = 'Akte erfolgreich gelöscht.';
                $this->load->view('templates/header', $data);
                $this->load->view('success', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $data['show_message'] = 'Akte konnte nicht gelöscht werden.';
                $this->load->view('templates/header', $data);
                $this->load->view('fail', $data);
                $this->load->view('templates/footer', $data);
            }
        } else {
            show_404();
        }
    }

    public function delete_file($id = 0) {
        $this->load->model('manage_archive');
        $data['title'] = "Datei löschen";

        $inserted_by = $this->manage_archive->getFileUser($id);
        $dossier_inserted_by = $this->manage_archive->getFileDossierUser($id);

        if ($inserted_by == $this->ion_auth->get_user_id() || $this->ion_auth->in_group(['admin', 'superuser']) || $dossier_inserted_by == $this->ion_auth->get_user_id()) {
            $res = $this->manage_archive->deleteFile($id);

            if ($res == True) {
                $data['show_message'] = 'Datei erfolgreich gelöscht.';
                $this->load->view('templates/header', $data);
                $this->load->view('success', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $data['show_message'] = 'Datei konnte nicht gelöscht werden.';
                $this->load->view('templates/header', $data);
                $this->load->view('fail', $data);
                $this->load->view('templates/footer', $data);
            }
        } else {
            show_404();
        }
    }

    public function delete_file_admin($id = 0) {
        $this->load->model('manage_archive');
        $this->load->helper('url');
        $data['title'] = "Datei löschen";

        $inserted_by = $this->manage_archive->getFileUser($id);
        $dossier_inserted_by = $this->manage_archive->getFileDossierUser($id);

        if ($inserted_by == $this->ion_auth->get_user_id() || $this->ion_auth->in_group(['admin', 'superuser']) || $dossier_inserted_by == $this->ion_auth->get_user_id()) {
            $res = $this->manage_archive->deleteFile($id);

            if ($res == True) {
                redirect('/managearchive/file_list', 'refresh');

            } else {
                $data['show_message'] = 'Datei konnte nicht gelöscht werden.';
                $this->load->view('templates/header', $data);
                $this->load->view('fail', $data);
                $this->load->view('templates/footer', $data);
            }
        } else {
            show_404();
        }
    }

    public function upload_single($id = 0) {
        $this->load->model('manage_archive');
        $data['title'] = "Datei hinzufügen";
        $data['id'] = $id;

        $inserted_by = $this->manage_archive->getDossierUser($id);

        if ($inserted_by == $this->ion_auth->get_user_id() || $this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user'])) {

            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'pdf|jpg|png';
            $config['max_size']             = 10000;
            $config['max_width']            = 2000;
            $config['max_height']           = 2000;
            $config['encrypt_name']           = true;
            
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $errors = array('error' => $this->upload->display_errors());
                    $this->load->view('templates/header', $data);
                    $this->load->view('manage_archive/upload_single', $data);
                    $this->load->view('templates/footer', $data);
            }
            else
            {
                    $upload_data = array('upload_data' => $this->upload->data());
                    if ($this->manage_archive->addFile($upload_data, $id)) {
                        $data['show_message'] = 'Datei erfolgreich hinzugefügt.';
                        $this->load->view('templates/header', $data);
                        $this->load->view('success', $data);
                        $this->load->view('templates/footer', $data);
                    } else {
                        $data['show_message'] = 'Fehler beim Hochladen.';
                        $this->load->view('templates/header', $data);
                        $this->load->view('fail', $data);
                        $this->load->view('templates/footer', $data);
                    }
                    
            }

             
        } else {
            show_404();
        }
    }

    public function list() {
        $this->load->helper('form');
        $this->load->model('archive_list');
        $data['states'] = $this->archive_list->getStates();
        $data['errors'] = '';
        $data['topics'] = $this->archive_list->getTopics();
        $data['title'] = "Archiv";
        $data['data'] = $this->archive_list->getList();


        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $this->load->view('templates/header', $data);
            $this->load->view('manage_archive/list', $data);
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
        
    }

    public function file_list() {
        $this->load->helper('form');
        $this->load->model('manage_archive');
        $data['data'] = $this->manage_archive->getFilesList();
        $data['title'] = 'Dokumentenliste';


        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $this->load->view('templates/header', $data);
            $this->load->view('manage_archive/file_list', $data);
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
        
    }

    public function bulk_delete() {
        $this->load->model('manage_archive');
        $this->load->helper('form');
        $this->load->helper('url');
        $data['title'] = 'Akten löschen';
        $this->load->database();
        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $raw = $this->input->post('bulk_delete');
            $arr = explode(",", $raw);

            foreach ($arr as $entry) {
           
                $this->manage_archive->delete($entry);
        
            }

            redirect('/managearchive/list', 'refresh');
        
        }else {
            show_404();
        }
    }

    public function bulk_delete_file() {
        $this->load->model('manage_archive');
        $this->load->helper('form');
        $this->load->helper('url');
        $data['title'] = 'Akten löschen';
        $this->load->database();
        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $raw = $this->input->post('bulk_delete');
            $arr = explode(",", $raw);

            foreach ($arr as $entry) {
           
                $this->manage_archive->deleteFile($entry);
        
            }

            redirect('/managearchive/file_list', 'refresh');
        
        }else {
            show_404();
        }
    }

}
