<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 9/9/2018
 * Time: 12:15 AM
 */
$config['logs'] = array(
    'managerPost' => array(
        'debug' => false,
        'name' => 'managerPost',
        'path' => APPPATH . '/logs-data/Post/ManagerPost/' . date('Y_m_d') . '.log'
    )
);