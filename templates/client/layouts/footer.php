<?php
if (!defined('_INCODE')) die('Access Deined...');
$msg = getFlashData('msg_subscribe');
$msgType = getFlashData('msg_type_subscribe');
$errors = getFlashData('errors_subscribe');
?>
<!-- Start Footer -->
<footer id="footer" class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <!-- Address Widget -->
                    <div class="single-widget address">
                        <h2><?php echo getOption('footer_1_title'); ?></h2>
                        <?php echo html_entity_decode(getOption('footer_1_description')); ?>
                        <ul class="list">
                            <li><i class="fa fa-phone"></i><?php echo getOption('general_hotline', 'label'); ?>: <?php echo getOption('general_hotline'); ?></li>
                            <li><i class="fa fa-envelope"></i><?php echo getOption('general_email', 'label'); ?>:<a href="mailto:<?php echo getOption('general_email'); ?>"><?php echo getOption('general_email'); ?></a>
                            </li>
                            <li><i class="fa fa-map-o"></i><?php echo getOption('general_address', 'label'); ?>: <?php echo getOption('general_address'); ?></li>
                        </ul>
                        <ul class="social">
                            <li><a href="<?php echo getOption('general_facebook'); ?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo getOption('general_twitter'); ?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo getOption('general_linkedin'); ?>"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="<?php echo getOption('general_youtube'); ?>"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="<?php echo getOption('general_behance'); ?>"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                    <!--/ End Address Widget -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <!-- Links Widget -->
                    <div class="single-widget links">
                        <h2><?php echo getOption('footer_2_title'); ?></h2>
                        <?php
                            $footerLinks = html_entity_decode(getOption('footer_2_description'));
                            $footerLinks = str_replace('<ul>', '', $footerLinks);
                            $footerLinks = str_replace('</ul>', '', $footerLinks);
                            echo '<ul class="list">'.$footerLinks.'</ul>';
                        ?>
                    </div>
                    <!--/ End Links Widget -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <!-- Twitter Widget -->
                    <div class="single-widget twitter">
                        <h2><?php echo getOption('footer_3_title'); ?></h2>
                        <?php  $linkTwitter = 'https://twitter.com/'.getOption('footer_3_twitter');  ?>
                        <a class="twitter-timeline" data-height="240" data-theme="dark" href="<?php echo $linkTwitter; ?>?ref_src=twsrc%5Etfw">Tweets by <?php echo getOption('footer_3_twitter'); ?></a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                    <!--/ End Twitter Widget -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <!-- Gallery Widget -->
                    <div class="single-widget photo-gallery" >
                        <h2><?php echo getOption('footer_4_title'); ?></h2>
                        <?php echo html_entity_decode(getOption('footer_4_description')); ?>
                        <div class="blog-main">
                            <div class="blog-main">
                                <!-- Newslatter Subscribe -->
                                <div class="single-sidebar subscribe" style="padding: 0;">
                                    <div class="single-widget subscribe">
                                        <form action="<?php echo _WEB_HOST_ROOT.'/submit-subscribe.html'; ?>" method="post">
                                            <input type="text" name="email" placeholder="Email Address">
                                            <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                                            <button type="submit">Đăng ký</button>
                                        </form>
                                    </div>
                                </div>
                                <!--/ End Newslatter Subscribe  -->
                            </div>
                        </div>
                        <?php getMsg($msg, $msgType); ?>
                    </div>
                    <!--/ End Gallery Widget -->
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!-- copyright -->
                    <div class="copyright">
                        <?php echo html_entity_decode(getOption('footer_copyright')); ?>
                    </div>
                    <!--/ End Copyright -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/ End footer -->

<!-- Jquery -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Modernizer JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/modernizr.min.js" type="text/javascript"></script>
<!-- Tromas JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/tromas.js" type="text/javascript"></script>
<!-- Tromas Plugins -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/theme-plugins.js" type="text/javascript"></script>
<!-- Google Map JS -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnhgNBg6jrSuqhTeKKEFDWI0_5fZLx0vM"
        type="text/javascript"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/gmap.min.js" type="text/javascript"></script>
<!-- Main JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/main.js?ver<?php echo rand(); ?>" type="text/javascript"></script>
<?php foot(); ?>
</div>
</body>
</html>
