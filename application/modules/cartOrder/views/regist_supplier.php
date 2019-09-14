<div class="row justify-content-center mb-5">
    <div class="col-xl-8 col-lg-10">
        <h3 class="mb-5">Đăng ký trở thành nhà cung cấp.</h3>
        <?= form_open() ?>
        <div class="row">
            <div class="col-lg-6 box-product-order mb-0">
                <div class="card bg-white">
                    <div class="card-header">
                        <h4>1. Ngành hàng hoăc sản phẩm cần chào bán <span class="text-danger">(*)</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="product" placeholder="">
                            <?= form_error('product', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                
                    <div class="card-header">
                        <h4>2. Tên người đại diện hoặc đơn vị <span class="text-danger">(*)</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="fullname" placeholder="">
                            <?= form_error('fullname', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                
                    <div class="card-header">
                        <h4>3. Số điện thoại liên hệ <span class="text-danger">(*)</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="">
                            <?= form_error('phone', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 box-product-order">
                <div class="card bg-white">
                    <div class="card-header">
                        <h4>4. Địa chỉ <span class="text-danger">(*)</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="">
                            <?= form_error('address', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>

                    <div class="card-header">
                        <h4>5. Số lượng cần bán (<span class="small">vd: 100 kg, 100 gói, ...</span>) <span class="text-danger">(*)</span></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="mount" placeholder="">
                            <?= form_error('mount', '<p class="text-danger mb-0">', '</p>') ?>
                        </div>
                    </div>
                    <div class="card-header">
                        <h4>6. Mùa vụ sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="time" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <input type="submit" value="Đăng ký" class="btn btn-success btn-block">
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>