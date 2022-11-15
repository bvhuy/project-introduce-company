<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Danh sách phòng ban'
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

$view = 'add'; //Mặc định
$id = 0; //Id mặc định

//Xử lý lọc dữ liệu
$filter = '';
$body = getBody('get');
//Xử lý lọc theo từ khoá
if (!empty($body['keyword'])) {
    $keyword = $body['keyword'];
    $filter = "WHERE name LIKE '%$keyword%'";
}

if (!empty($body['view'])) {
    $view = $body['view'];
}
if (!empty($body['id'])) {
    $id = $body['id'];
}

//Xử lý phân trang
$allContactTypeNum = getRows("SELECT id FROM contact_type $filter");

//1. Xác định số lượng bản ghi trên một trang
$perPage = _PER_PAGE;

//2. Tính số trang của các bản ghi
$maxPage = ceil($allContactTypeNum / $perPage);

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

//Lấy dữ liệu danh sách phòng ban
$listContactType = getRaw("SELECT contact_type.id, name, contact_type.create_at, (SELECT count(contacts.id) FROM contacts WHERE contacts.type_id = contact_type.id) as contacts_count FROM contact_type $filter ORDER BY contact_type.create_at DESC LIMIT $offset, $perPage");

//Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=contact_type', '', $queryString);
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
            <?php getMsg($msg, $msgType); ?>
            <div class="row">
                <div class="col-6">
                    <?php
                    if (!empty($view) && !empty($id)) {
                        if($checkRoleEdit) {
                            require_once $view . '.php';
                        }
                    } else {
                        if($checkRoleAdd) {
                            require_once 'add.php';
                        }
                    }
                    ?>
                </div>
                <div class="col-6">
                    <h4>Danh sách phòng ban</h4>
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-9">
                                <input type="search" class="form-control" name="keyword"
                                       placeholder="Nhập tên phòng ban..."
                                       value="<?php echo (!empty($keyword)) ? $keyword : false; ?>">
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                            </div>
                        </div>
                        <input type="hidden" name="module" value="contact_type">
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th width="5%">STT</th>
                                            <th>Tên</th>
                                            <th width="20%">Thời gian</th>
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
                                        if (!empty($listContactType)):
                                            foreach ($listContactType as $key => $item):
                                                ?>
                                                <tr>
                                                    <td><?php echo $key + 1; ?></td>
                                                    <td>
                                                        <a href="<?php echo getLinkAdmin('contact_type', '', ['id' => $item['id'], 'view' => 'edit']); ?>"><?php echo $item['name']; ?></a> <?php echo '(' . $item['contacts_count'] . ')'; ?>
                                                        <?php if($checkRoleDuplicate): ?>
                                                        <a href="<?php echo getLinkAdmin('contact_type', 'duplicate', ['id' => $item['id']]); ?>"
                                                           style="padding: 0 5px;" class="btn btn-danger btn-sm">Nhân
                                                            bản</a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></td>
                                                    <?php if($checkRoleEdit): ?>
                                                    <td class="text-center">
                                                        <a href="<?php echo getLinkAdmin('contact_type', '', ['id' => $item['id'], 'view' => 'edit']); ?>"
                                                           class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    </td>
                                                    <?php endif; ?>
                                                    <?php if($checkRoleDelete): ?>
                                                    <td class="text-center">
                                                        <a href="<?php echo getLinkAdmin('contact_type', 'delete', ['id' => $item['id']]); ?>"
                                                           onclick=" return confirm('Bạn có chắc chắn muốn xoá?')"
                                                           class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; else: ?>
                                            <tr>
                                                <td colspan="5">
                                                    <div class="alert alert-danger text-center">
                                                        Không có danh sách phòng ban
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
                                                echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contact_type' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
                                                echo '<li class="page-item' . $active . '"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contact_type' . $queryString . '&page=' . $index . '">' . $index . '</a></li>';
                                            }
                                            if ($page < $maxPage) {
                                                $nextPage = $page + 1;
                                                echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=contact_type' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
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
