<?php
if(!defined('_INCODE')) die('Access Deined...');

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

//Lấy dữ liệu cũ của nhóm người dùng
$body = getBody('get');
if(!empty($body['id'])) {
    $groupId = $body['id'];
    //Kiểm tra groupId có tồn tại trong db hay không
    //Nếu tồn tại => lấy ra thông tin
    //Không tồn tại => chuyển hướng về trang list
    $groupDetail = firstRaw("SELECT * FROM `groups` WHERE id = $groupId");
    if(!empty($groupDetail)) {
        setFlashData('groupDetail', $groupDetail);
    } else {
        redirect('admin?module=groups');
    }
} else {
    redirect('admin?module=groups');
}

$data = [
    'pageTitle' => 'Phân quyền: '.$groupDetail['name']
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);



if(isPost()) {
    $body = getBody();
    $errors = [];

    if(empty($errors)) {
        if(!empty($body['permissions'])) {
            $permissionsJson = json_encode($body['permissions']);
        } else {
            $permissionsJson = '';
        }

        $dataUpdate = [
            'permission' => trim($permissionsJson)
        ];
        $condition = "id=$groupId";
        $updateStatus = update('groups', $dataUpdate,  $condition);
        if($updateStatus) {
            setFlashData('msg', 'Phân quyền thành công');
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
    redirect('admin?module=groups&action=permission&id='.$groupId); //Load lại trang phân quyền nhóm người dùng
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$groupDetail = getFlashData('groupDetail');
if(!empty($groupDetail) && empty($old)) {
    $old = $groupDetail;
}

//Lấy danh sách module
$moduleLists = getRaw("SELECT * FROM modules");

if(!empty($old['permission'])) {
    $permissionsJson = $old['permission'];
    $permissionsArr = json_decode($permissionsJson, true);
}

?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php getMsg($msg, $msgType); ?>
            <form action="" method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap permission-lists">
                                    <thead>
                                    <tr>
                                        <th width="25%">Module</th>
                                        <th>Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty($moduleLists)): ?>
                                    <?php foreach($moduleLists as $item): ?>
                                    <?php
                                        $actions = $item['action'];
                                        $actionsArr = [];
                                        if(!empty($actions)) {
                                            $actionsArr = json_decode($actions, true);
                                        }
                                    ?>
                                    <tr>
                                        <td><strong><?php echo $item['title']; ?></strong></td>
                                        <td>
                                            <div class="row">
                                                <?php foreach ($actionsArr as $roleKey => $roleTitle): ?>
                                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                                    <input type="checkbox" name="<?php echo 'permissions['.$item['name'].'][]'; ?>" id="<?php echo $item['name'].'_'.$roleKey; ?>" value="<?php echo $roleKey; ?>" <?php echo (!empty($permissionsArr[$item['name']]) && in_array($roleKey, $permissionsArr[$item['name']])) ? 'checked' : false; ?>> <label for="<?php echo $item['name'].'_'.$roleKey; ?>"><?php echo $roleTitle; ?></label>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Phân quyền</button>
                <a href="<?php echo getLinkAdmin('groups'); ?>" class="btn btn-success">Quay lại</a>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);