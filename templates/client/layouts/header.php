<?php
$menuJson = html_entity_decode(getOption('menu'));
$menuDataArr = [];
if(!empty($menuJson)) {
    $menuDataArr = json_decode($menuJson, true);
}
//echo '<pre>';
//print_r($menuDataArr);
//echo '</pre>';
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="SITE KEYWORDS HERE" />
    <meta name="description" content="">
    <meta name='copyright' content='codeglim'>

    <!-- Title Tag -->
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] .' - '. getOption('general_sitename') : 'Tromas'; ?></title>

    <!-- Favicon -->
    <?php
        $faviconUrl = getOption('header_favicon');
        if(!empty($faviconUrl)):
    ?>
    <link rel="icon" type="image/png" href="<?php echo $faviconUrl; ?>">
    <?php endif; ?>
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/bootstrap.min.css">

    <!-- Tromas CSS -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/theme-plugins.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/style.css?ver=<?php echo rand(); ?>">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/responsive.css?ver=<?php echo rand(); ?>">

    <!-- Tromas Color -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE ?>/css/skin/skin1.css?ver=<?php echo rand(); ?>">
    <!--<link rel="stylesheet" href="css/skin/skin2.css">-->
    <!--<link rel="stylesheet" href="css/skin/skin3.css">-->
    <!--<link rel="stylesheet" href="css/skin/skin4.css">-->
    <!--<link rel="stylesheet" href="css/skin/skin5.css">-->
    <!--<link rel="stylesheet" href="css/skin/skin6.css">-->
    <!--<link rel="stylesheet" href="css/skin/skin7.css">-->
    <!--<link rel="stylesheet" href="css/skin/skin8.css">-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="#" id="tromas">
    <?php head(); ?>
</head>
<body id="bg" style="">
<div id="layout" class="">


    <!-- Start Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <!-- Logo -->
                    <?php
                    $logoUrl = getOption('header_logo');
                    ?>
                    <div class="logo">
                        <a href="<?php echo _WEB_HOST_ROOT; ?>">
                            <?php if(!empty($logoUrl)): ?>
                            <img src="<?php echo $logoUrl; ?>" alt="logo">
                            <?php else: ?>
                            <h2 class="text-uppercase"><?php echo getOption('general_sitename'); ?></h2>
                            <?php endif; ?>
                        </a>
                    </div>
                    <!--/ End Logo -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <!-- Header Widget -->
                    <div class="header-widget">
                        <!-- Single Widget -->
                        <div class="single-widget">
                            <i class="fa fa-clock-o"></i>
                            <h4><?php echo getOption('general_time', 'label'); ?></h4>
                            <p><?php echo getOption('general_time'); ?></p>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget">
                            <i class="fa fa-envelope"></i>
                            <h4><?php echo getOption('general_email', 'label'); ?></h4>
                            <p><a href="mailto:<?php echo getOption('general_email'); ?>"><?php echo getOption('general_email'); ?></a></p>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget">
                            <i class="fa fa-phone"></i>
                            <h4><?php echo getOption('general_hotline', 'label'); ?></h4>
                            <p><?php echo getOption('general_hotline'); ?></p>
                        </div>
                        <!--/ End Single Widget -->
                    </div>
                    <!--/ End Header Widget -->
                </div>
            </div>
        </div>
        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="nav-area">
                            <!-- Main Menu -->
                            <nav class="mainmenu">
                                <div class="collapse navbar-collapse">
<!--                                    <ul class="nav navbar-nav">-->
<!--                                        <li class="active"><a href="#">Home</a></li>-->
<!--                                        <li><a href="about-us.html">About Us</a></li>-->
<!--                                        <li><a href="#">services<i class="fa fa-angle-down"></i></a>-->
<!--                                            <ul class="drop-down">-->
<!--                                                <li><a href="services.html">Our services</a></li>-->
<!--                                                <li><a href="service-single.html">service Single</a></li>-->
<!--                                            </ul>-->
<!--                                        </li>-->
<!--                                        <li><a href="#">Projects<i class="fa fa-angle-down"></i></a>-->
<!--                                            <ul class="drop-down">-->
<!--                                                <li><a href="projects.html">Projects</a></li>-->
<!--                                                <li><a href="project-single.html">Project Single</a></li>-->
<!--                                            </ul>-->
<!--                                        </li>-->
<!--                                        <li><a href="#">Blogs<i class="fa fa-angle-down"></i></a>-->
<!--                                            <ul class="drop-down">-->
<!--                                                <li><a href="blog-grid.html">Blogs Grid</a></li>-->
<!--                                                <li><a href="blog-single.html">Blog Single</a></li>-->
<!--                                            </ul>-->
<!--                                        </li>-->
<!--                                        <li><a href="contact.html">Contact</a></li>-->
<!--                                    </ul>-->
                                    <?php
                                        getMenu($menuDataArr);
                                    ?>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                            <!-- Social -->
                            <ul class="social">
                                <li><a target="_blank" href="<?php echo getOption('general_linkedin'); ?>"><i class="fa fa-linkedin"></i></a></li>
                                <li><a target="_blank" href="<?php echo getOption('general_facebook'); ?>"><i class="fa fa-facebook"></i></a></li>
                                <li class="active"><a target="_blank" href="<?php echo getOption('general_twitter'); ?>"><i class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="<?php echo getOption('general_youtube'); ?>"><i class="fa fa-youtube"></i></a></li>
                                <li><a target="_blank" href="<?php echo getOption('general_behance'); ?>"><i class="fa fa-behance"></i></a></li>
                            </ul>
                            <!--/ End Social -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!--/ End Header -->