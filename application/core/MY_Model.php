<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class MY_Model extends CI_Model {
    
        public function add_data($tabel, $data) {
            $data = $this->db->escape_str($data);
            return $this->db->insert($tabel, $data);
        }

        public function edit_data($tabel, $pk_field, $id, $data) {
            $id = $this->db->escape_str($id);
            $data = $this->db->escape_str($data);

            $this->db->where($pk_field, $id);
            return $this->db->update($tabel, $data);
        }

        public function delete_data($tabel, $pk_field, $id) {
            $id = $this->db->escape_str($id);

            $this->db->where($pk_field, $id);
            return $this->db->delete($tabel);
        }

        public function view_data($tabel) {
            $this->db->order_by(1, 'asc');
            return $this->db->get($tabel);
        }

        public function select_data($tabel, $pk_field, $id) {
            $id = $this->db->escape_str($id);

            $this->db->where($pk_field, $id);
            return $this->db->get($tabel);
        }

    }  
?>