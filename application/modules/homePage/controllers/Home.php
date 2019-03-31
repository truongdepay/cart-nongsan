<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 12/24/2018
 * Time: 5:01 PM
 */

class Home extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper([
            'url',
        ]);
        $this->load->library([
            'users'
        ]);
        $this->users->redirectLogin();
        $this->load->config('config_template');
        $this->view = 'home';
    }


    public function index()
    {
        $data = [];
        $data['siteTitle'] = 'Home Page';
        $this->load->view(config_item('pathHeader'), $data);
        $this->load->view($this->view, $data);
        $this->load->view(config_item('pathFooter'), $data);
    }
}