<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 12/26/2018
 * Time: 3:16 PM
 */
$config['notifyError'] = [
    'title' => '** Tiêu đề không hợp lệ (tiêu đề phải có lớn hơn 1 ký tự)!',
    'desc' => '** Mô tả không hợp lệ (mô tả phải có lớn hơn 1 ký tự)!',
    'slugs' => '** Slugs không hợp lệ!',
    'dupSlugs' => '** Slugs này đã được sử dụng, vui lòng sửa lại cho hợp lệ',
    'uploadImages' => '** Vui lòng up ảnh nhỏ hơn 5MB',
    'fullname' => '** Tên không hợp lệ!',
    'username' => '** Username không hợp lệ! Username bao gồm: chữ thường, chữ hoa, chữ số, dấu "_" và "-" !',
    'dupUsername' => '** Username này đã được sử dụng',
    'password' => '** Password không hợp lệ! password bao gồm: chữ thường, chữ hoa, chữ số, các ký tự sau: "!@#$%^&". password có độ dài từ 6 đến 56 ký tự',
    'passwordCf' => '** Password confirm phải giống password',
    'token' => '** Token không hợp lệ!',
    'loginFail' => '** Sai thông tin đăng nhập, vui lòng thử lại'
];

$config['notifyCommon'] = [
    'add' => 'Thêm thành công',
    'edit' => 'Sửa thành công',
    'delete' => 'Xóa thành công',
    'notNull' => 'Không được để trống',
    'fromTo' => 'Ngày trước phải nhỏ hơn ngày sau'
];