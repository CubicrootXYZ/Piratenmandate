<?php
class Manage_archive extends CI_Model {

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

        public function validateForm($state, $topic) {
            $ret = [];
            $ret['validation'] = true;
            $ret['errors'] = '';
            //validate state
            $this->db->select('*');
            $this->db->from('ci_foreign_states');
            $this->db->where("slug", $state);
            $query = $this->db->get();
            $res =  $query->result_array(); 

            if (isset($res[0]['id'])) {
                $ret['state_id'] = $res[0]['id'];
            } else {
                $ret['state_id'] = '';
                $ret['validation'] = true;
                $ret['errors'] .= '';
            }

            //validate topic
            $this->db->select('*');
            $this->db->from('ci_topics');
            $this->db->where("slug", $topic);
            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['id'])) {
                $ret['topic_id'] = $res[0]['id'];
            } else {
                $ret['topic_id'] = '';
                $ret['validation'] = true;
                $ret['errors'] .= '';
            }          

            return $ret;
            
            
        }

        public function getFileId($name) {
            $this->db->select('id');
            $this->db->from('ci_files');
            $this->db->where("filename", $name);
            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['id'])) {
                return $res[0]['id'];
            } else 
            return 0;
        }

        public function insertFile($data) {
            $entry = array(
                'filename' => $data['upload_data']['file_name'],
                'filetype' => $data['upload_data']['file_type'],
                'filesize' => $data['upload_data']['file_size'],
                'file_display_name' => $data['upload_data']['orig_name'],
                'inserted_by' => $this->ion_auth->get_user_id()

            );

            $this->db->insert('ci_files', $entry);

            if ($this->db->affected_rows() > 0) {
                return $this->getFileId($data['upload_data']['file_name']);
            } else {
                return false;
            }
        }

        public function insert($data, $state_id, $topic_id) {
            $file_id = $this->insertFile($data);
            if ($file_id == 0) {
                return False;
            }
            if ($this->input->post('date') == '') {
                $date = date('Y-m-d');
            } else {
                $date = $this->input->post('date');
            }
            $entry = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('desc'),
                'state_id' => $state_id,
                'institution' => $this->input->post('institution'),
                'topic_id' => $topic_id,
                'keywords' => $this->input->post('keywords'),
                'status' => '1',
                'date' => $date,
                'inserted_by' => $this->ion_auth->get_user_id()

            );

            $this->db->insert('ci_dossiers', $entry);
            $dossier_id = $this->db->insert_id();

            if ($this->db->affected_rows() > 0) {
                $entry = array(
                    'dossier_id' => $dossier_id,
                    'file_id' => $file_id
                );
                $this->db->insert('ci_dossiers_files', $entry);
                return True;

            } else {
                return False;
            }
        }

        public function getDossierUser($id = 0) {
            $this->db->select('inserted_by');
            $this->db->from('ci_dossiers');
            $this->db->where("id", $id);
            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['inserted_by'])) {
                return $res[0]['inserted_by'];
            } else 
            return False;
        }

        public function getFileUser($id = 0) {
            $this->db->select('inserted_by');
            $this->db->from('ci_files');
            $this->db->where("id", $id);
            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['inserted_by'])) {
                return $res[0]['inserted_by'];
            } else 
            return False;
        }

        public function getFileDossierUser($id = 0) {
            $this->db->select('ci_dossiers.inserted_by');
            $this->db->from('ci_files');
            $this->db->where("ci_files.id", $id);
            $this->db->join('ci_dossiers_files', 'ci_files.id = ci_dossiers_files.file_id', 'left');
            $this->db->join('ci_dossiers', 'ci_dossiers_files.dossier_id = ci_dossiers.id', 'left');
            $query = $this->db->get();
            $res =  $query->result_array();

            if (isset($res[0]['inserted_by'])) {
                return $res[0]['inserted_by'];
            } else 
            return False;
        }

        public function delete($id = 0) {
            $this->load->helper("file");
            $this->db->select('*');
            $this->db->from('ci_dossiers_files');
            $this->db->join('ci_files', 'ci_dossiers_files.file_id = ci_files.id', 'left');
            $this->db->where("ci_dossiers_files.dossier_id", $id);
            $query = $this->db->get();
            $res =  $query->result_array();

            foreach($res as $file) {
                unlink('./uploads/'.$file['filename']);
                $this->db->delete('ci_files', array('id' => $file['file_id']));
            }

            $this->db->delete('ci_dossiers_files', array('dossier_id' => $id));
            $this->db->delete('ci_dossiers', array('id' => $id));
            if ($this->db->affected_rows() < 1) {
                return False;
            } else {
                return True;
            }
        }

        public function deleteFile($id = 0) {
            $this->load->helper("file");
            $this->db->select('*');
            $this->db->from('ci_files');
            $this->db->where("id", $id);
            $query = $this->db->get();
            $res =  $query->result_array();

            foreach($res as $file) {
                unlink('./uploads/'.$file['filename']);
                $this->db->delete('ci_files', array('id' => $id));
            }

            $this->db->delete('ci_dossiers_files', array('file_id' => $id));
            if ($this->db->affected_rows() < 1) {
                return False;
            } else {
                return True;
            }
        }

        public function addFile($data, $id) {
            $file_id = $this->insertFile($data);
            if ($file_id == 0) {
                return False;
            }

            $entry = array(
                'dossier_id' => $id,
                'file_id' => $file_id
            );
            $this->db->insert('ci_dossiers_files', $entry);

            if ($this->db->affected_rows() > 0) {
                return True;
            } else {
                return False;
            }

        }

        public function delete_all($user_id) {
            //delete all dossiers
            $this->db->select('*');
            $this->db->from('ci_dossiers');
            $this->db->where('inserted_by', $user_id);

            $query = $this->db->get();
            $res =  $query->result_array();

            foreach ($res as $del) {
                $this->delete($del['id']);
            }

            //delete all files
            $this->db->select('*');
            $this->db->from('ci_files');
            $this->db->where('inserted_by', $user_id);

            $query = $this->db->get();
            $res =  $query->result_array();

            foreach ($res as $del) {
                $this->deleteFile($del['id']);
            }

            //delete all mandates
            $this->db->delete('ci_elected_officials', array('inserted_by' => $user_id));

            return True;
        }

        public function getFilesList() {
            $this->db->from('ci_files');
            $this->db->select('*, ci_files.id AS file_id, users.id AS user_id');
            $this->db->join('users', 'ci_files.inserted_by = users.id', 'left');


            if ($this->input->get('username') !== null && strlen($this->input->get('username')) > 0) {
                $this->db->like('users.username', $this->input->get('username'));
            }
            if ($this->input->get('filename') !== null && strlen($this->input->get('filename')) > 0) {
                $this->db->like('file_display_name', $this->input->get('filename'));
            }

            if ($this->input->get('userid') !== null && strlen($this->input->get('userid')) > 0) {
                $this->db->where('users.id', $this->input->get('userid'));
            }

            $query = $this->db->get();
            $res =  $query->result_array();

            return $res;
        }
}