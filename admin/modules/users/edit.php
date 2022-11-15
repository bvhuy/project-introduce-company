<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Sửa người dùng'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

//Lấy dữ liệu cũ của người dùng
$body = getBody('get');
if(!empty($body['id'])) {
    $userId = $body['id'];
    //Kiểm tra userId có tồn tại trong database hay không
    //Nếu tồn tại => lấy ra thông tin
    //Nếu không tồn tại => chuyển hướng về trang lists
    $userDetail = firstRaw("SELECT * FROM users WHERE id = $userId");
    if(!empty($userDetail)) {
        //Tồn tại
        //Gán giá trị $userDetail vào flashData
        setFlashData('userDetail', $userDetail);
    } else {
        redirect('admin?module=users');
    }
} else {
    redirect('admin?module=users');
}

if(isPost()) {
    $body = getBody();
    $errors = [];
    if(empty(trim($body['fullname']))) {
        $errors['fullname']['required'] = 'Họ tên bắt buộc phải nhập';
    } else {
        if(strlen(trim($body['fullname'])) < 5) {
            $errors['fullname']['min'] = 'Họ tên >=5 ký tự';
        }
    }

    if(empty(trim($body['email']))) {
        $errors['email']['required'] = 'Email bắt buộc phải nhập';
    } else {
        if(!isEmail(trim($body['email']))) {
            $errors['email']['isEmail'] = 'Email không hợp lệ';
        } else {
            $email = trim($body['email']);
            $sql = "SELECT id FROM users WHERE email='$email' AND id<>$userId";
            if(getRows($sql) > 0) {
                $errors['email']['unique'] = 'Địa chỉ email đã tồn tại';
            }
        }
    }

    if(!empty(trim($body['password']))) {
        //Chỉ validate confirm_password nếu password được nhập
        //Validate nhập lại mật khẩu: Bắt buộc phải nhập, phải giống trường mật khẩu
        if(empty(trim($body['confirm_password']))) {
            $errors['confirm_password']['required'] = 'Xác nhận mật khẩu không được dể trống';
        } else {
            if(trim($body['password']) != trim($body['confirm_password'])) {
                $errors['confirm_password']['match'] = 'Hai mật khẩu không khớp nhau';
            }
        }
    }

    if(empty(trim($body['group_id']))) {
        $errors['group_id']['required'] = 'Vui lòng chọn nhóm người dùng';
    }

    if(empty($errors)) {
        $dataUpdate = [
            'fullname' => trim($body['fullname']),
            'email' => trim($body['email']),
            'group_id' => trim($body['group_id']),
            'status' => trim($body['status']),
            'update_at' => date('Y-m-d H:i:s')

        ];

        if(!empty(trim($body['password']))) {
            $dataUpdate['password'] = password_hash($body['password'], PASSWORD_DEFAULT);
        }

        $condition = "id=$userId";
        $updateStatus = update('users', $dataUpdate, $condition);
        if($updateStatus) {
            setFlashData('msg', 'Cập nhật người dùng thành công');
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
    redirect('admin?module=users&action=edit&id='.$userId); //Chuyển hướng đến trang hiện tại
}

//Truy vấn lấy danh sách nhóm
$allGroups = getRaw("SELECT id, name FROM `groups` ORDER BY name ASC");

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$userDetail =getFlashData('userDetail');
if(!empty($userDetail) && empty($old)) {
    $old = $userDetail;
}
?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php getMsg($msg, $msgType); ?>
            <form action="" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fullname">Họ tên</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ tên..." value="<?php echo old('fullname', $old); ?>">
                            <?php echo form_error('fullname', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email..." value="<?php echo old('email', $old); ?>">
                            <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu...">
                            <?php echo form_error('password', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="confirm_password">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu...">
                            <?php echo form_error('confirm_password', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="group_id">Nhóm người dùng</label>
                        <select name="group_id" id="group_id" class="form-control">
                            <option value="0">Chọn nhóm</option>
                            <?php
                            if(!empty($allGroups)):
                                foreach ($allGroups as $item):
                                    $selected = (old('group_id', $old) == $item['id']) ? 'selected': false;
                                    echo '<option value="'.$item['id'].'" '.$selected.'>'.$item['name'].'</option>';
                                endforeach;
                            endif;
                            ?>
                        </select>
                        <?php echo form_error('group_id', $errors, '<span class="error">', '</span>'); ?>
                    </div>
                    <div class="col-6">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" <?php echo (old('status', $old) == 0) ? 'selected' : false; ?>>Chưa kích hoạt</option>
                            <option value="1" <?php echo (old('status', $old) == 1) ? 'selected' : false; ?>>Kích hoạt</option>
                        </select>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="<?php echo getLinkAdmin('users'); ?>" class="btn btn-success">Quay lại</a>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);