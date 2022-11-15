function toSlug(title) {
    let slug = title.toLowerCase();//Chuyển thành chữ thường

    slug = slug.trim(); //xoá khoảng trắng hai đầu

    //lọc dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');

    //chuyển dấu cách (khoảng trắng) thành gạch ngang
    slug = slug.replace(/ /gi, '-');

    //chuyển các ký tự đặc biệt thành gạch ngang
    //xoá các ký tự đặc biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    return slug;
}

//lấy id từ url
let fullUrl = window.location.href;
const searchParams = new URLSearchParams(fullUrl);
let id = searchParams.get('id');



let sourceTitle = document.querySelector('.slug');
let slugRender = document.querySelector('.render-slug');

let renderLink = document.querySelector('.render-link');
if (renderLink !== null) {

    //Lấy slug tự động
    let slug = '';
    if(slugRender!== null) {
        slug = '/'+prefixUrl+'/'+slugRender.value.trim()+'-'+id+'.html';
    }
    if(id!==null) {
        renderLink.querySelector('span').innerHTML = `<a href="${rootUrl+slug}" target="_blank">${rootUrl+slug}</a>`;
    } else {
        renderLink.querySelector('span').innerHTML = 'Vui lòng cập nhật để hiển thị link';
    }
}


if (sourceTitle !== null && slugRender !== null) {
    sourceTitle.addEventListener('keyup', (e) => {
        if (!sessionStorage.getItem('save_slug')) {
            let title = e.target.value;
            if (title !== null) {
                let slug = toSlug(title);
                slugRender.value = slug;

            }
        }
    });

    sourceTitle.addEventListener('change', () => {
        sessionStorage.setItem('save_slug', 1);
        if(id!==null) {
            let currentLink = rootUrl + '/' + prefixUrl + '/' + slugRender.value.trim() + '-'+id+'.html';
            renderLink.querySelector('span a').innerHTML = currentLink;
            renderLink.querySelector('span a').href = currentLink;
        }
    });

    slugRender.addEventListener('change', (e) => {
        let slugValue = e.target.value;
        if (slugValue.trim() == '') {
            sessionStorage.removeItem('save_slug');
            let slug = toSlug(sourceTitle.value);
            e.target.value = slug;
        }
        if(id!==null) {
            let currentLink = rootUrl + '/' + prefixUrl + '/' + slugRender.value.trim() + '-'+id+'.html';
            renderLink.querySelector('span a').innerHTML = currentLink;
            renderLink.querySelector('span a').href = currentLink;
        }
    });

    if (slugRender.value.trim() == '') {
        sessionStorage.removeItem('save_slug');
    }
}

//Xử lý ckeditor với class
let classTextarea = document.querySelectorAll('.editor');
if (classTextarea !== null) {
    classTextarea.forEach((item, index) => {
        item.id = 'editor_' + (index + 1);
        CKEDITOR.replace(item.id);
    });
}

//Xử lý mở popup ckfinder
function openCkfinder() {
    let choosenImages = document.querySelectorAll('.choose-image');
    if (choosenImages !== null) {
        choosenImages.forEach(function (item) {
            item.addEventListener('click', function () {

                let parentElementObject = this.parentElement;
                while (parentElementObject) {
                    //parentElement.classList.contains('ckfinder-group')
                    parentElementObject = parentElementObject.parentElement;
                    if (parentElementObject.classList.contains('ckfinder-group')) {
                        break;
                    }
                }

                //Code mở popup Ckfinder
                CKFinder.popup({
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function (finder) {
                        finder.on('files:choose', function (evt) {
                            let fileUrl = evt.data.files.first().getUrl();
                            //Xử lý chèn link ảnh vào input
                            parentElementObject.querySelector('.image-render').value = fileUrl;
                        });
                        finder.on('file:choose:resizedImage', function (evt) {
                            let fileUrl = evt.data.resizedUrl;
                            //Xử lý chèn link ảnh vào input
                        });
                    }
                });
            });

        });
    }
}

openCkfinder();

//Xử lý thêm dữ liệu dưới dạng Repeater
const galleryItemHtml = `
<div class="gallery-item">
    <div class="row">
        <div class="col-11">
            <div class="row ckfinder-group">
                <div class="col-10">
                    <input type="text" class="form-control image-render" name="gallery[]" placeholder="Đường dẫn ảnh..." value="">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                </div>
            </div>
        </div>
        <div class="col-1">
            <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
        </div>
    </div>
</div>`;
const addGalleryObject = document.querySelector('.add-gallery');
const galleryImagesObject = document.querySelector('.gallery-images');

if(addGalleryObject!== null && galleryImagesObject!=null) {
    addGalleryObject.addEventListener('click', function (e) {
        e.preventDefault();
        let galleryItemHtmlNode = new DOMParser().parseFromString(galleryItemHtml, 'text/html').querySelector('.gallery-item');
        galleryImagesObject.appendChild(galleryItemHtmlNode);
        openCkfinder();
    });
    galleryImagesObject.addEventListener('click', function (e) {
       e.preventDefault();//ngăn tình trạng mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xoá')) {
                let galleryItem = e.target;
                while (galleryItem) {
                    galleryItem = galleryItem.parentElement;
                    if (galleryItem.classList.contains('gallery-item')) {
                        break;
                    }
                }
                if (galleryItem !== null) {
                    galleryItem.remove();
                }
            }
        }
    });
}

const slideItemHtml = `<div class="slide-item">
                        <div class="row">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tiêu đề</label>
                                            <input type="text" class="form-control" name="home_slide[slide_title][]" placeholder="Tiêu đề slide...">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tiêu đề ngắn</label>
                                            <input type="text" class="form-control" name="home_slide[slide_short_title][]" placeholder="Tiêu đề ngắn...">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Căn lề</label>
                                            <select name="home_slide[slide_align][]" class="form-control">
                                                <option value="left">Trái</option>
                                                <option value="right">Phải</option>
                                                <option value="center">Giữa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tên nút</label>
                                            <input type="text" class="form-control" name="home_slide[slide_button_text][]" placeholder="Tên...">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Link nút</label>
                                            <input type="text" class="form-control" name="home_slide[slide_button_link][]" placeholder="Link...">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Link nút video</label>
                                            <input type="text" class="form-control" name="home_slide[slide_button_video][]" placeholder="Link...">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Ảnh</label>
                                            <div class="row ckfinder-group">
                                                <div class="col-10">
                                                    <input type="text" class="form-control image-render" name="home_slide[slide_image][]" placeholder="Đường dẫn ảnh..." value="">
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
                                                    <input type="text" class="form-control image-render" name="home_slide[slide_bg][]" placeholder="Đường dẫn ảnh..." value="">
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
                                            <textarea class="form-control" name="home_slide[slide_description][]" placeholder="Mô tả slide..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    </div><!--End .slide-item-->`;
const addSlideObject = document.querySelector('.add-slide');
const slideWrapperObject = document.querySelector('.slide-wrapper');
if(addSlideObject !==null & slideWrapperObject !== null) {
    addSlideObject.addEventListener('click', function (e) {
        e.preventDefault();
        let slideItemHtmlNode = new DOMParser().parseFromString(slideItemHtml, 'text/html').querySelector('.slide-item');
        slideWrapperObject.appendChild(slideItemHtmlNode);
        openCkfinder();
    });

    slideWrapperObject.addEventListener('click', function (e) {
        e.preventDefault();//ngăn tình trạng mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xoá')) {
                let slideItem = e.target;
                while (slideItem) {
                    slideItem = slideItem.parentElement;
                    if (slideItem.classList.contains('slide-item')) {
                        break;
                    }
                }
                if (slideItem !== null) {
                    slideItem.remove();
                }
            }
        }
    });
}

const skillItemHtml = `<div class="skill-item">
                        <div class="row">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tên kỹ năng</label>
                                            <input type="text" class="form-control" name="home_about[skill][name][]" placeholder="Tên kỹ năng..." value="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Giá trị</label>
                                            <input type="text" class="form-control ranger" name="home_about[skill][value][]" placeholder="Giá trị..." value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    </div><!--End .skill-item-->`;
const addSkillObject = document.querySelector('.add-skill');
const skillWrapperObject = document.querySelector('.skill-wrapper');
if(addSkillObject !==null & skillWrapperObject !== null) {
    addSkillObject.addEventListener('click', function (e) {
        e.preventDefault();
        let skillItemHtmlNode = new DOMParser().parseFromString(skillItemHtml, 'text/html').querySelector('.skill-item');
        skillWrapperObject.appendChild(skillItemHtmlNode);
        openCkfinder();
        $('.ranger').ionRangeSlider({
            min     : 0,
            max     : 100,
            type    : 'single',
            step    : 1,
            postfix : ' %',
            prettify: false,
            hasGrid : true
        })
    });

    skillWrapperObject.addEventListener('click', function (e) {
        e.preventDefault();//ngăn tình trạng mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xoá')) {
                let skillItem = e.target;
                while (skillItem) {
                    skillItem = skillItem.parentElement;
                    if (skillItem.classList.contains('skill-item')) {
                        break;
                    }
                }
                if (skillItem !== null) {
                    skillItem.remove();
                }
            }
        }
    });
}

const counterItemHtml = `<div class="counter-item">
                        <div class="row">
                            <div class="col-11">
                                <h4>Thiết lập thành tựu</h4>
                                <div class="form-group">
                                    <label for="">Tên</label>
                                    <input type="text" class="form-control" name="home_counter[counter_name][]" placeholder="Tên...">
                                </div>
                                <div class="form-group">
                                    <label for="">Số lượng</label>
                                    <input type="text" class="form-control" name="home_counter[counter_number][]" placeholder="Số lượng...">
                                </div>
                                <div class="form-group">
                                    <label for="">Icon</label>
                                    <div class="row ckfinder-group">
                                        <div class="col-10">
                                            <input type="text" class="form-control image-render" name="home_counter[counter_icon][]" placeholder="Đường dẫn ảnh...">
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
                    </div>`;
const addCounterObject = document.querySelector('.add-counter');
const counterWrapperObject = document.querySelector('.counter-wrapper');
if(addCounterObject !==null & counterWrapperObject !== null) {
    addCounterObject.addEventListener('click', function (e) {
        e.preventDefault();
        let counterItemHtmlNode = new DOMParser().parseFromString(counterItemHtml, 'text/html').querySelector('.counter-item');
        counterWrapperObject.appendChild(counterItemHtmlNode);
        openCkfinder();
    });

    counterWrapperObject.addEventListener('click', function (e) {
        e.preventDefault();//ngăn tình trạng mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xoá')) {
                let counterItem = e.target;
                while (counterItem) {
                    counterItem = counterItem.parentElement;
                    if (counterItem.classList.contains('counter-item')) {
                        break;
                    }
                }
                if (counterItem !== null) {
                    counterItem.remove();
                }
            }
        }
    });
}


const clientItemHtml = `<div class="client-item">
                                <div class="row">
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Ảnh</label>
                                                    <div class="row ckfinder-group">
                                                        <div class="col-10">
                                                            <input type="text" class="form-control image-render" name="home_client[client_logo][]" placeholder="Đường dẫn ảnh..." value="" >
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
                                                    <input type="text" class="form-control" name="home_client[client_link][]" placeholder="Link..." value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                            </div>`;
const addClientObject = document.querySelector('.add-client');
const clientWrapperObject = document.querySelector('.client-wrapper');
if(addClientObject !==null & clientWrapperObject !== null) {
    addClientObject.addEventListener('click', function (e) {
        e.preventDefault();
        let clientItemHtmlNode = new DOMParser().parseFromString(clientItemHtml, 'text/html').querySelector('.client-item');
        clientWrapperObject.appendChild(clientItemHtmlNode);
        openCkfinder();
    });

    clientWrapperObject.addEventListener('click', function (e) {
        e.preventDefault();//ngăn tình trạng mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xoá')) {
                let clientItem = e.target;
                while (clientItem) {
                    clientItem = clientItem.parentElement;
                    if (clientItem.classList.contains('client-item')) {
                        break;
                    }
                }
                if (clientItem !== null) {
                    clientItem.remove();
                }
            }
        }
    });
}

const teamItemHtml = `<div class="team-item">
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Tên</label>
                                                        <input type="text" class="form-control" name="home_team[team_fullname][]" placeholder="Tên..." value="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Chức vụ</label>
                                                        <input type="text" class="form-control" name="home_team[team_position][]" placeholder="Chức vụ..." value="">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="">Ảnh đại diện</label>
                                                        <div class="row ckfinder-group">
                                                            <div class="col-10">
                                                                <input type="text" class="form-control image-render" name="home_team[team_image][]" placeholder="Đường dẫn ảnh..." value="" >
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
                                                        <input type="text" class="form-control" name="home_team[team_facebook][]" placeholder="Facebook..." value="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Twitter</label>
                                                        <input type="text" class="form-control" name="home_team[team_twitter][]" placeholder="Twitter..." value="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Behance</label>
                                                        <input type="text" class="form-control" name="home_team[team_behance][]" placeholder="Behance..." value="">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Dribbble</label>
                                                        <input type="text" class="form-control" name="home_team[team_dribbble][]" placeholder="Dribbble..." value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>`;
const addTeamObject = document.querySelector('.add-team');
const teamWrapperObject = document.querySelector('.team-wrapper');
if(addTeamObject !==null & teamWrapperObject !== null) {
    addTeamObject.addEventListener('click', function (e) {
        e.preventDefault();
        let teamItemHtmlNode = new DOMParser().parseFromString(teamItemHtml, 'text/html').querySelector('.team-item');
        teamWrapperObject.appendChild(teamItemHtmlNode);
        openCkfinder();
    });

    teamWrapperObject.addEventListener('click', function (e) {
        e.preventDefault();//ngăn tình trạng mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {
            if (confirm('Bạn có chắc chắn muốn xoá')) {
                let teamItem = e.target;
                while (teamItem) {
                    teamItem = teamItem.parentElement;
                    if (teamItem.classList.contains('team-item')) {
                        break;
                    }
                }
                if (teamItem !== null) {
                    teamItem.remove();
                }
            }
        }
    });
}

$('.ranger').ionRangeSlider({
    min     : 0,
    max     : 100,
    type    : 'single',
    step    : 1,
    postfix : ' %',
    prettify: false,
    hasGrid : true
})


//Menu editor custom

// icon picker options
//var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
// sortable list options
var sortableListOptions = {
    placeholderCss: {'background-color': "#cccccc"}
};
var editor = new MenuEditor('myEditor',
    {
        listOptions: sortableListOptions,
        //iconPicker: iconPickerOptions,
        maxLevel: 2 // (Optional) Default is -1 (no level limit)
        // Valid levels are from [0, 1, 2, 3,...N]
    });
editor.setForm($('#frmEdit'));
editor.setUpdateButton($('#btnUpdate'));
//Calling the update method
$("#btnUpdate").click(function(){
    editor.update();
});
// Calling the add method
$('#btnAdd').click(function(){
    editor.add();
});

if(typeof arrayJson !== 'undefined') {
    editor.setData(arrayJson);
}

if($('.save-menu').length > 0) {
    $('.save-menu').on('click', function(e){
        e.preventDefault(); //Vô hiệu hoá submit form
        var str = editor.getString();
        $('#menu-content').val(str);
        $('#frmEdit').submit();
    });
}

//Xử lý check phân quyền
let permissionObj = document.querySelector('.permission-lists');
if(permissionObj !== null) {
    const allowRoles = [
        'add',
        'edit',
        'delete',
        'duplicate'
    ];
    let rowPermissionObj = permissionObj.querySelectorAll('tr');
    if(rowPermissionObj != null) {
        rowPermissionObj.forEach(function (item) {
           let checkboxObj = item.querySelectorAll('input[type="checkbox"]');
           if(checkboxObj !== null) {
               checkboxObj.forEach(function (checkbox) {
                   checkbox.addEventListener('click', function () {
                      let checkboxValue = this.value;
                      if(checkboxValue.trim() !== '' && allowRoles.includes(checkboxValue)) {
                          let viewRole = item.querySelectorAll('input[value="lists"]');
                          if(viewRole !== null) {
                              viewRole[0].checked = true;
                          }
                      }
                   });
               });
           }
        });
    }
}