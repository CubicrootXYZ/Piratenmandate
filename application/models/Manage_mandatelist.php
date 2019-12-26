<?php
class Manage_mandatelist extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function getList($id = 0) {
            $dt = new DateTime();
            
            $this->db->select('*, ci_elected_officials.id AS mandate_id, ci_cities.display_name AS city_name, ci_foreign_states.display_name AS state_name, users.id AS user_id');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_cities', 'ci_elected_officials.city_id = ci_cities.id', 'left');
            $this->db->join('users', 'ci_elected_officials.inserted_by = users.id', 'left');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id', 'left');   
            
            if ($id != 0) {
                $this->db->where('ci_elected_officials.inserted_by', $this->ion_auth->get_user_id());
                $this->db->where_in('ci_elected_officials.status', [0,1,3]);
            }

            if ($this->input->get('old_mandates') != 'yes') {
                $this->db->where('ci_elected_officials.mandate_end >',  $dt->format('Y-m-d H:i:s'));
            }

            
            if ($this->input->get('name') !== null && strlen($this->input->get('name')) > 0) {
                $this->db->like('ci_elected_officials.name', $this->input->get('name'));
            }
            if ($this->input->get('username') !== null && strlen($this->input->get('username')) > 0) {
                $this->db->like('users.username', $this->input->get('username'));
            }
            if ($this->input->get('userid') !== null && strlen($this->input->get('userid')) > 0) {
                $this->db->where('users.id', $this->input->get('userid'));
            }
            if ($this->input->get('state') !== null && strlen($this->input->get('state')) > 0) {
                $this->db->like('ci_foreign_states.display_name', $this->input->get('state'));
            }
            if ($this->input->get('parliamentary_group') && strlen($this->input->get('parliamentary_group')) > 0) {
                $this->db->like('ci_elected_officials.parliamentary_group', $this->input->get('parliamentary_group'));
            }
            if ($this->input->get('institution') !== null && strlen($this->input->get('institution')) > 0) {
                $this->db->like('ci_elected_officials.institution', $this->input->get('institution'));
            }
            if ($this->input->get('postal_code') !== null && strlen($this->input->get('postal_code')) > 0) {
                $this->db->like('ci_cities.postal_code', $this->input->get('postal_code'));
            }
            if ($this->input->get('city') !== null && strlen($this->input->get('city')) > 0) {
                $this->db->like('ci_cities.display_name', $this->input->get('city'));
            }
            if ($this->input->get('status') !== null && strlen($this->input->get('status')) > 0) {
                if ($this->input->get('status') > 1 && $this->ion_auth->in_group(['admin', 'superuser'])) {
                    $this->db->where('status', $this->input->get('status'));
                } else if ($this->input->get('status') < 2 ) {
                    $this->db->where('status', $this->input->get('status'));
                }
                
            }
            if ($this->input->get('sort_by') !== null && strlen($this->input->get('sort_by')) > 0 && in_array($this->input->get('sort_by'), ['name', 'institution', 'mandate_end', 'mandate_start', 'ci_cities.display_name', 'ci_foreign_states.display_name', 'parliamentary_group'])) {
                $order = "ASC";
                if ($this->input->get('order') !== null) {
                    if ($this->input->get('order') == "ASC" || $this->input->get('order') == "DESC") {
                        $order = $this->input->get('order');
                    } 
                    
                } 
                $this->db->order_by($this->input->get('sort_by'), $order);
            }
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res;
            
            
        }

        public function getAckList() {
            $dt = new Datetime();
            
            $this->db->select('*, ci_elected_officials.id AS mandate_id, ci_cities.display_name AS city_name, ci_foreign_states.display_name AS state_name');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_cities', 'ci_elected_officials.city_id = ci_cities.id', 'left');
            $this->db->join('users', 'ci_elected_officials.inserted_by = users.id', 'left');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id', 'left');   
            
            if ($this->input->get('old_mandates') != 'yes') {
                $this->db->where('ci_elected_officials.mandate_end >',  $dt->format('Y-m-d H:i:s'));
            }

            
            if ($this->input->get('name') !== null && strlen($this->input->get('name')) > 0) {
                $this->db->like('ci_elected_officials.name', $this->input->get('name'));
            }
            if ($this->input->get('state') !== null && strlen($this->input->get('state')) > 0) {
                $this->db->like('ci_foreign_states.display_name', $this->input->get('state'));
            }
            if ($this->input->get('parliamentary_group') && strlen($this->input->get('parliamentary_group')) > 0) {
                $this->db->like('ci_elected_officials.parliamentary_group', $this->input->get('parliamentary_group'));
            }
            if ($this->input->get('institution') !== null && strlen($this->input->get('institution')) > 0) {
                $this->db->like('ci_elected_officials.institution', $this->input->get('institution'));
            }
            if ($this->input->get('postal_code') !== null && strlen($this->input->get('postal_code')) > 0) {
                $this->db->like('ci_cities.postal_code', $this->input->get('postal_code'));
            }
            if ($this->input->get('city') !== null && strlen($this->input->get('city')) > 0) {
                $this->db->like('ci_cities.display_name', $this->input->get('city'));
            }
            if ($this->input->get('status') !== null && strlen($this->input->get('status')) > 0) {
                if ($this->input->get('status') > 1 && $this->ion_auth->in_group(['admin', 'superuser'])) {
                    $this->db->where('status', $this->input->get('status'));
                } else if ($this->input->get('status') < 2 ) {
                    $this->db->where('status', $this->input->get('status'));
                }
                
            }
            if ($this->input->get('sort_by') !== null && strlen($this->input->get('sort_by')) > 0 && in_array($this->input->get('sort_by'), ['name', 'institution', 'mandate_end', 'mandate_start', 'ci_cities.display_name', 'ci_foreign_states.display_name', 'parliamentary_group'])) {
                $order = "ASC";
                if ($this->input->get('order') !== null) {
                    if ($this->input->get('order') == "ASC" || $this->input->get('order') == "DESC") {
                        $order = $this->input->get('order');
                    } 
                    
                } 
                $this->db->order_by($this->input->get('sort_by'), $order);
            }

            $this->db->where('status', '0');
            
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res;
            
            
        }
}