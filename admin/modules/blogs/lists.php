<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách bài viết'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

$checkRoleAdd = checkCurrentPermission('add');
$checkRoleEdit = checkCurrentPermission('edit');
$checkRoleDelete = checkCurrentPermission('delete');
$checkRoleDuplicate = checkCurrentPermission('duplicate');

//Xử lý lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();

    //Xử lý lọc dữ liệu
    //Xử lý lọc theo user
    if (!empty($body['user_id'])) {
        $userId = $body['user_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= "$operator blogs.user_id=$userId";
    }

    //Xử lý lọc theo từ khoá
    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator (title LIKE '%$keyword%' OR content LIKE '%$keyword%')";

    }

    //Xử lý lọc theo danh mục bài viết
    if (!empty($body['category_id'])) {
        $blogCategoryId = $body['category_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator category_id=$blogCategoryId";
    }


}

//Xử lý phân trang
$allBlogNum = getRows("SELECT id FROM blogs $filter");

//1. Xác định số lượng bản ghi trên một trang
$perPage = _PER_PAGE;

//2. Tính số trang của các bản ghi
$maxPage = ceil($allBlogNum / $perPage);

//3. Xử lý số trang dựa vào phương thức get
if (!empty($_GET['page'])) {
    $page = $body['page'];
    if ($page < 1 || $page > $maxPage) {
        $page = 1;
    }
} else {
    $page = 1;
}


$offset = ($page - 1) * $perPage;

//Lấy dữ liệu bài viết
$listBlogs = getRaw("SELECT blogs.id, title, view_count, blogs.slug, blogs.create_at, blogs.user_id as blog_user_id, blog_categories.name as blog_categories_name, users.fullname as user_fullname, blog_categories.id as category_id 
FROM blogs INNER JOIN blog_categories ON blogs.category_id = blog_categories.id 
    INNER JOIN users ON blogs.user_id = users.id $filter ORDER BY blogs.create_at DESC LIMIT $offset, $perPage");


//Truy vấn lấy danh sách danh mục
$listBlogCate = getRaw("SELECT id, name FROM blog_categories ORDER BY name ASC");

//Lấy dữ liệu tất cả người dùng
$allUsers = getRaw("SELECT id, fullname, email FROM users ORDER BY fullname");

//Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=blogs', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
    //var_dump(strpos($queryString, 'keyword'));
    if (strpos($queryString, 'keyword') !== false) {
        $queryString = '&' . $queryString;
    }

    if (strpos($queryString, 'lists') !== false) {
        $queryString = '&' . $queryString;
    }
}

//Gán lưu lại thông báo lỗi session
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if($checkRoleAdd): ?>
            <a href="<?php echo getLinkAdmin('blogs', 'add'); ?>" class="btn btn-primary btn-sm"><i
                        class="fa fa-plus"></i> Thêm bài viết</a>
            <hr>
            <?php endif; ?>
            <form action="" method="get">
                <div class="row">
                    <div class="col-3">
                        <select name="user_id" class="form-control">
                            <option value="0">Chọn người đăng</option>

                            <?php
                            if (!empty($allUsers)):
                                foreach ($allUsers as $item):
                                    $selected = (!empty($userId) && $userId == $item['id']) ? 'selected' : false;
                                    echo '<option value="' . $item['id'] . '" ' . $selected . '>' . $item['fullname'] . ' (' . $item['email'] . ')' . '</option>';
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <select name="category_id" id="" class="form-control">
                                <option value="0">Chọn danh mục</option>
                                <?php
                                if (!empty($listBlogCate)):
                                    foreach ($listBlogCate as $item):
                                        $selected = (!empty($blogCategoryId) && $blogCategoryId == $item['id']) ? 'selected' : false;
                                        echo '<option value="' . $item['id'] . '" ' . $selected . '>' . $item['name'] . '</option>';
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <input type="search" class="form-control" name="keyword" placeholder="Từ khoá tìm kiếm..."
                               value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                    </div>
                </div>
                <input type="hidden" name="module" value="blogs">
            </form>
            <hr>
            <?php getMsg($msg, $msgType); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th>Tiêu đề</th>
                                    <th width="15%">Danh mục</th>
                                    <th width="15%">Đăng bởi</th>
                                    <th width="15%">Thời gian</th>
                                    <?php if($checkRoleEdit): ?>
                                    <th width="10%">Sửa</th>
                                    <?php endif; ?>
                                    <?php if($checkRoleDelete): ?>
                                    <th width="10%">Xoá</th>
                                    <?php endif; ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($listBlogs)):
                                    foreach ($listBlogs as $key => $item):
                                        ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td>
                                                <a href="<?php echo getLinkAdmin('blogs', 'edit', ['id' => $item['id']]); ?>"><?php echo $item['title']; ?></a><br>
                                                <?php if($checkRoleDuplicate): ?>
                                                <a href="<?php echo getLinkAdmin('blogs', 'duplicate', ['id' => $item['id']]); ?>"
                                                   style="padding: 0 5px;" class="btn btn-danger btn-sm">Nhân bản</a>
                                                <?php endif; ?>
                                                <span class="btn btn-success btn-sm"
                                                      style="padding: 0 5px"><?php echo $item['view_count']; ?> lượt xem</span>
                                                <a target="_blank" href="<?php echo getLinkModule('blogs', $item['id']); ?>" class="btn btn-primary btn-sm"
                                                   style="padding: 0 5px">Xem</a>
                                            </td>
                                            <td>
                                                <a href="?<?php echo getLinkQueryString('category_id', $item['category_id']); ?>"><?php echo $item['blog_categories_name']; ?></a>
                                            </td>
                                            <td>
                                                <a href="?<?php echo getLinkQueryString('user_id', $item['blog_user_id']); ?>"><?php echo $item['user_fullname']; ?></a>
                                            </td>
                                            <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></td>
                                            <?php if($checkRoleEdit): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('blogs', 'edit', ['id' => $item['id']]); ?>"
                                                   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a>
                                            </td>
                                            <?php endif; ?>
                                            <?php if($checkRoleDelete): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('blogs', 'delete', ['id' => $item['id']]); ?>"
                                                   onclick=" return confirm('Bạn có chắc chắn muốn xoá?')"
                                                   class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-danger text-center">
                                                Không có bài viết
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                                <ul class="pagination pagination-sm">
                                    <?php
                                    if ($page > 1) {
                                        $prevPage = $page - 1;
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=blogs' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
                                    }
                                    $begin = $page - 2;
                                    if ($begin < 1) {
                                        $begin = 1;
                                    }
                                    $end = $page + 2;
                                    if ($end > $maxPage) {
                                        $end = $maxPage;
                                    }
                                    for ($index = $begin; $index <= $end; $index++) {
                                        $active = ($index == $page) ? ' active' : false;
                                        echo '<li class="page-item' . $active . '"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=blogs' . $queryString . '&page=' . $index . '">' . $index . '</a></li>';
                                    }
                                    if ($page < $maxPage) {
                                        $nextPage = $page + 1;
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=blogs' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                                    }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);
