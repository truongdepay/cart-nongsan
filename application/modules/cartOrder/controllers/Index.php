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
            'views',
            'form_validation'
        ]);

        $this->method = $this->input->server('REQUEST_METHOD');

    }

    public function index()
    {
        $data = [];
        $data['siteTitle'] = 'Giỏ hàng';
        $data['csrf_value'] = $this->security->get_csrf_hash();

        if ($this->session->has_userdata('cart')) {
            $response = $this->session->userdata('cart');
            $countProduct = $response;
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
                $totalMoney += $price * $countProduct[$listProduct[$i]];
                $result[] = [
                    'id' => $listProduct[$i],
                    'count' => $countProduct[$listProduct[$i]],
                    'title' => $info->post_title,
                    'url' => $info->guid,
                    'thumb' => $thumb->guid,
                    'price' => $price
                ];

            }
            $infocart = [
                'total_money' => $totalMoney
            ];
            $infocart = array_merge($infocart, $result);
            $this->session->set_userdata('info_cart', $infocart);
            $data['totalMoney'] = $totalMoney;
            $data['totalProduct'] = count($response);
            $data['result'] = $result;
            $template = 'index';
            $this->views->loadView($template, $data);
        } else {
            $template = 'cart_null';
            $this->views->loadView($template, $data);
        }

    }

    public function orderProduct()
    {
        if (strtolower($this->method) == 'post') {
            $id = $this->input->post('id');
            $order = $this->input->post('order');
            $this->addProduct($id, $order);
        }
    }


    public function addProduct($id = '', $order = 1)
    {
        $id = !empty($id)?$id:$this->input->get('id');

        $this->load->model('product_model');
        $check = $this->product_model->checkExist('ID', $id);
        if ($check > 0) {
            if ($order > 0 && is_numeric($order)) {
                if ($this->session->has_userdata('cart')) {
                    $ss = $this->session->userdata('cart');
                    if (isset($ss[$id])) {
                        $ss[$id] = $order;
                    } else {
                        $ss[$id] = 1;
                    }

                    $this->session->set_userdata('cart', $ss);
                    $dataSession = $ss;
                } else {
                    $dataSession = [
                        $id => 1
                    ];
                    $this->session->set_userdata('cart', $dataSession);
                }
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($dataSession));
            }
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'result' => 0,
                    'detail' => 'error! Please try again!'
                )));
        }
    }

    public function startOrder()
    {
        if ($this->session->has_userdata('info_cart')) {
            $infocart = $this->session->userdata('info_cart');
            var_dump($infocart);
            $data = [];
            $data['siteTitle'] = 'Tiến hành đặt hàng';
            $data['totalMoney'] = $infocart['total_money'];

            if (strtolower($this->method) == 'post') {
                $this->load->config('form_validation');
                $validation = config_item('validation_cart');
                $fullname = $this->input->post('fullname');
                $phone = $this->input->post('phone');
                $email = $this->input->post('email');
                $receive = $this->input->post('receive');
                $address = $this->input->post('address');
                $dateReceive = $this->input->post('date-receive');
                $note = $this->input->post('note');

                if ($receive == 0) {
                    $config = [
                        $validation['fullname'],
                        $validation['phone'],
                        $validation['email'],
                        $validation['address']
                    ];
                } else {
                    $config = [
                        $validation['fullname'],
                        $validation['phone'],
                        $validation['email']
                    ];
                }

                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == FALSE)
                {
                    // action
                }
                else
                {

                    if ($receive == 0) {
                        $cartData = [
                            'name_product' => $infocart[0]['title'],
                            'count' => $infocart[0]['count'],
                            'price' => $infocart[0]['price'],
                            'total_curency' => $infocart['total_money'],
                            'first_name' => $fullname,
                            'phone' => $phone,
                            'email' => $email,
                            'adress' => $address,
                            'date' => $dateReceive,
                            'time' => '',
                            'note' => $note
                        ];

                        $result = [
                            'status' => 0,
                            'content' => json_encode($cartData),
                            'created_at' => date("Y-m-d H:m:s"),
                            'order_at' => 0
                        ];
                    } else {
                        $cartData = [
                            'name_product' => $infocart[0]['title'],
                            'count' => $infocart[0]['count'],
                            'price' => $infocart[0]['price'],
                            'total_curency' => $infocart['total_money'],
                            'first_name' => $fullname,
                            'phone' => $phone,
                            'email' => $email,
                            'adress' => 'Cơ sở 1',
                            'date' => $dateReceive,
                            'time' => '',
                            'note' => $note
                        ];

                        $result = [
                            'status' => 0,
                            'content' => json_encode($cartData),
                            'created_at' => date("Y-m-d H:m:s"),
                            'order_at' => 1
                        ];
                    }

                    $this->load->model('order_model');
                    $this->order_model->add($result);
                }
            }

            $template = 'start_order';
            $this->views->loadView($template, $data);
        }
    }
}