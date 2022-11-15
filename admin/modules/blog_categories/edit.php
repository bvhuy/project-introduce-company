<?php
if (!defined('_INCODE')) die('Access Deined...');
//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}
$checkRoleEdit = checkCurrentPermission('edit');
if($checkRoleEdit) {

//Lấy dữ liệu cũ của danh mục bài viết
$body = getBody('get');
if(!empty($body['id'])) {
    $blogCategoryId = $body['id'];
    //Kiểm tra $cateId có tồn tại trong db hay không
    //Nếu tồn tại => lấy ra thông tin
    //Không tồn tại => chuyển hướng về trang list
    $blogCategoryDetail = firstRaw("SELECT * FROM blog_categories WHERE id = $blogCategoryId");
    if(!empty($blogCategoryDetail)) {
        setFlashData('blogCategoryDetail', $blogCategoryDetail);
    } else {
        redirect('admin?module=blog_categories');
    }
} else {
    redirect('admin?module=blog_categories');
}

if(isPost()) {
    $body = getBody();
    $errors = [];
    if(empty(trim($body['name']))) {
        $errors['name']['required'] = 'Tên danh mục bắt buộc phải nhập';
    } else {
        if(strlen(trim($body['name'])) < 4) {
            $errors['name']['min'] = 'Tên danh mục >=4 ký tự';
        }
    }

    //Validate slug: Bắt buộc nhập
    if(empty(trim($body['slug']))) {
        $errors['slug']['required'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
    }

    if(empty($errors)) {
        $dataUpdate = [
            'name' => trim($body['name']),
            'slug' => trim($body['slug']),
            'update_at' => date('Y-m-d H:i:s')
        ];
        $condition = "id=$blogCategoryId";
        $updatetStatus = update('blog_categories', $dataUpdate, $condition);
        if($updatetStatus) {
            setFlashData('msg', 'Cập nhật danh mục bài viết thành công');
            setFlashData('msg_type', 'success');

        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');
        }
    } else {
        //Có lỗi xảy ra
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
    }
    redirect('admin?module=blog_categories&action=lists&view=edit&id='.$blogCategoryId); //Load lại trang thêm người dùng
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$blogCategoryDetail = getFlashData('blogCategoryDetail');
if(!empty($blogCategoryDetail) && empty($old)) {
    $old = $blogCategoryDetail;
}
?>
<h4>Cập nhật danh mục</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="name">Tên danh mục</label>
        <input type="text" name="name" class="form-control slug" id="name" placeholder="Tên danh mục..." value="<?php echo old('name', $old); ?>" autofocus>
        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
    </div>
    <div class="form-group">
        <label for="">Đường dẫn tĩnh</label>
        <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..." value="<?php echo old('slug', $old); ?>">
        <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
        <p class="render-link"><b>Link</b>:  <span></span></p>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="<?php echo getLinkAdmin('blog_categories'); ?>" class="btn btn-success">Quay lại</a>
</form>

<?php
}