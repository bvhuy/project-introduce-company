<?php
if(!defined('_INCODE')) die('Access Deined...');
$homeTeamJson = getOption('home_team');
$homeTeamArr = [];
if(!empty($homeTeamJson)) {
    $homeTeamArr = json_decode($homeTeamJson, true);
}
?>
<!-- Start Team -->
<section id="team" class="team section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h1><?php echo (!empty(getOption('home_team_title'))) ? getOption('home_team_title') : false; ?></h1>
                    <p><?php echo (!empty(getOption('home_team_description'))) ? getOption('home_team_description') : false; ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            if(!empty($homeTeamArr)) {
                foreach ($homeTeamArr as $item) {
                    ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <!-- Single Team -->
                        <div class="single-team one default">
                            <!-- Team Head -->
                            <div class="t-head">
                                <img src="<?php echo $item['team_image']; ?>" alt="#">
                                <div class="t-hover">
                                    <ul class="t-social">
                                        <li><a href="<?php echo $item['team_facebook']; ?>"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="<?php echo $item['team_twitter']; ?>"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="<?php echo $item['team_behance']; ?>"><i class="fa fa-behance"></i></a></li>
                                        <li><a href="<?php echo $item['team_dribbble']; ?>"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Team Bottom -->
                            <div class="t-bottom">
                                <div class="t-icon">
                                    <a href="#team1"><i class="fa fa-plus"></i></a>
                                </div>
                                <h2 class="t-name"><?php echo $item['team_fullname']; ?></h2>
                                <p class="what"><?php echo $item['team_position']; ?></p>
                            </div>
                        </div>
                        <!-- End Single Team -->
                    </div>
                    <?php
                }
            }
            ?>
        </div>
</section>
<!--/ End Team -->