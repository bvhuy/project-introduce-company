<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập giới thiệu'
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
                <h4>Thiết lập tiêu đề</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('about_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="about_title" placeholder="<?php echo getOption('about_title', 'label'); ?>..." value="<?php echo getOption('about_title'); ?>">
                </div>

                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);