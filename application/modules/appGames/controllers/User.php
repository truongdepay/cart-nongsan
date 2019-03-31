<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 3/21/2019
 * Time: 4:05 PM
 */

class User extends MX_Controller
{
    protected $message;
    protected $method;
    protected $validation;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper([
            'url',
            'form'
        ]);

        $this->load->library([
            'session',
            'security',
            'form_validation',
            'users'
        ]);
        $this->load->database();
        $this->load->config('config_message');
        $this->load->config('form_validation');
        $this->validation = config_item('form_validation');
        $this->message = config_item('message_error');
        $this->method = $this->input->server('REQUEST_METHOD');
    }

    public function register()
    {
        $data = [];
        $data['siteTitle'] = 'Đăng ký';

        if (strtolower($this->method) == 'post') {
            $fullname = $this->input->post('fullname');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $config = [
                $this->validation['fullname'],
                $this->validation['username'],
                $this->validation['email'],
                $this->validation['password'],
                $this->validation['cf_password']
            ];
            $this->form_validation->set_message($this->message['register']);
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE)
            {
                // action
            }
            else
            {
                $passCreate = $this->users->createPassword($password);

                $dataUser = [
                    'fullname' => $fullname,
                    'username' => $username,
                    'status' => 1,
                    'email' => $email,
                    'salt' => $passCreate['salt'],
                    'password' => $passCreate['password'],
                    'date_create' => time()
                ];
                $this->load->model('User_model');
                $this->User_model->add($dataUser);
            }
        }

        $template = 'user_register';
        $this->loadViewGame($template, $data);
    }

    private function loadViewGame($template, $data)
    {
        $this->load->config('config_template');
        $this->load->view(config_item('pathHeaderGame'), $data);
        $this->load->view($template, $data);
        $this->load->view(config_item('pathFooterGame'), $data);
    }
}