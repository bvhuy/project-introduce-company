<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => '404 Not Found'
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);
?>
<section class="error-page section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">

                <div class="error-inner">
                    <h1>404<span>Page Not Found</span></h1>
                    <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula </p>
                    <a class="btn primary" href="<?php echo _WEB_HOST_ROOT; ?>"><i class="fa fa-long-arrow-left"></i>Go to home</a>
                </div>

            </div>
        </div>
    </div>
</section>
<?php
require_once _WEB_PATH_ROOT . '/modules/home/contents/call_to_action.php';
layout('footer', 'client', $data);
