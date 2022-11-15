<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập bài viết'
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
                    <label for=""><?php echo getOption('blog_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="blog_title" placeholder="<?php echo getOption('blog_title', 'label'); ?>..." value="<?php echo getOption('blog_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('blog_page_number', 'label'); ?></label>
                    <input type="text" class="form-control" name="blog_page_number" placeholder="<?php echo getOption('blog_page_number', 'label'); ?>..." value="<?php echo getOption('blog_page_number'); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);