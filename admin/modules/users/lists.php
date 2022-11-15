<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách người dùng'
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
$checkRoleChangePassword = checkCurrentPermission('change_password');
$checkRoleDelete = checkCurrentPermission('delete');
$checkRoleDuplicate = checkCurrentPermission('profile');

$userId = isLogin()['user_id'];

//Xử lý lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();

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

        $filter .= "$operator status = $statusSql";
    }

    //Xử lý lọc theo từ khoá
    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator fullname LIKE '%$keyword%'";

    }

    //Xử lý lọc theo group
    if (!empty($body['group_id'])) {
        $groupId = $body['group_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator group_id=$groupId";
    }
}

//Xử lý phân trang
$allUserNum = getRows("SELECT id FROM users $filter");

//1. Xác định số lượng bản ghi trên một trang
$perPage = _PER_PAGE;

//2. Tính số trang của các bản ghi
$maxPage = ceil($allUserNum / $perPage);

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

//Lấy dữ liệu người dùng
$listUsers = getRaw("SELECT users.id, fullname, email, status, users.create_at, `groups`.name as group_name FROM users INNER JOIN `groups` ON users.group_id = `groups`.id $filter ORDER BY users.create_at DESC LIMIT $offset, $perPage");


//Truy vấn lấy danh sách nhóm
$listGroups = getRaw("SELECT id, name FROM `groups` ORDER BY name ASC");

//Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=users', '', $queryString);
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
            <a href="<?php echo getLinkAdmin('users', 'add'); ?>" class="btn btn-primary btn-sm"><i
                        class="fa fa-plus"></i> Thêm người dùng</a>
            <hr>
            <?php endif; ?>
            <form action="" method="get">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <select name="status" id="" class="form-control">
                                <option value="0">Chọn trạng thái</option>
                                <option value="1" <?php echo (!empty($status)) && $status == 1 ? 'selected' : false; ?>>
                                    Kích hoạt
                                </option>
                                <option value="2" <?php echo (!empty($status)) && $status == 2 ? 'selected' : false; ?>>
                                    Chưa kích hoạt
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <select name="group_id" id="" class="form-control">
                                <option value="0">Chọn nhóm</option>
                                <?php
                                if (!empty($listGroups)):
                                    foreach ($listGroups as $item):
                                        $selected = (!empty($groupId) && $groupId == $item['id']) ? 'selected' : false;
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
                <input type="hidden" name="module" value="users">
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
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Nhóm</th>
                                    <th width="15%">Thời gian</th>
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
                                if (!empty($listUsers)):
                                    foreach ($listUsers as $key => $item):
                                        ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td>
                                                <a href="<?php echo getLinkAdmin('users', 'edit', ['id' => $item['id']]); ?>"><?php echo $item['fullname']; ?></a>
                                            </td>
                                            <td><?php echo $item['email']; ?></td>
                                            <td><?php echo $item['group_name']; ?></td>
                                            <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></td>
                                            <td><?php echo ($item['status'] == 1) ? '<button class="btn btn-success btn-sm">Kích hoạt</button>' : '<button class="btn btn-warning btn-sm">Chưa kích hoạt</button>'; ?></td>
                                            <?php if($checkRoleEdit): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('users', 'edit', ['id' => $item['id']]); ?>"
                                                   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a>
                                            </td>
                                            <?php endif; ?>
                                            <?php if($checkRoleDelete): ?>
                                            <td class="text-center">
                                                <?php if ($item['id'] !== $userId): ?>
                                                    <a href="<?php echo getLinkAdmin('users', 'delete', ['id' => $item['id']]); ?>"
                                                       onclick=" return confirm('Bạn có chắc chắn muốn xoá?')"
                                                       class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
                                                <?php endif; ?>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-danger text-center">
                                                Không có người dùng
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
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=users' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
                                        echo '<li class="page-item' . $active . '"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=users' . $queryString . '&page=' . $index . '">' . $index . '</a></li>';
                                    }
                                    if ($page < $maxPage) {
                                        $nextPage = $page + 1;
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=users' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
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
