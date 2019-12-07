<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Account_Model extends MY_Model {
        protected $table = 'accounts';
// =============================================================        
        public function add($data) {
            return $this->add_data($this->table, $data);
        }

        public function select($id = null) {
            if ($id === null) {
                return $this->view_data($this->table)->result_array();
            } else {
                return $this->select_data($this->table, 'id', $id)->result_array();
            }
        }

        public function edit($id, $data) {
            return $this->edit_data($this->table, 'no_rek', $id, $data);
        }

        public function delete($id) {
            return $this->delete_data($this->table, 'id_account', $id);
        }
// =============================================================
    }
?>