<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Owner extends MY_Controller {
        public $id_user, $email, $nama, $nohp, $dataAccount = [], $totalSaldo = 0, $controller;
// =============================================================
        public function __construct() {
            parent::__construct();

            $this->load->model(['account_model', 'mutasi_model', 'employee_model', 'user_model']);
            $this->load->library('form_validation');

            $this->id_user = $this->session->userdata('id');
            $this->email = $this->session->userdata('email');
            $this->nama = $this->session->userdata('nama');
            $this->nohp = $this->session->userdata('nohp');

            $this->controller = $this;
            $dataAccount = $this->account_model->select($this->id_user);

            if (count($dataAccount) > 0) {
                $no = 0;
                foreach ($dataAccount as $key => $value) {
                    $this->dataAccount[$no]['id_account'] = $value['id_account'];
                    $this->dataAccount[$no]['username'] = $this->cryptor($value['username'], 'd');
                    $this->dataAccount[$no]['password'] = $this->cryptor($value['password'], 'd');
                    $this->dataAccount[$no]['no_rek'] = $this->cryptor($value['no_rek'], 'd');
                    $this->dataAccount[$no]['typeBank'] = $value['typeBank'];
                    $this->dataAccount[$no]['saldo'] = $this->cryptor($value['saldo'], 'd');
                    $this->dataAccount[$no]['deskripsi'] = $value['deskripsi'];

                    $this->totalSaldo += $this->cryptor($value['saldo'], 'd');
                    $no++;
                }
            }
            
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
// ========================= View ==============================
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
                'listDataAccount' => $this->dataAccount
            ];

            $this->load->view('owner/index', $data);
        }

        public function list_employee() {
            $data = [
                'content' => 'owner/list_employee',
                'title' => 'Setting',
                'listDataEmployee' => $this->employee_model->viewByOwner($this->id_user)
            ];

            $this->load->view('owner/index', $data);
        }
// =============================================================
// ===================== Data Profile ==========================
// =============================================================
        public function edit_profile() {
            $this->form_validation->set_rules([
                [
                    'field' => 'nama',
                    'label' => 'Nama',
                    'rules' => 'trim|required'
                ]
            ]);

            $listData = $this->user_model->select($this->id_user);

            if ($this->input->post()) {
                $nama = $this->input->post('nama');
                $username = $this->input->post('username');
                $nohp = $this->input->post('nohp');

                if ($this->cryptor($username) != $listData->username) {
                    $this->form_validation->set_rules([
                        [
                            'field' => 'username',
                            'label' => 'Username',
                            'rules' => 'trim|required|callback_username_check'
                        ]
                    ]);
                }

                if ($nohp != $listData->nohp) {
                    $this->form_validation->set_rules([
                        [
                            'field' => 'nohp', 
                            'label' => 'Nomor HP', 
                            'rules' => 'trim|required|numeric|min_length[10]|max_length[13]|is_unique[users.nohp]'
                        ]
                    ]);
                }

                if ($this->form_validation->run() == TRUE) {
                    $data = [
                        'nama' => $nama
                    ];

                    if ($this->cryptor($username) != $listData->username) {
                        $data['username'] = $this->cryptor($username);
                    }

                    if ($nohp != $listData->nohp) {
                        $data['nohp'] = $nohp;
                    }

                    $query = $this->user_model->edit($this->id_user, $data);

                    if ($query) {
                        
                        $this->session->set_userdata($data);

                        $json = [
                            'message' => 'Profile berhasil diubah..',
                            'url' => base_url('owner')
                        ];
                    } else {
                        $json['errors'] = 'Profile gagal diubah..!';
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
                $data = [
                    'content' => 'owner/edit_profile',
                    'title' => 'Edit Profile',
                    'listData' => $listData
                ];

                $this->load->view('owner/index', $data);
            }
        }

        public function edit_akun() {
            $this->form_validation->set_rules([
                [
                    'field' => 'current_password', 
                    'label' => 'Password Sekarang', 
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'new_password', 
                    'label' => 'Password Baru', 
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'confirm_password', 
                    'label' => 'Konfirmasi Password', 
                    'rules' => 'trim|required|matches[new_password]'
                ]
            ]);

            $listData = $this->user_model->select($this->id_user);

            if ($this->input->post()) {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password');
                
                if ($this->form_validation->run() == TRUE) {
                    if ($this->cryptor($current_password) == $listData->password) {
                        $data['password'] = $this->cryptor($new_password);
                        
                        $query = $this->user_model->edit($this->id_user, $data);

                        if ($query) {
                            $json = [
                                'message' => 'Password berhasil diubah..',
                                'url' => base_url('owner')
                            ];
                        } else {
                            $json['errors'] = 'Password gagal diubah..!';
                        }
                    } else {
                        $json['errors'] = 'Current Password tidak sama..!';
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
                redirect(base_url('owner/edit_profile'), 'refresh');
            }
        }
// =============================================================
// ===================== Data Bank =============================
// =============================================================
        public function add_accountBank() {
            $this->form_validation->set_rules([
                [
                    'field' => 'nomorRek',
                    'label' => 'Nomor Rekening',
                    'rules' => 'trim|required|numeric|min_length[10]|max_length[30]|is_unique[accounts.no_rek]'
                ],
                [
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'password',
                    'label' => 'Password', 
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'deskripsi',
                    'label' => 'Deskripsi', 
                    'rules' => 'trim|required'
                ]
            ]);

            if ($this->input->post()) {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $no_rek = $this->input->post('nomorRek');
                $typeBank = $this->input->post('typeBank');
                $saldo = $this->input->post('saldo');
                $deskripsi = $this->input->post('deskripsi');
                
                if ($this->form_validation->run() == TRUE) {
                    if ($this->input->post('data') == "ada") {
                        $data = [
                            'id' => $this->id_user,
                            'username' => $this->cryptor($username),
                            'password' => $this->cryptor($password),
                            'no_rek' => $this->cryptor($no_rek),
                            'typeBank' => $typeBank,
                            'saldo' => $this->cryptor($saldo),
                            'deskripsi' => $deskripsi
                        ];
    
                        $query = $this->account_model->add($data);
    
                        if ($query) {
                            $json['message'] = "Akun berhasil ditambah..";
                        } else {
                            $json['errors'] = "Akun gagal ditambah..!";
                        }
                    } else {
                        $json['check'] = 'cek';
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
            echo json_encode($this->dataAccount);
        }

        public function updateSaldo_accountBank($id, $saldo) {
            $query = $this->account_model->edit($this->cryptor($id), ['saldo' => $this->cryptor($saldo)]);

            if ($query) {
                $json['message'] = 'Saldo berhasil di Update..';
            } else {
                $json['errors'] = 'Saldo gagal di Update..!';
            }

            echo json_encode($json);
        }

        public function delete_accountBank($id) {
            $query = $this->account_model->delete($id);

            if ($query) {
                $json['message'] = 'Akun berhasil dihapus..!';
            } else {
                $json['errors'] = 'Akun gagal dihapus..!';
            }

            echo json_encode($json);
        }
// =============================================================
// ====================== Data Employee ========================
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
                $password = $this->input->post('password');
                $fitur = $this->input->post('fitur');

                if ($fitur == NULL) {
                    $json['errors'] = "Akun harus memiliki fitur..!";
                } else {
                    $fitur = implode(', ', $fitur);
                    
                    if ($this->form_validation->run() == TRUE) {
                        $data = [
                            'nama' => $nama,
                            'username' => $this->cryptor($username),
                            'email' => $this->email,
                            'nohp' => $this->nohp,
                            'password' => $this->cryptor($password),
                            'akses' => 3,
                            'fitur' => $fitur
                        ];

                        $query = $this->employee_model->add($data, $this->id_user);

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
                $password = $this->input->post('password');

                if ($this->input->post('password') != NULL) {
                    $this->form_validation->set_rules([
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

                if ($fitur == NULL) {
                    $json['errors'] = "Akun harus memiliki fitur..!";
                } else {
                    $fitur = implode(', ', $fitur);
                    
                    if ($this->form_validation->run() == TRUE) {
                        $data = [
                            'nama' => $nama,
                            'fitur' => $fitur
                        ];

                        if ($this->input->post('password') != NULL) {
                            $data['password'] = $this->cryptor($password);
                        }

                        $query = $this->employee_model->edit($id, $data);

                        if ($query) {
                            $json['message'] = "Akun berhasil diubah..";
                        } else {
                            $json['errors'] = "Akun gagal diubah..!";
                        }
                    } else {
                        $no = 0;
                        foreach ($this->input->post() as $key => $value) {
                            if (form_error($key) != "") {
                                $json['form_errors'][$no]['id'] = $key . '-e';
                                $json['form_errors'][$no]['msg'] = form_error($key, null, null);
                                $no++;
                            }
                        }
                    }
                }
                echo json_encode($json);
            } else {
                echo json_encode($this->employee_model->select($id));
            }
        }

        public function get_employee() {
            echo json_encode($this->employee_model->viewByOwner($this->id_user));
        }

        public function delete_employee($id) {
            $query = $this->employee_model->delete($id);

            if ($query) {
                $json['message'] = 'Akun berhasil dihapus..!';
            } else {
                $json['errors'] = 'Akun gagal dihapus..!';
            }

            echo json_encode($json);
        }
// =============================================================
// ====================== Form Validate ========================
// =============================================================
        public function username_check($username) {
            $query = $this->user_model->usernameCheck($this->cryptor($username))->num_rows();
            if ($query != 0) {;
                $this->form_validation->set_message('username_check', '{field} is already being taken.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
// =============================================================
    }
?>