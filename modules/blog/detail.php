<?php
if(!defined('_INCODE')) die('Access Deined...');

if(!empty(getBody('get')['id'])) {
    $blogId= getBody('get')['id'];
    setView($blogId);//tăng view
    $sql = "SELECT b.*, u.fullname AS user_fullname, u.email AS user_email, u.about_content AS user_about_content, u.contact_facebook AS user_contact_facebook, u.contact_twitter AS user_contact_twitter, u.contact_linkedin AS user_contact_linkedin, u.contact_pinterest AS user_contact_pinterest, c.name AS category_name, g.name AS group_name, (SELECT count(id) FROM blogs WHERE user_id = u.id) AS count_blogs FROM blogs AS b 
    INNER JOIN blog_categories AS c ON b.category_id = c.id 
    INNER JOIN users AS u ON b.user_id = u.id 
    INNER JOIN `groups` AS g ON u.group_id = g.id WHERE b.id = $blogId";

    $blogDetail = firstRaw($sql);

    if(empty($blogDetail)) {
        redirectError();
    }


} else {
    redirectError();
}

$blogCategories = getRaw("SELECT *, (SELECT count(blogs.id) FROM blogs WHERE blogs.category_id = blog_categories.id) AS blogs_count FROM blog_categories ORDER BY name");
$blogLatest = getRaw("SELECT * FROM blogs WHERE id <> $blogId ORDER BY create_at DESC LIMIT 0,5");
$blogPopular = getRaw("SELECT * FROM blogs WHERE id <> $blogId AND popular = 1 LIMIT 0,5");
//Truy vấn lấy tất cả bài viết
$allBlogs = getRaw("SELECT * FROM blogs ORDER BY create_at DESC");
$currentKey = array_search($blogId, array_column($allBlogs, 'id'));

//Avatar
$userEmail = $blogDetail['user_email'];


$parentBreadCrumb = '<li><a href="'._WEB_HOST_ROOT.'/?module=blog'.'">'.getOption('blog_title').'<i class="fa fa-angle-right"></i></a></li> ';
$parentBreadCrumb.= '<li><a href="'._WEB_HOST_ROOT.'/?module=blog&action=category&id='.$blogDetail['category_id'].'">'.$blogDetail['category_name'].'<i class="fa fa-angle-right"></i></a></li>';
$data = [
    'pageTitle' => $blogDetail['title'],
    'pageName' => (!empty(getOption('blog_title'))) ? getOption('blog_title') : false,
    'itemParent' => $parentBreadCrumb,
    'breadCrumbLimit' => 5
];

layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);
?>
<!-- Start Blog -->
<section id="blog-main" class="blog-main archive single section">
    <div class="container">
        <div class="row">
            <div class="blog-main">
                <div class="col-md-4 col-sm-12 col-xs-12 sticky-area">
                    <!-- Blog Sidebar -->
                    <aside class="blog-sidebar">
                        <!-- Post Tab -->
                        <div class="single-sidebar post-tab">
                            <!-- Post Menu -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#latest" role="tab" data-toggle="tab">Mới nhất</a></li>
                                <li role="presentation"><a href="#popular" role="tab"  data-toggle="tab">Nổi bật</a></li>
                            </ul>
                            <!--/ End Post Menu -->
                            <div class="tab-content">
                                <?php if(!empty($blogLatest)): ?>
                                <div role="tabpanel" class="tab-pane fade in active" id="latest">
                                    <?php foreach ($blogLatest as $item): ?>
                                    <!-- Single Post -->
                                    <div class="single-post">
                                        <div class="post-img">
                                            <img src="<?php echo $item['thumbnail']; ?>" alt=""/>
                                        </div>
                                        <div class="post-info">
                                            <p><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></p>
                                            <h4><a href="<?php echo getLinkModule('blogs', $item['id']); ?>"><?php echo getLimitText($item['title'], 5); ?></a></h4>
                                        </div>
                                    </div>
                                    <!--/ End Single Post -->
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($blogPopular)): ?>
                                <div role="tabpanel" class="tab-pane fade" id="popular">
                                    <?php foreach ($blogPopular as $item): ?>
                                    <!-- Single Post -->
                                    <div class="single-post">
                                        <div class="post-img">
                                            <img src="<?php echo $item['thumbnail']; ?>" alt=""/>
                                        </div>
                                        <div class="post-info">
                                            <p><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></p>
                                            <h4><a href="<?php echo getLinkModule('blogs', $item['id']); ?>"><?php echo getLimitText($item['title'], 5); ?></a></h4>
                                        </div>
                                    </div>
                                    <!--/ End Single Post -->
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!--/ End Post Tab -->

                        <?php if(!empty($blogCategories)): ?>
                        <!-- Blog Category -->
                        <div class="single-sidebar category">
                            <h2><span>Danh mục</span></h2>
                            <ul>
                                <?php foreach ($blogCategories as $item): ?>
                                <li><a href="<?php echo getLinkModule('blog_categories', $item['id']); ?>"><?php echo $item['name']; ?><span><?php echo $item['blogs_count']; ?></span></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!--/ End Blog Category -->
                        <?php endif; ?>
                    </aside>
                    <!--/ End Blog Sidebar -->
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- Single Post -->
                            <div class="single-blog">
                                <div class="blog-post">
                                    <?php if(!empty($blogDetail['thumbnail'])): ?>
                                    <div class="blog-head">
                                        <img src="<?php echo $blogDetail['thumbnail']; ?>" alt="#">
                                    </div>
                                    <?php endif; ?>
                                    <div class="blog-info">
                                        <?php if(!empty($blogDetail['title'])): ?>
                                        <h2><a href="<?php echo _WEB_HOST_ROOT.'/?module=blog&action=detail&id='.$blogDetail['id']; ?>"><?php echo $blogDetail['title']; ?></a></h2>
                                        <?php endif; ?>
                                        <div class="meta">
                                            <span><i class="fa fa-user-o"></i>By: <a href="#"><?php echo $blogDetail['user_fullname']; ?></a></span>
                                            <span><i class="fa fa-comments-o"></i><a href="#">10k</a></span>
                                            <span><i class="fa fa-eye"></i><a href="#"><?php echo $blogDetail['view_count']; ?></a></span>
                                        </div>
                                        <?php if(!empty($blogDetail['content'])): ?>
                                            <?php echo html_entity_decode($blogDetail['content']); ?>
                                        <?php endif; ?>
                                        <div class="blog-bottom">
                                            <ul class="share">
                                                <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$blogDetail['id']; ?>"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                <li><a target="_blank" href="https://twitter.com/share?text=<?php echo $blogDetail['title'].'&url='._WEB_HOST_ROOT.'?module=blog&action=detail&id='.$blogDetail['id']; ?>"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                <li><a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$blogDetail['id']; ?>"><i class="fa fa-linkedin"></i>Linkedin</a></li>
                                                <li><a target="_blank" href="https://pinterest.com/pin/create/link/?url=<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$blogDetail['id']; ?>"><i class="fa fa-pinterest"></i>Pinterest</a></li>
                                            </ul>
                                            <!-- Next Prev -->
                                            <ul class="prev-next">
                                                <?php if($currentKey > 0): ?>
                                                <li class="prev"><a href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$allBlogs[$currentKey-1]['id']; ?>"><i class="fa fa-angle-double-left"></i></a></li>
                                                <?php endif; ?>
                                                <?php if($currentKey < count($allBlogs) - 1): ?>
                                                <li class="next"><a href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$allBlogs[$currentKey+1]['id']; ?>"><i class="fa fa-angle-double-right"></i></a></li>
                                                <?php endif; ?>
                                                </ul>
                                            <!--/ End Next Prev -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--/ End Single Post -->

                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="author-details">
                                <div class="author-left">
                                    <img src="<?php echo getAvatar($userEmail, 200); ?>" alt="#">
                                    <h4><?php echo $blogDetail['user_fullname']; ?><span><?php echo $blogDetail['group_name']; ?></span></h4>
                                    <p><a href="#"><i class="fa fa-pencil"></i><?php echo $blogDetail['count_blogs']; ?> Bài viết</a></p>
                                </div>
                                <div class="author-content">
                                    <p><?php echo $blogDetail['user_about_content'];?></p>
                                    <ul class="social-share">
                                        <li><a target="_blank" href="<?php echo $blogDetail['user_contact_facebook']; ?>"><i class="fa fa-facebook"></i></a></li>
                                        <li><a target="_blank" href="<?php echo $blogDetail['user_contact_twitter']; ?>"><i class="fa fa-twitter"></i></a></li>
                                        <li><a target="_blank" href="<?php echo $blogDetail['user_contact_linkedin']; ?>"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a target="_blank" href="<?php echo $blogDetail['user_contact_pinterest']; ?>"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php require_once _WEB_PATH_ROOT.'/modules/blog/comments_lists.php'?>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php require_once _WEB_PATH_ROOT.'/modules/blog/comments_form.php'?>
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