<?php
if(!defined('_INCODE')) die('Access Deined...');




if(!empty(getBody()['id'])) {
    $pageId = getBody()['id'];
    $pageDetail = firstRaw("SELECT * FROM pages WHERE id = $pageId");
    if(empty($pageDetail)) {
        redirectError();
    }
} else {
    redirectError();
}

$data = [
    'pageTitle' => (!empty($pageDetail['title'])) ? $pageDetail['title'] : false
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);
?>
<!-- Start Page -->
<section id="blog-main" class="blog-main section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if(!empty($pageDetail['title'])): ?>
                    <div class="section-title">
                        <h1><?php echo $pageDetail['title']; ?></h1>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="blog-main">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php if(!empty($pageDetail['content'])): ?>
                        <?php echo html_entity_decode($pageDetail['content']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Page -->
<?php
layout('footer', 'client', $data);
?>
<style>

</style>
