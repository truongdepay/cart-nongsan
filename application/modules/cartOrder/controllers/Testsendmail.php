<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 4/12/2019
 * Time: 11:56 AM
 */
class Testsendmail extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper();
        $this->load->library([
            'sendmail'
        ]);
    }

    public function index()
    {
        $subject = 'Test Send Mail';
        $body = "<b>Strong</b>";
        $this->sendmail->sendTo($subject, $body);
    }
}