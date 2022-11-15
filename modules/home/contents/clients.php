<?php
    $homeClientJson = getOption('home_client');
    $homeClientArr = [];
    if(!empty($homeClientJson)) {
        $homeClientArr = json_decode($homeClientJson, true);
    }
?>
<section id="clients" class="clients section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="section-title">
                    <?php if(!empty(getOption('home_client_title'))) {
                        echo '<h1>'.getOption('home_client_title').'</h1>';
                    } ?>
                    <?php if(!empty(getOption('home_client_description'))) {
                        echo '<p>'.getOption('home_client_description').'</p>';
                    } ?>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="clients-slider">
                    <?php
                        if(!empty($homeClientArr)) {
                            foreach ($homeClientArr as $item){
                    ?>
                                <div class="single-clients">
                                    <a href="<?php echo $item['client_link']; ?>" target="_blank"><img src="<?php echo $item['client_logo']; ?>" alt="#"></a>
                                </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>