<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 9/9/2018
 * Time: 12:43 AM
 */

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Monolog
{
    protected $_CI;
    public $monolog;

    public function __construct()
    {
        $this->_CI = & get_instance();
        $this->_CI->load->config('config_monolog');
        $this->monolog = config_item('logs');
    }

    public function creatMonolog($info = '', $fileName, $debug = true)
    {
        // Create the logger
        $logger = new Logger('Debug');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(APPPATH . '/logs-data/' . $fileName . '_' . date('Y_m_d', time()) . '.log' , Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());
        if ($debug === true) {
            $logger->info(json_encode($info));
        }
    }
}