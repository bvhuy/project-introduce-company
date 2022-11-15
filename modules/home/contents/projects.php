<?php
    $portfolioCategoryLists = getRaw("SELECT * FROM portfolio_categories ORDER BY name ASC");
    $portfolioLists = getRaw("SELECT portfolios.name, portfolios.id,  slug, thumbnail, description, video, portfolio_categories.name as portfolio_categories_name, portfolio_category_id FROM portfolios INNER JOIN portfolio_categories ON portfolios.portfolio_category_id = portfolio_categories.id ORDER BY portfolios.name ASC");
?>
<!-- Start Projects -->
<section id="projects" class="projects section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h1><?php echo getOption('home_project_title'); ?></h1>
                    <?php echo '<p>'.getOption('home_project_description').'</p>'; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if(!empty($portfolioCategoryLists)): ?>
                <!-- project Nav -->
                <div class="project-nav">
                    <ul class="cbp-l-filters-work" id="project-menu">
                        <li data-filter="*" class="cbp-filter-item active">All<div class="cbp-filter-counter"></div></li>
                        <?php foreach ($portfolioCategoryLists as $item): ?>
                        <li data-filter=".category_<?php echo $item['id']; ?>" class="cbp-filter-item"><?php echo $item['name']; ?><div class="cbp-filter-counter"></div></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!--/ End project Nav -->
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if(!empty($portfolioLists)): ?>
                <div id="project-item" class="cbp">
                    <?php foreach ($portfolioLists as $item): ?>
                    <div class="cbp-item category_<?php echo $item['portfolio_category_id']; ?>">
                        <!-- Single Project -->
                        <div class="project-single">
                            <div class="project-inner">
                                <div class="project-head">
                                    <img src="<?php echo $item['thumbnail']; ?>" alt="#">
                                </div>
                                <div class="project-bottom">
                                    <h4><a href="#"><?php echo $item['name']; ?></a><span class="category"><?php echo $item['portfolio_categories_name']; ?></span></h4>
                                </div>
                                <div class="button">
                                    <?php if(!empty($item['video'])): ?>
                                        <a href="<?php echo $item['video']; ?>" class="btn video-play cbp-lightbox"><i class="fa fa-play"></i></a>
                                    <?php else: ?>
                                        <a data-fancybox="portfolio" href="<?php echo $item['thumbnail']; ?>" class="btn"><i class="fa fa-photo"></i></a>
                                    <?php endif; ?>

                                    <a target="_blank" href="<?php echo getLinkModule('portfolios', $item['id']); ?>" class="btn"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--/ End Single Project -->
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!--/ End Projects -->