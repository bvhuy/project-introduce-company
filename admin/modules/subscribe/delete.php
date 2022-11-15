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
    $subscribeId = $body['id'];
    $subscribeDetailRows = getRows("SELECT id FROM subscribe WHERE id = $subscribeId");
    if($subscribeDetailRows > 0) {
        //Thực hiện xoá
        $condition = "id=$subscribeId";
        $deleteStatus = delete('subscribe', $condition);
        if($deleteStatus) {
            setFlashData('msg', 'Xoá đăng ký thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Xoá đăng ký không thành công! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Đăng ký không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=subscribe');