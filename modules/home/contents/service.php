<!-- Start Services -->
<section id="services" class="services section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h1><?php echo getOption('home_service_title'); ?></h1>
                    <?php echo '<p>'.getOption('home_service_description').'</p>'; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                $serviceLists = getRaw("SELECT * FROM services ORDER BY name ASC");
                if(!empty($serviceLists)):
                    foreach ($serviceLists as $item):
            ?>
                <!-- Single Service -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="single-services">
                        <div class="icon"><?php echo html_entity_decode($item['icon']); ?></div>
                        <div class="icon two"><?php echo html_entity_decode($item['icon']); ?></div>
                        <h2><a href="<?php echo getLinkModule('services', $item['id']); ?>"><?php echo $item['name']; ?></a></h2>
                        <?php echo html_entity_decode($item['description']); ?>
                    </div>
                </div>
                <!--/ End Single Service -->
            <?php endforeach; endif;?>
        </div>
    </div>
</section>
<!--/ End Services -->