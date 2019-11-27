<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH . '/libraries/REST_Controller.php';
    require APPPATH . '/libraries/Format.php';
    use Restserver\Libraries\REST_Controller;
    
    class Accounts extends REST_Controller  {
    
        function __construct() {
            parent::__construct();
            $this->load->model('account_model', 'account');
            $this->load->library('form_validation');
        }

        function index_post() {
            $this->form_validation->set_rules([
                [
                    'field' => 'id',
                    'label' => 'id',
                    'rules' => 'trim|required|numeric'
                ],
                [
                    'field' => 'nomorRek',
                    'label' => 'nomorRek',
                    'rules' => 'trim|required|numeric|min_length[10]|max_length[16]|is_unique[accounts.no_rek]'
                ],
                [
                    'field' => 'username',
                    'label' => 'username',
                    'rules' => 'trim|required|is_unique[accounts.username]'
                ],
                [
                    'field' => 'password',
                    'label' => 'password', 
                    'rules' => 'trim|required'
                ]
            ]);

            $this->form_validation->set_message('is_unique', '{field} is already being taken.');

            $this->form_validation->set_message('required', 'provide an {field}');

            $data = [
                'id' => $this->post('id'),
                'username' => $this->post('username'),
                'password' => $this->post('password'),
                'no_rek' => $this->post('norek'),
                'typeBank' => $this->post('typeBank')
            ];

            if ($this->form_validation->run() == TRUE) {
                $query = $this->account->add($data);
    
                if ($query){
                    $this->response([
                        'status' => true,
                        'massage'=> 'New user has been created.'
                    ], REST_Controller::HTTP_CREATED);
                } else {
                    $this->response([
                        'status' => false,
                        'massage'=> 'Failed to create new user.'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            } else {
                $this->response([
                    'status' => false,
                    'massage'=> array_filter(explode("\n", validation_errors(null, null)), function($value) { return !is_null($value) && $value !== ''; })
                ], REST_Controller::HTTP_NOT_ACCEPTABLE);
            }
        }

        function index_get() {
            $id = $this->get('id');

            $query = $this->account->select($id);

            if ($query) {
                $this->response([
                    'status' => true,
                    'data' => $query
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'data' => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        function index_delete() {
            $id = $this->delete('id');
            if ($id === null) {
                $this->response([
                    'status' => false,
                    'massage' => 'provide an id'
                ], REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $query = $this->account->delete($id);
                
                if ($query) {
                    $this->response([
                        'status' => true,
                        'id' => $id,
                        'massage'=> 'deleted.'
                    ], REST_Controller::HTTP_NO_CONTENT);
                } else {
                    $this->response([
                        'status' => false,
                        'massage' => 'id not found'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        }
    
    }  
?>