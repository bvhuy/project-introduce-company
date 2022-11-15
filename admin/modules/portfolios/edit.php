<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Cập nhật dự án'
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
    $portfolioId = $body['id'];
    //Kiểm tra portfolioId có tồn tại trong database hay không
    //Nếu tồn tại => lấy ra thông tin
    //Nếu không tồn tại => chuyển hướng về trang lists
    $portfolioDetail = firstRaw("SELECT * FROM portfolios WHERE id = $portfolioId");

    //Truy vấn lấy thư viện ảnh
    $galleryDetailArr = getRaw("SELECT * FROM portfolio_images WHERE portfolio_id = $portfolioId");
    $galleryData = [];
    $galleryIdsArr = []; //Lưu trữ id gallery trong db

    if(!empty($galleryDetailArr)) {
        foreach ($galleryDetailArr as $gallery) {
            $galleryData[] = $gallery['image'];
            $galleryIdsArr[] = $gallery['id'];
        }
    }

    if(!empty($portfolioDetail)) {
        //Tồn tại
        //Gán giá trị $userDetail vào flashData
        setFlashData('portfolioDetail', $portfolioDetail);
    } else {
        redirect('admin?module=portfolios');
    }
} else {
    redirect('admin?module=portfolios');
}

if(isPost()) {
    $body = getBody();
    $errors = [];

    //Validate tên dịch vụ: Bắt buộc nhập
    if(empty(trim($body['name']))) {
        $errors['name']['required'] = 'Tên dự án bắt buộc phải nhập';
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

    if(empty(trim($body['portfolio_category_id']))) {
        $errors['portfolio_category_id']['required'] = 'Vui lòng chọn danh mục';
    }

    //Validate ảnh dự án
    $galleryArr = !empty($body['gallery']) ? $body['gallery'] : [];
    if(!empty($galleryArr)) {
        foreach ($galleryArr as $key => $item) {
            if(empty(trim($item))) {
                $errors['gallery']['required'][$key] = 'Vui lòng chọn ảnh';
            }
        }
    }

    if(is_null($galleryArr)) {
        $galleryArr = [];
    }

    if(empty($errors)) {
        if(count($galleryArr) > count($galleryData)) {
            //insert những ảnh còn thiếu và update những ảnh thay đổi
            //$diff = array_diff($galleryArr, $galleryData);

            //$galleryData cũ, $galleryArr mới
            if(!empty($galleryData)) {
                foreach ($galleryData as $key => $item) {
                    $dataImages = [
                        'image' =>$galleryArr[$key],
                        'update_at' => date('Y-m-d H:i:s')
                    ];
                    //Update thự viện ảnh
                    //$condition = "image='$item'";
                    $condition = "id=".$galleryIdsArr[$key];
                    update('portfolio_images', $dataImages, $condition);
                }
            } else {
                $key = -1;
            }

            //Thêm ảnh vào mảng
            for($index = $key + 1; $index < count($galleryArr); $index++) {
                $dataImages = [
                    'image' => $galleryArr[$index],
                    'portfolio_id' => $portfolioId,
                    'create_at' => date('Y-m-d H:i:s')
                ];
                //Insert ảnh còn thiếu
                insert('portfolio_images', $dataImages);
            }
        } elseif(count($galleryArr) < count($galleryData)) {

            foreach ($galleryArr as $key => $item) {
                $dataImages = [
                    'image' => $item,
                    'update_at' => date('Y-m-d H:i:s')
                ];
                //Update thư viện ảnh
                //$condition = "image='".$galleryData[$key]."'";
                $condition = "id=".$galleryIdsArr[$key];
                update('portfolio_images', $dataImages, $condition);
            }

            if(is_null($key)) {
                $key = -1;
            }

            //Xoá ảnh
            for($index = $key + 1; $index < count($galleryData); $index++) {
                //Delete ảnh thừa
//                $condition = "image='".$galleryData[$index]."'";
                $condition = "id=".$galleryIdsArr[$index];
                delete('portfolio_images', $condition);
            }
        } else {

            foreach ($galleryData as $key => $item) {
                $dataImages = [
                    'image' =>$galleryArr[$key],
                    'update_at' => date('Y-m-d H:i:s')
                ];
                //Update thự viện ảnh
                $condition = "image='$item'";
                update('portfolio_images', $dataImages, $condition);
            }
        }

        $dataUpdate = [
            'name' => trim($body['name']),
            'slug' => trim($body['slug']),
            'thumbnail' => trim($body['thumbnail']),
            'description' => trim($body['description']),
            'video' => trim($body['video']),
            'content' => trim($body['content']),
            'portfolio_category_id' => trim($body['portfolio_category_id']),
            'update_at' => date('Y-m-d H:i:s')
        ];
        $condition = "id=$portfolioId";
        $updateStatus = update('portfolios', $dataUpdate, $condition);
        if($updateStatus) {

            setFlashData('msg', 'Cập nhật dự án thành công');
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
    redirect('admin?module=portfolios&action=edit&id='.$portfolioId); //Chuyển hướng đến trang hiện tại
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$portfolioDetail =getFlashData('portfolioDetail');
if(!empty($portfolioDetail) && empty($old)) {
    $old = $portfolioDetail;


    $old['gallery'] = $galleryData;
}

//Truy vấn lấy danh sách danh mục
$listPortfolioCategories = getRaw("SELECT id, name FROM portfolio_categories ORDER BY name ASC");
?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php getMsg($msg, $msgType); ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Tên dự án</label>
                    <input type="text" class="form-control slug" name="name" placeholder="Tên dự án..." value="<?php echo old('name', $old); ?>">
                    <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
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
                    <label for="">Ảnh dự án</label>
                    <div class="gallery-images">
                        <?php
                        $oldGallery = old('gallery', $old);
                        if(!empty($oldGallery)) {
                            $galleryErrors = !empty($errors['gallery']) ? $errors['gallery'] : false;
                            foreach ($oldGallery as $key => $item) {
                                ?>
                                <div class="gallery-item">
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="row ckfinder-group">
                                                <div class="col-10">
                                                    <input type="text" class="form-control image-render" name="gallery[]" placeholder="Đường dẫn ảnh..." value="<?php echo (!empty($item)) ? $item : false; ?>">
                                                </div>
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                                                </div>
                                            </div>
                                            <?php
                                            echo (!empty($galleryErrors['required'][$key])) ? '<span class="error">'.$galleryErrors['required'][$key].'</span>' : false;
                                            ?>
                                        </div>
                                        <div class="col-1">
                                            <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <p style="margin-top: 10px;"><a href="" class="btn btn-warning btn-sm add-gallery">Thêm ảnh</a></p>
                </div>
                <div class="form-group">
                    <label for="">Link video</label>
                    <input type="text" class="form-control" name="video" placeholder="Link video youtube..." value="<?php echo old('video', $old); ?>">
                    <?php echo form_error('video', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="portfolio_category_id">Danh mục</label>
                    <select name="portfolio_category_id" id="portfolio_category_id" class="form-control">
                        <option value="0">Chọn danh mục</option>
                        <?php
                        if(!empty($listPortfolioCategories)):
                            foreach ($listPortfolioCategories as $item):
                                $selected = (old('portfolio_category_id', $old) == $item['id']) ? 'selected': false;
                                echo '<option value="'.$item['id'].'" '.$selected.'>'.$item['name'].'</option>';
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <?php echo form_error('portfolio_category_id', $errors, '<span class="error">', '</span>'); ?>
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
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="<?php echo getLinkAdmin('portfolios'); ?>" class="btn btn-success">Quay lại</a>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);