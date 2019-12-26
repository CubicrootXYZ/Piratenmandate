<?php
class Archive_list extends CI_Model {

        public function __construct()
        {
            $this->load->database();
            $this->load->helper('form');
            $this->load->library('form_validation');
        }

        public function getTopics() {
            $dt = new Datetime();
            $ret = [];
            $this->db->select('*');
            $this->db->from('ci_topics');
            $this->db->order_by('display_name', 'ASC');
            $query = $this->db->get();
            $res =  $query->result_array();

             return $res;
        }

        public function getStates() {
            $this->db->select('*');
            $this->db->from('ci_foreign_states');
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res;
        }

        public function getList() {
            $dt = new DateTime();
            
            $this->db->select('*, ci_dossiers.id AS dossier_id, ci_topics.display_name AS topic_display_name, ci_topics.slug AS topic_slug, ci_foreign_states.display_name AS state_display_name, ci_foreign_states.slug AS state_slug, users.id AS user_id');
            $this->db->from('ci_dossiers');
            $this->db->join('ci_topics', 'ci_dossiers.topic_id = ci_topics.id', 'left');
            $this->db->join('ci_foreign_states', 'ci_dossiers.state_id = ci_foreign_states.id', 'left');
            $this->db->join('users', 'ci_dossiers.inserted_by = users.id', 'left');
            
            /*if ($id != 0) {
                $this->db->where('ci_elected_officials.inserted_by', $this->ion_auth->get_user_id());
                $this->db->where_in('ci_elected_officials.status', [0,1,3]);
            }

            if ($this->input->get('old_mandates') != 'yes') {
                $this->db->where('ci_elected_officials.mandate_end >',  $dt->format('Y-m-d H:i:s'));
            }*/


            if ($this->input->get('username') !== null && strlen($this->input->get('username')) > 0) {
                $this->db->like('users.username', $this->input->get('username'));
            }

            if ($this->input->get('userid') !== null && strlen($this->input->get('userid')) > 0) {
                $this->db->where('users.id', $this->input->get('userid'));
            }
            
            if ($this->input->get('title') !== null && strlen($this->input->get('title')) > 0) {
                $this->db->like('title', $this->input->get('title'));
            }
            if ($this->input->get('keywords') !== null && strlen($this->input->get('keywords')) > 0) {
                $this->db->like('ci_dossiers.keywords', $this->input->get('keywords'));
            }
            if ($this->input->get('state_name') && strlen($this->input->get('state_name')) > 0) {
                $this->db->where('ci_foreign_states.slug', $this->input->get('state_name'));
            }
            if ($this->input->get('topic') !== null && strlen($this->input->get('topic')) > 0) {
                $this->db->where('ci_topics.slug', $this->input->get('topic'));
            }
            

            if ($this->input->get('sort_by') !== null && strlen($this->input->get('sort_by')) > 0 && in_array($this->input->get('sort_by'), ['name', 'institution', 'mandate_end', 'mandate_start', 'ci_cities.display_name', 'ci_foreign_states.display_name', 'parliamentary_group'])) {
                $order = "ASC";
                if ($this->input->get('order') !== null) {
                    if ($this->input->get('order') == "ASC" || $this->input->get('order') == "DESC") {
                        $order = $this->input->get('order');
                    } 
                    
                } 
                $this->db->order_by($this->input->get('sort_by'), $order);
            } else {
                $this->db->order_by('insertdatetime', 'DESC');
            }

            if ($this->input->get('own') !== null && $this->input->get('own') == 'yes') {
                $this->db->where('ci_dossiers.inserted_by', $this->ion_auth->get_user_id());
                $this->db->where_in('status',[0,1,3]);
                
            } else {
                $this->db->where_in('status',[1,3]);
            }
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res;
            
            
        }


        public function getDossier($id = 0) {
            $dt = new DateTime();
            
            $this->db->select('*, ci_dossiers.id AS dossier_id, ci_topics.display_name AS topic_display_name, ci_topics.slug AS topic_slug, ci_foreign_states.display_name AS state_display_name, ci_foreign_states.slug AS state_slug, ci_files.inserted_by AS file_inserted_by, ci_dossiers.inserted_by AS dossier_inserted_by');
            $this->db->from('ci_dossiers');
            $this->db->where_in('status', array(1,3));
            $this->db->join('ci_topics', 'ci_dossiers.topic_id = ci_topics.id', 'left');
            $this->db->join('ci_foreign_states', 'ci_dossiers.state_id = ci_foreign_states.id', 'left');
            $this->db->join('ci_dossiers_files', 'ci_dossiers.id = ci_dossiers_files.dossier_id', 'left');
            $this->db->join('ci_files', 'ci_dossiers_files.file_id = ci_files.id', 'left');
            

                $this->db->where('ci_dossiers.id', $id);
                $this->db->where_in('ci_dossiers.status', [0,1,3]);

            
           

            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['dossier_id'])) {
                return $res;
            } else {
                return False;
            }

            
            
            
        }



}