<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 1/30/2019
 * Time: 10:59 AM
 */
?>
<div class="row justify-content-md-center mt-5">
    <div class="col col-lg-5 col-sm-12 col-md-12">
        <?= form_open('managerUser/index/index?action=create'); ?>
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" placeholder="Enter username" name="fullname">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <label for="Password_cf">Password Confirm</label>
                <input type="password" class="form-control" id="Password_cf" placeholder="Password Confirm" name="password_cf">
            </div>
            <div class="form-group">
                <label for="token">Token</label>
                <input type="text" class="form-control" id="token" placeholder="Enter token" name="token">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <?= form_close(); ?>
    </div>
</div>

