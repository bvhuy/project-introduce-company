<?php
if (!defined('_INCODE')) die('Access Deined...');
//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}
$checkRoleEdit = checkCurrentPermission('edit');
if($checkRoleEdit) {

//Lấy dữ liệu cũ của danh mục dự án
$body = getBody('get');
if(!empty($body['id'])) {
    $portfolioCategoryId = $body['id'];
    //Kiểm tra $cateId có tồn tại trong db hay không
    //Nếu tồn tại => lấy ra thông tin
    //Không tồn tại => chuyển hướng về trang list
    $portfolioCategoryDetail = firstRaw("SELECT * FROM portfolio_categories WHERE id = $portfolioCategoryId");
    if(!empty($portfolioCategoryDetail)) {
        setFlashData('portfolioCategoryDetail', $portfolioCategoryDetail);
    } else {
        redirect('admin?module=portfolio_categories');
    }
} else {
    redirect('admin?module=portfolio_categories');
}

if(isPost()) {
    $body = getBody();
    $errors = [];
    if(empty(trim($body['name']))) {
        $errors['name']['required'] = 'Tên danh mục bắt buộc phải nhập';
    } else {
        if(strlen(trim($body['name'])) < 4) {
            $errors['name']['min'] = 'Tên danh mục >=4 ký tự';
        }
    }

    if(empty($errors)) {
        $dataUpdate = [
            'name' => trim($body['name']),
            'update_at' => date('Y-m-d H:i:s')
        ];
        $condition = "id=$portfolioCategoryId";
        $updatetStatus = update('portfolio_categories', $dataUpdate, $condition);
        if($updatetStatus) {
            setFlashData('msg', 'Cập nhật danh mục dự án thành công');
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
    redirect('admin?module=portfolio_categories&action=lists&view=edit&id='.$portfolioCategoryId); //Load lại trang thêm người dùng
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$portfolioCategoryDetail = getFlashData('portfolioCategoryDetail');
if(!empty($portfolioCategoryDetail) && empty($old)) {
    $old = $portfolioCategoryDetail;
}
?>
<h4>Cập nhật danh mục</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="name">Tên danh mục</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Tên danh mục..." value="<?php echo old('name', $old); ?>">
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="<?php echo getLinkAdmin('portfolio_categories'); ?>" class="btn btn-success">Quay lại</a>
</form>
<?php
}