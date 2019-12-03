<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Employee extends CI_Controller {
        public $id_account, $id_owner, $nama, $fitur, $dataAccount;
// =============================================================
        public function __construct() {
            parent::__construct();

            $this->load->model(['account_model', 'mutasi_model']);
            $this->load->library('form_validation');

            $this->id_account = $this->session->userdata('id');
            $this->id_owner = $this->session->userdata('id_owner');
            $this->nama = $this->session->userdata('nama');

            $this->fitur = explode(', ', $this->session->userdata('fitur'));

            if (in_array('Saldo', $this->fitur)) {
                $this->dataAccount = $this->account_model->select($this->id_owner);
            }
            
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
            if(in_array('Dashboard', $this->fitur)) {
                $data = [
                    'content' => 'employee/dashboard',
                    'title' => 'Dashboard'
                ];

                $this->load->view('employee/index', $data);
            } else {
                redirect(base_url('employee/mutasi'), 'refresh');
            }
        }

        public function mutasi() {
            if(in_array('Debit', $this->fitur) || in_array('Kredit', $this->fitur)) {
                $data = [
                    'content' => 'employee/mutasi',
                    'title' => 'Mutasi',
                    'listDataAccount' => $this->account_model->select($this->id_owner)
                ];
                
                $this->load->view('employee/index', $data);
            } else {
                redirect(base_url('employee'),'refresh');
            }
        }
// =============================================================
        public function get_accountBank() {
            echo json_encode($this->account_model->select($this->id_owner));
        }
// =============================================================
    }
?>