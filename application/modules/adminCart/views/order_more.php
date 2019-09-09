<?php
/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 4/7/2019
 * Time: 2:26 AM
 */
?>
<h3>Công cụ</h3>
<form action="<?= base_url('adminCart/index/ordermore') ?>" method="get">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm theo số điện thoại" name="phone" value="<?= empty($this->input->get('phone')) ? '' : $this->input->get('phone') ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <input type="submit" value="Tìm" class="btn btn-info">
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="overflow-x: auto">
            <div class="card-header" >
                <h3><?= $siteTitle ?></h3>
            </div>
            <div class="ml-4 mt-3">
                <?php if (empty($this->input->get('phone'))) { ?>
                    <?php if ($next > 1) { ?>
                        <a href="<?= site_url('adminCart/index/ordermore?page=0') ?>" class="btn btn-success"><< Về trang đầu tiên</a>
                        <a href="<?= site_url('adminCart/index/ordermore?page=' . $prev) ?>" class="btn btn-success">< Prev</a>
                    <?php } ?>
                    <a href="<?= site_url('adminCart/index/ordermore?page=' . $next) ?>" class="btn btn-success">Next ></a>
                <?php }else{
                    $phone = empty($this->input->get('phone')) ? '' : $this->input->get('phone');
                    if ($next > 1) { ?>
                        <a href="<?= site_url('adminCart/index/ordermore?phone='.$phone.'&page=0') ?>" class="btn btn-success"><< Về trang đầu tiên</a>
                        <a href="<?= site_url('adminCart/index/ordermore?phone='.$phone.'&page=' . $prev) ?>" class="btn btn-success">< Prev</a>
                    <?php } ?>
                    <a href="<?= site_url('adminCart/index/ordermore?phone='.$phone.'&page=' . $next) ?>" class="btn btn-success">Next ></a>
                <?php } ?>
            </div>
            <div class="card-body" >
                <table class="table" style="min-width: 700px">
                    <thead class="bg-inverse text-white">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Người đặt
                        </th>
                        <th>
                            Sđt
                        </th>
                        <th>
                            Chi tiêt
                        </th>
                        <th>
                            Ngày đặt
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $value) { ?>
                        <tr class="<?= ($value->status == 0)?'bg-light-danger' : '' ?>" id="trow-<?= $value->id ?>" >
                            <td>
                                <?= $value->id ?>
                            </td>
                            <td>
                                <?= $value->fullname ?>
                            </td>
                            <td>
                                <?= $value->phone ?>
                            </td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?= $value->id ?>" <?= ($value->status == 0)?'onclick="updateStatus(this, ' . $value->id . ', 1)"' : '' ?> uri="<?= base_url(); ?>">Chi tiết</button>
                            </td>
                            <td>
                                <?= date('d-m-Y H:i:s', $value->date_create) ?>
                            </td>
                        </tr>
                        
                        <!--Modal chi tiet-->
                        <div id="myModal-<?= $value->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5>Họ tên: <?= $value->fullname ?></h5>
                                                <h5>Điện thoại: <?= $value->phone ?></h5>
                                                <h5>Email: <?= $value->email ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="text-danger">Sản phẩm: <?= $value->post_title ?></h5>
                                                <h5>Công ty/ đơn vị: <?= $value->company ?></h5>
                                                <h5>Số lượng: <?= $value->amount ?></h5>
                                                <h5>Giá mong muốn: <?= is_numeric($value->desired_price)?number_format($value->desired_price):'' ?> Vnd</h5>
                                                <h5>Ngày cần có hàng: <?= $value->date_want ?></h5>
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
            <div class="ml-4 mb-3">
                <?php if (empty($this->input->get('phone'))) { ?>
                    <?php if ($next > 1) { ?>
                        <a href="<?= site_url('adminCart/index/ordermore?page=0') ?>" class="btn btn-success"><< Về trang đầu tiên</a>
                        <a href="<?= site_url('adminCart/index/ordermore?page=' . $prev) ?>" class="btn btn-success">< Prev</a>
                    <?php } ?>
                    <a href="<?= site_url('adminCart/index/ordermore?page=' . $next) ?>" class="btn btn-success">Next ></a>
                <?php }else{
                    $phone = empty($this->input->get('phone')) ? '' : $this->input->get('phone');
                    if ($next > 1) { ?>
                        <a href="<?= site_url('adminCart/index/ordermore?phone='.$phone.'&page=0') ?>" class="btn btn-success"><< Về trang đầu tiên</a>
                        <a href="<?= site_url('adminCart/index/ordermore?phone='.$phone.'&page=' . $prev) ?>" class="btn btn-success">< Prev</a>
                    <?php } ?>
                    <a href="<?= site_url('adminCart/index/index?ordermore='.$phone.'&page=' . $next) ?>" class="btn btn-success">Next ></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    
    function updateStatus(elm, id, status)
    {
        var url = $(elm).attr('uri') + 'adminCart/index/updateStatusOrderMore';
        var data = { id : id, status : status};
        var idRow = "#trow-" + id;
        var classRow = $(idRow).attr("class");
        $.ajax({
            url : url,
            type : 'get',
            data : data,
            dataType : 'json',
            success  : function (result) {
                if (result.result == 1) {
                    if (result.detail.status != 0) {
                        $(idRow).removeClass(classRow);
                        $(elm).attr("onclick", "");
                    }
                }
            }
        });
    }
</script>