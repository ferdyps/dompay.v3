<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
// =============================================================
	public function __construct() {
		parent::__construct();

		$this->load->library(['form_validation']);
		$this->load->model('auth_model');
		
		// include_once APPPATH . "libraries/google-api-php-client/Google_Client.php";
		// include_once APPPATH . "libraries/google-api-php-client/contrib/Google_Oauth2Service.php";

		if ($this->session->userdata('isLoggedIn')) {
			$url = base_url('owner');
			header("Location: $url");
		}
	}
// =============================================================
	public function index() {
		$this->form_validation->set_rules([
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email'
			],
			[
				'field' => 'password', 
				'label' => 'Password', 
				'rules' => 'trim|required'
			]
		]);

		if ($this->input->post()) {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			
			if ($this->form_validation->run() == TRUE) {
				$query = $this->auth_model->login($email, $password);
				$data_account = $query->row();
				$row = $query->num_rows();

				if ($row != 0) {

					$array = [
						'id' => $data_account->id,
						'nama' => $data_account->nama,
						'isLoggedIn' => true
					];
					
					$this->session->set_userdata($array);

					$json = [
						'url' => base_url('owner'),
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

		if($this->input->post()) {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$nohp = $this->input->post('nohp');
			$password = md5($this->input->post('password'));
			
			if ($this->form_validation->run() == TRUE) {
				$data = [
					'nama' => $nama,
					'email' => $email,
					'nohp' => $nohp,
					'password' => $password
				];

				$query = $this->auth_model->register($data);
				
				if ($query) {
					$url = base_url();

					$json = [
						'message' => "Akun berhasil dibuat..",
						'url' => $url
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
