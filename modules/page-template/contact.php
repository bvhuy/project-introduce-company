<?php
if(!defined('_INCODE')) die('Access Deined...');
$data = [
    'pageTitle' => (!empty(getOption('contact_title'))) ? getOption('contact_title') : false
];
layout('header', 'client', $data);
layout('breadcrumb', 'client', $data);

//Truy vấn lấy phòng ban
$contactTypeLists = getRaw("SELECT id, name FROM contact_type ORDER BY name ASC");
if(isPost()) {
    $body = getBody();
    $errors = [];
    if(empty(trim($body['fullname']))) {
        $errors['fullname']['required'] = 'Họ và tên không để trống';
    } else {
        if(strlen(trim($body['fullname'])) < 5) {
            $errors['fullname']['min'] = 'Họ và tên >= 5 ký tự';
        }
    }

    if(empty(trim($body['email']))) {
        $errors['email']['required'] = 'Email không để trống';
    } else {
        if(!isEmail(trim($body['email']))) {
            $errors['email']['isEmail'] = 'Email không hợp lệ';
        }
    }

    if(empty(trim($body['type_id']))) {
        $errors['type_id']['required'] = 'Vui lòng chọn phòng ban';
    }

    if(empty(trim($body['message']))) {
        $errors['message']['required'] = 'Nội dung liên hệ không để trống';
    } else {
        if(strlen(trim($body['message'])) < 5) {
            $errors['message']['min'] = 'Nội dung liên hệ >= 10 ký tự';
        }
    }

    if(empty($errors)) {
        $dataInsert = [
                'fullname' => trim(strip_tags($body['fullname'])),
                'email' => trim(strip_tags($body['email'])),
                'type_id' => trim(strip_tags($body['type_id'])),
                'message' => trim(strip_tags($body['message'])),
                'status' => 0,
                'create_at' => date('Y-m-d H:i:s')
        ];
        //Mảng lưu id phòng ban trong database
        $allowedTypeContact = [];
        if(!empty($contactTypeLists)) {
            foreach ($contactTypeLists as $item) {
                $allowedTypeContact[] = $item['id'];
            }
        }
        //Kiểm tra phòng ban có tồn tại trong database
        if(isset($body['type_id']) && in_array(trim($body['type_id']), $allowedTypeContact)) {
            $insertStatus = insert('contacts', $dataInsert);
            if($insertStatus) {
                setFlashData('msg', 'Gửi liên hệ thành công. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
                setFlashData('msg_type', 'success');

                $contactType = getContactType($dataInsert['type_id']);
                $siteName = getOption('general_sitename');

                //Thiết lập gửi mail cho người liên hệ
                $subject = '['.$siteName.'] Cảm ơn bạn đã gửi liên hệ';
                $content = '<p>Chào bạn <b>'. $dataInsert['fullname'] . '</b></p>';
                $content.= '<p>Cảm ơn bạn đã gửi liên hệ cho chúng tôi. Dưới đây là thông tin của bạn</p>';
                $content.= '
                    <p>Họ và tên: '.$dataInsert['fullname'].'</p>
                    <p>Email: '.$dataInsert['email'].'</p>
                    <p>Nội dung: '.$dataInsert['message'].'</p>
                    <p>Thời gian gửi: '.getDateFormat($dataInsert['create_at'], 'd/m/Y H:i:s').'</p>
                    <p>Phòng ban: '.$contactType['name'].'</p>
                    <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</p>
                    <p>Trân trọng!</p>
                ';

                //Gửi mail cho người liên hệ
                $email = $dataInsert['email'];
                $sendStatus = sendMail($email, $subject, $content);
                if(!$sendStatus) {
                    setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
                    setFlashData('msg_type', 'danger');
                }

                //Thiết lập gửi mail cho admin
                $subjectAdmin = '['.$siteName.'] '.$dataInsert['fullname'].' gửi liên hệ';
                $contentAdmin = '
                    <p>Họ và tên: '.$dataInsert['fullname'].'</p>
                    <p>Email: '.$dataInsert['email'].'</p>
                    <p>Nội dung: '.$dataInsert['message'].'</p>
                    <p>Thời gian gửi: '.getDateFormat($dataInsert['create_at'], 'd/m/Y H:i:s').'</p>
                    <p>Phòng ban: '.$contactType['name'].'</p>
                    <p>Thông tin được gửi từ: '._WEB_HOST_ROOT.'</p>
                ';

                //Gủi mail cho admin
                $emailAdmin = getOption('general_email');
                $sendStatusAdmin = sendMail($emailAdmin, $subjectAdmin, $contentAdmin);
                if(!$sendStatusAdmin) {
                    setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
                    setFlashData('msg_type', 'danger');
                }

            } else {
                setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
                setFlashData('msg_type', 'danger');
            }
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
    redirect('lien-he.html');
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>
<!-- Start Contact -->
<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h1><?php echo (!empty(getOption('contact_title'))) ? getOption('contact_title') : false ;?></h1>
                    <p><?php echo (!empty(getOption('contact_description'))) ? getOption('contact_description') : false ;?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Contact Form -->
            <div class="col-md-8 col-sm-6 col-xs-12">
                <?php getMsg($msg, $msgType); ?>
                <form class="form" method="post" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="fullname" placeholder="Họ và tên..." value="<?php echo old('fullname', $old); ?>">
                                <?php echo form_error('fullname', $errors, '<span class="error">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email..." value="<?php echo old('email', $old); ?>">
                                <?php echo form_error('email', $errors, '<span class="error">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="type_id" class="form-control">
                                    <option value="0">Chọn phòng ban</option>
                                    <?php
                                        if(!empty($contactTypeLists)):
                                            foreach ($contactTypeLists as $item):
                                    ?>
                                    <option value="<?php echo $item['id']; ?>" <?php echo (!empty(old('type_id', $old)) && old('type_id', $old) == $item['id']) ? 'selected' : false; ?> ><?php echo $item['name']; ?></option>
                                    <?php endforeach; endif;?>
                                </select>
                                <?php echo form_error('type_id', $errors, '<span class="error">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="message" rows="7" placeholder="Nhập nội dung liên hệ..." ><?php echo old('message', $old); ?></textarea>
                                <?php echo form_error('message', $errors, '<span class="error">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group button">
                                <button type="submit" class="btn primary">Gửi liên hệ</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--/ End Contact Form -->
            <!-- Contact Address -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="contact-address">
                    <div class="contact">
                        <h2><?php echo (!empty(getOption('contact_address_title'))) ? getOption('contact_address_title') : false; ?></h2>
                        <p><?php echo (!empty(getOption('contact_address_description'))) ? getOption('contact_address_description') : false; ?></p>
                        <!-- Single Address -->
                        <div class="single-address">
                            <span><i class="fa fa-headphones"></i><?php echo (!empty(getOption('general_hotline', 'label'))) ? getOption('general_hotline', 'label') : false; ?></span>
                            <p><?php echo (!empty(getOption('general_hotline'))) ? getOption('general_hotline') : false; ?></p>
                        </div>
                        <!--/ End Single Address -->
                        <!-- Single Address -->
                        <div class="single-address">
                            <span><i class="fa fa-envelope"></i><?php echo (!empty(getOption('general_email', 'label'))) ? getOption('general_email', 'label') : false; ?></span>
                            <p><a href="mailto:<?php echo (!empty(getOption('general_email'))) ? getOption('general_email') : false; ?>"><?php echo (!empty(getOption('general_email'))) ? getOption('general_email') : false; ?></a></p>
                        </div>
                        <!--/ End Single Address -->
                        <!--/ End Single Address -->
                        <!-- Single Address -->
                        <div class="single-address">
                            <span><i class="fa fa-map"></i><?php echo (!empty(getOption('general_address', 'label'))) ? getOption('general_address', 'label') : false; ?></span>
                            <p><?php echo (!empty(getOption('general_hotline'))) ? getOption('general_address') : false; ?></p>
                        </div>
                        <!--/ End Single Address -->
                    </div>
                </div>
            </div>
            <!--/ End Contact Address -->
        </div>
    </div>
</section>
<!--/ End Contact -->
<?php
require_once _WEB_PATH_ROOT.'/modules/home/contents/call_to_action.php';
layout('footer', 'client', $data);
?>
<style>

</style>
