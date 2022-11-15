<?php
if(!defined('_INCODE')) die('Access Deined...');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function layout($layoutName = 'header', $dir = '' , $data = []) {
    if(!empty($dir)) {
        $dir = '/'.$dir;
    }
    if(file_exists(_WEB_PATH_TEMPLATE.$dir.'/layouts/'.$layoutName.'.php')) {
        require_once _WEB_PATH_TEMPLATE.$dir.'/layouts/'.$layoutName.'.php';
    }
}

function sendMail($to, $subject, $content) {
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'hv281100@gmail.com';                     //SMTP username
        $mail->Password   = 'tomjrmdxkhjrywrr';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('hv281100@gmail.com', 'Unicode Training');
        $mail->addAddress($to);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->CharSet = 'UTF-8';
        return $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//Kiểm tra phương thức POST
function isPost() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}

//Kiểm tra phương thức GET

function isGet() {
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }
    return false;
}

//Lấy giá trị phương thức POST, GET
function getBody($method='') {
    $bodyArr = [];
    if(empty($method)) {
        if(isGet()) {
            //Xử lý chuỗi trước khi hiển thị ra
            //return $_GET;
            /*
             * Đọc key của mảng $_GET
             */
            if(!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if(is_array($value)) {
                        //$bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        $bodyArr[$key] = filter_var($_GET[$key], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        //$bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        $bodyArr[$key] = filter_var($_GET[$key], FILTER_SANITIZE_SPECIAL_CHARS);
                    }

                }
            }
        }
        if(isPost()) {
            //Xử lý chuỗi trước khi hiển thị ra
            //return $_GET;
            /*
             * Đọc key của mảng $_GET
             */
            if(!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if(is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }

                }
            }
        }
    } else {
        if($method=='get') {
            if(!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if(is_array($value)) {
                        //$bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        $bodyArr[$key] = filter_var($_GET[$key], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        //$bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        $bodyArr[$key] = filter_var($_GET[$key], FILTER_SANITIZE_SPECIAL_CHARS);
                    }

                }
            }
        } elseif($method=='post') {
            if(!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if(is_array($value)) {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }

                }
            }
        }
    }


    return $bodyArr;
}

//Kiểm tra email

function isEmail($email) {
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

//Kiểm tra số nguyên

function isNumberInt($number, $range = []) {
    /*
     * $range = ['min_range' => 1, 'max_range' => 20];
     *
     */
    if(!empty($range)) {
        $options  = ['options' => $range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT, $options);
    } else {
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    }
    return $checkNumber;
}

//Kiểm tra số thực

function isNumberFloat($number, $range = []) {
    /*
     * $range = ['min_range' => 1, 'max_range' => 20];
     *
     */
    if(!empty($range)) {
        $options  = ['options' => $range];
        $checkNumberFloat = filter_var($number, FILTER_VALIDATE_FLOAT, $options);
    } else {
        $checkNumberFloat = filter_var($number, FILTER_VALIDATE_FLOAT);
    }
    return $checkNumberFloat;
}

//Kiểm tra số điện thoại (0123456789 - Bắt đầu bằng số 0, nối tiếp là 9 số)
function isPhone($phone) {
    $checkFirstZero = false;
    if($phone[0]=='0') {
        $checkFirstZero = true;
        $phone = substr($phone, 1);
    }

    $checkNumberLast = false;
    if(isNumberInt($phone) && strlen($phone) == 9) {
        $checkNumberLast = true;
    }

    if($checkFirstZero && $checkNumberLast) {
        return true;
    }
    return false;
}

//Hàm tạo thông báo
function getMsg($msg, $type = 'success') {
    if(!empty($msg)) {
        echo '<div class="alert alert-'.$type.' text-center">';
        echo $msg;
        echo '</div>';
    }
}

//Hàm chuyển hướng

function redirect($path = 'index.php', $fullUrl = false) {
    if(empty($fullUrl)) {
        $url = _WEB_HOST_ROOT. '/'.$path;
    } else {
        $url = $path;
    }
    header("Location: $url");
    exit;
}

//Thông báo lỗi
function form_error($fieldName, $errors, $beforeHtml = '', $afterHtml = '') {
    return (!empty($errors[$fieldName])) ? $beforeHtml.reset($errors[$fieldName]).$afterHtml : null;
}

//Hàm hiển thị dữ liệu cũ
function old($fieldName, $oldData, $default = null) {
    return (!empty($oldData[$fieldName])) ? $oldData[$fieldName] : $default;
}

//Hàm kiểm tra trạng thái đăng nhập
function isLogin() {
    $checkLogin = false;
    if(getSession('loginToken')) {
        $tokenLogin = getSession('loginToken');
        $queryToken = firstRaw("SELECT user_id FROM login_token WHERE token = '$tokenLogin'");
        if(!empty($queryToken)) {
            //$checkLogin = true;
            $checkLogin = $queryToken;
        } else {
            removeSession('loginToken');
        }
    }
    return $checkLogin;
}

//Hàm tự động xoá token login nếu đăng xuất
function autoRemoveTokenLogin() {
    $allUsers = getRaw("SELECT * FROM users WHERE status = 1");
    if(!empty($allUsers)) {
        foreach ($allUsers as $user) {
            $now = date('Y-m-d H:i:s');

            $before = $user['last_activity'];

            $diff = strtotime($now) - strtotime($before);
            $diff= floor($diff/60);
            if($diff >= _TIMEOUT_SESSION_TOKEN) {
                delete('login_token', "user_id=".$user['id']);
            }
        }
    }
}

//Lưu lại thời gian cuối cùng hoạt động
function saveActivity() {
    $userId = isset(isLogin()['user_id']) ? isLogin()['user_id'] : false;
    if(!empty($userId)) {
        update('users', ['last_activity' => date('Y-m-d H:i:s')], "id=$userId");
    }
}

//Hàm lấy thông user
function getUserInfo($user_id) {
    $info = firstRaw("SELECT * FROM users WHERE id =$user_id");
    return $info;
}

//Hàm active menu sidebar
function activeMenuSidebar($module) {
    if(!empty(getBody()['module']) && getBody()['module']==$module) {
        return true;
    }
    return false;
}

//Hàm get link
function getLinkAdmin($module, $action='', $params=[]) {
    $url = _WEB_HOST_ROOT_ADMIN;
    $url = $url.'?module='.$module;
    if(!empty($action)) {
        $url = $url.'&action='.$action;
    }
    /*
     * params = ['id' => 1, 'keyword' => 'unicode']
     * =>paramsString = id=1&keyword=unicode
     */
    if(!empty($params)) {
        $paramsString = http_build_query($params);
        $url = $url.'&'.$paramsString;
    }
    return $url;
}

//Hàm định dạng thời gian

function getDateFormat($strDate, $format) {
    $dataObject = date_create($strDate);
    if(!empty($dataObject)) {
        return date_format($dataObject, $format);
    }
    return false;
}


//Check font-awesome icon
function isFontIcon($input) {
    $input = html_entity_decode($input);
    if(strpos($input, '<i class="') !==false) {
        return true;
    }
    return false;
}

//Hàm getLinkQueryString
function getLinkQueryString($key, $value) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryArr = explode('&', $queryString);
    $queryArr = array_filter($queryArr);
    $queryFinal = '';
    $check = false;
    if(!empty($queryArr)) {
        foreach ($queryArr as $item) {
            $itemArr = explode('=', $item);
            if(!empty($itemArr)) {
                if($itemArr[0]==$key) {
                    $itemArr[1] = $value;
                    $check = true;
                }
                $item = implode('=', $itemArr);
                $queryFinal.=$item.'&';
            }

        }
    }

    if(!$check) {
        $queryFinal.=$key.'='.$value;
    }

    if(!empty($queryFinal)) {
        $queryFinal = rtrim($queryFinal, '&');
    } else {
        $queryFinal = $queryString;
    }
    return $queryFinal;
}


function setExceptionError($exception) {
    if(_DEBUG) {
        setFlashData('debug_error', [
            'error_code' => $exception->getCode(),
            'error_message' => $exception->getMessage(),
            'error_file' => $exception->getFile(),
            'error_line' => $exception->getLine()
        ]);
        $reload = getFlashData('reload');

        if (!$reload) {
            setFlashData('reload', 1);
            if (isAdmin()){
                redirect(getPathAdmin());
            }else{
                redirect(getPath());
            }
        }
        die();
    } else {
        require_once _WEB_PATH_ROOT.'/modules/errors/500.php';
    }
}


function setErrorHandler($errno, $errstr, $errfile, $errline) {
    if(!_DEBUG) {
        require_once _WEB_PATH_ROOT.'/modules/errors/500.php';
        return;
    }
    setFlashData('debug_error', [
        'error_code' => $errno,
        'error_message' => $errstr,
        'error_file' => $errfile,
        'error_line' => $errline
    ]);
    $reload = getFlashData('reload');

    if(!$reload) {
        setFlashData('reload', 1);
        if(isAdmin()) {
            redirect(getPathAdmin());
        } else {
            redirect(getPath());
        }
    }
    die();

    //throw new ErrorException($errstr, $errno, 1, $errfile, $errline);
}

function loadExceptionError() {
    $debugError = getFlashData('debug_error');
    if(!empty($debugError)) {
        if(_DEBUG) {
            require_once _WEB_PATH_ROOT.'/modules/errors/exception.php';
        } else {
            require_once _WEB_PATH_ROOT.'/modules/errors/500.php';
        }
    }
}


function getPathAdmin() {
    $path = 'admin';
    if(!empty($_SERVER['QUERY_STRING'])) {
        $path.='?'.trim($_SERVER['QUERY_STRING']);
    }
    return $path;
}

function getPath() {
    $path = '';
    if(!empty($_SERVER['QUERY_STRING'])) {
        $path.='?'.trim($_SERVER['QUERY_STRING']);
    }
    return $path;
}

//Kiểm tra trang hiện tại có phải trang admin hay không
function isAdmin() {
    if(!empty($_SERVER['PHP_SELF'])) {
        $currentFile = $_SERVER['PHP_SELF'];
        $dirFile = dirname($currentFile);
        $baseNameDir = basename($dirFile);
        if(trim($baseNameDir) == 'admin') {
            return true;
        }
    }
    return false;
}


function getOption($key, $type='') {
    $sql = "SELECT * FROM options WHERE opt_key = '$key'";
    $option = firstRaw($sql);
    if(!empty($option)) {
        if($type == 'label') {
            return $option['name'];
        }
        return $option['opt_value'];
    }
    return false;
}

function updateOptions($data = []) {
    if(isPost()) {
        $allFields = getBody();
        if(!empty($data)) {
            $keyDataArr = array_keys($data);
            $valueDataArr = array_values($data);
            foreach ($keyDataArr as $key => $value) {
                $allFields[$value] = $valueDataArr[$key];
            }
        }
        $count = 0;
        if(!empty($allFields)) {
            foreach ($allFields as $key => $value) {
                $dataUpdate = [
                    'opt_value' => trim($value)
                ];
                $updateStatus = update('options', $dataUpdate, "opt_key='$key'");
                if($updateStatus) {
                    $count++;
                }
            }
        }
        if($count > 0) {
            setFlashData('msg', 'Đã cập nhật '.$count.' bản ghi thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Cập nhật không thành công');
            setFlashData('msg_type', 'danger');
        }
        redirect(getPathAdmin()); //reload trang
    }
}


//Lấy số lượng trạng thái chưa xử lý người liên hệ
function getCountContacts() {
    $sql = "SELECT id FROM contacts WHERE status = 0";
    $count = getRows($sql);
    return $count;
}


//Hàm load
function head() {
?>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_ROOT; ?>/templates/core/css/style.css?ver=<?php echo rand(); ?>">
<?php
}

function foot() {
    ?>
    <script type="text/javascript" src="<?php echo _WEB_HOST_ROOT; ?>/templates/core/js/custom.js?ver=<?php echo rand(); ?>"></script>
    <?php
}

function loadError($name='404') {
    $pathError = _WEB_PATH_ROOT.'/modules/errors/'.$name.'.php';
    require_once $pathError;
}

function redirectError($name='404') {
    $pathError = '?module=errors&action=404';
    redirect($pathError);
}

function getYoutubeId($url) {
    $result = [];
    $urlStr = parse_url($url, PHP_URL_QUERY);
    parse_str($urlStr, $result);
    if(!empty($result['v'])) {
        return $result['v'];
    }
    return false;
}

//Hàm cắt chữ
function getLimitText($content, $limit = 20) {
    $content = strip_tags($content);
    $content = trim($content);
    $contentArr = explode(' ', $content);
    $contentArr = array_filter($contentArr);
    $wordsNumber = count($contentArr); //Trả về số lượng phần tử của mảng
    if($wordsNumber > $limit) {
        $contentArrLimit = explode(' ', $content, $limit + 1);
        array_pop($contentArrLimit);
        $limitText = implode(' ', $contentArrLimit).'...';
        return $limitText;
    }
    return $content;
}

//
function setView($id) {
    $blog = firstRaw("SELECT view_count FROM blogs WHERE id=$id");
    $check = false;
    if(!empty($blog)) {
        $view = $blog['view_count'];
        $view++;
        $check = true;
    } else {
        if(is_array($blog)) {
            $view = 1;
            $check = true;
        }
    }

    if($check) {
        update('blogs', ['view_count' => $view], "id=$id");
    }
}

//Lấy avatar từ gravatar
function getAvatar($email, $size = null) {
    $hashGravatar = md5(strtolower(trim($email)));
    if(!empty($size)) {
        $urlGravatar = 'https://www.gravatar.com/avatar/'.$hashGravatar.'?='.$size;
    } else {
        $urlGravatar = 'https://www.gravatar.com/avatar/'.$hashGravatar;
    }
    return $urlGravatar;
}

//
function getCommentList($commentData, $parentId, $blogId) {
    if(!empty($commentData)) {
        echo '<div class="comments-children">';
        foreach ($commentData as $key => $item) {
            if($item['parent_id'] == $parentId) {
            ?>
                <div class="comment-list">
                    <div class="head">
                        <img src="<?php echo getAvatar($item['email'], 200); ?>" alt="#"/>
                    </div>
                    <div class="body">
                        <h4><?php echo $item['name']; echo (!empty($item['user_id'])) ? ' <div class="label label-danger">'.$item['groups_name'].'</div>' : false; ?><span class="meta"><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s'); ?></span></h4>
                        <p><?php echo $item['content']; ?> <a href="<?php echo _WEB_HOST_ROOT.'?module=blog&action=detail&id='.$blogId.'&comment_id='.$item['id'].'#comments-form'; ?>"><i class="fa fa-reply"></i>Trả lời</a></p>
                    </div>
                </div>
            <?php
            getCommentList($commentData, $item['id'], $blogId);
            unset($commentData[$key]);
            }
         }
        echo '</div>';
    }
}

function getComment($commentId) {
    $commentData = firstRaw("SELECT * FROM comments WHERE id = $commentId");
    if(!empty($commentData)) {
        return $commentData;
    }
    return false;
}

//Đệ quy lất tất cả trả lời của một bình luận => gán vào mảng
function getCommentReply($commentData, $parentId, &$result = []) {
    if(!empty($commentData)) {
        foreach ($commentData as $key => $item) {
            if($parentId == $item['parent_id']) {
                $result[] = $item['id'];
                getCommentReply($commentData, $item['id'], $result);
                unset($commentData[$key]);
            }
        }
    }
    return $result;
}

//
function getCommentCount($status = 0) {
    $statusComment = getRows("SELECT id FROM comments WHERE status = $status");
    return $statusComment;
}

//Lấy thông tin phòng ban
function getContactType($typeId) {
    $sql = "SELECT * FROM contact_type WHERE id = $typeId";
    return firstRaw($sql);
}

function getSubscribeCount($status = 0) {
    $statusSubscribe = getRows("SELECT id FROM subscribe WHERE status = $status");
    return $statusSubscribe;
}

//Đổ dữ liệu menu
function getMenu($dataMenu, $isSub = false) {
    if(!empty($dataMenu)) {
        echo ($isSub) ? '<ul class="drop-down">' : '<ul class="nav navbar-nav">';
        foreach ($dataMenu as $key => $item) {
            $active = ($item['active'] == 'active') ? ' class="active"' : false;
            echo '<li'.$active.'><a target="'.$item['target'].'" href="'.$item['href'].'" title="'.$item['title'].'" >'.$item['text'].'</a>';
            if(!empty($item['children'])) {
                getMenu($item['children'], true);
            }
            echo '</li>';
        }
        echo '</ul>';
    }
}