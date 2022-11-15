<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật dịch vụ'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

$userId = isLogin()['user_id'];

//Lấy dữ liệu cũ của nhóm người dùng
$body = getBody('get');
if(!empty($body['id'])) {
    $serviceId = $body['id'];
    //Kiểm tra groupId có tồn tại trong db hay không
    //Nếu tồn tại => lấy ra thông tin
    //Không tồn tại => chuyển hướng về trang list
    $serviceDetail = firstRaw("SELECT * FROM services WHERE id = $serviceId");
    if(!empty($serviceDetail)) {
        setFlashData('serviceDetail', $serviceDetail);
    } else {
        redirect('admin?module=services');
    }
} else {
    redirect('admin?module=services');
}

if(isPost()) {
    $body = getBody();

    $errors = [];

    //Validate tên dịch vụ: Bắt buộc nhập
    if(empty(trim($body['name']))) {
        $errors['name']['required'] = 'Tên dịch vụ bắt buộc phải nhập';
    }

    //Validate slug: Bắt buộc nhập
    if(empty(trim($body['slug']))) {
        $errors['slug']['required'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
    }

    //Validate icon: Bắt buộc nhập
    if(empty(trim($body['icon']))) {
        $errors['icon']['required'] = 'Icon bắt buộc phải nhập';
    }

    //Validate nội dung: Bắt buộc nhập
    if(empty(trim($body['content']))) {
        $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
    }

    if(empty($errors)) {
        $dataUpdate = [
            'name' => trim($body['name']),
            'slug' => trim($body['slug']),
            'icon' => trim($body['icon']),
            'description' => trim($body['description']),
            'content' => trim($body['content']),
            'update_at' => date('Y-m-d H:i:s')
        ];
        $condition = "id=$serviceId";
        $updatetStatus = update('services', $dataUpdate, $condition);
        if($updatetStatus) {
            setFlashData('msg', 'Cập nhật dịch vụ dùng thành công');
            setFlashData('msg_type', 'success');

        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');
        }
    } else {
        //Có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }
    redirect('admin?module=services&action=edit&id='.$serviceId); //Load lại trang thêm dịch vụ
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$serviceDetail = getFlashData('serviceDetail');
if(!empty($serviceDetail) && empty($old)) {
    $old = $serviceDetail;
}
?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php getMsg($msg, $msgType); ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Tên dịch vụ</label>
                    <input type="text" class="form-control slug" name="name" placeholder="Tên dịch vụ..." value="<?php echo old('name', $old); ?>">
                    <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn tĩnh</label>
                    <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..." value="<?php echo old('slug', $old); ?>">
                    <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
                    <p class="render-link"><b>Link</b>:  <span></span></p>
                </div>
                <div class="form-group">
                    <label for="">Icon</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="icon" placeholder="Đường dẫn ảnh hoặc mã icon..." value="<?php echo old('icon', $old); ?>">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                        </div>
                    </div>
                    <?php echo form_error('icon', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Mô tả ngắn</label>
                    <textarea name="description" class="form-control" placeholder="Mô tả ngắn..."><?php echo old('description', $old); ?></textarea>
                    <?php echo form_error('description', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea name="content" class="form-control editor"><?php echo old('content', $old); ?></textarea>
                    <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="<?php echo getLinkAdmin('services'); ?>" class="btn btn-success">Quay lại</a>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);