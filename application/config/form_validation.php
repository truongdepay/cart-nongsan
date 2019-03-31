<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 3/25/2019
 * Time: 1:42 PM
 */

$config['form_validation'] = [
    'username' => [
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'required|alpha_numeric|max_length[32]|min_length[3]|is_unique[user.username]'
    ],
    'fullname' => [
        'field' => 'fullname',
        'label' => 'Name',
        'rules' => 'required|min_length[3]|max_length[32]'
    ],
    'password' => [
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required|min_length[6]|max_length[32]'
    ],
    'cf_password' => [
        'field' => 'cf_password',
        'label' => 'Confirm Password',
        'rules' => 'required|min_length[6]|max_length[32]|matches[password]'
    ],
    'email' => [
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email|is_unique[user.email]'
    ]
];