<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật bình luận'
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
    $commentId = $body['id'];
    //Kiểm tra commentId có tồn tại trong database hay không
    //Nếu tồn tại => lấy ra thông tin
    //Nếu không tồn tại => chuyển hướng về trang lists
    $commentDetail = firstRaw("SELECT comments.*, blogs.title AS blog_title, users.fullname AS user_fullname, users.email AS user_email, `groups`.name AS group_name FROM comments 
    INNER JOIN blogs ON comments.blog_id = blogs.id 
    LEFT JOIN users ON comments.user_id = users.id LEFT JOIN `groups` ON users.group_id = `groups`.id WHERE comments.id = $commentId");
    if(!empty($commentDetail)) {
        //Tồn tại
        //Gán giá trị $commentDetail vào flashData
        setFlashData('commentDetail', $commentDetail);
    } else {
        redirect('admin?module=comments');
    }
} else {
    redirect('admin?module=comments');
}

if(isPost()) {
    $body = getBody();
    $errors = [];

    if(empty($commentDetail['user_id'])) {
        if (empty($body['name'])) {
            $errors['name']['required'] = 'Họ và tên không được để trống';
        } else {
            if (strlen(trim($body['name'])) < 5) {
                $errors['name']['min'] = 'Họ và tên >= 5 ký tự';
            }
        }

        //Validate email
        if (empty($body['email'])) {
            $errors['email']['required'] = 'Email bắt không được để trống';
        } else {
            if (!isEmail(trim($body['email']))) {
                $errors['email']['isEmail'] = 'Email không hợp lệ';
            }
        }
    }

    //Validate content
    if (empty($body['content'])) {
        $errors['content']['required'] = 'Nội dung bình luận không được để trống';
    }

    if(empty($errors)) {

        $allowedStatus = [0, 1];
        if(isset($body['status']) && in_array($body['status'], $allowedStatus)) {

            $dataUpdate = [
                'content' => trim($body['content']),
                'status' => trim($body['status']),
                'update_at' => date('Y-m-d H:i:s')
            ];

            if (empty($commentDetail['user_id'])) {
                $dataUpdate['name'] = trim($body['name']);
                $dataUpdate['email'] = trim($body['email']);
            }

            $condition = "id=$commentId";
            $updateStatus = update('comments', $dataUpdate, $condition);
            if ($updateStatus) {
                setFlashData('msg', 'Cập nhật bình luận thành công');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
                setFlashData('msg_type', 'danger');
            }
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
    redirect('admin?module=comments&action=edit&id='.$commentId); //Chuyển hướng đến trang hiện tại
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$commentDetail =getFlashData('commentDetail');
if(!empty($commentDetail) && empty($old)) {
    $old = $commentDetail;
}
?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php getMsg($msg, $msgType); ?>
            <form action="" method="post">
                <p><strong>Bình luận từ bài viết</strong>: <?php echo '<a target="_blank" href="'._WEB_HOST_ROOT.'?module=blog&action=detail&id='.$commentDetail['blog_id'].'">'.$commentDetail['blog_title'].'</a>'; ?></p>
                <?php
                    if(!empty($commentDetail['parent_id'])) {
                        $commentData = getComment($commentDetail['parent_id']);
                        if(!empty($commentData['name'])) {
                            echo '<p><strong>Trả lời bình luận</strong>: '.$commentData['name'].'</p>';
                        }
                    }
                ?>
                <?php if(empty($commentDetail['user_id'])): ?>
                <h4>Thông tin cá nhân</h4>
                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Họ và tên..." value="<?php echo old('name', $old); ?>">
                    <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" class="form-control" name="email" placeholder="Email..." value="<?php echo old('email', $old); ?>">
                    <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <?php else: ?>
                <h4>Thông tin người dùng</h4>
                <p>- Họ tên: <?php echo $commentDetail['user_fullname']; ?></p>
                <p>- Email: <?php echo $commentDetail['user_email']; ?></p>
                <p>- Nhóm: <?php echo $commentDetail['group_name']; ?></p>
                <?php endif; ?>
                <h4>Chi tiết bình luận</h4>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea name="content" id="content" class="form-control"><?php echo old('content', $old); ?></textarea>
                    <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select name="status" id="status" class="form-control">
                        <option value="0" <?php echo (old('status', $old) == 0) ? 'selected' : false; ?>>Chưa duyệt</option>
                        <option value="1" <?php echo (old('status', $old) == 1) ? 'selected' : false; ?>>Đã duyệt</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="<?php echo getLinkAdmin('comments'); ?>" class="btn btn-success">Quay lại</a>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);