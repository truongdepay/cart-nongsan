<?php

/**
 * Class RegistSupplier
 */
class RegistSupplier extends MX_Controller
{
    protected $method;
    public function __construct()
    {
        parent::__construct();
        $this->load->library([
            'views',
            'form_validation',
            'sendmail'
        ]);
        $this->load->helper([
            'url',
            'form',
        ]);
        $this->method = strtolower($this->input->server('REQUEST_METHOD'));
    }
    
    public function index()
    {
        $template = 'regist_supplier';
        $data['siteTitle'] = 'Đăng ký nhà cung cấp';
        
        if ($this->method === 'post') {
            $this->load->config('form_validation');
            $this->load->config('config_message');
            $validation = config_item('validation_cart');
            $message = config_item('message_error');
            $config = [
                $validation['product'],
                $validation['fullname'],
                $validation['phone'],
                $validation['address'],
                $validation['mount']
            ];
            $this->form_validation->set_message($message['register']);
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() == FALSE) {
                $this->views->loadView($template, $data);
            } else {
                $listData = $this->input->post();
                $listData['create_at'] = time();
                $this->load->model('Supplier_model');
                $this->Supplier_model->add($listData);
                
                //send mail
                $subject = '[DangKyNCC] - Đăng ký NCC - lúc ' . date('H:i:s d-m-Y ');
                $this->load->config('email');
                $emailSystem = config_item('email');
    
                $body = $this->bodyMail($listData);
                $this->sendmail->sendTo($subject, $body, $emailSystem['mail_to'], $emailSystem['mail_cc']);
                $this->views->loadView('supplier_success', $data);
            }
        } else {
            $this->views->loadView($template, $data);
        }
    }
    
    private function bodyMail($info)
    {
        $tag = '';
        //$tag .= "<style>table{border:1px solid #ddd;} table tr td{border: 1px solid #ddd; padding: 5px}</style>";
        $tb = '';
        $tag .= "<h3>Tên KH: ". $info['fullname'] ."</h3>";
        $tag .= "<h3>Điện thoại KH: ". $info['phone'] ."</h3>";
        $tag .= "<h3>Địa Chỉ: " . $info['address'] . "</h3>";
        $tag .= "<hr>";
        $tb .= "<table>";
        $tb .= "<tr style='border:1px solid #333'>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Tên sản phẩm</th>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Số lượng</th>";
        $tb .= "<th style='border:1px solid #333; padding: 5px'>Mùa vụ sản phẩm</th>";
        $tb .= "</tr>";
        
        $tb .= "<tr>";
        $tb .= "<td style='border:1px solid #333; padding: 5px'>" . $info['product'] . "</td>";
        $tb .= "<td style='border:1px solid #333; padding: 5px'>" . $info['mount'] . "</td>";
        $tb .= "<td style='border:1px solid #333; padding: 5px'>" . $info['time'] . "</td>";
        $tb .= "</tr>";
        $tb .= "</table>";
        $tag .= $tb;
        return $tag;
    }
}