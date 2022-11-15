<?php
if(!defined('_INCODE')) die('Access Deined...');
if(isPost()) {
    if(!empty(getBody())) {
        $body = getBody();
        $errors = [];
        $checkEmail = false;

        if(empty(trim($body['email']))) {
            $errors['email']['required'] = 'Email không để trống';
        } else {
            if(!isEmail(trim($body['email']))) {
                $errors['email']['min'] = 'Email không hợp lệ';
            } else {
                $email = trim($body['email']);
                $sql = "SELECT email FROM subscribe WHERE email = '$email'";
                if(getRows($sql) > 0) {
                    $errors['email']['unique'] = 'Email đã đăng ký nhận thông báo từ trước';
                    $checkEmail = true;
                }
            }
        }

        if(empty($errors)) {
            $dataInsert = [
                'email' => trim($body['email']),
                'status' => 0,
                'create_at'=> date('Y-m-d H:i:s')
            ];
            $insertStatus = insert('subscribe', $dataInsert);
            if($insertStatus) {
                setFlashData('msg_subscribe', 'Đăng ký thành công');
                setFlashData('msg_type_subscribe', 'success');
            } else {
                setFlashData('msg_subscribe', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
                setFlashData('msg_type_subscribe', 'danger');
            }
        } else {
            //Có lỗi xảy ra
            if(!$checkEmail) {
                setFlashData('msg_subscribe', 'Vui lòng kiểm tra dữ liệu nhập vào');
            }
            setFlashData('msg_type_subscribe', 'danger');
            setFlashData('errors_subscribe', $errors);
            setFlashData('old_subscribe', $body);
        }
    }
    $urlBack = $_SERVER['HTTP_REFERER']. '#footer';
    redirect($urlBack, true);
}