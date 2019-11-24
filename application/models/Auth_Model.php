<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Auth_Model extends MY_Model {

        public function login($username, $password) {
            $username = $this->db->escape($username);
            $password = $this->db->escape($password);
            
            $condition = "username = $username AND password = $password";
            $this->db->where($condition);
            
            return $this->db->get('users');
        }

        public function register($data) {
            return $this->add_data('users', $data);
        }
    }
?>