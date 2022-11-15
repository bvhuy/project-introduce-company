<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách bình luận'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

$checkRoleStatus = checkCurrentPermission('status');
$checkRoleEdit = checkCurrentPermission('edit');
$checkRoleDelete = checkCurrentPermission('delete');

//Xử lý lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();

    //Xử lý lọc theo từ khoá
    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator (comments.name LIKE '%$keyword%' OR comments.email LIKE '%$keyword%' OR comments.content LIKE '%$keyword%')";

    }

    //Xử lý lọc theo user
    if (!empty($body['user_id'])) {
        $userId = $body['user_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator comments.user_id=$userId";
    }

    //Xử lý lọc dữ liệu
    if (!empty($body['status'])) {
        $status = $body['status'];
        if ($status == 2) {
            $statusSql = 0;
        } else {
            $statusSql = $status;
        }

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= " $operator comments.status = $statusSql";
    }
}

//Xử lý phân trang
$allCommentsNum = getRows("SELECT id FROM comments $filter");

//1. Xác định số lượng bản ghi trên một trang
$perPage = _PER_PAGE;

//2. Tính số trang của các bản ghi
$maxPage = ceil($allCommentsNum / $perPage);

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

//Lấy dữ liệu bình luận
$listComments = getRaw("SELECT comments.*, blogs.title AS blog_title, users.fullname AS user_fullname, users.email AS user_email FROM comments 
    INNER JOIN blogs ON comments.blog_id = blogs.id 
    LEFT JOIN users ON comments.user_id = users.id $filter ORDER BY comments.create_at DESC LIMIT $offset, $perPage");


//Lấy dữ liệu tất cả người dùng
$allUsers = getRaw("SELECT id, fullname, email FROM users ORDER BY fullname");
//Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=comments', '', $queryString);
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
            <form action="" method="get">
                <div class="row">
                    <div class="col-3">
                        <select name="user_id" class="form-control">
                            <option value="0">Chọn người dùng</option>
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
                            <select name="status" id="" class="form-control">
                                <option value="0">Chọn trạng thái</option>
                                <option value="1" <?php echo (!empty($status)) && $status == 1 ? 'selected' : false; ?>>
                                    Đã duyệt
                                </option>
                                <option value="2" <?php echo (!empty($status)) && $status == 2 ? 'selected' : false; ?>>
                                    Chưa duyệt
                                </option>
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
                <input type="hidden" name="module" value="comments">
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
                                    <th>Thông tin</th>
                                    <th>Nội dung</th>
                                    <?php if($checkRoleStatus): ?>
                                    <th width="15%">Trạng thái</th>
                                    <?php endif; ?>
                                    <th width="10%">Thời gian</th>
                                    <th width="15%">Bài viết</th>
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
                                if (!empty($listComments)):
                                    foreach ($listComments as $key => $item):
                                        if(!empty($item['user_id'])) {
                                            $item['name'] = $item['user_fullname'];
                                            $item['email'] = $item['user_email'];
                                            $listComments[$key] = $item;
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td>
                                                - Họ tên: <?php echo $item['name']; ?> <br>
                                                - Email: <?php echo $item['email']; ?> <br>
                                                <?php
                                                    if(!empty($item['parent_id'])):
                                                        $commentData = getComment($item['parent_id']);
                                                        if(!empty($commentData['name'])):
                                                            echo '- Trả lời: '.$commentData['name'];
                                                        endif;
                                                    endif;
                                                ?>
                                            </td>
                                            <td><?php echo getLimitText($item['content'], 5); ?></td>
                                            <?php if($checkRoleStatus): ?>
                                            <td class="text-center">
                                                <?php echo ($item['status'] == 1) ? '<button class="btn btn-success btn-sm">Đã duyệt</button>' : '<button class="btn btn-info btn-sm">Chưa duyệt</button>'; ?>
                                                <br>
                                                <?php echo ($item['status'] == 0) ? '<a href="'._WEB_HOST_ROOT_ADMIN.'?module=comments&action=status&id='.$item['id'].'&status=1">Duyệt</a>' : '<a href="'._WEB_HOST_ROOT_ADMIN.'?module=comments&action=status&id='.$item['id'].'&status=0" class="text-danger">Bỏ duyệt</a>' ?>
                                            </td>
                                            <?php endif; ?>
                                            <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></td>
                                            <td class="text-center">
                                                <a target="_blank" href="<?php echo getLinkModule('blogs', $item['blog_id']); ?>"><?php echo getLimitText($item['blog_title'], 5); ?></a>
                                            </td>
                                            <?php if($checkRoleEdit): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('comments', 'edit', ['id' => $item['id']]); ?>"
                                                   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a>
                                            </td>
                                            <?php endif; ?>
                                            <?php if($checkRoleDelete): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('comments', 'delete', ['id' => $item['id']]); ?>"
                                                   onclick=" return confirm('Bạn có chắc chắn muốn xoá?')"
                                                   class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-danger text-center">
                                                Không có bình luận
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
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=comments' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
                                        echo '<li class="page-item' . $active . '"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=comments' . $queryString . '&page=' . $index . '">' . $index . '</a></li>';
                                    }
                                    if ($page < $maxPage) {
                                        $nextPage = $page + 1;
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=comments' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
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
