<?php
class Manage_mandatenew extends CI_Model {

        public function __construct()
        {
            $this->load->database();
            $this->load->helper('form');
            $this->load->library('form_validation');
        }

        public function validateForm($state, $postal_code, $status) {
            $ret = [];
            $ret['validation'] = true;
            $ret['errors'] = '';
            //validate state
            $this->db->select('*');
            $this->db->from('ci_foreign_states');
            $this->db->where("display_name", $state);
            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['id'])) {
                $ret['state_id'] = $res[0]['id'];
            } else {
                $ret['validation'] = false;
                $ret['errors'] .= 'Bundesland nicht gültig. ';
            }
            //validate city
            $this->db->select('*');
            $this->db->from('ci_cities');
            $this->db->where("postal_code", $postal_code);
            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['id'])) {
                $ret['city_id'] = $res[0]['id'];
            } else {
                $ret['validation'] = false;
                $ret['errors'] .= 'PLZ nicht gültig. ';
            }
            //validate status
            if($this->ion_auth->in_group(['acknowledged_user']) && !(in_array($status, ['0', '1']))) {
                $ret['validation'] = false;
                $ret['errors'] .= 'Nicht berechtigt diesen Status zu setzen. ';
            }
            if($this->ion_auth->in_group(['member']) && !(in_array($status, ['0']))) {
                $ret['validation'] = false;
                $ret['errors'] .= 'Nicht berechtigt diesen Status zu setzen. ';
            }   
                      

            return $ret;
            
            
        }

        public function insert($city_id, $state_id) {
            $entry = array(
                'name' => $this->input->post('name'),
                'election_list' => $this->input->post('election_list'),
                'parliamentary_group' => $this->input->post('parliamentary_group'),
                'election_result' => $this->input->post('election_result'),
                'state_id' => $state_id,
                'city_id' => $city_id,
                'institution' => $this->input->post('institution'),
                'mandate_start' => $this->input->post('mandate_start'),
                'mandate_end' => $this->input->post('mandate_end'),
                'status' => $this->input->post('status'),
                'institution_display_name' => $this->input->post('institution_display_name'),
                'external_link' => $this->input->post('external_link'),
                'inserted_by' => $this->ion_auth->get_user_id()

            );

            $this->db->insert('ci_elected_officials', $entry);

            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
}