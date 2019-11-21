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

        public function bank() {
            $data = [
                'content' => 'user/bank'
            ];

            $this->load->view('user/index', $data);
        }
// =============================================================
        public function add_accountBank() {
            $this->form_validation->set_rules([
                [
                    'field' => 'nama',
                    'label' => 'Nama',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_email|is_unique[users.email]'
                ],
                [
                    'field' => 'nohp', 
                    'label' => 'Nomor HP', 
                    'rules' => 'trim|required|numeric|min_length[10]|max_length[13]|is_unique[users.nohp]'
                ],
                [
                    'field' => 'password', 
                    'label' => 'Password', 
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'confirm_password', 
                    'label' => 'Konfirmasi Password', 
                    'rules' => 'trim|required|matches[password]'
                ]
            ]);
        }
    }
?>