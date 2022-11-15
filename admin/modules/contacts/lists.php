<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách liên hệ'
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

    //Xử lý lọc dữ liệu
    if (!empty($body['status'])) {
        $status = $body['status'];
        if ($status == 1) {
            $statusSql = 0;
        } elseif ($status == 3) {
            $statusSql = 1;
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
        $filter .= " $operator (message LIKE '%$keyword%' OR fullname LIKE '%$keyword%' OR email LIKE '%$keyword%')";

    }

    //Xử lý lọc theo phòng ban
    if (!empty($body['type_id'])) {
        $typeId = $body['type_id'];
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator type_id=$typeId";
    }
}

//Xử lý phân liên hệ
$allContactNum = getRows("SELECT id FROM contacts $filter");

//1. Xác định số lượng bản ghi trên một liên hệ
$perPage = _PER_PAGE;

//2. Tính số liên hệ của các bản ghi
$maxPage = ceil($allContactNum / $perPage);

//3. Xử lý số liên hệ dựa vào phương thức get
if (!empty($_GET['page'])) {
    $page = $body['page'];
    if ($page < 1 || $page > $maxPage) {
        $page = 1;
    }
} else {
    $page = 1;
}


$offset = ($page - 1) * $perPage;

//Lấy dữ liệu liên hệ
$listContacts = getRaw("SELECT contacts.id, fullname, email, message, note, status, contacts.create_at, type_id, contact_type.name as contact_type_name FROM contacts INNER JOIN contact_type ON contacts.type_id = contact_type.id $filter ORDER BY contacts.create_at DESC LIMIT $offset, $perPage");
//Lấy dữ liệu tất cả phòng ban
$allContactType = getRaw("SELECT id, name FROM contact_type ORDER BY name");
//Xử lý query string tìm kiếm với phân liên hệ
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=contacts', '', $queryString);
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
                        <div class="form-group">
                            <select name="status" id="" class="form-control">
                                <option value="0">Chọn trạng thái</option>
                                <option value="1" <?php echo (!empty($status)) && $status == 1 ? 'selected' : false; ?>>
                                    Chưa xử lý
                                </option>
                                <option value="3" <?php echo (!empty($status)) && $status == 3 ? 'selected' : false; ?>>
                                    Đang xử lý
                                </option>
                                <option value="2" <?php echo (!empty($status)) && $status == 2 ? 'selected' : false; ?>>
                                    Đã xử lý
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <select name="type_id" class="form-control">
                            <option value="0">Chọn phòng ban</option>
                            <?php
                            if (!empty($allContactType)):
                                foreach ($allContactType as $item):
                                    $selected = (!empty($typeId) && $typeId == $item['id']) ? 'selected' : false;
                                    echo '<option value="' . $item['id'] . '" ' . $selected . '>' . $item['name'].'</option>';
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="search" class="form-control" name="keyword" placeholder="Nhập nội dung, họ tên, email người liên hệ..."
                               value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                    </div>
                </div>
                <input type="hidden" name="module" value="contacts">
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
                                    <th width="15%">Thông tin</th>
                                    <th>Nội dung liên hệ</th>
                                    <th width="15%">Trạng thái</th>
                                    <th>Ghi chú</th>
                                    <th width="10%">Thời gian</th>
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
                                if (!empty($listContacts)):
                                    foreach ($listContacts as $key => $item):
                                        ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td>
                                                Họ tên: <?php echo $item['fullname']; ?><br>
                                                Email: <?php echo $item['email']; ?><br>
                                                Phòng ban: <a href="?<?php echo getLinkQueryString('type_id', $item['type_id']); ?>"><?php echo $item['contact_type_name']; ?></a>
                                            </td>
                                            <td><?php echo $item['message']; ?></td>
                                            <td>
                                                <?php
                                                if($item['status'] == 2):
                                                    echo '<button class="btn btn-success btn-sm">Đã xử lý</button>';
                                                elseif($item['status'] == 1):
                                                    echo '<button class="btn btn-primary btn-sm">Đang xử lý</button>';
                                                else:
                                                    echo '<button class="btn btn-warning btn-sm">Chưa xử lý</button>';
                                                endif;
                                                ?>
                                            </td>
                                            <td><?php echo $item['note']; ?></td>
                                            <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></td>
                                            <?php if($checkRoleEdit): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('contacts', 'edit', ['id' => $item['id']]); ?>"
                                                   class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a>
                                            </td>
                                            <?php endif; ?>
                                            <?php if($checkRoleDelete): ?>
                                            <td class="text-center">
                                                <a href="<?php echo getLinkAdmin('contacts', 'delete', ['id' => $item['id']]); ?>"
                                                   onclick=" return confirm('Bạn có chắc chắn muốn xoá?')"
                                                   class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-danger text-center">
                                                Không có liên hệ
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
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contacts' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
                                        echo '<li class="page-item' . $active . '"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contacts' . $queryString . '&page=' . $index . '">' . $index . '</a></li>';
                                    }
                                    if ($page < $maxPage) {
                                        $nextPage = $page + 1;
                                        echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contacts' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
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
