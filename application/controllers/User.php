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
                    'field' => 'nomorRek',
                    'label' => 'Nomor Rekening',
                    'rules' => 'trim|required|numeric|min_length[10]|max_length[16]|is_unique[accounts.no_rek]'
                ],
                [
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'trim|required|is_unique[accounts.username]'
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

            if ($this->input->post()) {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $no_rek = $this->input->post('nomorRek');
                $typeBank = $this->input->post('typeBank');
                
                if ($this->form_validation->run() == TRUE) {
                    # code...
                } else {
                    $no = 0;
                    foreach ($this->input->post() as $key => $value) {
                        if (form_error($key) != "") {
                            $json['form_errors'][$no]['id'] = $key;
                            $json['form_errors'][$no]['msg'] = form_error($key, null, null);
                            $no++;
                        }
                    }
                }
                echo json_encode($json);
            } else {
                redirect(base_url('user/bank'),'refresh');
            }
        }
    }
?>