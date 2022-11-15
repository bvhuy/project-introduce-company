<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật trang'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

//Lấy dữ liệu cũ của trang
$body = getBody('get');
if(!empty($body['id'])) {
    $subscribeId = $body['id'];
    //Kiểm tra $subscribeId có tồn tại trong db hay không
    //Nếu tồn tại => lấy ra thông tin
    //Không tồn tại => chuyển hướng về trang list
    $subscribeDetail = firstRaw("SELECT * FROM subscribe WHERE id = $subscribeId");
    if(!empty($subscribeDetail)) {
        setFlashData('subscribeDetail', $subscribeDetail);
    } else {
        redirect('admin?module=subscribe');
    }
} else {
    redirect('admin?module=subscribe');
}

if(isPost()) {
    $body = getBody();

    $errors = [];
    if(empty(trim($body['email']))) {
        $errors['email']['required'] = 'Email bắt buộc phải nhập';
    } else {
        if (!isEmail(trim($body['email']))) {
            $errors['email']['isEmail'] = 'Email không hợp lệ';
        }
    }

    if(empty($errors)) {

        $allowedStatus = [0,1,2];
        if(isset($body['status']) && in_array(trim($body['status']), $allowedStatus)) {

            $dataUpdate = [
                'email' => trim(strip_tags($body['email'])),
                'status' => trim(strip_tags($body['status'])),
                'update_at' => date('Y-m-d H:i:s')
            ];
            $condition = "id=$subscribeId";
            $updatetStatus = update('subscribe', $dataUpdate, $condition);

            if($updatetStatus) {
                setFlashData('msg', 'Cập nhật đăng ký thành công');
                setFlashData('msg_type', 'success');

            } else {
                setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
                setFlashData('msg_type', 'danger');
            }
        }else {
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
    redirect('admin?module=subscribe&action=edit&id='.$subscribeId); //Load lại trang hiện tại
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$subscribeDetail = getFlashData('subscribeDetail');
if(!empty($subscribeDetail) && empty($old)) {
    $old = $subscribeDetail;
}
?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php getMsg($msg, $msgType); ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email..." value="<?php echo old('email', $old); ?>">
                    <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select name="status" id="status" class="form-control">
                        <option value="0" <?php echo (old('status', $old) == 0) ? 'selected' : false; ?>>Chưa xử lý</option>
                        <option value="1" <?php echo (old('status', $old) == 1) ? 'selected' : false; ?>>Đang xử lý</option>
                        <option value="2" <?php echo (old('status', $old) == 2) ? 'selected' : false; ?>>Đã xử lý</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="<?php echo getLinkAdmin('subscribe'); ?>" class="btn btn-success">Quay lại</a>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);