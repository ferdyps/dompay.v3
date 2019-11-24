<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class User_Model extends MY_Model {
        protected $table = 'users', $table_emp = 'employees', $view_emp = 'vemployees';
// =============================================================
        public function addEmployee($data, $id_owner) {
            $this->add_data($this->table, $data);
            
            $this->db->where('username', $data['username']);
            $userdata = $this->db->get('users')->row();
            
            $data_emp = [
                'id' => $userdata->id,
                'id_owner' => $id_owner
            ];

            return $this->add_data($this->table_emp, $data_emp);
        }

        public function selectEmployee($id) {
            return $this->select_data($this->view_emp, 'id', $id)->row();
        }

        public function editEmployee($id, $data) {
            return $this->edit_data($this->table, 'id', $id, $data);
        }

        public function deleteEmployee($id) {
            return $this->delete_data($this->table, 'id', $id);
        }
// =============================================================
        public function viewEmployeeByOwner($id) {
            return $this->select_data($this->view_emp, 'id_owner', $id)->result_array();
        }
// =============================================================
    }
?>