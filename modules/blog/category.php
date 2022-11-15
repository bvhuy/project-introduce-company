<?php
if(!defined('_INCODE')) die('Access Deined...');

if(!empty(getBody()['id'])) {
    $categoryId = getBody()['id'];
    $category = firstRaw("SELECT * FROM blog_categories WHERE id = $categoryId");
    if(empty($category)) {
        redirectError();
    }
} else {
    redirectError();
}
$data = [
    'pageTitle' => (!empty($category['name'])) ? $category['name'] : false,
    'itemParent' => '<li><a href="'._WEB_HOST_ROOT.'/?module=blog'.'">'.getOption('blog_title').'<i class="fa fa-angle-right"></i></a></li>'
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

if (isGet()) {
    $body = getBody();
    //Xử lý phân trang
    $allBlogNum = getRows("SELECT id FROM blogs WHERE category_id = $categoryId");

    //1. Xác định số lượng bản ghi trên một trang
    $perPage = _PER_PAGE;

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

$blogLists = getRaw("SELECT blogs.*, blog_categories.name AS blog_categories_name FROM blogs INNER JOIN blog_categories ON blogs.category_id = blog_categories.id WHERE blogs.category_id = $categoryId ORDER BY blogs.create_at DESC LIMIT $offset, $perPage");
if(!empty($blogLists)):
    ?>
    <!-- Start Blog -->
    <section id="blog-main" class="blog-main archive grid section">
        <div class="container">
            <div class="row">
                <div class="blog-main">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <?php foreach ($blogLists as $item): ?>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <!-- Single Post -->
                                    <div class="single-blog">
                                        <div class="blog-post">
                                            <div class="blog-head">
                                                <img src="<?php echo $item['thumbnail']; ?>" alt="#">
                                                <a class="link" href="<?php echo getLinkModule('blogs', $item['id']); ?>"><i class="fa fa-paper-plane"></i></a>
                                            </div>
                                            <div class="blog-info">
                                                <h2><a href="<?php echo getLinkModule('blogs', $item['id']); ?>"><?php echo $item['title']; ?></a></h2>
                                                <div class="meta">
                                                    <span><i class="fa fa-list"></i><a href="<?php echo getLinkModule('blog_categories', $item['category_id']); ?>"><?php echo $item['blog_categories_name']; ?></a></span>
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
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Start Pagination -->
                                <div class="pagination-main">
                                    <ul class="pagination">
                                        <?php
                                        $categoryLink = getLinkModule('blog_categories', $categoryId);
                                        if ($page > 1) {
                                            $prevPage = $page - 1;
                                            $paginationLink = str_replace('.html', '-page-'.$prevPage, $categoryLink);
                                            echo '<li class="prev"><a class="fa fa-angle-double-left" href="' .$paginationLink. '"></a></li>';
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
                                            $paginationLink = str_replace('.html', '-page-'.$index, $categoryLink);
                                            echo '<li'.$active.'><a href="' . $paginationLink . '">' . $index . '</a></li>';
                                        }
                                        if ($page < $maxPage) {
                                            $nextPage = $page + 1;
                                            $paginationLink = str_replace('.html', '-page-'.$nextPage, $categoryLink);
                                            echo '<li class="next"><a class="fa fa-angle-double-right" href="' . $paginationLink . '"></a></li>';
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
endif;
layout('footer', 'client', $data);
?>