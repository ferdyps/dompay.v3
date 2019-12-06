<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class MY_Controller extends CI_Controller {
    
        function cryptor($string, $action = 'e') {
            // you may change these values to your own
            $secret_key = 'CIZ69AHLrpxkBCUU3imX';
            $secret_iv = 'adhjST3TppCW8Ge4bHT5';
        
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
    }
?>