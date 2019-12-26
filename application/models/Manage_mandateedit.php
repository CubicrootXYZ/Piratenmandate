<?php
class Manage_mandateedit extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function getMandate($id, $user_id) {

            $this->db->select('*, ci_elected_officials.id AS mandate_id, ci_cities.display_name AS city_name, ci_foreign_states.display_name AS state_display_name');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_cities', 'ci_elected_officials.city_id = ci_cities.id', 'left');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id', 'left');   

            $this->db->where('ci_elected_officials.id', $id);
            
                               
            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['id'])) {
                $res[0]['validation'] = true;
            } else {
                $res[0]['validation'] = false;
            }

            if (!($this->ion_auth->in_group(['admin', 'superuser'])) && $res[0]['inserted_by'] != $user_id) {
                $res[0]['validation'] = false;
            }
            if (!($this->ion_auth->in_group(['admin', 'superuser'])) && in_array($res[0]['status'], ['2'])) {
                $res[0]['validation'] = false;
            }

            return $res[0];
            
            
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

        public function update($id, $state_id, $city_id) {
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
                'external_link' => $this->input->post('external_link')
            );
            $this->db->where('id', $id);
            $this->db->update('ci_elected_officials', $entry);

            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function validateRemove($id) {
            $this->db->select('*, ci_elected_officials.id AS mandate_id, ci_cities.display_name AS city_name, ci_foreign_states.display_name AS state_display_name');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_cities', 'ci_elected_officials.city_id = ci_cities.id', 'left');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id', 'left');   

            $this->db->where('ci_elected_officials.id', $id);
            
                               
            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['id'])) {
                $res[0]['validation'] = true;
            } else {
                $res[0]['validation'] = false;
            }

            if (!($this->ion_auth->in_group(['admin', 'superuser'])) && $res[0]['inserted_by'] != $this->ion_auth->get_user_id()) {
                $res[0]['validation'] = false;
            }
            if (!($this->ion_auth->in_group(['admin', 'superuser'])) && in_array($res[0]['status'], ['2'])) {
                $res[0]['validation'] = false;
            }

            return $res[0];
        }
}