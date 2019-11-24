<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Owner extends CI_Controller {
        public $id_account, $email, $nama, $nohp;
// =============================================================
        public function __construct() {
            parent::__construct();

            $this->load->model(['account_model', 'mutasi_model', 'user_model']);
            $this->load->library('form_validation');

            $this->id_account = $this->session->userdata('id');
            $this->email = $this->session->userdata('email');
            $this->nama = $this->session->userdata('nama');
            $this->nohp = $this->session->userdata('nohp');
            
            if (!$this->session->userdata('isLoggedIn')) {
                redirect(base_url(), 'refresh');
            } else {
                if ($this->session->userdata('akses') == 1) {
                    redirect(base_url('superadmin'), 'refresh');
                } else if($this->session->userdata('akses') == 3) {
                    redirect(base_url('employee'), 'refresh');
                }
            }
        }
// =============================================================
        public function index() {
            $data = [
                'content' => 'owner/dashboard',
                'title' => 'Dashboard'
            ];

            $this->load->view('owner/index', $data);
        }

        public function bank() {
            $data = [
                'content' => 'owner/bank',
                'title' => 'Bank'
            ];

            $this->load->view('owner/index', $data);
        }

        public function mutasi() {
            $data = [
                'content' => 'owner/mutasi',
                'title' => 'Mutasi',
                'listDataAccount' => $this->account_model->viewByAcc($this->id_account)
            ];

            $this->load->view('owner/index', $data);
        }

        public function list_employee() {
            $data = [
                'content' => 'owner/list_employee',
                'title' => 'Setting',
                'listDataEmployee' => $this->user_model->viewEmployeeByOwner($this->id_account)
            ];

            $this->load->view('owner/index', $data);
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
                    $data = [
                        'id' => $this->id_account,
                        'username' => $username,
                        'password' => $password,
                        'no_rek' => $no_rek,
                        'typeBank' => $typeBank
                    ];

                    $query = $this->account_model->add($data);

                    if ($query) {
                        $json['message'] = "Akun berhasil ditambah..";
                    } else {
                        $json['errors'] = "Akun gagal ditambah..!";
                    }
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
                redirect(base_url('owner/bank'),'refresh');
            }
        }

        public function get_accountBank() {
            echo json_encode($this->account_model->viewByAcc($this->id_account));
        }
// =============================================================
        public function add_employee() {
            $this->form_validation->set_rules([
                [
                    'field' => 'nama',
                    'label' => 'Nama',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'trim|required|is_unique[users.username]'
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

            $this->form_validation->set_message('is_unique', '{field} is already being taken.');

            if ($this->input->post()) {
                $nama = $this->input->post('nama');
                $username = $this->input->post('username');
                $password = md5($this->input->post('password'));
                $fitur = $this->input->post('fitur');

                if ($fitur == NULL) {
                    $json['errors'] = "Akun harus memiliki fitur..!";
                } else {
                    $fitur = implode(', ', $fitur);
                    
                    if ($this->form_validation->run() == TRUE) {
                        $data = [
                            'nama' => $nama,
                            'username' => $username,
                            'email' => $this->email,
                            'nohp' => $this->nohp,
                            'password' => $password,
                            'akses' => 3,
                            'fitur' => $fitur
                        ];

                        $query = $this->user_model->addEmployee($data, $this->id_account);

                        if ($query) {
                            $json['message'] = "Akun berhasil ditambah..";
                        } else {
                            $json['errors'] = "Akun gagal ditambah..!";
                        }
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
                }
                echo json_encode($json);
            } else {
                redirect(base_url('owner/list_employee'),'refresh');
            }
        }

        public function edit_employee($id) {
            $this->form_validation->set_rules([
                [
                    'field' => 'nama',
                    'label' => 'Nama',
                    'rules' => 'trim|required'
                ]
            ]);

            if ($this->input->post()) {
                $nama = $this->input->post('nama');
                $fitur = $this->input->post('fitur');

                if ($fitur == NULL) {
                    $json['errors'] = "Akun harus memiliki fitur..!";
                } else {
                    $fitur = implode(', ', $fitur);
                    
                    if ($this->form_validation->run() == TRUE) {
                        $data = [
                            'nama' => $nama,
                            'fitur' => $fitur
                        ];

                        $query = $this->user_model->editEmployee($id, $data);

                        if ($query) {
                            $json['message'] = "Akun berhasil diubah..";
                        } else {
                            $json['errors'] = "Akun gagal diubah..!";
                        }
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
                }
                echo json_encode($json);
            } else {
                echo json_encode($this->user_model->selectEmployee($id));
            }
        }

        public function get_employee() {
            echo json_encode($this->user_model->viewEmployeeByOwner($this->id_account));
        }

        public function delete_employee($id) {
            $query = $this->user_model->deleteEmployee($id);

            if ($query) {
                $json['message'] = 'Akun berhasil dihapus..!';
            } else {
                $json['errors'] = 'Akun gagal dihapus..!';
            }

            echo json_encode($json);
        }
// =============================================================
    }
?>