<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
        'pageTitle' => 'Trang chủ'
];
layout('header', 'client', $data);
require_once 'contents/slide.php';
require_once 'contents/about.php';
require_once 'contents/service.php';
require_once 'contents/counter.php';
require_once 'contents/projects.php';
require_once 'contents/team.php';
require_once 'contents/blog.php';
require_once 'contents/clients.php';
require_once 'contents/call_to_action.php';
layout('footer', 'client', $data);