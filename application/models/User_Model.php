<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class User_Model extends MY_Model {
        protected $table = 'users', $view_owner = 'vowners';
// =============================================================
        public function add($data) {
            return $this->add_data($this->table, $data);
        }

        public function select($id = null) {
            if ($id == null) {
                return $this->view_data($this->table)->result_array();
            } else {
                return $this->select_data($this->table, 'id', $id)->row();
            }
        }

        public function edit($id, $data) {
            return $this->edit_data($this->table, 'id', $id, $data);
        }

        public function delete($id) {
            return $this->delete_data($this->table, 'id', $id);
        }
// =============================================================
        public function selectAllOwner() {
            return $this->view_data($this->view_owner)->result_array();
        }

        public function selectOwnerById($id) {
            return $this->select_data($this->view_owner, 'id', $id);
        }
// =============================================================
        public function usernameCheck($username) {
            return $this->select_data($this->table, 'username', $username);
        }
// =============================================================
    }
?>