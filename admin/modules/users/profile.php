<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật thông tin cá nhân'
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
$userDetail = getUserInfo($userId);

setFlashData('userDetail', $userDetail);

//Xử lý cập nhật thông tin cá nhân

if(isPost()) {

        $body =getBody();

        $errors = [];

        //Validate fullname: bắt buộc phải nhập, >= 5 kí tự
        if(empty(trim($body['fullname']))) {
            $errors['fullname']['required'] = 'Họ và tên bắt buộc phải nhập';
        } else {
            if(strlen(trim($body['fullname'])) < 5) {
                $errors['fullname']['min'] = 'Họ và tên >= 5 kí tự';
            }
        }

        //Validate email: bắt buộc phải nhập, email không hợp lệ, kiểm tra email tồn tại
        if(empty(trim($body['email']))) {
            $errors['email']['required'] = 'Email bắt buộc phải nhập';
        } else {
            if(!isEmail(trim($body['email']))) {
                $errors['email']['isEmail'] = 'Email không hợp lệ';
            } else {
                $email = trim($body['email']);
                $sql = "SELECT id FROM users WHERE email ='$email' AND id<>$userId";
                if(getRows($sql) > 0) {
                    $errors['email']['unique'] = 'Địa chỉ email đã tồn tại';
                }
            }
        }

        //Kiểm tra mảng $errors
        if(empty($errors)) {
            //Không có lỗi xảy ra

            $dataUpdate = [
                'fullname' => $body['fullname'],
                'email' => $body['email'],
                'contact_facebook' => $body['contact_facebook'],
                'contact_twitter' => $body['contact_twitter'],
                'contact_linkedin' =>$body['contact_linkedin'],
                'contact_pinterest' => $body['contact_pinterest'],
                'about_content' => $body['about_content'],
                'update_at' => date('Y-m-d H:i:s')
            ];

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

        redirect('admin?module=users&action=profile'); //Chuyển hướng đến trang hiện tại
}


//Gán lưu lại thông báo lỗi session
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

$userDetail = getFlashData('userDetail');
if(!empty($userDetail) && empty($old)) {
    $old = $userDetail;
}
?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php
            getMsg($msg, $msgType);
            ?>
            <form action="" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Họ và tên..." value="<?php echo old('fullname', $old); ?>" >
                            <?php echo form_error('fullname', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email..." value="<?php echo old('email', $old); ?>" >
                            <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="contact_facebook">Facebook</label>
                            <input type="text" class="form-control" name="contact_facebook" id="contact_facebook" placeholder="Facebook..." value="<?php echo old('contact_facebook', $old); ?>" >
                            <?php echo form_error('contact_facebook', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="contact_twitter">Twitter</label>
                            <input type="text" class="form-control" name="contact_twitter" id="contact_twitter" placeholder="Twitter..." value="<?php echo old('contact_twitter', $old); ?>" >
                            <?php echo form_error('contact_twitter', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="contact_linkedin">LinkedIn</label>
                            <input type="text" class="form-control" name="contact_linkedin" id="contact_linkedin" placeholder="LinkedIn..." value="<?php echo old('contact_linkedin', $old); ?>" >
                            <?php echo form_error('contact_linkedin', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="contact_pinterest">Pinterest</label>
                            <input type="text" class="form-control" name="contact_pinterest" id="contact_pinterest" placeholder="Pinterest..." value="<?php echo old('contact_pinterest', $old); ?>" >
                            <?php echo form_error('contact_pinterest', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="about_content">Nội dung giới thiệu</label>
                            <textarea class="form-control" name="about_content" id="about_content"><?php echo old('about_content', $old); ?></textarea>
                            <?php echo form_error('about_content', $errors, '<span class="error">', '</span>'); ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);