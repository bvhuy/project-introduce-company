<?php
    $commentLists = getRaw("SELECT comments.*, users.fullname as user_fullname, users.email AS user_email, `groups`.name AS groups_name FROM comments 
    LEFT JOIN users ON comments.user_id = users.id LEFT JOIN `groups` ON users.group_id = `groups`.id WHERE blog_id = $blogId AND comments.status = 1 ORDER BY comments.create_at DESC");
    $commentData = [];
?>
<div class="blog-comments">
    <h2>Bình luận (<?php echo count($commentLists); ?>)</h2>
    <div class="comments-body">
        <?php
            if(!empty($commentLists)):
            foreach ($commentLists as $key => $item):
                $commentData[$item['id']] = $item;
                if(!empty($item['user_id'])) {
                    $item['name']  = $item['user_fullname'];
                    $item['email']  = $item['user_email'];
                    $commentLists[$key] = $item;
                }
                if($item['parent_id'] == 0):
        ?>
        <!-- Single Comments -->
        <div class="single-comments">
            <div class="main">
                <div class="head">
                    <img src="<?php echo getAvatar($item['email'], 200); ?>" alt="#"/>
                </div>
                <div class="body">
                    <h4><?php echo $item['name']; echo (!empty($item['user_id'])) ? ' <div class="label label-danger">'.$item['groups_name'].'</div>' : false; ?> <span class="meta"><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s'); ?></span></h4>
                    <p><?php echo $item['content']; ?> <a href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$blogId.'&comment_id='.$item['id'].'#comments-form'; ?>"><i class="fa fa-reply"></i>Trả lời</a></p>
                </div>
            </div>

            <?php getCommentList($commentLists, $item['id'], $blogId); ?>

        </div>
        <!--/ End Single Comments -->
        <?php endif; ?>
        <?php endforeach; else:?>
            <div class="alert alert-info text-center">
                Không có bình luận. Hãy là người đầu tiên viết bình luận.
            </div>
        <?php endif; ?>
    </div>
</div>
