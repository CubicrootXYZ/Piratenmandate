<?php
class Mandates_list extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function getList($state = '') {
            $dt = new DateTime();

            

            $this->db->select('*, ci_elected_officials.id AS mandate_id, ci_cities.display_name AS city_name, ci_foreign_states.display_name AS state_name');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_cities', 'ci_elected_officials.city_id = ci_cities.id');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id');
           
            

            if (strlen($state) > 0) {
                if ($state == "bundestag" || $state == "bt") {
                    $this->db->where('institution', "Bundestag");
                } else if ($state == "europaparlament" || $state == "ep") {
                    $this->db->where('institution', "Europaparlament");
                } else if ($state == "landesparlamente" || $state == "lt" ||$state == "landtage") {
                    $this->db->where('institution', "Landesparlament");
                } else {
                    $this->db->where_in('institution', array("Gemeinderat", "Kreisrat", "Bürgermeister", "Sonstiges kommunales Mandat"));
                    $this->db->where('ci_foreign_states.slug', $state);
                }
            }

            if ($this->input->get('name') !== null && strlen($this->input->get('name')) > 0) {
                $this->db->like('name', $this->input->get('name'));
            }
            if ($this->input->get('state') !== null && strlen($this->input->get('state')) > 0) {
                $this->db->like('ci_foreign_states.display_name', $this->input->get('state'));
            }
            if ($this->input->get('parliamentary_group') && strlen($this->input->get('parliamentary_group')) > 0) {
                $this->db->like('parliamentary_group', $this->input->get('parliamentary_group'));
            }
            if ($this->input->get('institution') !== null && strlen($this->input->get('institution')) > 0) {
                $this->db->like('institution', $this->input->get('institution'));
            }
            if ($this->input->get('postal_code') !== null && strlen($this->input->get('postal_code')) > 0) {
                $this->db->like('ci_cities.postal_code', $this->input->get('postal_code'));
            }
            if ($this->input->get('city') !== null && strlen($this->input->get('city')) > 0) {
                $this->db->like('ci_cities.display_name', $this->input->get('city'));
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

            if ($this->input->get('own') !== null && $this->input->get('own') == 'yes') {
                $this->db->where('ci_elected_officials.inserted_by', $this->ion_auth->get_user_id());
                $this->db->where_in('status',[0,1,3]);
                
            } else {
                $this->db->where_in('status',[1,3]);
                $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            }
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res;
                      
            
            
        }
}