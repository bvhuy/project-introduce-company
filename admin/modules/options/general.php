<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập chung'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

updateOptions();

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post">
                <?php getMsg($msg, $msgType); ?>
                <h4>Thông tin chung</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_sitename', 'label'); ?></label>
                    <input type="text" class="form-control" name="general_sitename" placeholder="<?php echo getOption('general_sitename', 'label'); ?>..." value="<?php echo getOption('general_sitename'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_description', 'label'); ?></label>
                    <textarea class="form-control" name="general_description" placeholder="<?php echo getOption('general_description', 'label'); ?>..."><?php echo getOption('general_description'); ?></textarea>
                </div>
                <h4>Thông tin liên hệ</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_hotline', 'label'); ?></label>
                    <input type="text" class="form-control" name="general_hotline" placeholder="<?php echo getOption('general_hotline', 'label'); ?>..." value="<?php echo getOption('general_hotline'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_email', 'label'); ?></label>
                    <input type="text" class="form-control" name="general_email" placeholder="<?php echo getOption('general_email', 'label'); ?>..." value="<?php echo getOption('general_email'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_time', 'label'); ?></label>
                    <input type="text" class="form-control" name="general_time" placeholder="<?php echo getOption('general_time', 'label'); ?>..." value="<?php echo getOption('general_time'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_address', 'label'); ?></label>
                    <input type="text" class="form-control" name="general_address" placeholder="<?php echo getOption('general_address', 'label'); ?>..." value="<?php echo getOption('general_address'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_linkedin', 'label'); ?></label>
                    <input type="text" class="form-control" name="general_linkedin" placeholder="<?php echo getOption('general_linkedin', 'label'); ?>..." value="<?php echo getOption('general_linkedin'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_facebook', 'label'); ?></label>
                    <input type="text" class="form-control" name="general_facebook" placeholder="<?php echo getOption('general_facebook', 'label'); ?>..." value="<?php echo getOption('general_facebook'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_twitter', 'label'); ?></label>
                    <input type="text" class="form-control" name="general_twitter" placeholder="<?php echo getOption('general_twitter', 'label'); ?>..." value="<?php echo getOption('general_twitter'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_youtube', 'label'); ?></label>
                    <input type="text" class="form-control" name="general_youtube" placeholder="<?php echo getOption('general_youtube', 'label'); ?>..." value="<?php echo getOption('general_youtube'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('general_behance', 'label'); ?></label>
                    <input type="text" class="form-control" name="general_behance" placeholder="<?php echo getOption('general_behance', 'label'); ?>..." value="<?php echo getOption('general_behance'); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);