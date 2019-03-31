<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 2/22/2019
 * Time: 11:15 AM
 */

class Index extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper([
            'url',
            'form',
            'validate',
            'elements',
        ]);
        $this->load->library([
            'session',
            'users',
            'monolog'
        ]);
        $this->users->redirectLogin();
        $this->load->config('config_notification');
        $this->noError = config_item('notifyError');
        $this->load->model('Page_model');
        $this->load->config('config_upload');
        $this->configImg = config_item('img');
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
            case 'category':
                $this->category();
                break;
            default:
                $this->manager();
                break;
        }
    }

    public function create()
    {

    }
}