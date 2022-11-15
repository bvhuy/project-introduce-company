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
if(!empty($body)) {
    $userId = isLogin()['user_id'];
    $userIdDelete = $body['id'];
    if($userId !== $userIdDelete) {
        $userDetailRows = getRows("SELECT id FROM users WHERE id=$userIdDelete");
        if($userDetailRows > 0) {
            //Thực hiện xoá
            //1. Xoá login_token
            $condition = "user_id=$userIdDelete";
            $deleteToken = delete('login_token', $condition);
            if($deleteToken) {
                //2. Xoá user
                $deleteUser = delete('users', "id=$userIdDelete");
                if($deleteUser) {
                    setFlashData('msg', 'Xoá người dùng thành công');
                    setFlashData('msg_type', 'success');
                } else {
                    setFlashData('msg', 'Lỗi hệ thống! Vui lòng thử lại sau.');
                    setFlashData('msg_type', 'danger');
                }
            } else {
                setFlashData('msg', 'Lỗi hệ thống! Vui lòng thử lại sau.');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Người dùng không tồn tại trên hệ thống');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Bạn không được xoá chính mình khi đang đăng nhập');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=users');