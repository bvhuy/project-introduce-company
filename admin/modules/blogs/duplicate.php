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
    $blogDetail = firstRaw("SELECT * FROM blogs WHERE id = $blogId");
    if (!empty($blogDetail)) {
        //Loại bỏ thời gian tạo (create_at), thời gian cập nhật (update_at), id
        $blogDetail['create_at'] = date('Y-m-d H:i:s');
        unset($blogDetail['update_at']);
        unset($blogDetail['id']);

        $duplicate = $blogDetail['duplicate'];
        $duplicate++;

        $title = $blogDetail['title'].' ('.$duplicate.')';
        $blogDetail['title'] = $title;

        $insertStatus = insert('blogs', $blogDetail);
        if($insertStatus) {
            setFlashData('msg', 'Nhân bản bài viết thành công');
            setFlashData('msg_type', 'success');
            update('blogs',[
                'duplicate' => $duplicate
            ], "id=$blogId");
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