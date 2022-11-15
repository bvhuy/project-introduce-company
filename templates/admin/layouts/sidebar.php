<?php
$user_id = isLogin()['user_id'];
$userDetail = getUserInfo($user_id);
//Avatar
$userEmail = $userDetail['email'];

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="brand-link text-center">
        <span class="brand-text font-weight-light text-uppercase">Tromas Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo getAvatar($userEmail, 200); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo getLinkAdmin('users', 'profile'); ?>" class="d-block"><?php echo $userDetail['fullname']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!--
                Trang tổng quan - Begin
                -->
                <li class="nav-item">
                    <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="nav-link <?php echo activeMenuSidebar('')  || !isset(getBody()['module']) ? 'active' : false; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Tổng quan
                        </p>
                    </a>
                </li>
                <!--
                Trang tổng quan - End
                -->
                <?php if(checkCurrentPermission('lists', 'groups')): ?>
                <!--
                Nhóm người dùng - Begin
                -->
                <li class="nav-item has-treeview <?php echo activeMenuSidebar('groups') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link <?php echo activeMenuSidebar('groups') ? 'active' : false; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Nhóm người dùng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('groups', 'lists'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <?php if(checkCurrentPermission('add', 'groups')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('groups', 'add'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!--
                Nhóm người dùng - End
                -->
                <?php endif; ?>
                <?php if(checkCurrentPermission('lists', 'users')): ?>
                <!--
                Quản lý người dùng - Begin
                -->
                <li class="nav-item has-treeview <?php echo activeMenuSidebar('users') && (!empty(getBody()['action']) && getBody()['action'] !== 'profile') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link <?php echo activeMenuSidebar('users') && (!empty(getBody()['action']) && getBody()['action'] !== 'profile') ? 'active' : false; ?>" >
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Quản lý người dùng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('users','lists'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <?php if(checkCurrentPermission('add', 'users')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('users', 'add'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!--
               Quản lý người dùng - End
               -->
                <?php endif; ?>
                <?php if(checkCurrentPermission('lists', 'services')): ?>
                <!--
                Quản lý dịch vụ - Begin
                -->
                <li class="nav-item has-treeview <?php echo activeMenuSidebar('services') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link <?php echo activeMenuSidebar('services') ? 'active' : false; ?>" >
                        <i class="nav-icon fab fa-servicestack"></i>
                        <p>
                            Quản lý dịch vụ
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('services','lists'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <?php if(checkCurrentPermission('add', 'services')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('services', 'add'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!--
               Quản lý dịch vụ - End
               -->
                <?php endif; ?>
                <?php if(checkCurrentPermission('lists', 'pages')): ?>
                <!--
                Quản lý trang - Begin
                -->
                <li class="nav-item has-treeview <?php echo activeMenuSidebar('pages') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link <?php echo activeMenuSidebar('pages') ? 'active' : false; ?>" >
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Quản lý trang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('pages','lists'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <?php if(checkCurrentPermission('add', 'pages')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('pages', 'add'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!--
               Quản lý trang - End
               -->
                <?php endif; ?>
                <?php if(checkCurrentPermission('lists', 'portfolios')): ?>
                <!--
                Quản lý dự án - Begin
                -->
                <li class="nav-item has-treeview <?php echo activeMenuSidebar('portfolios') || activeMenuSidebar('portfolio_categories') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link <?php echo activeMenuSidebar('portfolios') || activeMenuSidebar('portfolio_categories') ? 'active' : false; ?>" >
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p>
                            Quản lý dự án
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('portfolios','lists'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <?php if(checkCurrentPermission('add', 'portfolios')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('portfolios', 'add'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('lists', 'portfolio_categories')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('portfolio_categories', 'lists'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục dự án</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!--
               Quản lý dự án - End
               -->
                <?php endif; ?>
                <?php if(checkCurrentPermission('lists', 'blogs')): ?>
                <!--
                Quản lý bài viết - Begin
                -->
                <li class="nav-item has-treeview <?php echo activeMenuSidebar('blogs') || activeMenuSidebar('blog_categories') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link <?php echo activeMenuSidebar('blogs') || activeMenuSidebar('blog_categories') ? 'active' : false; ?>" >
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Quản lý bài viết
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('blogs','lists'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <?php if(checkCurrentPermission('add', 'blogs')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('blogs', 'add'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('lists', 'blog_categories')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('blog_categories', 'lists'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục bài viết</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!--
               Quản lý bài viết - End
               -->
                <?php endif; ?>
                <?php if(checkCurrentPermission('lists', 'contacts')): ?>
                <!--
                Quản lý liên hệ - Begin
                -->
                <li class="nav-item has-treeview <?php echo activeMenuSidebar('contacts') || activeMenuSidebar('contact_type') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link <?php echo activeMenuSidebar('contacts') || activeMenuSidebar('contact_type') ? 'active' : false; ?>" >
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>
                            Quản lý liên hệ <?php echo (getCountContacts() > 0) ? '<span class="badge badge-danger">'.getCountContacts().'</span>' : false; ?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('contacts','lists'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p> <?php echo (getCountContacts() > 0) ? '<span class="badge badge-danger">'.getCountContacts().'</span>' : false; ?>
                            </a>
                        </li>
                        <?php if(checkCurrentPermission('lists', 'contact_type')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('contact_type', 'lists'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý phòng ban</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!--
               Quản lý liên hệ - End
               -->
                <?php endif; ?>
                <?php if(checkCurrentPermission('lists', 'comments')): ?>
                <!--
                Quản lý bình luận - Begin
                -->
                <li class="nav-item">
                    <a href="<?php echo getLinkAdmin('comments','lists'); ?>" class="nav-link <?php echo activeMenuSidebar('comments') ? 'active' : false; ?>" >
                        <i class="nav-icon fas fa-comment-dots"></i>
                        <p>
                            Quản lý bình luận <?php echo (getCommentCount() > 0) ? '<span class="badge badge-danger">'.getCommentCount().'</span>' : false; ?>
                        </p>
                    </a>
                </li>
                <!--
               Quản lý bình luận - End
               -->
                <?php endif; ?>
                <?php if(checkCurrentPermission('lists', 'subscribe')): ?>
                <!--
                Quản lý đăng ký - Begin
                -->
                <li class="nav-item">
                    <a href="<?php echo getLinkAdmin('subscribe','lists'); ?>" class="nav-link <?php echo activeMenuSidebar('subscribe') ? 'active' : false; ?>" >
                        <i class="nav-icon fas fa-mail-bulk"></i>
                        <p>
                            Đăng ký nhận tin <?php echo (getSubscribeCount() > 0) ? '<span class="badge badge-danger">'.getSubscribeCount().'</span>' : false; ?>
                        </p>
                    </a>
                </li>
                <!--
               Quản lý đăng ký - End
               -->
                <?php endif; ?>
                <?php if(checkCurrentPermission('general', 'options')): ?>
                <!--
                Cấu hình chung - Begin
                -->
                <li class="nav-item has-treeview <?php echo activeMenuSidebar('options') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link <?php echo activeMenuSidebar('options') ? 'active' : false; ?>" >
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Cấu hình
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options','general'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập chung</p>
                            </a>
                        </li>
                        <?php if(checkCurrentPermission('header', 'options')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options', 'header'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Header</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('footer', 'options')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options', 'footer'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Footer</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('home', 'options')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options', 'home'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Trang chủ</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('about', 'options')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options', 'about'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Giới thiệu</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('team', 'options')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options', 'team'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Đội ngũ</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('service', 'options')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options', 'service'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Dịch vụ</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('portfolio', 'options')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options', 'portfolio'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Dự án</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('blog', 'options')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options', 'blog'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Bài viết</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('contact', 'options')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options', 'contact'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Liên hệ</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(checkCurrentPermission('menu', 'options')): ?>
                        <li class="nav-item">
                            <a href="<?php echo getLinkAdmin('options', 'menu'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập Menu</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!--
               Cấu hình chung - End
               -->
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">