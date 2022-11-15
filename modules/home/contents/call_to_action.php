<!-- Start Call-To-Action -->
<section class="call-to-action">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="call-to-main">
                    <?php if(!empty(getOption('home_cta_title'))) {
                            echo '<h2>'.html_entity_decode(getOption('home_cta_title')).'</h2>';
                        }
                    ?>
                    <?php
                        if(!empty(getOption('home_cta_button_link')) && !empty(getOption('home_cta_button_icon')) && !empty(getOption('home_cta_button_text'))) {
                            echo '<a href="'.getOption('home_cta_button_link').'" class="btn">'.html_entity_decode(getOption('home_cta_button_icon')).getOption('home_cta_button_text').'</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Call-To-Action -->