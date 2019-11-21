<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Account_Model extends MY_Model {
        protected $table = 'accounts';
        
        public function add($data) {
            $account = $this->db->escape_str($data);
            
            return $this->add_data($this->table, $account);
        }
        
        public function viewByAcc($id) {
            return $this->select_data($this->table, 'id', $id)->result_array();
        }
    }
?>