<?php

class OrderMore extends MX_Controller
{
    protected $method;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper([
            'url',
            'form',
            'language'
        ]);
        
        $this->load->library([
            'lang',
            'session',
            'views',
            'form_validation',
            'sendmail'
        ]);
        
        $this->method = strtolower($this->input->server('REQUEST_METHOD'));
    }
    
    public function index()
    {
        $getLang = $this->input->get('lang');
        
        switch ($getLang) {
            case 'vi':
                $lang = 'vietnamese';
                $langShort = 'vi';
                break;
            case 'en':
                $lang = 'english';
                $langShort = 'en';
                break;
            default :
                $lang = 'vietnamese';
                $langShort = 'vi';
                break;
        }
        $id = empty($this->input->get('id')) ? '' : $this->input->get('id');
        if ($id === '') {
            redirect('https://nongsandungha.com');
        }
        $id = empty($this->input->get('id')) ? '' : $this->input->get('id');
        $this->lang->load('order_more', $lang);
        $template = 'order_more';
        $data = [];
        $this->load->model('product_model');
        $info = $this->product_model->getInfo($id);
        $thumbID = $this->product_model->getThumbnail($id);
        $thumb = $this->product_model->getInfo($thumbID->meta_value);
        $priceRow = $this->product_model->getPrice($id);
        $price = empty($priceRow)? 0 : $priceRow->meta_value;
        
        $data['info'] = $info;
        $data['thumb'] = $thumb;
        $data['price'] = $price;
        $data['id'] = $id;
        $data['lang'] = $langShort;
        $data['siteTitle'] = lang('title');
        $this->views->loadView($template, $data);
    }
    
    public function add()
    {
        $data = [];
        $getLang = $this->input->get('lang');
        switch ($getLang) {
            case 'vi':
                $lang = 'vietnamese';
                $langShort = 'vi';
                break;
            case 'en':
                $lang = 'english';
                $langShort = 'en';
                break;
            default :
                $lang = 'vietnamese';
                $langShort = 'vi';
                break;
        }
        $this->lang->load('order_more', $lang);
        $id = empty($this->input->get('id')) ? '' : $this->input->get('id');
        $this->load->model('product_model');
        $info = $this->product_model->getInfo($id);
        $thumbID = $this->product_model->getThumbnail($id);
        $thumb = $this->product_model->getInfo($thumbID->meta_value);
        $priceRow = $this->product_model->getPrice($id);
        $price = empty($priceRow)? 0 : $priceRow->meta_value;
    
        $data['info'] = $info;
        $data['thumb'] = $thumb;
        $data['price'] = $price;
        $data['id'] = $id;
        $data['lang'] = $langShort;
        $data['siteTitle'] = lang('title');
        if ($this->method === 'post') {
            $this->load->config('form_validation');
            $this->load->config('config_message');
            $validation = config_item('validation_cart');
            $message = config_item('message_error');
            
            $fullname = $this->input->post('fullname');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $company = $this->input->post('company');
            $address = $this->input->post('address');
            $amount = $this->input->post('amount');
            $desiredPrice = $this->input->post('desired_price');
            $dateWant = $this->input->post('date_want');
            $product = $this->input->post('product');
            
            $config = [
                $validation['fullname'],
                $validation['phone'],
                $validation['email'],
                $validation['address']
            ];
            $this->form_validation->set_message($message['register']);
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE)
            {
                $template = 'order_more';
                $this->views->loadView($template, $data);
            } else {
                $dataOrder = [
                    'status' => 0,
                    'fullname' => $fullname,
                    'phone' => $phone,
                    'email' => $email,
                    'company' => $company,
                    'address' => $address,
                    'amount' => $amount,
                    'desired_price' => $desiredPrice,
                    'date_want' => $dateWant,
                    'product' => $product,
                    'date_create' => time()
                ];
                $this->load->model('Ordermore_model');
                $this->Ordermore_model->add($dataOrder);
                $subject = '[DonHangSi] NSDH - Đặt hàng - lúc ' . date('H:i:s d-m-Y ');
                $body = $this->bodyMail($dataOrder, $id);
                $this->sendmail->sendTo($subject, $body);
                $template = 'order_success';
                $this->views->loadView($template, $data);
            }
        } else {
            redirect('https://nongsandungha.com');
        }
    }
    
    private function bodyMail($info, $id)
    {
        $this->load->model('product_model');
        $item = $this->product_model->getInfo($id);
        $thumbID = $this->product_model->getThumbnail($id);
        $thumb = $this->product_model->getInfo($thumbID->meta_value);
        $priceRow = $this->product_model->getPrice($id);
        $price = empty($priceRow)? 0 : $priceRow->meta_value;
        
        $tag = '';
        //$tag .= "<style>table{border:1px solid #ddd;} table tr td{border: 1px solid #ddd; padding: 5px}</style>";
        $tb = '';
        $tag .= "<h3>Tên KH: ". $info['fullname'] ."</h3>";
        $tag .= "<h3>Điện thoại KH: ". $info['phone'] ."</h3>";
        $tag .= "<h3>Email KH: ". $info['email'] ."</h3>";
        $tag .= "<h3>Địa Chỉ: " . $info['address'] . "</h3>";
        $tag .= "<h3>Ngày nhận: " . $info['date_want'] . "</h3>";
        $tag .= "<hr>";
        $tb .= "<table>";
        $tb .= "<tr style='border:1px solid #333'>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Tên sản phẩm</th>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Giá bán lẻ</th>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Số lượng</th>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Giá mong muốn</th>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Ngày cần có hàng</th>";
        $tb .= "</tr>";
    
        $tb .= "<tr>";
        $tb .= "<td style='border:1px solid #333; padding: 5px'>" . $item->post_title . "</td>";
        $tb .= "<td style='border:1px solid #333; padding: 5px'>" . number_format($price) . "đ</td>";
        $tb .= "<td style='border:1px solid #333; padding: 5px'>" . $info['amount'] . "</td>";
        $tb .= "<td style='border:1px solid #333; padding: 5px'>" . number_format($info['desired_price']) . "đ</td>";
        $tb .= "<td style='border:1px solid #333; padding: 5px'>" . $info['date_want'] . "</td>";
        $tb .= "</tr>";
        $tb .= "</table>";
        $tag .= $tb;
        return $tag;
    }
}