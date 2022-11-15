<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => (!empty(getOption('about_title'))) ? getOption('about_title') : false
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);
require_once _WEB_PATH_ROOT.'/modules/home/contents/about.php';
require_once _WEB_PATH_ROOT.'/modules/home/contents/clients.php';
layout('footer', 'client', $data);
?>
<style>
    .clients {
        background: #f6f6f6 !important;
    }
</style>
