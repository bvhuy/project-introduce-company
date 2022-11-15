<?php
if (!defined('_INCODE')) die('Access Deined...');

$data = [
    'pageTitle' => 'Danh sách dự án'
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
        $filter .= "$operator portfolios.user_id=$userId";
    }

    //Xử lý lọc theo từ khoá
    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator portfolios.name LIKE '%$keyword%'";

    }

    //Xử lý lọc theo danh mục dự án
    if (!empty($body['portfolio_category_id'])) {
        $portfolioCategoryId = $body['portfolio_category_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator portfolio_category_id=$portfolioCategoryId";
    }


}

//Xử lý phân trang
$allPortfolioNum = getRows("SELECT id FROM portfolios $filter");

//1. Xác định số lượng bản ghi trên một trang
$perPage = _PER_PAGE;

//2. Tính số trang của các bản ghi
$maxPage = ceil($allPortfolioNum / $perPage);

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

//Lấy dữ liệu dự án
$listPortfolios = getRaw("SELECT portfolios.id, portfolios.slug, portfolios.name as portfolio_name, portfolios.create_at, portfolios.user_id as portfolio_user_id, portfolio_categories.name as portfolio_categories_name, users.fullname as user_fullname, portfolio_categories.id as portfolio_category_id 
FROM portfolios INNER JOIN portfolio_categories ON portfolios.portfolio_category_id = portfolio_categories.id 
    INNER JOIN users ON portfolios.user_id = users.id $filter ORDER BY portfolios.create_at DESC LIMIT $offset, $perPage");


//Truy vấn lấy danh sách danh mục
$listPortfolioCategories = getRaw("SELECT id, name FROM portfolio_categories ORDER BY name ASC");

//Lấy dữ liệu tất cả người dùng
$allUsers = getRaw("SELECT id, fullname, email FROM users ORDER BY fullname");

//Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=portfolios', '', $queryString);
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
            <a href="<?php echo getLinkAdmin('portfolios', 'add'); ?>" class="btn btn-primary btn-sm"><i
                        class="fa fa-plus"></i> Thêm dự án</a>
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
                            <select name="portfolio_category_id" id="" class="form-control">
                                <option value="0">Chọn danh mục</option>
                                <?php
                                if (!empty($listPortfolioCategories)):
                                    foreach ($listPortfolioCategories as $item):
                                        $selected = (!empty($portfolioCategoryId) && $portfolioCategoryId == $item['id']) ? 'selected' : false;
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
                <input type="hidden" name="module" value="portfolios">
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
                                    <th>Tên</th>
                                    <th width="15%">Danh mục</th>
                                    <th width="15%">Đăng bởi</th>
                                    <th width="15%">Thời gian</th>
                                    <th width="10%">Xem</th>
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
                                if (!empty($listPortfolios)):
                                    foreach ($listPortfolios as $key => $item):
                                        ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td>
                                                <a href="<?php echo getLinkAdmin('portfolios', 'edit', ['id' => $item['id']]); ?>"><?php echo $item['portfolio_name']; ?></a>
                                                <?php if($checkRoleDuplicate): ?>
                                                <a href="<?php echo getLinkAdmin('portfolios', 'duplicate', ['id' => $item['id']]); ?>"
                                                   style="padding: 0 5px;" class="btn btn-danger btn-sm">Nhân bản</a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="?<?php echo getLinkQueryString('portfolio_category_id', $item['portfolio_category_id']); ?>"><?php echo $item['portfolio_categories_name']; ?></a>
                                            </td>
                                            <td>
                                                <a href="?<?php echo getLinkQueryString('user_id', $item['portfolio_user_id']); ?>"><?php echo $item['user_fullname']; ?></a>
                                            </td>
                                            <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></td>
                                            <td class="text-center">
                                                <a target="_blank" href="<?php echo getLinkModule('portfolios', $item['id']); ?>" class="btn btn-primary btn-sm">Xem</a>
                                            </td>
                                            <?php if($checkRoleEdit): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('portfolios', 'edit', ['id' => $item['id']]); ?>"
                                                   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a>
                                            </td>
                                            <?php endif; ?>
                                            <?php if($checkRoleDelete): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('portfolios', 'delete', ['id' => $item['id']]); ?>"
                                                   onclick=" return confirm('Bạn có chắc chắn muốn xoá?')"
                                                   class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-danger text-center">
                                                Không có dự án
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
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=portfolios' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
                                        echo '<li class="page-item' . $active . '"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=portfolios' . $queryString . '&page=' . $index . '">' . $index . '</a></li>';
                                    }
                                    if ($page < $maxPage) {
                                        $nextPage = $page + 1;
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=portfolios' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
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
