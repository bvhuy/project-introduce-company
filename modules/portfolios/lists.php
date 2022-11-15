<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => (!empty(getOption('portfolio_title'))) ? getOption('portfolio_title') : false
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);
require_once _WEB_PATH_ROOT . '/modules/home/contents/projects.php';
layout('footer', 'client', $data);
?>
