<?php
if(!defined('_INCODE')) die('Access Deined...');

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

$checkRoleAdd = checkCurrentPermission('add');
if($checkRoleAdd) {

$userId = isLogin()['user_id'];
if(isPost()) {
    $body = getBody();
    $errors = [];
    if(empty(trim($body['name']))) {
        $errors['name']['required'] = 'Tên danh mục dự án bắt buộc phải nhập';
    } else {
        if(strlen(trim($body['name'])) < 4) {
            $errors['name']['min'] = 'Tên danh mục dự án >=4 ký tự';
        }
    }

    if(empty($errors)) {
        $dataInsert = [
            'name' => trim($body['name']),
            'user_id' => $userId,
            'create_at' => date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('portfolio_categories', $dataInsert);
        if($insertStatus) {
            setFlashData('msg', 'Thêm danh mục dự án thành công');
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
    redirect('admin?module=portfolio_categories'); //Load lại trang danh mục dự án
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>
<h4>Thêm danh mục</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="name">Tên danh mục</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Tên danh mục..." value="<?php echo old('name', $old); ?>">
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
    </div>
    <button type="submit" class="btn btn-primary">Thêm mới</button>
</form>
<?php
}