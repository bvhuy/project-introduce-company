<?php
    $homeAboutJson = getOption('home_about');
    $homeAboutArr = [];
    $homeAboutInfo = [];
    $homeAboutSkill = [];
    if(!empty($homeAboutJson)) {
        $homeAboutArr = json_decode($homeAboutJson, true);
        $homeAboutInfo = json_decode($homeAboutArr['information'], true);
        $homeAboutSkill = json_decode($homeAboutArr['skill'], true);
    }
?>
<!-- Start About -->
<section id="about-us" class="about-us section" style="background: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-title" style="margin-bottom: 30px;">
                    <?php
                        if(!empty($homeAboutInfo['about_title']))
                        {
                            echo '<h1>'.$homeAboutInfo['about_title'].'</h1>';
                        }
                    ?>
                    <?php
                        if(!empty($homeAboutInfo['about_description'])) {
                            echo '<p>'.$homeAboutInfo['about_description'].'</p>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="tabs-main center-nav" style="margin-top: 0; padding: 0">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="about">
                            <div class="about-inner">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <?php
                                            if(!empty($homeAboutInfo['about_image']) && !empty($homeAboutInfo['about_video'])):
                                        ?>
                                        <div class="single-image">
                                            <img src="<?php echo $homeAboutInfo['about_image']; ?>" alt="">
                                            <a href="<?php echo $homeAboutInfo['about_video']; ?>" class="video-popup mfp-iframe"><i class="fa fa-play"></i></a>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <?php if(!empty($homeAboutInfo['about_content'])): ?>
                                        <div class="content">
                                            <?php
                                            $aboutContent = html_entity_decode($homeAboutInfo['about_content']);
                                            echo $aboutContent;
                                            ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!empty($homeAboutSkill)): ?>
        <div class="row">
            <div id="our-skill" class="our-skill">
            <?php foreach ($homeAboutSkill as $item): ?>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="single-skill">
                    <div class="skill-info">
                        <h4><?php echo $item['name']; ?></h4>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $item['value']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $item['value'].'%'; ?>;">
                            <span class="percent"><?php echo $item['value'].'%'; ?></span></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<!--/ End About -->