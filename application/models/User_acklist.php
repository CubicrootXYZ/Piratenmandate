<?php
class User_acklist extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function getAckList() {
            $blocked_users = array();
            $acked_users = array();
            $this->db->select('*');
            $this->db->from('users_groups');
            $this->db->join('groups', 'users_groups.group_id = groups.id', 'left');
            $query = $this->db->get();
            $res =  $query->result_array();

            foreach ($res as $user) {
                if (in_array($user['name'], ['admin', 'superuser'])) {
                    array_push($blocked_users, $user['user_id']);
                } else if (in_array($user['name'], ['acknowledged_user'])) {
                    array_push($acked_users, $user['user_id']);
                }
            }


            $dt = new DateTime();
            
            $this->db->select('*, users.id AS users_id');
            $this->db->from('users_groups');
            $this->db->join('users', 'users_groups.user_id = users.id');
            $this->db->join('groups', 'users_groups.group_id = groups.id', 'left');
            $this->db->group_by("user_id");
            // run SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

            if ($this->input->get('ack') !== null && $this->input->get('ack') == 'yes' && !empty($blocked_users)) {
                $this->db->where_not_in('users.id', $blocked_users);
            } else if (!empty($blocked_users) && !empty($acked_users)) {
                $this->db->where_not_in('users.id', $blocked_users);
                $this->db->where_not_in('users.id', $acked_users);
            } else if (!empty($blocked_users)) {
                $this->db->where_not_in('users.id', $blocked_users);
            }
            if ($this->input->get('username') !== null && strlen($this->input->get('username')) > 0) {
                $this->db->like('users.username', $this->input->get('username'));
            }
            if ($this->input->get('email') !== null && strlen($this->input->get('email')) > 0) {
                $this->db->like('users.email', $this->input->get('email'));
            }
            
             
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res;          
            
        }

       
}