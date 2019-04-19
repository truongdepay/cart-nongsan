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
            'form_validation',
            'sendmail'
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
            $infocart['info'] = $result;
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
                    $resultOrder = $this->session->userdata('cart');
                    $count = count($resultOrder);
                } else {
                    $dataSession = [
                        $id => 1
                    ];
                    $this->session->set_userdata('cart', $dataSession);
                    $resultOrder = $this->session->userdata('cart');
                    $count = count($resultOrder);
                }
                $response = [
                    'result' => 1,
                    'detail' => [
                        'count' => $count
                    ]
                ];
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
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
        $data = [];
        $data['siteTitle'] = 'Tiến hành đặt hàng';
        if ($this->session->has_userdata('info_cart')) {
            $infocart = $this->session->userdata('info_cart');
            $data['totalMoney'] = $infocart['total_money'];
            if (strtolower($this->method) == 'post') {
                $this->load->config('form_validation');
                $this->load->config('config_message');
                $validation = config_item('validation_cart');
                $message = config_item('message_error');
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
                $this->form_validation->set_message($message['register']);
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == FALSE)
                {
                    $template = 'start_order';
                    $this->views->loadView($template, $data);
                }
                else
                {
                    $dataOrder = [
                        'name' => $fullname,
                        'status' => 0,
                        'phone' => $phone,
                        'email' => $email,
                        'type' => $receive,
                        'address' => $address,
                        'date_order' => time(),
                        'date_receive' => $dateReceive,
                        'content' => json_encode($infocart),
                        'note' => $note
                    ];
                    $this->load->model('order_model');
                    $idUpdate = $this->order_model->add($dataOrder);
                    //send mail
                    $subject = 'NSDH - Đặt hàng - lúc ' . date('H:i:s d-m-Y ');
                    $body = $this->bodyMail($dataOrder, $idUpdate);
                    $this->sendmail->sendTo($subject, $body);
                    $this->session->unset_userdata('cart');
                    $this->session->unset_userdata('info_cart');
                    $template = 'order_success';
                    $this->views->loadView($template, $data);
                }
            } else {
                $template = 'start_order';
                $this->views->loadView($template, $data);
            }


        } else {
            redirect('cartOrder/index');
        }
    }

    public function deleteProduct()
    {
        if (strtolower($this->method) == 'post') {
            $id = $this->input->post('id');
            if ($this->session->has_userdata('cart')) {
                $ss = $this->session->userdata('cart');
                if (isset($ss[$id])) {
                    unset($ss[$id]);
                    $this->session->set_userdata('cart', $ss);
                }
                if (count($ss) == 0) {
                    $this->session->unset_userdata('cart');
                }
                $response = [
                    'result' => 1
                ];
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            }
        }
    }

    public function displayCart()
    {
        if ($this->session->has_userdata('cart')) {
            $response = $this->session->userdata('cart');
            $resultOrder = $this->session->userdata('cart');
            $count = count($resultOrder);
            $response = [
                'result' => 1,
                'detail' => [
                    'count' => $count
                ]
            ];
        } else {
            $response = [
                'result' => 1,
                'detail' => [
                    'count' => 0
                ]
            ];
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    private function bodyMail($info, $id)
    {
        $this->load->model('order_model');
        $type = $info['type'];
        $content = json_decode($info['content']);
        $tag = '';
        //$tag .= "<style>table{border:1px solid #ddd;} table tr td{border: 1px solid #ddd; padding: 5px}</style>";
        $tb = '';
        $tag .= "<h3>Tên KH: ". $info['name'] ."</h3>";
        $tag .= "<h3>Điện thoại KH: ". $info['phone'] ."</h3>";
        $tag .= "<h3>Email KH: ". $info['email'] ."</h3>";
        if ($type == 0) {
            $tag .= "<h3>Nhận: tại nhà</h3>";
        } else {
            $tag .= "<h3>Nhận: tại cửa hàng</h3>";
        }
        $tag .= "<h3>Địa Chỉ nhận: " . $info['address'] . "</h3>";
        $tag .= "<h3>Ngày nhận: " . $info['date_receive'] . "</h3>";
        $tag .= "<hr>";

        $tb .= "<tr style='border:1px solid #333'>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Tên sản phẩm</th>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Số lượng</th>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Giá</th>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Tổng</th>";
        $tb .= "</tr>";

        for($i = 0; $i < count($content->info); $i++) {
            $tb .= "<tr>";
            $tb .= "<td style='border:1px solid #333; padding: 5px'>" . $content->info[$i]->title . "</td>";
            $tb .= "<td style='border:1px solid #333; padding: 5px'>" . $content->info[$i]->count . "</td>";
            $tb .= "<td style='border:1px solid #333; padding: 5px'>" . number_format($content->info[$i]->price) . "đ</td>";
            $tb .= "<td style='border:1px solid #333; padding: 5px'>" . number_format($content->info[$i]->price * $content->info[$i]->count) . "đ</td>";
            $tb .= "</tr>";
        }
        $tag .= "<table style='font-size: 15px;'>";
        $tag .= $tb;
        $tag .= "</table>";
        $tag .= "<hr>";
        $tag .= "<h2>Tổng tiền: " . number_format($content->total_money) . "đ</h2>";
        $tag .= "<h4>Ghi chú: " . $info['note'] . "</h4>";
        $tag .= "<hr>";
        $tag .= "<a href='". base_url('adminCart/index/updateStatus?id=' . $id . "&status=1") . "'>Đánh dấu là đã đọc</a>";
        return $tag;
    }
}