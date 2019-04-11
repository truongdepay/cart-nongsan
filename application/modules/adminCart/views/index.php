<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 4/7/2019
 * Time: 2:26 AM
 */
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3><?= $siteTitle ?></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="bg-inverse text-white">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Người đặt
                        </th>
                        <th>
                            Chi tiêt
                        </th>
                        <th>
                            Ngày đặt
                        </th>
                        <th>
                            Hành động
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $value) { ?>
                        <tr>
                            <td>
                                <?= $value->id ?>
                            </td>
                            <td>
                                <?= $value->name ?>
                            </td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?= $value->id ?>">Chi tiết</button>
                            </td>
                            <td>
                                <?= date('d/m/Y  H:s:i', $value->date_order) ?>
                            </td>
                            <td>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="success-<?= $value->id ?>" name="status-<?= $value->id ?>" class="custom-control-input">
                                    <label class="custom-control-label" for="success-<?= $value->id ?>">Đã giao</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="cancel-<?= $value->id ?>" name="status-<?= $value->id ?>" class="custom-control-input">
                                    <label class="custom-control-label" for="cancel-<?= $value->id ?>">Đã hủy</label>
                                </div>
                            </td>
                        </tr>

                        <!--Modal chi tiet-->
                        <?php $content = json_decode($value->content); ?>
                        <div id="myModal-<?= $value->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-danger" id="myModalLabel">Tổng tiền: <?= number_format($content->total_money) ?>đ</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <?php for($i = 0; $i < count($content->info); $i++) { ?>
                                                    <h3 class="text-success"><?= $content->info[$i]->title ?></h3>
                                                    <h6>Số lượng(<?= $content->info[$i]->count ?>) x giá(<?= number_format($content->info[$i]->price) ?> đ): <?= number_format($content->info[$i]->count * $content->info[$i]->price) ?> đ</h6>
                                                    <hr>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5>Họ tên: <?= $value->name ?></h5>
                                                <h5>Điện thoại: <?= $value->phone ?></h5>
                                                <h5>Email: <?= $value->email ?></h5>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <h4>Địa chỉ nhận hàng: <span class="text-primary"><?= $value->address ?></span></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
