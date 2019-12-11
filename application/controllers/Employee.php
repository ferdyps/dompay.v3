<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Employee extends MY_Controller {
        public $id_user, $id_owner, $nama, $fitur, $dataAccount;
// =============================================================
        public function __construct() {
            parent::__construct();

            $this->load->model(['account_model', 'mutasi_model', 'user_model']);
            $this->load->library('form_validation');

            $this->id_user = $this->session->userdata('id');
            $this->id_owner = $this->session->userdata('id_owner');
            $this->nama = $this->session->userdata('nama');

            $dataEmployee = $this->user_model->select($this->id_user);

            $this->fitur = explode(', ', $dataEmployee->fitur);

            $dataAccount = $this->account_model->select($this->id_owner);

            if (count($dataAccount) > 0) {
                $no = 0;
                foreach ($dataAccount as $key => $value) {
                    $this->dataAccount[$no]['id_account'] = $value['id_account'];
                    $this->dataAccount[$no]['username'] = $this->cryptor($value['username'], 'd');
                    $this->dataAccount[$no]['password'] = $this->cryptor($value['password'], 'd');
                    $this->dataAccount[$no]['no_rek'] = $this->cryptor($value['no_rek'], 'd');
                    $this->dataAccount[$no]['typeBank'] = $value['typeBank'];
                    $no++;
                }
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
            // if(in_array('Dashboard', $this->fitur)) {
            //     $data = [
            //         'content' => 'employee/dashboard',
            //         'title' => 'Dashboard'
            //     ];

            //     $this->load->view('employee/index', $data);
            // } else {
                redirect(base_url('employee/mutasi'), 'refresh');
            // }
        }

        public function mutasi() {
            if(in_array('Debit', $this->fitur) || in_array('Kredit', $this->fitur)) {
                $data = [
                    'content' => 'employee/mutasi',
                    'title' => 'Mutasi',
                    'listDataAccount' => $this->dataAccount
                ];
                
                $this->load->view('employee/index', $data);
            } else {
                redirect(base_url('employee'),'refresh');
            }
        }
// =============================================================
        public function get_accountBank() {
            echo json_encode($this->dataAccount);
        }
// =============================================================
    }
?>