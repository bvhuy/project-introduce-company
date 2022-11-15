<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thêm trang'
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

if(isPost()) {
    $body = getBody();
    $errors = [];

    //Validate tên dịch vụ: Bắt buộc nhập
    if(empty(trim($body['title']))) {
        $errors['title']['required'] = 'Tiêu đề trang bắt buộc phải nhập';
    }

    //Validate slug: Bắt buộc nhập
    if(empty(trim($body['slug']))) {
        $errors['slug']['required'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
    }

    //Validate nội dung: Bắt buộc nhập
    if(empty(trim($body['content']))) {
        $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
    }

    if(empty($errors)) {
        $dataInsert = [
            'title' => trim($body['title']),
            'slug' => trim($body['slug']),
            'content' => trim($body['content']),
            'user_id' => $userId,
            'create_at' => date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('pages', $dataInsert);
        if($insertStatus) {
            setFlashData('msg', 'Thêm trang thành công');
            setFlashData('msg_type', 'success');
            redirect('admin?module=pages'); //Chuyển hướng sang trang danh sách trang
        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');
            redirect('admin?module=pages&action=add'); //Load lại trang thêm trang
        }
    } else {
        //Có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('admin?module=pages&action=add'); //Load lại trang thêm trang
    }
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php getMsg($msg, $msgType); ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control slug" name="title" placeholder="Tiêu đề..." value="<?php echo old('title', $old); ?>">
                    <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn tĩnh</label>
                    <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..." value="<?php echo old('slug', $old); ?>">
                    <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
                    <p class="render-link"><b>Link</b>:  <span></span></p>
                </div>
                <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea name="content" class="form-control editor"><?php echo old('content', $old); ?></textarea>
                    <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <a href="<?php echo getLinkAdmin('pages'); ?>" class="btn btn-success">Quay lại</a>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);