<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => (!empty(getOption('blog_title'))) ? getOption('blog_title') : false
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);
if (isGet()) {
    $body = getBody();
    //Xử lý phân trang
    $allBlogNum = getRows("SELECT id FROM blogs");

    //1. Xác định số lượng bản ghi trên một trang
    $perPage = (!empty(getOption('blog_page_number'))) ? getOption('blog_page_number') : 0;

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
}

$blogLists = getRaw("SELECT blogs.*, blog_categories.name AS blog_categories_name FROM blogs INNER JOIN blog_categories ON blogs.category_id = blog_categories.id ORDER BY blogs.create_at DESC LIMIT $offset, $perPage");

?>
<!-- Start Blog -->
<section id="blog-main" class="blog-main archive grid section">
    <div class="container">
        <div class="row">
            <div class="blog-main">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="single-sidebar subscribe">
                        <h2><span>Tìm kiếm bài viết</span></h2>
                        <div class="single-widget subscribe">
                            <form method="get" action="<?php echo _WEB_HOST_ROOT.'/tim-kiem.html'; ?>">
                                <input type="search" name="keyword" placeholder="Nhập từ khoá tìm kiếm...">
                                <button type="submit">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <?php if(!empty($blogLists)): ?>
                        <?php foreach ($blogLists as $item): ?>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <!-- Single Post -->
                            <div class="single-blog">
                                <div class="blog-post">
                                    <div class="blog-head">
                                        <img src="<?php echo $item['thumbnail']; ?>" alt="#">
                                        <a class="link" href="<?php echo getLinkModule('blogs', $item['id']); ?>""><i class="fa fa-paper-plane"></i></a>
                                    </div>
                                    <div class="blog-info">
                                        <h2><a href="<?php echo getLinkModule('blogs', $item['id']); ?>"><?php echo $item['title']; ?></a></h2>
                                        <div class="meta">
                                            <span><i class="fa fa-list"></i><a href="<?php echo getLinkModule('blog_categories', $item['category_id']); ?>""><?php echo $item['blog_categories_name']; ?></a></span>
                                            <span><i class="fa fa-calendar-o"></i><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></span>
                                            <span><i class="fa fa-eye"></i><a href="#"><?php echo $item['view_count']; ?></a></span>
                                        </div>
                                        <?php echo html_entity_decode($item['description']); ?>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Single Post -->
                        </div>
                    <?php endforeach;?>
                    <?php endif;?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Start Pagination -->
                            <div class="pagination-main">
                                <ul class="pagination">
                                    <?php
                                    if ($page > 1) {
                                        $prevPage = $page - 1;
                                        echo '<li class="prev"><a class="fa fa-angle-double-left" href="'._WEB_HOST_ROOT.'/bai-viet-page-'.$prevPage.'.html"></a></li>';
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
                                        $active = ($index == $page) ? ' class="active"' : false;
                                        echo '<li'.$active.'><a href="'._WEB_HOST_ROOT.'/bai-viet-page-'.$index.'.html">' . $index . '</a></li>';
                                    }
                                    if ($page < $maxPage) {
                                        $nextPage = $page + 1;
                                        echo '<li class="next"><a class="fa fa-angle-double-right" href="'._WEB_HOST_ROOT.'/bai-viet-page-'.$nextPage.'.html"></a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!--/ End Pagination -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Blog -->
<?php
layout('footer', 'client', $data);
?>