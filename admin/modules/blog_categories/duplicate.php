<?php
if (!defined('_INCODE')) die('Access Deined...');
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
if (!empty($body['id'])) {
    $cateId = $body['id'];
    $cateDetail = firstRaw("SELECT * FROM blog_categories WHERE id = $cateId");
    if (!empty($cateDetail)) {
        //Loại bỏ thời gian tạo (create_at), thời gian cập nhật (update_at), id
        $cateDetail['create_at'] = date('Y-m-d H:i:s');
        unset($cateDetail['update_at']);
        unset($cateDetail['id']);

        $duplicate = $cateDetail['duplicate'];
        $duplicate++;

        $name = $cateDetail['name'] . ' (' . $duplicate . ')';
        $cateDetail['name'] = $name;
        $insertStatus = insert('blog_categories', $cateDetail);
        if ($insertStatus) {
            setFlashData('msg', 'Nhân bản danh mục thành công');
            setFlashData('msg_type', 'success');
            update('blog_categories', [
                'duplicate' => $duplicate
            ], "id=$cateId");
        }
    } else {
        setFlashData('msg', 'Danh mục không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=blog_categories');