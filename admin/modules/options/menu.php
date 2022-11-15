<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập menu'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền
$checkPermission = checkCurrentPermission();
if(!$checkPermission) {
    redirectPermission('admin');
}

if(isPost()) {
    //if(!empty(getBody())) {
        $body = getBody();
        if(isset($body['text'])) {
            unset($body['text']);
        }

        if(isset($body['href'])) {
            unset($body['href']);
        }

        if(isset($body['target'])) {
            unset($body['target']);
        }

        if(isset($body['title'])) {
            unset($body['title']);
        }

        if(isset($body['menu'])) {
            $menu = $body['menu'];
            $dataUpdate = ['menu' => $menu];
            updateOptions($dataUpdate);
        }
    //}

}



$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" id="frmEdit" class="form-horizontal">
                <?php getMsg($msg, $msgType); ?>
                <div class="row">
                    <div class="col-6">
                        <ul id="myEditor" class="sortableLists list-group">
                        </ul>
                    </div>
                    <div class="col-6">
                        <div class="card border-primary mb-3">
                            <div class="card-header bg-primary text-white">Quản lý</div>
                            <div class="card-body">
                                    <div class="form-group">
                                        <label for="text">Tiêu đề</label>
                                        <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Tiêu đề">
                                    </div>
                                    <div class="form-group">
                                        <label for="href">Link</label>
                                        <input type="text" class="form-control item-menu" id="href" name="href" placeholder="Link">
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Target</label>
                                        <select name="target" id="target" class="form-control item-menu">
                                            <option value="_self">Self</option>
                                            <option value="_blank">Blank</option>
                                            <option value="_top">Top</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Tooltip</label>
                                        <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                                    </div>
                                    <div class="form-group">
                                        <label for="active">Active</label>
                                        <select name="active" id="active" class="form-control item-menu">
                                            <option value="">No active</option>
                                            <option value="active">Active</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Cập nhật</button>
                                <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Thêm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea name="menu" id="menu-content" style="display: none"></textarea>
                <button type="submit" class="btn btn-primary save-menu">Lưu thay đổi</button>
                <a href="<?php echo getLinkAdmin('options', 'menu'); ?>" class="btn btn-danger">Huỷ</a>
                <hr>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script type="text/javascript">
        <?php
            $menuJson = getOption('menu') ;
            $menuJson = !empty($menuJson) ? html_entity_decode($menuJson) : '';
        ?>
        var arrayJson = <?php echo $menuJson; ?>;
    </script>
<?php

layout('footer', 'admin', $data);