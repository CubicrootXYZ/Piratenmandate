<?php
class Mandates_map extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function getMapMarkers() {
            
            return $this->getByState("baden_wuerttemberg");
            
        }

        public function getByState($state_slug) {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('*, ci_elected_officials.id AS mandate_id');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_cities', 'ci_elected_officials.city_id = ci_cities.id');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where('ci_foreign_states.slug', $state_slug);
            $this->db->where_in('institution', array("Gemeinderat", "Kreistag", "Bürgermeister", "Sonstiges kommunales Mandat"));
            $query = $this->db->get();
            $res =  $query->result_array();

            foreach ($res as $result) {
                if (array_key_exists($result["postal_code"], $markers)) {
                    array_push($markers[$result["postal_code"]], $result);
                } else {
                    $markers[$result["postal_code"]][0] = $result;
                }
            }

            return $markers;
        }

        public function getState() {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('*, ci_elected_officials.id AS mandate_id');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_cities', 'ci_elected_officials.city_id = ci_cities.id');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where_in('institution', array("Landesparlament", "Sonstiges Mandat"));
            $query = $this->db->get();
            $res =  $query->result_array();

            foreach ($res as $result) {
                if (array_key_exists($result["postal_code"], $markers)) {
                    array_push($markers[$result["postal_code"]], $result);
                } else {
                    $markers[$result["postal_code"]][0] = $result;
                }
            }

            return $markers;
        }

        public function getCountry() {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('*, ci_elected_officials.id AS mandate_id');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_cities', 'ci_elected_officials.city_id = ci_cities.id');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where_in('institution', array("Bundestag"));
            $query = $this->db->get();
            $res =  $query->result_array();

            foreach ($res as $result) {
                if (array_key_exists($result["postal_code"], $markers)) {
                    array_push($markers[$result["postal_code"]], $result);
                } else {
                    $markers[$result["postal_code"]][0] = $result;
                }
            }

            return $markers;
        }

        public function getEu() {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('*, ci_elected_officials.id AS mandate_id');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_cities', 'ci_elected_officials.city_id = ci_cities.id');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where_in('institution', array("Europaparlament"));
            $query = $this->db->get();
            $res =  $query->result_array();

            foreach ($res as $result) {
                if (array_key_exists($result["postal_code"], $markers)) {
                    array_push($markers[$result["postal_code"]], $result);
                } else {
                    $markers[$result["postal_code"]][0] = $result;
                }
            }

            return $markers;
        }

        public function getEpMandates() {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where_in('institution', array("Europaparlament"));
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res[0]["COUNT(*)"];
        }

        public function getBtMandates() {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where_in('institution', array("Bundestag"));
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res[0]["COUNT(*)"];
        }

        public function getLtMandates() {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where_in('institution', array("Landesparlament"));
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res[0]["COUNT(*)"];
        }

        public function getLocalMandates() {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where_in('institution', array("Gemeinderat", "Kreistag", "Bürgermeister", "Sonstiges kommunales Mandat"));
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res[0]["COUNT(*)"];
        }

        public function getTotalMandates() {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res[0]["COUNT(*)"];
        }

        public function getUsers() {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('COUNT(*)');
            $this->db->from('users');
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res[0]["COUNT(*)"];
        }

        public function getFiles() {

            $dt = new DateTime();

            $this->db->select('COUNT(*)');
            $this->db->from('ci_files');
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res[0]["COUNT(*)"];
        }
}