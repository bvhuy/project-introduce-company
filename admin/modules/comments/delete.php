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
    $commentId = $body['id'];
    $commentDetailRows = getRows("SELECT id FROM comments WHERE id = $commentId");
    if($commentDetailRows > 0) {
        //Truy vấn lấy tất cả bình luận
        $commentData = getRaw("SELECT * FROM comments");
        //Lấy tất cả bình luận trả lời
        $commentIdArr = getCommentReply($commentData, $commentId);
        //Thêm bình luận cần xoá vào mảng bình luận trả lời
        $commentIdArr[] = $commentId;
        //Chuyển mảng thành chuỗi
        $commentIdStr = implode(',', $commentIdArr);

        //Thực hiện xoá
        $condition = "id IN($commentIdStr)";
        $deleteStatus = delete('comments', $condition);

        if($deleteStatus) {
            setFlashData('msg', 'Xoá bình luận thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Xoá bình luận không thành công! Vui lòng thử lại sau.');
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