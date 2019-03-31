<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 2/22/2019
 * Time: 10:54 PM
 */

class Index extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library([
            'FacebookSdk'
        ]);
    }

    public function login()
    {
        $data = [];
        $data['link'] = $this->facebooksdk->getToken();
        $template = 'login';
        $this->load->view($template, $data);
    }

    public function callback()
    {
        $data = [];
        $data['accessToken'] = $this->facebooksdk->callback();
        var_dump($data['accessToken']);
        $template = 'callback';
        $this->load->view($template, $data);
    }
}