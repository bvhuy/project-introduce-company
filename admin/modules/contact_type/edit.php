<?php
if (!defined('_INCODE')) die('Access Deined...');
//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}
$checkRoleEdit = checkCurrentPermission('edit');
if($checkRoleEdit) {
//Lấy dữ liệu cũ của phòng ban bài viết
$body = getBody('get');
if(!empty($body['id'])) {
    $contactTypeId = $body['id'];
    //Kiểm tra $cateId có tồn tại trong db hay không
    //Nếu tồn tại => lấy ra thông tin
    //Không tồn tại => chuyển hướng về trang list
    $contactTypeDetail = firstRaw("SELECT * FROM contact_type WHERE id = $contactTypeId");
    if(!empty($contactTypeDetail)) {
        setFlashData('contactTypeDetail', $contactTypeDetail);
    } else {
        redirect('admin?module=contact_type');
    }
} else {
    redirect('admin?module=contact_type');
}

if(isPost()) {
    $body = getBody();
    $errors = [];
    if(empty(trim($body['name']))) {
        $errors['name']['required'] = 'Tên phòng ban bắt buộc phải nhập';
    } else {
        if(strlen(trim($body['name'])) < 4) {
            $errors['name']['min'] = 'Tên phòng ban >=4 ký tự';
        }
    }

    if(empty($errors)) {
        $dataUpdate = [
            'name' => trim($body['name']),
            'update_at' => date('Y-m-d H:i:s')
        ];
        $condition = "id=$contactTypeId";
        $updatetStatus = update('contact_type', $dataUpdate, $condition);
        if($updatetStatus) {
            setFlashData('msg', 'Cập nhật phòng ban bài viết thành công');
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
    redirect('admin?module=contact_type&action=lists&view=edit&id='.$contactTypeId); //Load lại trang thêm phòng ban
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$contactTypeDetail = getFlashData('contactTypeDetail');
if(!empty($contactTypeDetail) && empty($old)) {
    $old = $contactTypeDetail;
}
?>
<h4>Cập nhật phòng ban</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="name">Tên phòng ban</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Tên phòng ban..." value="<?php echo old('name', $old); ?>" autofocus>
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="<?php echo getLinkAdmin('contact_type'); ?>" class="btn btn-success">Quay lại</a>
</form>
<?php
}