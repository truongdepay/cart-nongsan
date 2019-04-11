<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 4/7/2019
 * Time: 2:25 AM
 */
class Index extends MX_Controller
{
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
            'views'
        ]);
    }

    public function index()
    {

        $data = [];
        $data['siteTitle'] = "Quản lý đơn hàng";

        $page = empty($this->input->get('page')) ? 0 : $this->input->get('page');
        $limit = empty($this->input->get('limit')) ? 15 : $this->input->get('limit');
        $start = $page * $limit;
        $where = [];
        $this->load->model('order_model');
        $data['result'] = $this->order_model->getResult($where, $limit, $start);

        $template = 'index';
        $this->views->loadViewAdmin($template, $data);
    }

    public function nongsan()
    {
        $template = 'nongsan';
        $this->load->view($template);
    }
}