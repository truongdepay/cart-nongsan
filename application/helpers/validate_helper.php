<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 12/25/2018
 * Time: 3:41 PM
 */


if (!function_exists('titleCheck')) {
    /**
     * @param string $title
     * @return bool
     */
    function titleCheck($title = '')
    {
        if (preg_match('/.{1,}/', $title, $match)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('descCheck')) {
    /**
     * @param string $desc
     * @return bool
     */
    function descCheck($desc = '')
    {
        if (preg_match('/.{1,}/', $desc, $match)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('slugsCheck')) {
    /**
     * @param string $slugs
     * @return bool
     */
    function slugsCheck($slugs = '')
    {
        if (preg_match('/^[0-9A-Za-z][-a-z0-9]*$/', $slugs, $match)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('fullnameCheck')) {
    function fullnameCheck($fullname)
    {
        if (preg_match('/.*/', $fullname, $match)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('usernameCheck')) {
    function usernameCheck($username)
    {
        if (preg_match('/^[a-zA-Z0-9\_\-]*$/', $username, $match)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('passwordCheck')) {
    function passwordCheck($password)
    {
        if (preg_match('/^[a-zA-Z0-9\!\@\#\$\%\^\&]{6,56}$/', $password, $match)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('priceCheck')) {
    function priceCheck($price)
    {
        if (empty($price)) {
            return true;
        }else {
            if (is_numeric($price)) {
                return true;
            } else {
                return false;
            }
        }

    }
}

if (!function_exists('checkNull')) {
    function checkNull($content)
    {
        if (empty($content)) {
            return false;
        }
        return true;
    }
}