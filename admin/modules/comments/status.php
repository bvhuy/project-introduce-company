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
if(!empty($body['id'])) {
    $commentId = $body['id'];

    $commentDetailRows = getRows("SELECT id FROM comments WHERE id = $commentId");
    if($commentDetailRows > 0) {

        $allowedStatus = [0, 1];
        if(isset($body['status']) && in_array($body['status'], $allowedStatus)) {

            $status = $body['status'];
            $condition = "id=$commentId";
            $dataUpdate = [
                'status' => $status
            ];

            $updateStatus = update('comments', $dataUpdate, $condition);
            $msg = '';
            if($status == 0) {
                $msg = 'Bỏ duyệt';
            } else {
                $msg = 'Duyệt';
            }
            if (!empty($updateStatus)) {
                setFlashData('msg', $msg.' bình luận thành công');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', $msg.' bình luận không thành công');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Liên kết không tồn tại');
            setFlashData('msg_type', 'danger');
        }
    } else {
        setFlashData('msg', 'Bình luận không tồn tại trên hệ thống');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', 'Liên kết không tồn tại');
    setFlashData('msg_type', 'danger');
}

redirect('admin?module=comments');