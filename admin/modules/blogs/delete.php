<?php
if(!defined('_INCODE')) die('Access Deined...');
if (!isLogin()) {
    redirect('admin?module=auth&action=login');
} else {
    $userId = isLogin()['user_id'];
    $userDetail = getUserInfo($userId);
}

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

$body = getBody();
if(!empty($body['id'])) {
    $blogId = $body['id'];
    $blogDetailRows = getRows("SELECT id FROM blogs WHERE id = $blogId");
    if($blogDetailRows > 0) {
        //Thực hiện xoá
        $condition = "id=$blogId";
        $deleteStatus = delete('blogs', $condition);
        if($deleteStatus) {
            setFlashData('msg', 'Xoá bài viết thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Xoá bài viết không thành công! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Bài viết không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=blogs');