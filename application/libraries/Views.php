<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 3/31/2019
 * Time: 11:32 AM
 */

class Views
{
    protected $CI;
    public function __construct()
    {
        $this->CI = & get_instance();
    }

    public function loadView($template, $data = [])
    {
        $this->CI->load->config('config_template');
        $this->CI->load->view(config_item('pathHeaderGame'), $data);
        $this->CI->load->view($template, $data);
        $this->CI->load->view(config_item('pathFooterGame'), $data);
    }
}