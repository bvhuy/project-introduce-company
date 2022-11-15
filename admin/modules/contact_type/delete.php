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
    $contactTypeId = $body['id'];
    $contactTypeDetail = getRows("SELECT id FROM contact_type WHERE id = $contactTypeId");
    if($contactTypeDetail > 0) {
        //Kiểm tra xem trong phòng ban còn liên hệ ko
        $contactNum = getRows("SELECT id FROM contacts WHERE type_id=$contactTypeId");
        if($contactNum > 0) {
            setFlashData('msg', 'Trong phòng ban vẫn còn '.$contactNum.' liên hệ');
            setFlashData('msg_type', 'danger');
        } else {
            //Thực hiện xoá
            $condition = "id=$contactTypeId";
            $deleteStatus = delete('contact_type', $condition);
            if($deleteStatus) {
                setFlashData('msg', 'Xoá phòng ban thành công');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', 'Xoá phòng ban không thành công! Vui lòng thử lại sau.');
                setFlashData('msg_type', 'danger');
            }
        }
    } else {
        setFlashData('msg', 'Phòng ban không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=contact_type');