<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
// =============================================================
	public function __construct() {
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model(['auth_model', 'employee_model']);

		if ($this->session->userdata('isLoggedIn')) {
			if ($this->session->userdata('akses') == 1) {
				$url = base_url('superadmin');
			} else if($this->session->userdata('akses') == 2) {
				$url = base_url('owner');
			} else {
				$url = base_url('employee');
			}
			header("Location: $url");
		}
	}
// =============================================================
	public function index() {
		$this->form_validation->set_rules([
			[
				'field' => 'username',
				'label' => 'Email',
				'rules' => 'trim|required'
			],
			[
				'field' => 'password', 
				'label' => 'Password', 
				'rules' => 'trim|required'
			]
		]);

		if ($this->input->post()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->form_validation->run() == TRUE) {
				$query = $this->auth_model->login($this->cryptor($username), $this->cryptor($password));
				$data_account = $query->row();
				$row = $query->num_rows();

				if ($row != 0) {

					$array = [
						'id' => $data_account->id,
						'nama' => $data_account->nama,
						'akses' => $data_account->akses,
						'fitur' => $data_account->fitur,
						'isLoggedIn' => true
					];

					if ($data_account->akses == 1) {
						$url = base_url('superadmin');
					} elseif ($data_account->akses == 2) {
						$array['email'] = $data_account->email;
						$array['nohp'] = $data_account->nohp;
						
						$url = base_url('owner');
					} else {
						$data_emp = $this->employee_model->select($data_account->id);

						$array['id_owner'] = $data_emp->id_owner;

						$url = base_url('employee');
					}
					
					$this->session->set_userdata($array);

					$json = [
						'url' => $url,
						'message' => 'Login Berhasil..'
					];
				} else {
					$json['errors'] = "Akun belum terdaftar..!";
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
				'content' => 'auth/login'
			];

			$this->load->view('auth/index', $data);
		}
	}

	public function register() {
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

		$this->form_validation->set_message('is_unique', '{field} is already being taken.');

		if($this->input->post()) {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$nohp = $this->input->post('nohp');
			$password = $this->input->post('password');
			
			if ($this->form_validation->run() == TRUE) {
				$data = [
					'nama' => $nama,
					'username' => $this->cryptor($email),
					'email' => $email,
					'nohp' => $nohp,
					'password' => $this->cryptor($password),
					'akses' => 2,
					'fitur' => 'All'
				];

				$query = $this->auth_model->register($data);
				
				if ($query) {

					$json = [
						'url' => base_url(),
						'message' => "Akun berhasil dibuat.."
					];
				} else {
					$json['errors'] = "Akun gagal dibuat..!";
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
			$data['content'] = 'auth/register';
			$this->load->view('auth/index', $data);
		}
	}
// =============================================================
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
// =============================================================
}
