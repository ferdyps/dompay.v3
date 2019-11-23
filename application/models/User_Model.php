<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class User_Model extends MY_Model {
        protected $table = 'users';
// =============================================================
        public function addEmployee($data) {
            return $this->add_data($this->table, $data);
        }

        public function deleteEmployee($id) {
            return $this->delete_data($this->table, 'id', $id);
        }

        public function viewEmployeeByOwner($id) {
            return $this->select_data($this->table, 'id_owner', $id)->result_array();
        }
// =============================================================
    }
?>