<?php
if(!defined('_INCODE')) die('Access Deined...');

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}
$checkRoleAdd = checkCurrentPermission('add');
if($checkRoleAdd) {

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
        $dataInsert = [
            'name' => trim($body['name']),
            'create_at' => date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('contact_type', $dataInsert);
        if($insertStatus) {
            setFlashData('msg', 'Thêm phòng ban thành công');
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
    redirect('admin?module=contact_type'); //Load lại trang phòng ban
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>
<h4>Thêm phòng ban</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="name">Tên phòng ban</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Tên phòng ban..." value="<?php echo old('name', $old); ?>" autofocus>
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
    </div>
    <button type="submit" class="btn btn-primary">Thêm mới</button>
</form>
<?php
}