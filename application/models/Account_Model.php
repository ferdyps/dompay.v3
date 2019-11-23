<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Account_Model extends MY_Model {
        protected $table = 'accounts';
// =============================================================        
        public function add($data) {
            return $this->add_data($this->table, $data);
        }
// =============================================================
        public function viewByAcc($id) {
            return $this->select_data($this->table, 'id', $id)->result_array();
        }
// =============================================================
    }
?>