<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 1/30/2019
 * Time: 9:38 AM
 */

class Index extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper([
            'url',
            'form',
            'validate'
        ]);
        $this->load->library([
            'session',
            'users'
        ]);
        $this->load->model('User_model');
        $this->load->config('config_notification');
        $this->noError = config_item('notifyError');
    }

    public function index()
    {
        $action = $this->input->get('action');
        switch ($action) {
            case 'index':
                $this->manager();
                break;
            case 'create':
                $this->create();
                break;
            case 'edit':
                $this->edit();
                break;
            case 'delete':
                $this->delete();
                break;
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            case 'ckfinder':
                $this->ckfinder();
                break;
            default:
                $this->manager();
                break;
        }
    }

    private function manager()
    {
        $data = [];
        $data['siteTitle'] = 'Thay đổi thông tin Profile';

        $template = 'manager';
        $this->loadView($template, $data);
    }

    private function create()
    {
        $data = [];
        $data['siteTitle'] = 'Tạo mới user';

        if (strtolower($this->input->server('REQUEST_METHOD')) == 'post') {
            $error = [];
            $fullname = $this->input->post('fullname');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $passwordCf = $this->input->post('password_cf');
            $token = $this->input->post('token');

            $checkUsername = $this->User_model->checkExist('username', $username);

            if ($checkUsername > 0) {
                $error['dupUsername'] = $this->noError['dupUsername'];
            }

            if (!fullnameCheck($fullname)) {
                $error['fullname'] = $this->noError['fullname'];
            }
            if (!usernameCheck($username)) {
                $error['username'] = $this->noError['username'];
            }
            if (!passwordCheck($password)) {
                $error['password'] = $this->noError['password'];
            }
            if ($password !== $passwordCf) {
                $error['passwordCf'] = $this->noError['passwordCf'];
            }

            $loadToken = config_item('encryption_key');

            if ($token !== $loadToken) {
                $error['token'] = $this->noError['token'];
            }

            if (empty($error)) {

                $salt = sha1(time());
                $strPassword = $password . $salt;
                $password = password_hash($strPassword, PASSWORD_BCRYPT);

                $dataUser = [
                    'status' => 1,
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'salt' => $salt,
                    'date_create' => time()
                ];

                $this->User_model->add($dataUser);
                site_url('');
            } else {
                $flashData = [
                    'fullname' => $fullname,
                    'username' => $username
                ];
                $this->session->set_flashdata('userData', $flashData);
                site_url('managerUser/index/index?action=create');
            }
        }

        $template = 'create';
        $this->loadViewLogin($template, $data);
    }

    private function login()
    {
        $this->users->redirectAfterLogin();
        $data = [];
        $data['siteTitle'] = 'Login';
        if (strtolower($this->input->server('REQUEST_METHOD')) == 'post') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $checkUser = $this->User_model->checkExist('username', $username);
            if ($checkUser > 0) {
                $infoUser = $this->User_model->getInfo('username', $username);
                $password = $password . $infoUser->salt;
                $checkPass = password_verify($password, $infoUser->password);

                if ($checkPass) {
                    $sessionLogin = [
                        'check' => true,
                        'username' => $infoUser->username,
                        'fullname' => $infoUser->fullname
                    ];

                    $this->session->set_userdata('login', $sessionLogin);
                    redirect('');
                } else {
                    $error['loginFail'] = $this->noError['loginFail'];
                }
            } else {
                $error['loginFail'] = $this->noError['loginFail'];
            }
        }

        $template = 'login';
        $this->loadViewLogin($template, $data);
    }

    private function logout()
    {
        $this->users->redirectLogin();
        $checkLogin = $this->users->checkLogin();
        if ($checkLogin) {
            $sessionData = [
                'check' => false
            ];
            $this->session->set_userdata('login', $sessionData);
            redirect('managerUser/index/index?action=login');
        }
    }


    private function loadView($template, $data)
    {
        $this->load->config('config_template');
        $this->load->view(config_item('pathHeader'), $data);
        $this->load->view($template, $data);
        $this->load->view(config_item('pathFooter'), $data);
    }

    private function loadViewLogin($template, $data)
    {
        $this->load->config('config_template');
        $this->load->view(config_item('pathHeaderAdmin'), $data);
        $this->load->view($template, $data);
        $this->load->view(config_item('pathFooterAdmin'), $data);
    }
}