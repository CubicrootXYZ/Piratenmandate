<?php
class Mandates_stats extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function sortarr($a,$b) 
        {
          return ($b["val"] <= $a["val"]) ? -1 : 1;
        }

        public function getByState($state_slug) {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->join('ci_foreign_states', 'ci_elected_officials.state_id = ci_foreign_states.id');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where('ci_foreign_states.slug', $state_slug);
            $this->db->where_in('institution', array("Gemeinderat", "Kreistag", "Bürgermeister", "Sonstiges kommunales Mandat", "Landesparlament"));
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res[0]["COUNT(*)"];
        }

        public function getByInstitution($val) {
            $markers = [];

            $dt = new DateTime();

            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where('institution', $val);
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res[0]["COUNT(*)"];
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

        public function getMandatesByState() {
            $states = $this->getStates();
            $total = $this->getLocalMandates()+$this->getLtMandates();

            foreach ($states as $state) {
                $ret[$state['slug']]['val'] = $this->getByState($state['slug']);
                $ret[$state['slug']]['rel'] = 100*($ret[$state['slug']]['val']/$total);
                $ret[$state['slug']]['display_name'] = $state['display_name'];
            }

            usort($ret, array('Mandates_stats','sortarr'));

            return $ret;

        }

        public function getMandatesByInstitution() {
            $ret = [];
            $institutions = $this->getInstitutions();
            $total = $this->getTotalMandates();

            foreach ($institutions as $institution) {
                $inst_name = str_replace(' ', '_', $institution);
                $ret[$inst_name]['val'] = $this->getByInstitution($institution);
                $ret[$inst_name]['rel'] = 100*($ret[$inst_name]['val']/$total);
                $ret[$inst_name]['display_name'] = $institution;
            }

            usort($ret, array('Mandates_stats','sortarr'));
            
            return $ret;

        }

        public function getMandatesByList() {
            $ret = [];
            $institutions = $this->getInstitutions();
            $total = $this->getTotalMandates();

            $dt = new DateTime();

            //get Pirate lists
            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->like('election_list', 'Pirat');
            $query = $this->db->get();
            $res =  $query->result_array();

            $ret['pirates']['val'] = $res[0]['COUNT(*)'];
            $ret['pirates']['rel'] = 100*($res[0]['COUNT(*)']/$total);
            $ret['pirates']['display_name'] = 'Piraten';

            //get empty
            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where('election_list', '');
            $query = $this->db->get();
            $res =  $query->result_array();

            $ret['unknown']['val'] = $res[0]['COUNT(*)'];
            $ret['unknown']['rel'] = 100*($res[0]['COUNT(*)']/$total);
            $ret['unknown']['display_name'] = 'Unbekannt';

            $ret['Fremdliste']['val'] = $total-$ret['unknown']['rel']-$ret['pirates']['val'];
            $ret['Fremdliste']['rel'] = 100*($ret['Fremdliste']['val']/$total);
            $ret['Fremdliste']['display_name'] = 'Fremdliste';
            

            usort($ret, array('Mandates_stats','sortarr'));
            
            return $ret;

        }

        public function getMandatesByGroup() {
            $ret = [];
            $total = $this->getTotalMandates();

            $dt = new DateTime();

            //get Pirate lists
            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->like('parliamentary_group', 'Pirat');
            $query1 = $this->db->get();
            $res1 =  $query1->result_array();

            $ret['pirates']['val'] = $res1[0]['COUNT(*)'];
            $ret['pirates']['rel'] = 100*($res1[0]['COUNT(*)']/$total);
            $ret['pirates']['display_name'] = 'Piraten';
            $cnt = $res1[0]['COUNT(*)'];

            //get spd
            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->like('parliamentary_group', 'SPD');
            $query = $this->db->get();
            $res =  $query->result_array();

            $ret['spd']['val'] = $res[0]['COUNT(*)'];
            $ret['spd']['rel'] = 100*($res[0]['COUNT(*)']/$total);
            $ret['spd']['display_name'] = 'SPD';
            $cnt += $res[0]['COUNT(*)'];

            //get linke
            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->like('parliamentary_group', 'Linke');
            $query = $this->db->get();
            $res =  $query->result_array();

            $ret['linke']['val'] = $res[0]['COUNT(*)'];
            $ret['linke']['rel'] = 100*($res[0]['COUNT(*)']/$total);
            $ret['linke']['display_name'] = 'Die Linke';
            $cnt += $res[0]['COUNT(*)'];

            //get grüne
            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->like('parliamentary_group', 'Grüne');
            $query = $this->db->get();
            $res =  $query->result_array();

            $ret['grüne']['val'] = $res[0]['COUNT(*)'];
            $ret['grüne']['rel'] = 100*($res[0]['COUNT(*)']/$total);
            $ret['grüne']['display_name'] = 'Bündnis90/Grüne';
            $cnt += $res[0]['COUNT(*)'];

            //get fdp
            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->like('parliamentary_group', 'FDP');
            $query8 = $this->db->get();
            $res8 =  $query8->result_array();

            $ret['fdp']['val'] = $res8[0]['COUNT(*)'];
            $ret['fdp']['rel'] = 100*($res8[0]['COUNT(*)']/$total);
            $ret['fdp']['display_name'] = 'FDP';
            $cnt += $res8[0]['COUNT(*)'];

            //get cdu
            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->like('parliamentary_group', 'CDU');
            $query = $this->db->get();
            $res =  $query->result_array();

            $ret['cdu']['val'] = $res[0]['COUNT(*)'];
            $ret['cdu']['rel'] = 100*($res[0]['COUNT(*)']/$total);
            $ret['cdu']['display_name'] = 'CDU';
            $cnt += $res[0]['COUNT(*)'];

            //get empty
            $this->db->select('COUNT(*)');
            $this->db->from('ci_elected_officials');
            $this->db->where_in('status', [1,3]);
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->where('parliamentary_group', '');
            $query = $this->db->get();
            $res =  $query->result_array();

            $ret['unknown']['val'] = $res[0]['COUNT(*)'];
            $ret['unknown']['rel'] = 100*($res[0]['COUNT(*)']/$total);
            $ret['unknown']['display_name'] = 'Unbekannt';
            $cnt += $res[0]['COUNT(*)'];

            /*$ret['Andere']['val'] = $total-$cnt;
            $ret['Andere']['rel'] = 100*($ret['Andere']['val']/$total);
            $ret['Andere']['display_name'] = 'Andere/nicht identifiziert';*/
            

            usort($ret, array('Mandates_stats','sortarr'));
            
            return $ret;

        }

        public function getInstitutions() {
            $dt = new Datetime();
            $ret = [];
            $this->db->select('institution');
            $this->db->from('ci_elected_officials');
            $this->db->where('mandate_end >',  $dt->format('Y-m-d H:i:s'));
            $this->db->group_by('institution');
            $this->db->order_by('institution', 'ASC');
            $query = $this->db->get();
            $res =  $query->result_array();

            foreach ($res as $inst) {
                if (!in_array($inst['institution'], $ret)) {
                    array_push($ret, $inst['institution']);
                }
            }

            return $ret;
        }


        public function getStates() {
            $this->db->select('*');
            $this->db->from('ci_foreign_states');
            $this->db->where_not_in('display_name', array("Brüssel"));
            $query = $this->db->get();
            $res =  $query->result_array();

            return $res;
        }
}