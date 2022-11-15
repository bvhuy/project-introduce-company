<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập Footer'
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
            <?php getMsg($msg, $msgType); ?>
            <form action="" method="post">
                <h4>Thiết lập cột 1</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('footer_1_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="footer_1_title" placeholder="<?php echo getOption('footer_1_title', 'label'); ?>..." value="<?php echo getOption('footer_1_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('footer_1_description', 'label'); ?></label>
                    <textarea class="form-control editor" name="footer_1_description" placeholder="Mô tả..."><?php echo getOption('footer_1_description'); ?></textarea>
                </div>
                <h4>Thiết lập cột 2</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('footer_2_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="footer_2_title" placeholder="<?php echo getOption('footer_2_title', 'label'); ?>..." value="<?php echo getOption('footer_2_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('footer_2_description', 'label'); ?></label>
                    <textarea class="form-control editor" name="footer_2_description" placeholder="Mô tả..."><?php echo getOption('footer_2_description'); ?></textarea>
                </div>
                <h4>Thiết lập cột 3</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('footer_3_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="footer_3_title" placeholder="<?php echo getOption('footer_3_title', 'label'); ?>..." value="<?php echo getOption('footer_3_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('footer_3_twitter', 'label'); ?></label>
                    <input type="text" class="form-control" name="footer_3_twitter" placeholder="<?php echo getOption('footer_3_twitter', 'label'); ?>..." value="<?php echo getOption('footer_3_twitter'); ?>">
                </div>
                <h4>Thiết lập cột 4</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('footer_4_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="footer_4_title" placeholder="<?php echo getOption('footer_4_title', 'label'); ?>..." value="<?php echo getOption('footer_4_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('footer_4_description', 'label'); ?></label>
                    <textarea class="form-control editor" name="footer_4_description" placeholder="<?php echo getOption('footer_4_description', 'label'); ?>..."><?php echo getOption('footer_4_description'); ?></textarea>
                </div>
                <h4>Thiết lập Copyright</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('footer_copyright', 'label'); ?></label>
                    <textarea class="form-control editor" name="footer_copyright" placeholder="<?php echo getOption('footer_copyright', 'label'); ?>..."><?php echo getOption('footer_copyright'); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);