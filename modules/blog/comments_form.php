<?php

if(!empty(getBody('get')['comment_id'])) {
    $commentId = getBody('get')['comment_id'];
    $commentName = null;
    $commentName = $commentData[$commentId]['name'];
}

//Check admin login
if(!empty(isLogin())) {
    $userId = isLogin()['user_id'];
}

if (isPost()) {
    $body = getBody();
    $errors = [];

    if(empty($userId)) {
        //Validate name
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
                $errors['name']['isEmail'] = 'Email không hợp lệ';
            }
        }

        //Validate content
        if (empty($body['content'])) {
            $errors['content']['required'] = 'Nội dung bình luận không được để trống';
        } else {
            if (strlen(trim($body['content'])) < 10) {
                $errors['content']['min'] = 'Nội dung >= 10 ký tự';
            }
        }
    }

    if (empty($errors)) {

        //Lưu tất cả thông tin vào cookie
        if(empty($userId)) {
            $commentInfo = [
                'name' => trim(strip_tags($body['name'])),
                'email' => trim(strip_tags($body['email']))
            ];
            setcookie('commentInfo', json_encode($commentInfo), time() + 86400 * 365);
        }

        //Xử lý submit
        $dataInsert = [
            'content' => trim(strip_tags($body['content'])),
            'parent_id' => 0,
            'blog_id' => $blogId,
            'user_id' => !empty($userId) ? $userId : null,
            'status' => 0,
            'create_at' => date('Y-m-d H:i:s')
        ];
        if(empty($userId)) {
            $dataInsert['name'] = trim(strip_tags($body['name']));
            $dataInsert['email'] = trim(strip_tags($body['email']));
        }


        if(!empty($commentId)) {
            $dataInsert['parent_id'] = $commentId;
            $dataInsert['status'] = 1; //Bỏ duyệt bình luận khi trả lời bình luận
        }

        $insertStatus = insert('comments', $dataInsert);
        if ($insertStatus) {
            if(empty($commentId)) {
                setFlashData('msg', 'Bình luận đã được gửi đi thành công. Vui lòng chờ duyệt');
            } else {
                setFlashData('msg', 'Bình luận đã được gửi đi thành công.');
            }


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
    //redirect('?module=blog&action=detail&id=' . $blogId . '#comments-form'); //Load lại trang hiện tại
    $linkBlog = getLinkModule('blogs', $blogId).'#comments-form';
    redirect($linkBlog, true);
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

//Lấy dữ liệu từ cookie
$commentInfo = [];
if(!empty($_COOKIE['commentInfo'])) {
    $commentInfo = json_decode($_COOKIE['commentInfo'], true);
}

?>
<div class="comments-form" id="comments-form">

    <?php
        $cannelComment = ' <a href="'._WEB_HOST_ROOT.'?module=blog&action=detail&id='.$blogId.'#comments-form">Huỷ</a>';
    ?>
    <h2><?php echo (!empty($commentName)) ? 'Trả lời bình luận: '.$commentName. $cannelComment : 'Viết bình luận'; ?></h2>
    <?php
    //Check admin login
    if(!empty($userId)) {
        $userDetail = getUserInfo($userId);
        echo '<p>Bạn đang đăng nhập với tài khoản <b>'.$userDetail['fullname'].'</b> - <a href="'.getLinkAdmin('auth', 'logout').'">Đăng xuất</a></p>';
    }
    ?>
    <!-- Contact Form -->
    <?php getMsg($msg, $msgType); ?>
    <form class="form" method="post" action="">
        <div class="row">
            <?php if(empty($userId)): ?>
            <div class="col-md-6">
                <div class="form-group">
                    <i class="fa fa-user"></i>
                    <input type="text" name="name" placeholder="Họ và tên..." value="<?php echo old('name', $commentInfo); ?>">
                    <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" placeholder="Địa chỉ email..."
                           value="<?php echo old('email', $commentInfo); ?>">
                    <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-12">
                <div class="form-group">
                    <i class="fa fa-pencil"></i>
                    <textarea name="content" rows="7"
                              placeholder="Nhập nội dung bình luận..."></textarea>
                    <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group button">
                    <button type="submit" class="button primary"><i class="fa fa-send"></i>Gửi bình luận</button>
                </div>
            </div>

        </div>
    </form>
    <!--/ End Contact Form -->
</div>