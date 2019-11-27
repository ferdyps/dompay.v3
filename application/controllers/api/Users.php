<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH . '/libraries/REST_Controller.php';
    require APPPATH . '/libraries/Format.php';
    use Restserver\Libraries\REST_Controller;
    
    class Users extends REST_Controller  {
    
        function __construct() {
            parent::__construct();
            $this->load->model('user_model', 'user');
            $this->load->library('form_validation');
        }

        function index_post() {
            $this->form_validation->set_rules([
                [
                    'field' => 'nama',
                    'label' => 'nama',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'trim|required|valid_email|is_unique[users.email]'
                ],
                [
                    'field' => 'nohp', 
                    'label' => 'nohp', 
                    'rules' => 'trim|required|numeric|min_length[10]|max_length[13]|is_unique[users.nohp]'
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
                'nama' => $this->post('nama'),
                'email' => $this->post('email'),
                'nohp' => $this->post('nohp'),
                'password' => md5($this->post('password')),
                'akses' => 2,
                'fitur' => "All"
            ];

            if ($this->form_validation->run() == TRUE) {
                $query = $this->user->add($data);
    
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

            $query = $this->user->select($id);

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

        function index_put() {
            $id = $this->put('id');

            $data = [
                'nama' => $this->post('nama'),
                'email' => $this->post('email'),
                'nohp' => $this->post('nohp')
            ];

            $query = $this->user->edit($id, $data);
    
            if ($query){
                $this->response([
                    'status' => true,
                    'massage'=> 'New user has been created.'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'massage'=> 'Failed to create new user.'
                ], REST_Controller::HTTP_BAD_REQUEST);
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
                $query = $this->user->delete($id);
                
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