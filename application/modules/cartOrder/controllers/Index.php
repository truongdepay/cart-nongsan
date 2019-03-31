<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 3/31/2019
 * Time: 11:25 AM
 */

class Index extends MX_Controller
{
    protected $method;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper([
            'url',
            'form'
        ]);

        $this->load->library([
            'security',
            'session',
            'views'
        ]);

        $this->method = $this->input->server('REQUEST_METHOD');

    }

    public function index()
    {
        $response = [
            'count' => 4,
            'product' => [
                3332,
                3332,
                2610,
                2610
            ]
        ];
        $countProduct = array_count_values($response['product']);
        $listProduct = array_keys($countProduct);
        $result = [];
        $totalMoney = 0;
        $this->load->model('product_model');
        for ($i = 0; $i < count($listProduct); $i ++) {
            $info = $this->product_model->getInfo($listProduct[$i]);
            $thumbID = $this->product_model->getThumbnail($listProduct[$i]);
            $thumb = $this->product_model->getInfo($thumbID->meta_value);
            $priceRow = $this->product_model->getPrice($listProduct[$i]);
            $price = $priceRow->meta_value;
            $totalMoney += $price;
            $result[] = [
                'id' => $listProduct[$i],
                'count' => $countProduct[$listProduct[$i]],
                'title' => $info->post_title,
                'url' => $info->guid,
                'thumb' => $thumb->guid,
                'price' => $price
            ];

        }
        $data = [];
        $data['siteTitle'] = 'Giỏ hàng';
        $data['csrf_value'] = $this->security->get_csrf_hash();
        $data['totalMoney'] = $totalMoney;
        $data['totalProduct'] = count($response['product']);
        $data['result'] = $result;
        $template = 'index';
        $this->views->loadView($template, $data);
    }

    public function orderProduct()
    {
        if (strtolower($this->method) == 'post') {

        }
    }


    public function addProduct()
    {
        $id = $this->input->get('id');
        if ($this->session->has_userdata('cart')) {
            $ss = $this->session->userdata('cart');
            $count = $ss['count'] + 1;
            $product = $ss['product'];
            $product[] = $id;

            $this->session->set_userdata('cart', [
                'count' => $count,
                'product' => $product
            ]);
            $dataSession = [
                'count' => $count,
                'product' => $product
            ];
        } else {
            $dataSession = [
                'count' => 1,
                'product' => [
                    $id
                ]
            ];
            $this->session->set_userdata('cart', $dataSession);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($dataSession));

    }
}