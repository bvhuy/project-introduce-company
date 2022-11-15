<?php
if(!defined('_INCODE')) die('Access Deined...');

try {
    if(class_exists('PDO')) {
        $dsn = _DRIVE.':dbname='._DB.';host='._HOST;
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Đẩy lỗi vào ngoại lê khi truy vấn
        ];
        $conn = new PDO($dsn,_USER, _PASS, $options);
    }

} catch (Exception $exception) {
    require_once 'modules/errors/database.php'; //Import error
    die;
}
