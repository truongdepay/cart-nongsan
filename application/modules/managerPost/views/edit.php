<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 1/15/2019
 * Time: 2:59 PM
 */
?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><?= $siteTitle; ?></h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->userdata('error')) {
                    echo displayError($this->session->userdata('error'));
                }
                ?>
                <?= form_open_multipart('managerPost/index/index?action=edit&id=' . $id); ?>
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" class="form-control" id="title" placeholder="" name="title" url-data="/managerPost/index/createSlug?action=edit&id=<?= $item->id ?>" value="<?= keepData('dataPost', 'title', $item->title); ?>">
                </div>
                <div class="form-group">
                    <label for="title">Slugs</label>
                    <input type="text" class="form-control" id="slugs" placeholder="" name="slugs" url-data="/managerPost/index/createSlug?action=edit&id=<?= $item->id ?>" value="<?= keepData('dataPost', 'slugs', $item->slugs); ?>">
                    <span class="error-slugs text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="desc">Mô tả</label>
                    <textarea class="form-control" id="desc" rows="3" name="desc"><?= keepData('dataPost', 'desc', $item->desc); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea class="form-control" id="content" rows="3" name="content"><?= keepData('dataPost', 'content', $item->content); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="keywords">Từ khóa</label>
                    <input type="text" class="form-control" id="keywords" placeholder="" name="keywords" value="<?= keepData('dataPost', 'keywords', $item->keywords); ?>">
                </div>
                <div class="form-group">
                    <label for="keywords">Tags</label>
                    <input type="text" class="form-control" id="tags" placeholder="" name="tags" value="<?= keepData('dataPost', 'tags', $item->tags); ?>">
                </div>
                <div class="form-group">
                    <label for="category">Danh mục</label>
                    <select class="form-control" id="category" name="category">
                        <?php foreach ($listCat as $value) { ?>
                            <option value="<?= $value->id; ?>"><?= $value->title; ?></option>
                        <?php } ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="thumb">Ảnh</label>
                    <input type="file" class="" name="thumb" id="thumb" onchange="previewFile()">
                    <img src="<?= base_url($item->thumb); ?>" alt="" class="" id="thumb-preview" width="100px">
                </div>
                <div class="form-group">
                    <label for="status">Danh mục</label>
                    <select class="form-control" id="status" name="status" data-status="<?= $item->status; ?>">
                        <option value="0">Lưu nháp</option>
                        <option value="1">Công khai</option>
                    </select>
                </div>
                <input type="submit" name="save" id="save" class="btn btn-primary" value="Lưu">
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>


<script>
    function previewFile(){
        var preview = document.getElementById('thumb-preview'); //selects the query named img
        var file    = document.getElementById('thumb').files[0]; //sames as here
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        } else {
            preview.src = "";
        }
    }
    var editor = CKEDITOR.replace( 'content' );
    CKFinder.setupCKEditor(editor);
    autoSelect(<?= $item->category; ?>, '#category option');
    autoSelect(<?= $item->status; ?>, '#status option');

</script>