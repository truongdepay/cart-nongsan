<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: Zenn
 * @Date:   2018-04-25 00:44:08
 * @Last Modified by:   Ngoc Truong
 * @Last Modified time: 2018-05-27 17:29:12
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/assets/images/favicon.png') ?>">
    <title><?= $siteTitle ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i' rel='stylesheet' type='text/css'>
    <link href="<?= base_url('assets/assets/extra-libs/c3/c3.min.css'); ?>" rel="stylesheet"/>

    <link href="<?= base_url('assets/assets/extra-libs/prism/prism.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/fontawesome/css/all.css')?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/libs/pickadate/lib/themes/default.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/libs/pickadate/lib/themes/default.date.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/libs/pickadate/lib/themes/default.time.css') ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="<?= base_url('assets/dist/css/style.min.css'); ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/css/styles.css')?>" rel="stylesheet" type="text/css">

    <script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?= base_url('assets/assets/libs/popper.js/dist/umd/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/app.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/app.init.horizontal.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/app-style-switcher.horizontal.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/extra-libs/sparkline/sparkline.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/waves.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/sidebarmenu.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/custom.min.js') ?>"></script>
    <script src="<?= base_url('assets/assets/extra-libs/prism/prism.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/pickadate/lib/compressed/picker.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/pickadate/lib/compressed/picker.date.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/pickadate/lib/compressed/picker.time.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/pickadate/lib/compressed/legacy.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/moment/moment.js') ?>"></script>
    <script src="<?= base_url('assets/assets/libs/daterangepicker/daterangepicker.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/pages/forms/datetimepicker/datetimepicker.init.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js'); ?>"></script>

</head>
<body class="bg-light">
<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                    <i class="ti-menu ti-close"></i>
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
        </nav>
    </header>
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <!-- User Profile-->
                    <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Personal</span></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-Car-Wheel"></i><span class="hide-menu">Quản lý </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="index.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu">Đơn mua lẻ</span></a></li>
                            <li class="sidebar-item"><a href="index.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu">Đơn mua sỉ</span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-Car-Wheel"></i><span class="hide-menu">Cài đặt </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="index.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Cài đặt chung </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-Car-Wheel"></i><span class="hide-menu">Tài khoản</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="index.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Chỉnh sửa </span></a></li>
                            <li class="sidebar-item"><a href="index.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Đăng xuất </span></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <div class="page-wrapper" style="">
        <div class="container-fluid">


