<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Zenn
 * Date: 12/24/2018
 * Time: 11:37 PM
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
                        <button onclick="window.open('<?= site_url('managerPost/index/index?action=create'); ?>', '_parent')" type="button" class="btn btn-secondary" data-dismiss="modal">Tiếp</button>
                        <button onclick="window.open('<?= site_url('managerPost/index/index?action=manager'); ?>', '_parent')" type="button" class="btn btn-primary">Thôi khỏi</button>
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
                <h4><?= $siteTitle ?></h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->userdata('edit')) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        Sửa thành công bài viết có ID: <?= $this->session->userdata('edit'); ?>
                    </div>
                    <?php
                }
                ?>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="btn-group right" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-success m-r-xs" id="delete-more" onclick="window.location.href = '<?= site_url('managerPost/index/index?action=create') ?>'">Thêm mới bài viết</button>
                            <button type="button" class="btn btn-danger" id="delete-more" onclick="deleteData();">Xóa những bài đã chọn</button>
                            <button type="button" class="btn btn-light rounded-0" id="public-more" onclick="publicData();"><i class="far fa-eye"></i> Công khai</button>
                            <button type="button" class="btn btn-light rounded-0" id="public-more" onclick="draftData();"><i class="far fa-eye-slash"></i> Lưu nháp</button>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Chọn</th>
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
                            <td><div class="form-check form-check-inline">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2-<?= $value->id; ?>" value="<?= $value->id; ?>" onclick="selectRow(this);">
                                        <label class="custom-control-label" for="customCheck2-<?= $value->id; ?>"></label>
                                    </div>
                                </div>
                            <th scope="row"><?= $value->id; ?></th>
                            <th><img src="<?= base_url($value->thumb); ?>" alt="" width="64px"></th>
                            <td><?= $value->title; ?></td>
                            <td><?= convertStatus($value->status); ?></td>
                            <td><?= $value->cat_title; ?></td>
                            <td>
                                <button onclick="window.open('<?= site_url('managerPost/index/index?action=edit&id=' . $value->id); ?>', '_parent');" class="btn btn-success "><i class="far fa-edit"></i></button>
                                <button data-toggle="modal" data-target="#deleteModal-<?= $value->id ?>" class="btn btn-danger "><i class="far fa-trash-alt"></i></button>
                                <button data-toggle="modal" data-target="#exampleModalLong-<?= $value->id ?>" class="btn btn-default "><i class="fas fa-info-circle"></i></button>
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
                        <!--                Delete Modal-->
                        <div class="modal fade" id="deleteModal-<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Xác nhận xóa bài viết sau</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-danger"><?= $value->title; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.open('<?= site_url('managerPost/index/index?action=delete&id=' . $value->id); ?>', '_parent')">Xóa</button>
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
<input type="hidden" id="select-row" value="{}">
<script>
    function selectRow(elm)
    {
        var id = $(elm).val();
        var check = $(elm).prop("checked");
        var valSelect = $("#select-row").val();
        valSelect = JSON.parse(valSelect);

        if (check) {
            valSelect[id] = id;
            console.log(valSelect);

        } else {
            delete valSelect[id];
        }
        valSelect = JSON.stringify(valSelect);
        $("#select-row").val(valSelect);
    }

    function deleteData() {
        var dataSelect = $("#select-row").val();
        var url = window.location.origin + '/managerPost/index?action=delete&group_id=' + dataSelect;
        var confirm = window.confirm("Xác nhận xóa");
        if (confirm == true) {
            window.open(url, '_self');
        }
    }
</script>