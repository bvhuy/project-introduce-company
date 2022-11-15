<!-- Start Breadcrumbs -->
<section class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>
                    <?php
//                    echo (!empty($data['pageTitle'])) ? $data['pageTitle'] : false;
                    if(!empty($data['pageName'])) {
                        echo $data['pageName'];
                    } elseif (!empty($data['pageTitle'])) {
                        echo $data['pageTitle'];
                    }
                    ?>
                </h2>
                <ul class="bread-list">
                    <li><a href="<?php echo _WEB_HOST_ROOT; ?>">Trang chủ<i class="fa fa-angle-right"></i></a></li>
                    <?php
                        echo (!empty($data['itemParent'])) ? $data['itemParent'] : false;
                    ?>
                    <li class="active">
                        <a href="">
                            <?php
                                if(!empty($data['pageTitle'])) {
                                    echo (!empty($data['breadCrumbLimit'])) ? getLimitText($data['pageTitle'], $data['breadCrumbLimit']) : $data['pageTitle'];
                                }
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--/ End Breadcrumbs -->