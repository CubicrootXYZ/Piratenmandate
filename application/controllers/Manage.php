

<?php
//select users.username, users_groups.group_id from users INNER JOIN users_groups on (users.id = users_groups.user_id) 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Manage extends Auth_Controller
{
 
    public function index()
    {   
        if ($this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user', 'members'])) {
            $data['title'] = "Manage";
            $this->load->view('templates/header', $data);
                $this->load->view('manage/dashboard', $data);
                $this->load->view('templates/footer', $data);
        } else {
            // redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
        }
        
    }

    public function delete_all($id = 0) {
        $data['title'] = "Userdaten löschen";
        $this->load->model('manage_archive');

        if ($this->ion_auth->is_admin($id)) {
            show_404();
        }

        if ($this->ion_auth->is_admin()) {
            $this->manage_archive->delete_all($id);
            $data['show_message'] = "Daten gelöscht.";
                    $this->load->view('templates/header', $data);
                    $this->load->view('success', $data);
                    $this->load->view('templates/footer', $data);
        } else if ($this->ion_auth->logged_in() && $id == $this->ion_auth->get_user_id()) {
            $this->manage_archive->delete_all($id);
            $data['show_message'] = "Daten gelöscht.";
                    $this->load->view('templates/header', $data);
                    $this->load->view('success', $data);
                    $this->load->view('templates/footer', $data);
            
        } else {
            show_404();
        }
    }

    public function mandate_new() {
        if ($this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user', 'members'])) {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('manage_mandatenew');
            $error = false;

            $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('parliamentary_group', 'Fraktion', 'max_length[50]');
            $this->form_validation->set_rules('postal_code', 'Postleitzahl', 'max_length[8]');
            $this->form_validation->set_rules('institution_display_name', 'Institution (Anzeigenamen)', 'required|max_length[50]');
            $this->form_validation->set_rules('mandate_start', 'Mandatsbeginn', 'required');
            $this->form_validation->set_rules('mandate_end', 'Mandatsende', 'required');
            $this->form_validation->set_rules('status', 'Status', 'in_list[0,1,2,3]');
            $this->form_validation->set_rules('institution', 'Institution', 'required');

            $val = $this->manage_mandatenew->validateForm($this->input->post('state_name'), $this->input->post('postal_code'), $this->input->post('status'));
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $data['errors'] = $val['errors'];
            } else {
                $data['errors'] = '';
            }
            

            if (!$val['validation']) {
                $error = true;
            }

            $data['title'] = "Manage";

            if ($this->form_validation->run() === FALSE || $error === true)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('manage/mandatenew', $data);
                $this->load->view('templates/footer', $data);
            } else {
                if ($this->manage_mandatenew->insert($val['city_id'], $val['state_id'])) {
                    $data['show_message'] = "Mandatsträger erfolgreich angelegt.";
                    $this->load->view('templates/header', $data);
                    $this->load->view('success', $data);
                    $this->load->view('templates/footer', $data);
                } else {
                    $data['error'] = 'Datenbankfehler! ';
                    $this->load->view('templates/header', $data);
                    $this->load->view('manage/mandatenew', $data);
                    $this->load->view('templates/footer', $data);
                }
                
            }
        } else {
            // redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
        }
    }

    public function mandate_list() {
        $this->load->model('manage_mandatelist');
        $this->load->helper('form');
        

        $data['title'] = "Mandate";

        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $data['data'] = $this->manage_mandatelist->getList();
            $this->load->view('templates/header', $data);
            $this->load->view('manage/mandatelist', $data);
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }

    public function mandate_edit($id = '0') {
        $this->load->model('manage_mandateedit');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $error = false;
        $data['mandate_id'] = $id;
        

        $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]');
        $this->form_validation->set_rules('parliamentary_group', 'Fraktion', 'max_length[50]');
        $this->form_validation->set_rules('postal_code', 'Postleitzahl', 'max_length[8]');
        $this->form_validation->set_rules('institution_display_name', 'Institution (Anzeigenamen)', 'required|max_length[50]');
        $this->form_validation->set_rules('mandate_start', 'Mandatsbeginn', 'required');
        $this->form_validation->set_rules('mandate_end', 'Mandatsende', 'required');
        $this->form_validation->set_rules('status', 'Status', 'in_list[0,1,2,3]');
        $this->form_validation->set_rules('institution', 'Institution', 'required');
        $form_val = $this->form_validation->run();

        if (isset($_POST['name'])){       

            $val = $this->manage_mandateedit->validateForm($this->input->post('state_name'), $this->input->post('postal_code'), $this->input->post('status'));
            $data['errors'] = $val['errors'];
            if (!$val['validation']) {
                $error = true;
            }

            $data['name'] = $this->input->post('name');
            $data['election_list'] = $this->input->post('election_list');
            $data['election_result'] = $this->input->post('election_result');
            $data['state_display_name'] = $this->input->post('state_name');
            $data['postal_code'] = $this->input->post('postal_code');
            $data['institution'] = $this->input->post('institution');
            $data['institution_display_name'] = $this->input->post('institution_display_name');
            $data['parliamentary_group'] = $this->input->post('parliamentary_group');
            $data['mandate_end'] = $this->input->post('mandate_end');
            $data['mandate_start'] = $this->input->post('mandate_start');
            $data['external_link'] = $this->input->post('external_link');
            $data['status'] = $this->input->post('status');
            $data['inserted_by'] = $this->manage_mandateedit->getMandate($id, $this->ion_auth->get_user_id())['inserted_by'];
            $data['validation'] = true;
        } else {
            $data = $this->manage_mandateedit->getMandate($id, $this->ion_auth->get_user_id());
            $data['errors'] = '';
        }


        

        $data['title'] = "Mandate";

        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            
            $this->load->view('templates/header', $data);
            if ($data['validation'] == true) {
                if (isset($_POST['name']) && $form_val == true && $error != true) {
                    $data['success'] = $this->manage_mandateedit->update($id, $val['state_id'], $val['city_id']);
                }
                $this->load->view('manage/mandateedit', $data);
            } else {
                $data['show_message'] = "Bearbeitung fehlgeschlagen.";
                $this->load->view('fail', $data);
            }            
            $this->load->view('templates/footer', $data);
        } else if ($this->ion_auth->logged_in()) {
            if (isset($data['inserted_by']) && $data['inserted_by'] == $this->ion_auth->get_user_id()) {
                $this->load->view('templates/header', $data);
                if ($data['validation'] == true) {
                    if (isset($_POST['name']) && $form_val == true && $error != true) {
                        $data['success'] = $this->manage_mandateedit->update($id, $val['state_id'], $val['city_id']);
                    }
                    $this->load->view('manage/mandateedit', $data);
                } else {
                    $data['show_message'] = "Bearbeitung fehlgeschlagen.";
                    $this->load->view('fail', $data);
                }            
                $this->load->view('templates/footer', $data);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function mandate_remove($id) {
        $data['title'] = 'Mandat entfernen';
        $this->load->database();
        $this->load->model('manage_mandateedit');
        $val = $this->manage_mandateedit->validateRemove($id);

        if ($val['validation'] == true) {
            $this->db->where('id', $id);
            $this->db->update('ci_elected_officials', array('status' => 2));
            $this->load->view('templates/header', $data);
            if ($this->db->affected_rows() > 0) {
                $data['show_message'] = "Löschung erfolgreich.";
                $this->load->view('success', $data);
            } else {
                $data['show_message'] = "Löschung fehlgeschlagen.";
                $this->load->view('manage/fail', $data);
            }
            $this->load->view('templates/footer', $data);
        } else {
            $data['show_message'] = "Löschung fehlgeschlagen.";
            $this->load->view('templates/header', $data);
            $this->load->view('fail', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function mandate_delete($id) {
        $data['title'] = 'Mandat löschen';
        $this->load->database();
        $this->load->model('manage_mandateedit');


        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $this->db->where('id', $id);
            $this->db->delete('ci_elected_officials');
            $this->load->view('templates/header', $data);
            if ($this->db->affected_rows() > 0) {
                $data['show_message'] = "Löschung erfolgreich.";
                $this->load->view('success', $data);
            } else {
                $data['show_message'] = "Löschung fehlgeschlagen.";
                $this->load->view('fail', $data);
            }
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }

    public function mandate_delete_admin($id) {
        $this->load->helper('url');
        $data['title'] = 'Mandat löschen';
        $this->load->database();
        $this->load->model('manage_mandateedit');


        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $this->db->where('id', $id);
            $this->db->delete('ci_elected_officials');
            $this->load->view('templates/header', $data);
            if ($this->db->affected_rows() > 0) {
                $data['show_message'] = "Löschung erfolgreich.";
                redirect('/manage/mandate_list', 'refresh');
            } else {
                $data['show_message'] = "Löschung fehlgeschlagen.";
                $this->load->view('fail', $data);
            }
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }

    public function mandate_remove_admin($id) {
        $this->load->helper('url');
        $data['title'] = 'Mandat entfernen';
        $this->load->database();
        $this->load->model('manage_mandateedit');
        $val = $this->manage_mandateedit->validateRemove($id);

        if ($val['validation'] == true) {
            $this->db->where('id', $id);
            $this->db->update('ci_elected_officials', array('status' => 2));
            $this->load->view('templates/header', $data);
            if ($this->db->affected_rows() > 0) {
                $data['show_message'] = "Löschung erfolgreich.";
                redirect('/manage/mandate_list', 'refresh');
            } else {
                $data['show_message'] = "Löschung fehlgeschlagen.";
                $this->load->view('manage/fail', $data);
            }
            $this->load->view('templates/footer', $data);
        } else {
            $data['show_message'] = "Löschung fehlgeschlagen.";
            $this->load->view('templates/header', $data);
            $this->load->view('fail', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function mandate_ack($id) {
        $this->load->helper('url');
        $data['title'] = 'Mandat freischalten';
        $this->load->database();
        $this->load->model('manage_mandateedit');


        if ($this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user'])) {
            $this->db->where('id', $id);
            $this->db->update('ci_elected_officials', array('status' => 1));
            $this->load->view('templates/header', $data);
            if ($this->db->affected_rows() > 0) {
                $data['show_message'] = "Freischaltung erfolgreich.";
                redirect('/manage/mandate_acklist', 'refresh');
            } else {
                $data['show_message'] = "Freischaltung fehlgeschlagen.";
                $this->load->view('fail', $data);
            }
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }


    public function mandate_acklist() {
        $this->load->model('manage_mandatelist');
        $this->load->helper('form');
        

        $data['title'] = "Mandate";

        if ($this->ion_auth->in_group(['admin', 'superuser', 'acknowledged_user'])) {
            $data['data'] = $this->manage_mandatelist->getAckList();
            $this->load->view('templates/header', $data);
            $this->load->view('manage/mandateacklist', $data);
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }

    public function user_acklist() {
        $this->load->model('user_acklist');
        $this->load->helper('form');
        

        $data['title'] = "User";

        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $data['data'] = $this->user_acklist->getAckList();
            $this->load->view('templates/header', $data);
            $this->load->view('manage/useracklist', $data);
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }

    public function user_ack($id) {
        $this->load->helper('form');
        $this->load->helper('url');

        $data['title'] = "User";

        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $this->ion_auth->add_to_group(3, $id);
            $this->load->view('templates/header', $data);
            $data['show_message'] = "Aktion erfolgreich";
            redirect('/manage/user_acklist', 'refresh');
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }

    public function user_deack($id) {
        $this->load->helper('form');
        $this->load->helper('url');

        $data['title'] = "User";

        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $this->ion_auth->remove_from_group(3, $id);
            $this->load->view('templates/header', $data);
            $data['show_message'] = "Aktion erfolgreich.";
            redirect('/manage/user_acklist', 'refresh');
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }

    public function user_activate($id) {
        $this->load->helper('url');
        $data['title'] = 'User aktivieren';
        $this->load->database();


        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $this->db->where('id', $id);
            $this->db->update('users', array('active' => 1));
            $this->load->view('templates/header', $data);
            if ($this->db->affected_rows() > 0) {
                $data['show_message'] = "User erfolgreich aktiviert.";
                redirect('/manage/user_acklist', 'refresh');
            } else {
                $data['show_message'] = "Aktivierung fehlgeschlagen.";
                $this->load->view('fail', $data);
            }
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }

    public function user_delete($id) {
        $data['title'] = "User löschen";

        if ($this->ion_auth->is_admin($id)) {
            show_404();
        }

        if ($this->ion_auth->is_admin()) {
            $this->ion_auth->delete_user($id);
            redirect('auth/', 'refresh');
        } else if ($this->ion_auth->logged_in() && $id == $this->ion_auth->get_user_id()) {
            $this->ion_auth->logout();
            $this->ion_auth->delete_user($id);
            redirect('auth/login', 'refresh');
            
        } else {
            show_404();
        }
        
    }

    public function bulk_delete() {
        $this->load->helper('form');
        $this->load->helper('url');
        $data['title'] = 'Mandat löschen';
        $this->load->database();
        $this->load->model('manage_mandateedit');
        if ($this->ion_auth->in_group(['admin', 'superuser'])) {
            $raw = $this->input->post('bulk_delete');
            $arr = explode(",", $raw);

            foreach ($arr as $entry) {
           
                $this->db->where('id', $entry);
                $this->db->delete('ci_elected_officials');
        
            }

            redirect('/manage/mandate_list', 'refresh');
        
        }else {
            show_404();
        }
    }

    public function information($id = 0) {
        $this->load->database();
        $ret = [];

        if ($this->ion_auth->in_group(['admin']) && $id != 0) {
            $this->db->select('*');
            $this->db->from('ci_dossiers');
            $this->db->where('inserted_by', $id);

            $query = $this->db->get();
            $res =  $query->result_array();
            $ret['dossiers'] = $res;

            $this->db->select('*');
            $this->db->from('ci_files');
            $this->db->where('inserted_by', $id);

            $query = $this->db->get();
            $res =  $query->result_array();
            $ret['files'] = $res;

            $this->db->select('*');
            $this->db->from('ci_elected_officials');
            $this->db->where('inserted_by', $id);

            $query = $this->db->get();
            $res =  $query->result_array();
            $ret['mandates'] = $res;

            $this->db->select('ip_address, username, email, created_on, last_login, active, first_name, last_name, company, phone');
            $this->db->from('users');
            $this->db->where('id', $id);

            $query = $this->db->get();
            $res =  $query->result_array();
            $ret['user'] = $res;

            echo (json_encode($ret));

        } else if ($this->ion_auth->logged_in()) {
            $this->db->select('*');
            $this->db->from('ci_dossiers');
            $this->db->where('inserted_by', $this->ion_auth->get_user_id());

            $query = $this->db->get();
            $res =  $query->result_array();
            $ret['dossiers'] = $res;

            $this->db->select('*');
            $this->db->from('ci_files');
            $this->db->where('inserted_by', $this->ion_auth->get_user_id());

            $query = $this->db->get();
            $res =  $query->result_array();
            $ret['files'] = $res;

            $this->db->select('*');
            $this->db->from('ci_elected_officials');
            $this->db->where('inserted_by', $this->ion_auth->get_user_id());

            $query = $this->db->get();
            $res =  $query->result_array();
            $ret['mandates'] = $res;

            $this->db->select('ip_address, username, email, created_on, last_login, active, first_name, last_name, company, phone');
            $this->db->from('users');
            $this->db->where('id', $this->ion_auth->get_user_id());

            $query = $this->db->get();
            $res =  $query->result_array();
            $ret['user'] = $res;

            echo (json_encode($ret));

        } else {
            show_404();
        }
    }

}
