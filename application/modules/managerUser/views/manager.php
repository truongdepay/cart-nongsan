<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 1/31/2019
 * Time: 4:49 PM
 */
?>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4>Thay đổi thông tin user</h4>
            </div>
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Fullname</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname">
                    </div>
                    <button type="button" class="btn btn-primary" id="submit">Lưu thông tin</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4>Thay đổi mật khẩu</h4>
            </div>
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password hiện tại</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password mới</label>
                        <input type="password" class="form-control" id="" name="new_pass" placeholder="Password mới">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nhập lại Password</label>
                        <input type="password" class="form-control" id="" name="confirm_pass" placeholder="Nhập lại Password">
                    </div>
                    <button type="button" class="btn btn-primary" id="submit">Lưu thông tin</button>
                </form>
            </div>
        </div>
    </div>
</div>