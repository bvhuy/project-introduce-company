<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật bài viết'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}


//Lấy dữ liệu cũ của dự án
$body = getBody('get');
if(!empty($body['id'])) {
    $blogId = $body['id'];
    //Kiểm tra blogId có tồn tại trong database hay không
    //Nếu tồn tại => lấy ra thông tin
    //Nếu không tồn tại => chuyển hướng về trang lists
    $blogDetail = firstRaw("SELECT * FROM blogs WHERE id = $blogId");
    if(!empty($blogDetail)) {
        //Tồn tại
        //Gán giá trị $blogDetail vào flashData
        setFlashData('blogDetail', $blogDetail);
    } else {
        redirect('admin?module=blogs');
    }
} else {
    redirect('admin?module=blogs');
}

if(isPost()) {
    $body = getBody();
    $errors = [];

    //Validate tên dịch vụ: Bắt buộc nhập
    if(empty(trim($body['title']))) {
        $errors['title']['required'] = 'Tiêu đề bài viết bắt buộc phải nhập';
    }

    //Validate slug: Bắt buộc nhập
    if(empty(trim($body['slug']))) {
        $errors['slug']['required'] = 'Đường dẫn tĩnh bắt buộc phải nhập';
    }

    //Validate thumbnail: Bắt buộc nhập
    if(empty(trim($body['thumbnail']))) {
        $errors['thumbnail']['required'] = 'Ảnh đại điện bắt buộc phải chọn';
    }

    //Validate nội dung: Bắt buộc nhập
    if(empty(trim($body['content']))) {
        $errors['content']['required'] = 'Nội dung bắt buộc phải nhập';
    }

    if(empty(trim($body['category_id']))) {
        $errors['category_id']['required'] = 'Vui lòng chọn danh mục';
    }

    if(empty($errors)) {
        $dataUpdate = [
            'title' => trim($body['title']),
            'slug' => trim($body['slug']),
            'thumbnail' => trim($body['thumbnail']),
            'description' => trim($body['description']),
            'content' => trim($body['content']),
            'category_id' => trim($body['category_id']),
            'popular' => trim($body['popular']),
            'update_at' => date('Y-m-d H:i:s')
        ];
        $condition = "id=$blogId";
        $updateStatus = update('blogs', $dataUpdate, $condition);
        if($updateStatus) {
            setFlashData('msg', 'Cập nhật bài viết thành công');
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
    redirect('admin?module=blogs&action=edit&id='.$blogId); //Chuyển hướng đến trang hiện tại
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$blogDetail =getFlashData('blogDetail');
if(!empty($blogDetail) && empty($old)) {
    $old = $blogDetail;
}

//Truy vấn lấy danh sách danh mục
$listBlogCate = getRaw("SELECT id, name FROM blog_categories ORDER BY name ASC");
?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php getMsg($msg, $msgType); ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control slug" name="title" placeholder="Tiêu đề..." value="<?php echo old('title', $old); ?>">
                    <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn tĩnh</label>
                    <input type="text" class="form-control render-slug" name="slug" placeholder="Đường dẫn tĩnh..." value="<?php echo old('slug', $old); ?>">
                    <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
                    <p class="render-link"><b>Link</b>:  <span></span></p>
                </div>
                <div class="form-group">
                    <label for="">Ảnh đại diện</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="thumbnail" placeholder="Đường dẫn ảnh..." value="<?php echo old('thumbnail', $old); ?>">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                        </div>
                    </div>
                    <?php echo form_error('thumbnail', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="category_id">Danh mục</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="0">Chọn danh mục</option>
                        <?php
                        if(!empty($listBlogCate)):
                            foreach ($listBlogCate as $item):
                                $selected = (old('category_id', $old) == $item['id']) ? 'selected': false;
                                echo '<option value="'.$item['id'].'" '.$selected.'>'.$item['name'].'</option>';
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <?php echo form_error('category_id', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Mô tả ngắn</label>
                    <textarea name="description" class="form-control" placeholder="Mô tả ngắn..."><?php echo old('description', $old); ?></textarea>
                    <?php echo form_error('description', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea name="content" class="form-control editor"><?php echo old('content', $old); ?></textarea>
                    <?php echo form_error('content', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="popular">Nổi bật</label>
                    <select name="popular" id="popular" class="form-control">
                        <option value="0" <?php echo (old('popular', $old) == 0) ? 'selected' : false; ?>>Không nổi bật</option>
                        <option value="1" <?php echo (old('popular', $old) == 1) ? 'selected' : false; ?>>Nổi bật</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="<?php echo getLinkAdmin('blogs'); ?>" class="btn btn-success">Quay lại</a>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);