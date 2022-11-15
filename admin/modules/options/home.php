<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => 'Thiết lập trang chủ'
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
    $homeSlideJson = '';
    if(!empty(getBody()['home_slide'])) {
        $homeSlide= getBody()['home_slide'];
        $homeSlideArr = [];
        if(!empty($homeSlide['slide_title'])) {
            foreach ($homeSlide['slide_title'] as $key => $value) {
                $homeSlideArr[] = [
                        'slide_title' => $value,
                        'slide_short_title' => isset($homeSlide['slide_short_title'][$key]) ? $homeSlide['slide_short_title'][$key] : '',
                        'slide_align' => isset($homeSlide['slide_align'][$key]) ? $homeSlide['slide_align'][$key] : '',
                        'slide_button_text' => isset($homeSlide['slide_button_text'][$key]) ? $homeSlide['slide_button_text'][$key] : '',
                        'slide_button_link' => isset($homeSlide['slide_button_link'][$key]) ? $homeSlide['slide_button_link'][$key] : '',
                        'slide_button_video' => isset($homeSlide['slide_button_video'][$key]) ? $homeSlide['slide_button_video'][$key] : '',
                        'slide_image' => isset($homeSlide['slide_image'][$key]) ? $homeSlide['slide_image'][$key] : '',
                        'slide_bg' => isset($homeSlide['slide_bg'][$key]) ? $homeSlide['slide_bg'][$key] : '',
                        'slide_description' => isset($homeSlide['slide_description'][$key]) ? $homeSlide['slide_description'][$key] : '',
                ];
            }
        }
        //Chuyển arr sang json
        $homeSlideJson = json_encode($homeSlideArr);
    }

    $homeAbout = [];
    if(!empty(getBody()['home_about'])) {
        $homeAbout['information'] = json_encode(getBody()['home_about']);
    }

    $homeAboutSkillJson = '';
    if(!empty(getBody()['home_about']['skill'])) {
        $homeAboutSkill = getBody()['home_about']['skill'];
        $homeAboutSkillArr = [];
        if(!empty($homeAboutSkill['name'])) {
            foreach ($homeAboutSkill['name'] as $key => $value) {
                $homeAboutSkillArr[] = [
                        'name' => $value,
                        'value' => (isset($homeAboutSkill['value'][$key])) ? $homeAboutSkill['value'][$key] : ''
                ];
            }
        }
        //Chuyển arr sang json
        $homeAboutSkillJson = json_encode($homeAboutSkillArr);
    }

    $homeAbout['skill'] = $homeAboutSkillJson;

    $homeCounterJson = '';
    if(!empty(getBody()['home_counter'])) {
        $homeCounter = getBody()['home_counter'];
        $homeCounterArr = [];
        if(!empty($homeCounter['counter_name'])) {
            foreach ($homeCounter['counter_name'] as $key => $item) {
                $homeCounterArr[] = [
                        'counter_name' => $item,
                        'counter_number' => (isset($homeCounter['counter_number'][$key])) ? $homeCounter['counter_number'][$key] : '',
                        'counter_icon' => (isset($homeCounter['counter_icon'][$key])) ? $homeCounter['counter_icon'][$key] : ''
                ];
            }
        }
        $homeCounterJson = json_encode($homeCounterArr);
    }

    $homeClientJson = '';
    if(!empty(getBody()['home_client'])) {
        $homeClient = getBody()['home_client'];
        $homeClientArr = [];
        if(!empty($homeClient['client_link'])) {
            foreach ($homeClient['client_link'] as $key => $item) {
                $homeClientArr[] = [
                    'client_link' => $item,
                    'client_logo' => (isset($homeClient['client_logo'][$key])) ? $homeClient['client_logo'][$key] : ''
                ];
            }
        }
        $homeClientJson = json_encode($homeClientArr);
    }

    $homeTeamJson = '';
    if(!empty(getBody()['home_team'])) {
        $homeTeam = getBody()['home_team'];
        $homeTeamArr = [];
        if(!empty($homeTeam['team_fullname'])) {
            foreach ($homeTeam['team_fullname'] as $key => $item) {
                $homeTeamArr[] = [
                    'team_fullname' => $item,
                    'team_position' => isset($homeTeam['team_position'][$key]) ? $homeTeam['team_position'][$key] : '',
                    'team_image' => isset($homeTeam['team_image'][$key]) ? $homeTeam['team_image'][$key] : '',
                    'team_facebook' => isset($homeTeam['team_facebook'][$key]) ? $homeTeam['team_facebook'][$key] : '',
                    'team_twitter' => isset($homeTeam['team_twitter'][$key]) ? $homeTeam['team_twitter'][$key] : '',
                    'team_behance' => isset($homeTeam['team_behance'][$key]) ? $homeTeam['team_behance'][$key] : '',
                    'team_dribbble' => isset($homeTeam['team_dribbble'][$key]) ? $homeTeam['team_dribbble'][$key] : ''
                ];
            }
        }
        $homeTeamJson = json_encode($homeTeamArr);
    }

    $homeAboutJson = json_encode($homeAbout);
    $data = [
            'home_slide' => $homeSlideJson,
            'home_about'=> $homeAboutJson,
            'home_counter' => $homeCounterJson,
            'home_client' => $homeClientJson,
            'home_team' => $homeTeamJson,
    ];
    updateOptions($data);


}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');

?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h4>Thiết lập slide</h4>
            <form action="" method="post">
                <?php getMsg($msg, $msgType); ?>
                <div class="slide-wrapper">
                    <?php
                        $homeSlideJson = getOption('home_slide');
                        if(!empty($homeSlideJson)) {
                            $homeSlideArr = json_decode($homeSlideJson, true);
                            if(!empty($homeSlideArr)) {
                                foreach ($homeSlideArr as $item) {
                                    ?>
                                    <div class="slide-item">
                                        <div class="row">
                                            <div class="col-11">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Tiêu đề</label>
                                                            <input type="text" class="form-control" name="home_slide[slide_title][]" placeholder="Tiêu đề..." value="<?php echo $item['slide_title']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Tiêu đề ngắn</label>
                                                            <input type="text" class="form-control" name="home_slide[slide_short_title][]" placeholder="Tiêu đề ngắn..." value="<?php echo $item['slide_short_title']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Căn lề</label>
                                                            <select name="home_slide[slide_align][]" class="form-control">
                                                                <option value="left" <?php echo ($item['slide_align'] == 'left') ? 'selected' : false; ?> >Trái</option>
                                                                <option value="right" <?php echo ($item['slide_align'] == 'right') ? 'selected' : false; ?>>Phải</option>
                                                                <option value="center" <?php echo ($item['slide_align'] == 'center') ? 'selected' : false; ?>>Giữa</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Tên nút</label>
                                                            <input type="text" class="form-control" name="home_slide[slide_button_text][]" placeholder="Tên..." value="<?php echo $item['slide_button_text']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Link nút</label>
                                                            <input type="text" class="form-control" name="home_slide[slide_button_link][]" placeholder="Link..." value="<?php echo $item['slide_button_link']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Link nút video</label>
                                                            <input type="text" class="form-control" name="home_slide[slide_button_video][]" placeholder="Link..." value="<?php echo $item['slide_button_video']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Ảnh</label>
                                                            <div class="row ckfinder-group">
                                                                <div class="col-10">
                                                                    <input type="text" class="form-control image-render" name="home_slide[slide_image][]" placeholder="Đường dẫn ảnh..." value="<?php echo $item['slide_image']; ?>">
                                                                </div>
                                                                <div class="col-2">
                                                                    <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-upload"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="">Ảnh nền</label>
                                                            <div class="row ckfinder-group">
                                                                <div class="col-10">
                                                                    <input type="text" class="form-control image-render" name="home_slide[slide_bg][]" placeholder="Đường dẫn ảnh..." value="<?php echo $item['slide_bg']; ?>">
                                                                </div>
                                                                <div class="col-2">
                                                                    <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-upload"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="">Mô tả</label>
                                                            <textarea class="form-control" name="home_slide[slide_description][]" placeholder="Mô tả slide..."><?php echo $item['slide_description']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div><!--End .slide-wrapper-->
                <p>
                    <button type="button" class="btn btn-warning btn-sm add-slide">Thêm slide</button>
                </p>
                <h4>Thiết lập giới thiệu</h4>
                <?php
                    $homeAboutJson = getOption('home_about');
                    $homeAboutArr = [];
                    $homeAboutInfo = [];
                    $homeAboutSkill = [];
                    if(!empty($homeAboutJson)) {
                        $homeAboutArr = json_decode($homeAboutJson, true);
                        $homeAboutInfo = json_decode($homeAboutArr['information'], true);
                        $homeAboutSkill = json_decode($homeAboutArr['skill'], true);
                    }
                ?>
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control" name="home_about[about_title]" placeholder="Tiêu đề..." value="<?php echo (!empty($homeAboutInfo['about_title'])) ? $homeAboutInfo['about_title'] : false; ?>">
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea class="form-control" name="home_about[about_description]" placeholder="Mô tả..."><?php echo (!empty($homeAboutInfo['about_description'])) ? $homeAboutInfo['about_description'] : false; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea class="form-control editor" name="home_about[about_content]" placeholder="Nội dung..."><?php echo (!empty($homeAboutInfo['about_content'])) ? $homeAboutInfo['about_content'] : false; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Hình ảnh</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_about[about_image]" placeholder="Đường dẫn ảnh..." value="<?php echo (!empty($homeAboutInfo['about_image'])) ? $homeAboutInfo['about_image'] : false; ?>" >
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Video</label>
                    <input type="text" class="form-control" name="home_about[about_video]" placeholder="Link video youtube..." value="<?php echo (!empty($homeAboutInfo['about_video'])) ? $homeAboutInfo['about_video'] : false; ?>">
                </div>
                <h4>Danh sách kỹ năng</h4>
                <div class="skill-wrapper">
                    <?php
                        if(!empty($homeAboutSkill)):
                            foreach ($homeAboutSkill as $item):
                    ?>
                    <div class="skill-item">
                        <div class="row">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tên kỹ năng</label>
                                            <input type="text" class="form-control" name="home_about[skill][name][]" placeholder="Tên kỹ năng..." value="<?php echo $item['name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Giá trị</label>
                                            <input type="text" class="form-control ranger" name="home_about[skill][value][]" placeholder="Giá trị..." value="<?php echo $item['value']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    </div><!--End .skill-item-->
                    <?php endforeach; endif; ?>

                </div><!--End .skill-wrapper-->
                <p><button type="button" class="btn btn-warning btn-sm add-skill">Thêm kỹ năng</button></p>
                <h4>Thiết lập dịch vụ</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('home_service_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="home_service_title" placeholder="<?php echo getOption('home_service_title', 'label'); ?>..." value="<?php echo getOption('home_service_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('home_service_description', 'label'); ?></label>
                    <textarea class="form-control" name="home_service_description" placeholder="<?php echo getOption('home_service_description', 'label'); ?>..."><?php echo getOption('home_service_description'); ?></textarea>
                </div>
                <h4>Thiết lập thành tựu</h4>
                <div class="form-group">
                    <label for="">Ảnh nền</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_counter_bg" placeholder="Đường dẫn ảnh hoặc mã icon..." value="<?php echo getOption('home_counter_bg'); ?>" >
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                        </div>
                    </div>
                </div>
                <h4>Danh sách thành tựu</h4>
                <div class="counter-wrapper">
                    <?php
                        $homeSlideJson = getOption('home_counter');
                        if(!empty($homeSlideJson)) {
                            $homeCounterArr = json_decode($homeSlideJson, true);
                            if(!empty($homeCounterArr)) {
                                foreach ($homeCounterArr as $item) {
                    ?>
                                    <div class="counter-item">
                                        <div class="row">
                                            <div class="col-11">
                                                <div class="form-group">
                                                    <label for="">Tên</label>
                                                    <input type="text" class="form-control" name="home_counter[counter_name][]" placeholder="Tên..." value="<?php echo $item['counter_name']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Số lượng</label>
                                                    <input type="text" class="form-control" name="home_counter[counter_number][]" placeholder="Số lượng..." value="<?php echo $item['counter_number']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Icon</label>
                                                    <div class="row ckfinder-group">
                                                        <div class="col-10">
                                                            <input type="text" class="form-control image-render" name="home_counter[counter_icon][]" placeholder="Đường dẫn ảnh hoặc mã icon..." value="<?php echo $item['counter_icon']; ?>" >
                                                        </div>
                                                        <div class="col-2">
                                                            <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                    </div>
                    <?php
                                }
                            }
                        }
                    ?>
                </div>
                <p><button type="button" class="btn btn-warning btn-sm add-counter">Thêm thành tựu</button></p>
                <h4>Thiết lập dự án</h4>
                <div class="form-group">
                    <label for="">Tên</label>
                    <input type="text" class="form-control" name="home_project_title" placeholder="Tên..." value="<?php echo getOption('home_project_title'); ?>">
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea class="form-control" name="home_project_description" placeholder="Mô tả..."><?php echo getOption('home_project_description'); ?></textarea>
                </div>
                <h4>Thiết lập đội ngũ</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('home_team_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="home_team_title" placeholder="<?php echo getOption('home_team_title', 'label'); ?>..." value="<?php echo getOption('home_team_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('home_team_description', 'label'); ?></label>
                    <textarea class="form-control" name="home_team_description" placeholder="<?php echo getOption('home_team_description', 'label'); ?>..."><?php echo getOption('home_team_description'); ?></textarea>
                </div>
                <h4>Danh sách đội ngũ</h4>
                <div class="team-wrapper">
                    <?php
                    $homeTeamJson = getOption('home_team');
                    if(!empty($homeTeamJson)) {
                        $homeTeamArr = json_decode($homeTeamJson, true);
                        if(!empty($homeTeamArr)) {
                            foreach ($homeTeamArr as $item) {
                                ?>
                                <div class="team-item">
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Tên</label>
                                                        <input type="text" class="form-control" name="home_team[team_fullname][]" placeholder="Tên..." value="<?php echo $item['team_fullname']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Chức vụ</label>
                                                        <input type="text" class="form-control" name="home_team[team_position][]" placeholder="Chức vụ..." value="<?php echo $item['team_position']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="">Ảnh đại diện</label>
                                                        <div class="row ckfinder-group">
                                                            <div class="col-10">
                                                                <input type="text" class="form-control image-render" name="home_team[team_image][]" placeholder="Đường dẫn ảnh..." value="<?php echo $item['team_image']; ?>" >
                                                            </div>
                                                            <div class="col-2">
                                                                <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-upload"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Facebook</label>
                                                        <input type="text" class="form-control" name="home_team[team_facebook][]" placeholder="Facebook..." value="<?php echo $item['team_facebook']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Twitter</label>
                                                        <input type="text" class="form-control" name="home_team[team_twitter][]" placeholder="Twitter..." value="<?php echo $item['team_twitter']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Behance</label>
                                                        <input type="text" class="form-control" name="home_team[team_behance][]" placeholder="Behance..." value="<?php echo $item['team_behance']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Dribbble</label>
                                                        <input type="text" class="form-control" name="home_team[team_dribbble][]" placeholder="Dribbble..." value="<?php echo $item['team_dribbble']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <p><button type="button" class="btn btn-warning btn-sm add-team">Thêm đội ngũ</button></p>
                <h4>Thiết lập bài viết</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('home_blog_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="home_blog_title" placeholder="<?php echo getOption('home_blog_title', 'label'); ?>..." value="<?php echo getOption('home_blog_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('home_blog_description', 'label'); ?></label>
                    <textarea class="form-control" name="home_blog_description" placeholder="<?php echo getOption('home_blog_description', 'label'); ?>..."><?php echo getOption('home_blog_description'); ?></textarea>
                </div>
                <h4>Thiết lập đối tác</h4>
                <div class="form-group">
                    <label for=""><?php echo getOption('home_client_title', 'label'); ?></label>
                    <input type="text" class="form-control" name="home_client_title" placeholder="<?php echo getOption('home_client_title', 'label'); ?>..." value="<?php echo getOption('home_client_title'); ?>">
                </div>
                <div class="form-group">
                    <label for=""><?php echo getOption('home_client_description', 'label'); ?></label>
                    <textarea class="form-control" name="home_client_description" placeholder="<?php echo getOption('home_client_description', 'label'); ?>..."><?php echo getOption('home_client_description'); ?></textarea>
                </div>
                <h4>Danh sách đối tác</h4>
                <div class="client-wrapper">
                <?php
                    $homeClientJson = getOption('home_client');
                    if(!empty($homeClientJson)) {
                        $homeClientArr = json_decode($homeClientJson, true);
                        if(!empty($homeClientArr)) {
                            foreach ($homeClientArr as $item) {
                                ?>
                                <div class="client-item">
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Ảnh</label>
                                                        <div class="row ckfinder-group">
                                                            <div class="col-10">
                                                                <input type="text" class="form-control image-render" name="home_client[client_logo][]" placeholder="Đường dẫn ảnh..." value="<?php echo $item['client_logo']; ?>">
                                                            </div>
                                                            <div class="col-2">
                                                                <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Link</label>
                                                        <input type="text" class="form-control" name="home_client[client_link][]" placeholder="Link..." value="<?php echo $item['client_link']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                <?php
                            }
                        }
                    }
                ?>
                </div>
                <p><button type="button" class="btn btn-warning btn-sm add-client">Thêm đối tác</button></p>
                <h4>Thiết lập nút kêu gọi</h4>
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control" name="home_cta_title" placeholder="Tiêu đề..." value="<?php echo getOption('home_cta_title'); ?>">
                </div>
                <div class="form-group">
                    <label for="">Tên nút</label>
                    <input type="text" class="form-control" name="home_cta_button_text" placeholder="Tên nút..." value="<?php echo getOption('home_cta_button_text'); ?>">
                </div>
                <div class="form-group">
                    <label for="">Link nút</label>
                    <input type="text" class="form-control" name="home_cta_button_link" placeholder="Link nút..." value="<?php echo getOption('home_cta_button_link'); ?>">
                </div>
                <div class="form-group">
                    <label for="">Icon</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_cta_button_icon" placeholder="Đường dẫn ảnh hoặc mã icon..." value="<?php echo getOption('home_cta_button_icon'); ?>" >
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php
layout('footer', 'admin', $data);