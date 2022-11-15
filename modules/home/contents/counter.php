<div id="counter" class="counter section" data-stellar-background-ratio="0.5" style="<?php echo (!empty(getOption('home_counter_bg'))) ? "background-image: url('".getOption('home_counter_bg')."')" : false; ?>">
    <div class="container">
        <div class="row">
<?php
$homeCounterJson = getOption('home_counter');
$homeCounterArr = [];
if(!empty($homeCounterJson)) {
    $homeCounterArr = json_decode($homeCounterJson, true);
    if(!empty($homeCounterArr)) {
        foreach ($homeCounterArr as $item) {
?>
            <div class="col-md-3 col-sm-6 col-xs-12">

                <div class="counter-single">
                    <?php if(!empty($item['counter_icon'])): ?>
                    <div class="icon">
                        <?php echo html_entity_decode($item['counter_icon']); ?>
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($item['counter_name']) && !empty($item['counter_number'])): ?>
                    <div class="s-info">
                        <span class="number"><?php echo $item['counter_number']; ?></span>
                        <p><?php echo $item['counter_name']; ?></p>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
<?php
        }
    }
}
?>
        </div>
    </div>
</div>