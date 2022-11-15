<?php
if(!defined('_INCODE')) die('Access Deined...');


//Xử lý lọc dữ liệu
$filter = '';
$keyword = '';
if (isGet()) {
    $body = getBody();
    //Xử lý lọc theo từ khoá
    if (!empty(trim($body['keyword']))) {
        $keyword = trim($body['keyword']);
        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }
        $filter .= " $operator (blogs.title LIKE '%$keyword%' OR blogs.content LIKE '%$keyword%') ";
    } else {
        redirectError();
    }
}

//Xử lý phân trang
$allBlogNum = getRows("SELECT * FROM blogs $filter");

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

$data = [
    'pageTitle' => 'Tìm kiếm: '.$keyword.''
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

//Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=search', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');

    if (strpos($queryString, 'keyword') !== false) {
        $queryString = '&' . $queryString;
    }

    if (strpos($queryString, 'lists') !== false) {
        $queryString = '&' . $queryString;
    }
}

$blogLists = getRaw("SELECT blogs.*, blog_categories.name AS blog_categories_name FROM blogs 
    INNER JOIN blog_categories ON blogs.category_id = blog_categories.id $filter ORDER BY blogs.create_at DESC LIMIT $offset, $perPage");
?>
    <!-- Start Blog -->
    <section id="blog-main" class="blog-main archive grid section">
        <div class="container">
            <div class="row">
                <div class="blog-main">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="single-sidebar subscribe">
                            <h2><span>Tìm kiếm bài viết<?php echo ($allBlogNum) > 0 ? ' : đã tìm thấy '.$allBlogNum.' bài viết' : false; ?></span></h2>
                            <div class="single-widget subscribe">
                                <form method="get" action="<?php echo _WEB_HOST_ROOT.'/tim-kiem.html'; ?>">
                                    <input type="search" name="keyword" placeholder="Nhập từ khoá tìm kiếm..." value="<?php echo (!empty(getBody()['keyword'])) ? getBody()['keyword'] : false; ?>" >
                                    <button type="submit">Tìm kiếm</button>
                                </form>
                            </div>
                        </div>
                        <?php if(!empty($blogLists)): ?>
                        <div class="row">
                            <?php foreach ($blogLists as $item): ?>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <!-- Single Post -->
                                    <div class="single-blog">
                                        <div class="blog-post">
                                            <div class="blog-head">
                                                <img src="<?php echo $item['thumbnail']; ?>" alt="#">
                                                <a class="link" href="<?php echo _WEB_HOST_ROOT.'/?module=blog&action=detail&id='.$item['id']; ?>"><i class="fa fa-paper-plane"></i></a>
                                            </div>
                                            <div class="blog-info">
                                                <h2><a href="<?php echo _WEB_HOST_ROOT.'/?module=blog&action=detail&id='.$item['id']; ?>"><?php echo $item['title']; ?></a></h2>
                                                <div class="meta">
                                                    <span><i class="fa fa-list"></i><a href="<?php echo _WEB_HOST_ROOT.'/?module=blog&action=category&id='.$item['category_id']; ?>"><?php echo $item['blog_categories_name']; ?></a></span>
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


                                        if ($page > 1) {
                                            $prevPage = $page - 1;
                                            $paginationLink = _WEB_HOST_ROOT.'/tim-kiem.html?keyword='.$keyword.'&page='.$prevPage;
                                            echo '<li class="prev"><a class="fa fa-angle-double-left" href="' . $paginationLink . '"></a></li>';
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
                                            $paginationLink = _WEB_HOST_ROOT.'/tim-kiem.html?keyword='.$keyword.'&page='.$index;
                                            echo '<li'.$active.'><a href="' . $paginationLink . '">' . $index . '</a></li>';
                                        }
                                        if ($page < $maxPage) {
                                            $nextPage = $page + 1;
                                            $paginationLink = _WEB_HOST_ROOT.'/tim-kiem.html?keyword='.$keyword.'&page='.$nextPage;
                                            echo '<li class="next"><a class="fa fa-angle-double-right" href=""' . $paginationLink . '"></a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <!--/ End Pagination -->
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info text-center">Không tìm thấy bài viết</div>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Blog -->
<?php
layout('footer', 'client', $data);
?>