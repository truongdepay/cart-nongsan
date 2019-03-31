<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 1/13/2019
 * Time: 12:05 PM
 */

if (!function_exists('convertStatus')) {
    /**
     * @param $status
     * @return string
     */
    function convertStatus($status)
    {
        $config[0] = "<b class='text-warning'>Lưu nháp</b>";
        $config[1] = "<b class='text-success'>Công khai</b>";
        $config['null'] = "<span class='text-primary'>###</span>";
        if (isset($status)) {
            return $config[$status];
        } else {
            return $config['null'];
        }
    }
}

if (!function_exists('keepData')) {
    /**
     * @param $sessionName
     * @param $name
     * @return null
     */
    function keepData($sessionName, $name, $default = null)
    {
        $CI =& get_instance();
        $CI->load->library('session'); // load library
        if (!empty($name && !empty($sessionName))) {
            if ($CI->session->userdata($sessionName)) {
                $ssData = $CI->session->userdata($sessionName);
                if (isset($ssData[$name])) {
                    return $ssData[$name];
                } else {
                    return $default;
                }
            } else {
                return $default;
            }
        } else {
            return $default;
        }
    }
}

if (!function_exists('displayError')) {
    function displayError($error)
    {
        $str = '';
        foreach ($error as $value) {
            $str .= '<p class="d-block">' . $value . '</p>';
        }
        $html = '<div class="alert alert-danger" role="alert">' . $str . '</div>';
        return $html;
    }
}