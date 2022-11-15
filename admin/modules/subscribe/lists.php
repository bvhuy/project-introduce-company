<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách đăng ký nhận tin'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

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
        $filter .= " $operator email LIKE '%$keyword%'";

    }
}

//Xử lý phân trang
$allSubscribeNum = getRows("SELECT id FROM subscribe $filter");

//1. Xác định số lượng bản ghi trên một trang
$perPage = _PER_PAGE;

//2. Tính số trang của các bản ghi
$maxPage = ceil($allSubscribeNum / $perPage);

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

//Lấy dữ liệu trang
$listSubscribe = getRaw("SELECT * FROM subscribe $filter ORDER BY create_at DESC LIMIT $offset, $perPage");


//Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=subscribe', '', $queryString);
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
                    <div class="col-9">
                        <input type="search" class="form-control" name="keyword" placeholder="Từ khoá tìm kiếm..."
                               value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                    </div>
                </div>
                <input type="hidden" name="module" value="subscribe">
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
                                    <th>Email</th>
                                    <th width="10%">Thời gian</th>
                                    <th width="15%">Trạng thái</th>
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
                                if (!empty($listSubscribe)):
                                    foreach ($listSubscribe as $key => $item):
                                        ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo $item['email']; ?></td>
                                            <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></td>
                                            <td>
                                                <?php if($item['status'] == 0): ?>
                                                <button class="btn btn-warning btn-sm">Chưa xử lý</button>
                                                <?php elseif($item['status'] == 1): ?>
                                                <button class="btn btn-info btn-sm">Đang xử lý</button>
                                                <?php else:?>
                                                <button class="btn btn-success btn-sm">Đã xử lý</button>
                                                <?php endif;?>
                                            </td>
                                            <?php if($checkRoleEdit): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('subscribe', 'edit', ['id' => $item['id']]); ?>"
                                                   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a>
                                            </td>
                                            <?php endif; ?>
                                            <?php if($checkRoleDelete): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('subscribe', 'delete', ['id' => $item['id']]); ?>"
                                                   onclick=" return confirm('Bạn có chắc chắn muốn xoá?')"
                                                   class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert alert-danger text-center">
                                                Không có đăng ký
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
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=subscribe' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
                                        echo '<li class="page-item' . $active . '"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=subscribe' . $queryString . '&page=' . $index . '">' . $index . '</a></li>';
                                    }
                                    if ($page < $maxPage) {
                                        $nextPage = $page + 1;
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=subscribe' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
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
