<?php
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 3/21/2019
 * Time: 4:09 PM
 */
?>

<div class="container">
    <div class="row justify-content-lg-center justify-content-md-center">
        <div class="col-12 col-sm-12 col-md-8 col-lg-6">
            <div class="card border-0 rounded shadow">
                <div class="card-header">
                    <h3 class="text-danger">Điền thông tin đăng ký</h3>
                </div>
                <div class="card-body">
                    <?= form_open() ?>
                    <div class="form-group row ">
                        <div class="col-12 ">
                            <input class="form-control form-control-lg" type="text" placeholder="Name" name="fullname" value="<?= set_value('fullname') ?>">
                            <?= form_error('fullname', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 ">
                            <input class="form-control form-control-lg" type="text" placeholder="Username" name="username" value="<?= set_value('username') ?>">
                            <?= form_error('username', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 ">
                            <input class="form-control form-control-lg" type="email" placeholder="Email" name="email" value="<?= set_value('email') ?>">
                            <?= form_error('email', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 ">
                            <input class="form-control form-control-lg" type="password" placeholder="Password" name="password">
                            <?= form_error('password', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 ">
                            <input class="form-control form-control-lg" type="password" placeholder="Confirm Password" name="cf_password">
                            <?= form_error('cf_password', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                    <div class="form-group text-center ">
                        <div class="col-xs-12 p-b-20 ">
                            <button class="btn btn-block btn-lg btn-info " type="submit ">Đăng ký</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0 m-t-10 ">
                        <div class="col-sm-12 text-center ">
                            Nếu bạn đã có tài khoản? <a href="<?= site_url('managerUser') ?>" class="text-info m-l-5 "><b>Đăng nhập</b></a>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>