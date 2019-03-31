<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 3/1/2019
 * Time: 9:47 AM
 */

class Index extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library([
            'crawler',
            'monolog'
        ]);
    }

    public function getResult()
    {
        $url = 'https://www.premierleague.com/tables';
        $response = $this->crawler->getResult($url);
        var_dump($response);
        $this->monolog->creatMonolog($response, '/crawler/result/');
    }
}