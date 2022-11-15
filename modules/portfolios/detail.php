<?php
if(!defined('_INCODE')) die('Access Deined...');

if(!empty(getBody()['id'])) {
    $portfolioId= getBody()['id'];
    $sql = "SELECT p.name, p.description, p.video, p.content, p.create_at, c.name AS portfolio_categories_name, u.fullname AS user_fullname, u.contact_facebook as user_facebook, u.contact_twitter as user_twitter, u.contact_linkedin as user_linkedin, u.contact_pinterest as user_pinterest FROM  portfolios AS p INNER JOIN portfolio_categories AS c ON p.portfolio_category_id = c.id INNER JOIN users AS u ON p.user_id = u.id WHERE p.id = $portfolioId";
    $portfolioDetail = firstRaw($sql);
    $portfolioImages = getRaw("SELECT * FROM portfolio_images WHERE portfolio_id = $portfolioId");
    if(empty($portfolioDetail)) {
        redirectError();
    }
} else {
    redirectError();
}
$data = [
    'pageTitle' => $portfolioDetail['name']
];
layout('header', 'client', $data);
$data['itemParent'] = '<li><a href="'._WEB_HOST_ROOT.'/?module=portfolios'.'">'.getOption('portfolio_title').'<i class="fa fa-angle-right"></i></a></li>';
layout('breadcrumb', 'client', $data);
?>
<!-- Start Project -->
<section id="projects" class="projects section single">
    <div class="container">
        <?php if(!empty($portfolioImages)): ?>
        <?php $count = 0; ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="project-single">
                    <div class="project-inner">
                        <div class="project-head">
                            <div class="project-slider">
                                <ul class="bxslider">
                                    <?php foreach ($portfolioImages as $item): ?>
                                    <li><img src="<?php echo $item['image']; ?>" alt="#"></li>
                                    <?php endforeach; ?>
                                </ul>
                                <div id="bx-pager">
                                    <?php foreach ($portfolioImages as $item): ?>
                                    <a data-slide-index="<?php echo $count; ?>" href=""><img src="<?php echo $item['image']; ?>" alt="#"></a>
                                    <?php $count++; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <!--  Project -->
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="project-sidebar">
                    <div class="single-sidebar project-info">
                        <?php if(!empty($portfolioDetail['user_fullname'])): ?>
                        <!-- Single Widget -->
                        <div class="single-info">
                            <i class="fa fa-user"></i>
                            <h4>Người đăng</h4>
                            <a href="#"><?php echo $portfolioDetail['user_fullname']; ?></a>
                        </div>
                        <!--/ End Single Widget -->
                        <?php endif; ?>
                        <?php if(!empty($portfolioDetail['portfolio_categories_name'])): ?>
                        <!-- Single Widget -->
                        <div class="single-info">
                            <i class="fa fa-tags "></i>
                            <h4>Danh mục</h4>
                            <a href="#"><?php echo $portfolioDetail['portfolio_categories_name']; ?></a>
                        </div>
                        <!--/ End Single Widget -->
                        <?php endif; ?>
                        <?php if(!empty($portfolioDetail['create_at'])): ?>
                        <!-- Single Widget -->
                        <div class="single-info">
                            <i class="fa fa-calendar"></i>
                            <h4>Ngày đăng</h4>
                            <a href="#"><?php echo getDateFormat($portfolioDetail['create_at'], 'd/m/Y H:i:s'); ?></a>
                        </div>
                        <!--/ End Single Widget -->
                        <?php endif; ?>
                        <?php if(!empty($portfolioDetail['user_facebook'])): ?>
                        <!-- Single Widget -->
                        <div class="single-info">
                            <i class="fa fa-facebook"></i>
                            <h4>Facebook</h4>
                            <a href="<?php echo $portfolioDetail['user_facebook']; ?>"><?php echo $portfolioDetail['user_facebook']; ?></a>
                        </div>
                        <!--/ End Single Widget -->
                        <?php endif; ?>
                        <?php if(!empty($portfolioDetail['user_twitter'])): ?>
                            <!-- Single Widget -->
                            <div class="single-info">
                                <i class="fa fa-twitter"></i>
                                <h4>Twitter</h4>
                                <a href="<?php echo $portfolioDetail['user_twitter']; ?>"><?php echo $portfolioDetail['user_twitter']; ?></a>
                            </div>
                            <!--/ End Single Widget -->
                        <?php endif; ?>
                        <?php if(!empty($portfolioDetail['user_linkedin'])): ?>
                            <!-- Single Widget -->
                            <div class="single-info">
                                <i class="fa fa-linkedin"></i>
                                <h4>LinkedIn</h4>
                                <a href="<?php echo $portfolioDetail['user_linkedin']; ?>"><?php echo $portfolioDetail['user_linkedin']; ?></a>
                            </div>
                            <!--/ End Single Widget -->
                        <?php endif; ?>
                        <?php if(!empty($portfolioDetail['user_pinterest'])): ?>
                            <!-- Single Widget -->
                            <div class="single-info">
                                <i class="fa fa-pinterest"></i>
                                <h4>Pinterest</h4>
                                <a href="<?php echo $portfolioDetail['user_pinterest']; ?>"><?php echo $portfolioDetail['user_pinterest']; ?></a>
                            </div>
                            <!--/ End Single Widget -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="project-content">
                    <?php echo (!empty($portfolioDetail['name'])) ? '<h2>'.$portfolioDetail['name'].'</h2>' : false; ?>
                    <?php echo (!empty($portfolioDetail['content'])) ? html_entity_decode($portfolioDetail['content']) : false; ?>
                    <?php
                        if(!empty($portfolioDetail['video'])) {
                            $youtubeId = getYoutubeId($portfolioDetail['video']);
                            if(!empty($youtubeId)) {
                    ?>
                            <iframe width="100%" height="500" src="https://www.youtube.com/embed/<?php echo $youtubeId; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Project -->
<?php
require_once _WEB_PATH_ROOT . '/modules/home/contents/call_to_action.php';
layout('footer', 'client', $data);
?>
