<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật liên hệ'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);


//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

//Lấy dữ liệu cũ của dự án
$body = getBody('get');
if(!empty($body['id'])) {
    $contactId = $body['id'];
    //Kiểm tra blogId có tồn tại trong database hay không
    //Nếu tồn tại => lấy ra thông tin
    //Nếu không tồn tại => chuyển hướng về trang lists
    $contactDetail = firstRaw("SELECT * FROM contacts WHERE id = $contactId");
    if(!empty($contactDetail)) {
        //Tồn tại
        //Gán giá trị $contactDetail vào flashData
        setFlashData('contactDetail', $contactDetail);
    } else {
        redirect('admin?module=contacts');
    }
} else {
    redirect('admin?module=contacts');
}

if(isPost()) {
    $body = getBody();
    $errors = [];

    //Validate họ tên: Bắt buộc nhập
    if(empty(trim($body['fullname']))) {
        $errors['fullname']['required'] = 'Họ và tên bắt buộc phải nhập';
    }

    if(empty(trim($body['email']))) {
        $errors['email']['required'] = 'Email bắt buộc phải nhập';
    } else {
        if(!isEmail(trim($body['email']))) {
            $errors['email']['isEmail'] = 'Email không hợp lệ';
        }
    }

    //Validate message: Bắt buộc nhập
    if(empty(trim($body['message']))) {
        $errors['message']['required'] = 'Nội dung bắt buộc phải nhập';
    }

    if(empty(trim($body['type_id']))) {
        $errors['type_id']['required'] = 'Vui lòng chọn phòng ban';
    }

    if(empty($errors)) {
        $dataUpdate = [
            'fullname' => trim($body['fullname']),
            'email' => trim($body['email']),
            'type_id' => trim($body['type_id']),
            'message' => trim($body['message']),
            'status' => trim($body['status']),
            'note' => trim($body['note']),
            'update_at' => date('Y-m-d H:i:s')
        ];
        $condition = "id=$contactId";
        $updateStatus = update('contacts', $dataUpdate, $condition);
        if($updateStatus) {
            setFlashData('msg', 'Cập nhật bài viết thành công');
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
    redirect('admin?module=contacts&action=edit&id='.$contactId); //Chuyển hướng đến trang hiện tại
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$contactDetail =getFlashData('contactDetail');
if(!empty($contactDetail) && empty($old)) {
    $old = $contactDetail;
}

//Truy vấn lấy cả phòng ban
$listContactType = getRaw("SELECT id, name FROM contact_type ORDER BY name ASC");
?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php getMsg($msg, $msgType); ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Họ tên</label>
                    <input type="text" class="form-control" name="fullname" placeholder="Họ tên.." value="<?php echo old('fullname', $old); ?>">
                    <?php echo form_error('fullname', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email.." value="<?php echo old('email', $old); ?>">
                    <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="type_id">Phòng ban</label>
                    <select name="type_id" id="type_id" class="form-control">
                        <option value="0">Chọn phòng ban</option>
                        <?php
                        if(!empty($listContactType)):
                            foreach ($listContactType as $item):
                                $selected = (old('type_id', $old) == $item['id']) ? 'selected': false;
                                echo '<option value="'.$item['id'].'" '.$selected.'>'.$item['name'].'</option>';
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <?php echo form_error('type_id', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea name="message" class="form-control"><?php echo old('message', $old); ?></textarea>
                    <?php echo form_error('message', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Ghi chú</label>
                    <textarea name="note" class="form-control"><?php echo old('note', $old); ?></textarea>
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
                <a href="<?php echo getLinkAdmin('contacts'); ?>" class="btn btn-success">Quay lại</a>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);