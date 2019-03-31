<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 1/22/2019
 * Time: 9:30 AM
 */
?>
<h3><?= $siteTitle ?></h3>
<?php
if ($this->session->userdata('error')) {
    echo displayError($this->session->userdata('error'));
}
?>
<?= form_open_multipart('managerCat/index/index?action=edit&id=' . $id); ?>
<div class="form-group">
    <label for="title">Tiêu đề danh mục</label>
    <input type="text" class="form-control" id="title" placeholder="" name="title" url-data="/managerCat/index/createSlug?action=edit&id=<?= $id; ?>" value="<?= keepData('dataCat','title', $item->title); ?>">
</div>
<div class="form-group">
    <label for="title">Slugs</label>
    <input type="text" class="form-control" id="slugs" placeholder="" name="slugs" url-data="/managerCat/index/createSlug?action=edit&id=<?= $id; ?>" value="<?= keepData('dataCat','slugs', $item->slugs); ?>">
    <span class="error-slugs text-danger"></span>
</div>
<div class="form-group">
    <label for="type">Kiểu</label>
    <select class="form-control" id="type" name="type" onchange="selectCategory(this);" uri="/managerCat/index/changeTypeCat?id=<?= $item->id; ?>">
        <option value="">Chọn kiểu</option>
        <option value="0">Post</option>
        <option value="1">Product</option>
    </select>
</div>
<div class="form-group">
    <label for="parent">Danh mục cha</label>
    <select class="form-control" id="parent" name="parent">
        <option value="">Mặc định là cha</option>
        <?php
            foreach ($listCat as $value) {
                ?>
                <option value="<?= $value->id; ?>"><?= $value->title; ?></option>
        <?php
            }
        ?>
    </select>
</div>

<div class="form-group">
    <label for="status">Trạng thái</label>
    <select class="form-control" id="status" name="status">
        <option value="">Chọn trạng thái</option>
        <option value="1">Công khai</option>
        <option value="0">Lưu nháp</option>
    </select>
</div>
<input type="submit" name="save" id="save" class="btn btn-primary" value="Lưu">
<?= form_close(); ?>

<script>
    autoSelect(<?= $item->type; ?>, '#type option');
    autoSelect(<?= $item->parent; ?>, '#parent option');
    autoSelect(<?= $item->status; ?>, '#status option');
</script>
