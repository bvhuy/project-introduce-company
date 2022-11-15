<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => (!empty(getOption('team_title'))) ? getOption('team_title') : false
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);
require_once _WEB_PATH_ROOT.'/modules/home/contents/team.php';
layout('footer', 'client', $data);
