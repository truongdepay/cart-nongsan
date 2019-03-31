<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 12/25/2018
 * Time: 11:10 PM
 */
?>
<?php
if ($this->session->userdata('success')) {
    ?>

    <!-- Modal -->
    <div class="modal fade" id="modalNotify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn làm thêm một bài nữa không?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button onclick="window.open('<?= site_url('managerProduct/index/index?action=create'); ?>', '_parent')" type="button" class="btn btn-secondary" data-dismiss="modal">Tiếp</button>
                    <button onclick="window.open('<?= site_url('managerProduct/index/index?action=manager'); ?>', '_parent')" type="button" class="btn btn-primary">Thôi khỏi</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#modalNotify").modal('show');
    </script>
    <?php
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3><?= $siteTitle ?></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th></th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">##</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $key => $value) { ?>
                        <tr>
                            <th scope="row"><?= $value->id; ?></th>
                            <th><img src="<?= base_url($value->thumb); ?>" alt="" width="64px"></th>
                            <td><?= $value->title; ?></td>
                            <td><?= convertStatus($value->status); ?></td>
                            <td><?= $value->cat_title; ?></td>
                            <td>
                                <button onclick="window.open('<?= site_url('managerProduct/index/index?action=edit&id=' . $value->id); ?>', '_parent');" class="btn btn-success"><i class="far fa-edit"></i></button>
                                <button onclick="window.open('<?= site_url('managerProduct/index/index?action=delete&id=' . $value->id); ?>', '_parent')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                <button data-toggle="modal" data-target="#exampleModalLong-<?= $value->id ?>" class="btn btn-default"><i class="fas fa-info-circle"></i></button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalLong-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Thông tin thêm</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Giá: <span class="font-weight-bold"><?= number_format($value->price); ?><span class="text-danger"> VND</span></span></li>
                                            <li class="list-group-item">Ngày đăng: <?= date('d/m/Y', $value->date_create); ?></li>
                                            <li class="list-group-item">Người đăng: <?= $value->author; ?></li>
                                            <li class="list-group-item">Ngày sửa cuối: <?= date('d/m/Y', $value->date_modify); ?></li>
                                            <li class="list-group-item">Người sửa cuối: <?= $value->author_modify; ?></li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

