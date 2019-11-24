<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Employee extends CI_Controller {
        public $id_account, $id_owner, $fitur;
// =============================================================
        public function __construct() {
            parent::__construct();

            $this->load->model(['account_model', 'mutasi_model']);
            $this->load->library('form_validation');

            $this->id_account = $this->session->userdata('id');
            $this->id_owner = $this->session->userdata('id_owner');

            $this->fitur = explode(', ', $this->session->userdata('fitur'));
            
            if (!$this->session->userdata('isLoggedIn')) {
                redirect(base_url(), 'refresh');
            } else {
                if ($this->session->userdata('akses') == 1) {
                    redirect(base_url('superadmin'), 'refresh');
                } else if($this->session->userdata('akses') == 2) {
                    redirect(base_url('owner'), 'refresh');
                }
            }
        }
// =============================================================
        public function index() {
            $data = [
                'content' => 'employee/dashboard',
                'title' => 'Dashboard'
            ];

            $this->load->view('employee/index', $data);
        }

        public function bank() {
            $data = [
                'content' => 'employee/bank',
                'title' => 'Bank'
            ];

            $this->load->view('employee/index', $data);
        }

        public function mutasi() {
            $data = [
                'content' => 'employee/mutasi',
                'title' => 'Mutasi',
                'listDataAccount' => $this->account_model->viewByAcc($this->id_owner)
            ];
            
            $this->load->view('employee/index', $data);
        }
// =============================================================
        public function get_accountBank() {
            echo json_encode($this->account_model->viewByAcc($this->id_owner));
        }
// =============================================================
    }
?>