<?php
    $blogLists = getRaw("SELECT blogs.id, title, description, view_count, thumbnail, content, view_count, blogs.create_at, blog_categories.name as blog_categories_name, category_id FROM blogs INNER JOIN blog_categories ON blogs.category_id = blog_categories.id ORDER BY blogs.create_at ASC");
?>
<!-- Start Blogs -->
<section id="blog-main" class="blog-main section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if(!empty(getOption('home_blog_title')) && !empty(getOption('home_blog_description'))): ?>
                <div class="section-title">
                    <h1><?php echo getOption('home_blog_title'); ?></h1>
                    <p><?php echo getOption('home_blog_description'); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="blog-main">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-slider">
                        <?php
                            if(!empty($blogLists)):
                                foreach ($blogLists as $item):
                        ?>
                        <!-- Single Slider -->
                        <div class="single-blog single-slider">
                            <div class="blog-post">
                                <div class="blog-head">
                                    <img src="<?php echo $item['thumbnail']; ?>" alt="#">
                                    <a class="link" href="<?php echo getLinkModule('blogs', $item['id']); ?>"><i class="fa fa-paper-plane"></i></a>
                                </div>
                                <div class="blog-info">
                                    <h2><a href="<?php echo getLinkModule('blogs', $item['id']); ?>"><?php echo $item['title']; ?></a></h2>
                                    <div class="meta">
                                        <span><i class="fa fa-list"></i><a href="<?php echo getLinkModule('blog_categories', $item['category_id']); ?>"><?php echo $item['blog_categories_name']; ?></a></span>
                                        <span><i class="fa fa-calendar-o"></i><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y') : false; ?></span>
                                        <span><i class="fa fa-eye"></i><a href="#"><?php echo $item['view_count']; ?></a></span>
                                    </div>
                                    <p><?php echo $item['description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <!--/ End Single Slider -->
                        <?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Blog -->