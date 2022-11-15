<?php
if(!defined('_INCODE')) die('Access Deined...');

if(!empty(getBody()['id'])) {
    $serviceId= getBody()['id'];
    $sql = "SELECT * FROM services WHERE id = $serviceId";
    $serviceDetail = firstRaw($sql);
    if(empty($serviceDetail)) {
        redirectError();
    }
} else {
    redirectError();
}
$data = [
    'pageTitle' => $serviceDetail['name']
];
layout('header', 'client', $data);
$data['itemParent'] = '<li><a href="'._WEB_HOST_ROOT.'/?module=services'.'">'.getOption('service_title').'<i class="fa fa-angle-right"></i></a></li>';
layout('breadcrumb', 'client', $data);
?>
<section id="services" class="services single full section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="services-main">

<!--                    <div class="services-slider">-->
<!---->
<!--                        <div class="single-slide">-->
<!--                            <img src="images/services.jpg" alt="#">-->
<!--                        </div>-->
<!---->
<!---->
<!--                        <div class="single-slide">-->
<!--                            <img src="images/services.jpg" alt="#">-->
<!--                        </div>-->
<!---->
<!--                    </div>-->


                    <div class="services-content">
                        <h2><?php echo $serviceDetail['name']; ?></h2>
                        <?php echo html_entity_decode($serviceDetail['content']); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>




<?php
require_once _WEB_PATH_ROOT . '/modules/home/contents/call_to_action.php';
layout('footer', 'client', $data);
?>