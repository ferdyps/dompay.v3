<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Auth_Model extends MY_Model {

        public function login($email, $password) {
            $email = $this->db->escape($email);
            $password = $this->db->escape($password);
            
            $condition = "email = $email AND password = $password";
            $this->db->where($condition);
            
            return $this->db->get('users');
        }

        public function register($data) {
            $data = $this->db->escape_str($data);

            return $this->db->insert('users', $data);
        }
    }
?>