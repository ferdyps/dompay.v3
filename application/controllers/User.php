<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class User extends CI_Controller {
        public $id_account;
// =============================================================
        public function __construct() {
            parent::__construct();

            $this->load->model(['account_model', 'mutasi_model']);
            $this->load->library('form_validation');

            $this->id_account = $this->session->userdata('id');
            
            if (!$this->session->userdata('isLoggedIn')) {
                redirect(base_url(), 'refresh');
            }
        }
// =============================================================
        public function index() {
            $data = [
                'content' => 'user/dashboard'
            ];

            $this->load->view('user/index', $data);
        }
// =============================================================
        public function bank(){
            $data = [
                'content' => 'user/bank'
            ];
            $this->load->view('user/index', $data);
            
        }
    }
?>