<?php
class Mandates_single extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function getData($id) {
            $dt = new DateTime();

            $this->db->select('*, ci_elected_officials.id AS mandate_id, ci_cities.display_name AS city_name, ci_foreign_states.display_name AS state_name');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_cities', 'ci_elected_officials.city_id = ci_cities.id');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id');
            $this->db->where('ci_elected_officials.id', $id);
            $this->db->where('status', 1);
            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['mandate_id'])) {
                $dt_mand = new Datetime($res[0]['mandate_end']);

                if ($dt_mand < $dt) {
                    $res[0]['name'] = '-';
                    $res[0]['external_link'] = '';
                }

                return $res[0]; 
            } else {
                return False;
            }
                      
            
            
        }
}