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
    $cateId = $body['id'];
    $cateDetailRows = getRows("SELECT id FROM portfolio_categories WHERE id = $cateId");
    if($cateDetailRows > 0) {
        //Kiểm tra xem trong danh mục còn dự án ko
        $portfolioNum = getRows("SELECT id FROM portfolios WHERE portfolio_category_id=$cateId");
        if($portfolioNum > 0) {
            setFlashData('msg', 'Trong danh mục vẫn còn '.$portfolioNum.' dự án');
            setFlashData('msg_type', 'danger');
        } else {
            //Thực hiện xoá
            $condition = "id=$cateId";
            $deleteStatus = delete('portfolio_categories', $condition);
            if($deleteStatus) {
                setFlashData('msg', 'Xoá danh mục thành công');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', 'Xoá danh mục không thành công! Vui lòng thử lại sau.');
                setFlashData('msg_type', 'danger');
            }
        }
    } else {
        setFlashData('msg', 'Danh mục không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=portfolio_categories');