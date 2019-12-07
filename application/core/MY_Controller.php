<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class MY_Controller extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->library('encryption');
        }
        
        function cryptor($string, $action = 'e') {
            // you may change these values to your own
            $secret_key = hex2bin('809df8227001b1c05b64548ef2893bd8');
            $secret_iv = hex2bin('3dd9b060bc2b15ca6c360b1786321561');
        
            $output = false;
            $encrypt_method = "AES-256-CBC";
            $key = hash('sha512', $secret_key);
            $iv = substr(hash('sha512', $secret_iv), 0, 16);
        
            if($action == 'e') {
                $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
            } else if($action == 'd'){
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
            
            return $output;
        }

        function ci_cryptor($string, $action = 'e') {
            if($action == 'e') {
                $output = $this->encryption->encrypt($string);
            } else if($action == 'd'){
                $output = $this->encryption->decrypt($string);
            }
            
            return $output;
        }
    }
?>