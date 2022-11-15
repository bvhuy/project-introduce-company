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
    $pageId = $body['id'];
    $pageDetail = firstRaw("SELECT * FROM pages WHERE id = $pageId");
    if (!empty($pageDetail)) {
        //Loại bỏ thời gian tạo (create_at), thời gian cập nhật (update_at), id
        $pageDetail['create_at'] = date('Y-m-d H:i:s');
        unset($pageDetail['update_at']);
        unset($pageDetail['id']);

        $duplicate = $pageDetail['duplicate'];
        $duplicate++;

        $title = $pageDetail['title'].' ('.$duplicate.')';
        $pageDetail['title'] = $title;
        $insertStatus = insert('pages', $pageDetail);
        if($insertStatus) {
            setFlashData('msg', 'Nhân bản trang thành công');
            setFlashData('msg_type', 'success');
            update('pages',[
                'duplicate' => $duplicate
            ], "id=$pageId");
        }
    } else {
        setFlashData('msg', 'Trang không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=pages');