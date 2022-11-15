<!-- Start Hero Area -->
<section class="hero-area">
    <div class="slider-one">
<?php
$homeSlideJson = getOption('home_slide');
$homeSlideArr = [];
if(!empty($homeSlideJson)) {
    $homeSlideArr = json_decode($homeSlideJson, true);
    if(!empty($homeSlideArr)) {
        foreach ($homeSlideArr as $item) {
            $classSlideAligh = '';
            $classSlideCol = '';
            if(!empty($item['slide_align'])) {
                if($item['slide_align'] == 'right') {
                    $classSlideAligh = ' right';
                    $classSlideCol = ' col-md-offset-5';
                } elseif ($item['slide_align'] == 'center') {
                    $classSlideAligh = ' center';
                }
            }
            ?>
            <!-- Single Slider -->
            <div class="single-slider" style="<?php echo (!empty($item['slide_image'])) ? "background-image:url('".$item['slide_image']."');" : false; ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 col-xs-12<?php echo (!empty($classSlideCol)) ? $classSlideCol : false; ?>">
                            <!-- Slider Text -->
                            <div class="slide-text<?php echo (!empty($classSlideAligh)) ? $classSlideAligh : false; ?>">
                                <h1>
                                    <?php if(!empty($item['slide_short_title'])): ?>
                                    <span class="short"><?php echo $item['slide_short_title']; ?></span>
                                    <?php endif; ?>
                                    <?php if(!empty($item['slide_title'])): ?>
                                    <?php echo $item['slide_title']; ?>
                                    <?php endif; ?>
                                </h1>
                                <?php if(!empty($item['slide_description'])): ?>
                                <p><?php echo $item['slide_description']; ?></p>
                                <?php endif; ?>
                                <div class="slide-btn">
                                    <?php if(!empty($item['slide_button_video'])): ?>
                                    <a href="<?php echo $item['slide_button_video']; ?>" class="btn primary video-play video-popup mfp-fade">Play Video<i class="fa fa-play"></i>
                                        <div class="waves-block">
                                            <div class="waves wave-1"></div>
                                            <div class="waves wave-2"></div>
                                            <div class="waves wave-3"></div>
                                        </div>
                                    </a>
                                    <?php else: ?>
                                    <?php if(!empty($item['slide_button_link'])): ?>
                                        <a href="<?php echo $item['slide_button_link']; ?>" class="btn primary"><?php echo (!empty($item['slide_button_text'])) ? $item['slide_button_text'] : 'Read more'; ?></a>
                                    <?php endif; ?>
                                    <?php endif;?>
                                </div>
                            </div>
                            <!--/ End SLider Text -->
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Single Slider -->
            <?php
        }
    }
}
?>
    </div>
</section>
<!--/ End Hero Area -->

