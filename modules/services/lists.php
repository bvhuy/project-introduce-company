<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => (!empty(getOption('service_title'))) ? getOption('service_title') : false
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);
require_once _WEB_PATH_ROOT . '/modules/home/contents/service.php';
layout('footer', 'client', $data);
?>
<style>
    .clients {
        background: #f6f6f6 !important;
    }
</style>
