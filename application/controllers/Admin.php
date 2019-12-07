<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    
    public function __construct(){
        parent::__construct();

        $this->nama = $this->session->userdata('nama');
        
        if (!$this->session->userdata('isLoggedIn')) {
            redirect(base_url(), 'refresh');
        } else {
            if ($this->session->userdata('akses') == 3) {
                redirect(base_url('employee'), 'refresh');
            } else if($this->session->userdata('akses') == 2) {
                redirect(base_url('owner'), 'refresh');
            }
        }
    }
// ================================================================
    public function index(){
        $data = [
            'content' => 'admin/dashboard',
            'title' => 'Dashboard'
        ];
        $this->load->view('admin/index', $data);
    }

}

/* End of file Controllername.php */

?>