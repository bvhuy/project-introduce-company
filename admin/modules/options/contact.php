<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập liên hệ'
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
                <h4>Thiết lập chung</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('contact_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="contact_title" placeholder="<?php echo getOption('contact_title', 'label'); ?>..." value="<?php echo getOption('contact_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('contact_description', 'label'); ?></label>
                    <textarea class="form-control" name="contact_description" placeholder="<?php echo getOption('contact_description', 'label'); ?>..."><?php echo getOption('contact_description'); ?></textarea>
                </div>
                <h4>Thiết lập thông tin liên hệ</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('contact_address_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="contact_address_title" placeholder="<?php echo getOption('contact_address_title', 'label'); ?>..." value="<?php echo getOption('contact_address_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('contact_address_description', 'label'); ?></label>
                    <textarea class="form-control" name="contact_address_description" placeholder="<?php echo getOption('contact_address_description', 'label'); ?>..."><?php echo getOption('contact_address_description'); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);