<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH . '/libraries/REST_Controller.php';
    require APPPATH . '/libraries/Format.php';
    use Restserver\Libraries\REST_Controller;
    
    class Mutasi extends REST_Controller {
    
        function __construct() {
            parent::__construct();
            $this->load->model('mutasi_model', 'mutasi');
        }

        function index_get() {
            $no_rek = $this->get('no_rek');

            $query = $this->mutasi->select($this->cryptor($no_rek));

            if ($query) {
                $this->response([
                    'status' => true,
                    'data' => $query
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'data' => 'no_rek not found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }  
    }  
?>