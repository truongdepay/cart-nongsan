<div class="row justify-content-center mb-5">
    <div class="col-xl-8 col-lg-10">
        <h5 style="text-align: center"><?= lang('title_lang') ?></h5>
        <div class="row">
            <div class="col-12">
                <div class="form-group" style="text-align: center;">
                    <a href="<?= site_url('cartOrder/orderMore/index?id='.$id.'&lang=vi') ?>" class="btn btn-danger">Tiếng việt</a>
                    <a href="<?= site_url('cartOrder/orderMore/index?id='.$id.'&lang=en') ?>" class="btn btn-danger">English</a>
                </div>
            </div>
            <div class="col-6"></div>
        </div>
        <div class="card-header bg-light">
            <h3><?= lang('title') ?></h3>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 col-sm-2 col-md-2 col-lg-2">
                        <img
                                src="<?= $thumb->guid ?>"
                                alt="" style="width: 100%;">
                    </div>
                    <div class="col-9 col-sm-6 col-md-6 col-lg-6">
                        <h5><?= $info->post_title ?></h5>
                        <h4 class="text-danger"><?= number_format($price) ?> VND</h4>
                    </div>
                </div>
            </div>
        </div>
        <?= form_open('cartOrder/orderMore/add?id='.$id.'&lang=' . $lang) ?>
        <input type="hidden" name="product" value="<?= $id ?>">
        <div class="row">
            <div class="col-lg-6 box-product-order mb-0">
                <div class="card bg-white">
                    <div class="card-header">
                        <h4>1. <?= lang('name') ?> <span class="text-danger">(*)</span></h4>
                    </div>
                    <div class="card-body">
                         <div class="form-group">
                             <input type="text" class="form-control" name="fullname" placeholder="<?= lang('name') ?>">
                             <?= form_error('fullname', '<p class="text-danger mb-0">', '</p>') ?>
                         </div>
                    </div>
                    
                    <div class="card-header">
                        <h4>2. <?= lang('phone') ?> <span class="text-danger">(*)</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="<?= lang('phone') ?>">
                            <?= form_error('phone', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>

                    <div class="card-header">
                        <h4>2-1. <?= lang('email') ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="<?= lang('email') ?>">
                            <?= form_error('email', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                    
                    <div class="card-header">
                        <h4>3. <?= lang('company') ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="company" placeholder="<?= lang('company') ?>">
                            <?= form_error('company', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                    
                    <div class="card-header">
                        <h4>4. <?= lang('address') ?> <span class="text-danger">(*)</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="<?= lang('address') ?>">
                            <?= form_error('address', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 box-product-order">
                <div class="card bg-white">
                    <div class="card-header">
                        <h4>5. <?= lang('amount') ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="amount" placeholder="<?= lang('amount') ?>">
                            <?= form_error('amount', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>

                    <div class="card-header">
                        <h4>6. <?= lang('desired_price') ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="desired_price" placeholder="<?= lang('desired_price') ?>">
                            <?= form_error('desired_price', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>

                    <div class="card-header">
                        <h4>7. <?= lang('date_want') ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="date_want" placeholder="<?= lang('date_want') ?>" id="date_want">
                            <?= form_error('date_want', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <input type="submit" value="Gửi order" class="btn btn-success btn-block">
            </div>
        </div>
    </div>
    <?= form_close() ?>
</div>
<script>
    $(function() {
        $( "#date_want" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>