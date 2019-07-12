<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 4/7/2019
 * Time: 2:25 AM
 */
class Index extends MX_Controller
{
    protected $status;
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
            'views',
            'users'
        ]);
        $this->users->redirectLogin();
        $this->method = strtolower($this->input->server('REQUEST_METHOD'));
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
        $data['csrf_value'] = $this->security->get_csrf_hash();
        $template = 'index';
        $this->views->loadViewAdmin($template, $data);
    }

    public function updateStatus()
    {
        if ($this->method == 'get') {
            $id = $this->input->get('id');
            $status = $this->input->get('status');
            $this->load->model('order_model');
            $checkExist = $this->order_model->checkExist('id', $id);
            if (is_numeric($status) && $checkExist > 0) {
                $data = [
                    'status' => $status
                ];
                $this->order_model->update($id, $data);
                $response = [
                    'result' => 1,
                    'detail' => [
                        'notify' => 'Success',
                        'csrf_value' => $this->security->get_csrf_hash(),
                        'status' => $status
                    ]
                ];
            } else {
                $response = [
                    'result' => 0,
                    'detail' => [
                        'notify' => 'Error!',
                        'csrf_value' => $this->security->get_csrf_hash(),
                    ]
                ];
            }
        } else {
            $response = [
                'result' => 0,
                'detail' => [
                    'notify' => 'Error Reuest Method! Do not support get request!',
                    'csrf_value' => $this->security->get_csrf_hash(),
                ]
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function nongsan()
    {
        $template = 'nongsan';
        $this->load->view($template);
    }
}