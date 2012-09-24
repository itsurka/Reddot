var tp_drop = 0;
var curr_num_elem_sel = 0;


// после загрузки страницы
$(
    function()
    {

        /****************************** КАРТА ОБЪЕКТОВ  ************************/

        // на странице карты если она еще не загружена отключить
        // клики по меню, и загрузить скрипт карты
        if (typeof($('#myMap').get(0))!='undefined') {

            $.getScript('/js/map_script.js');

            $('.themes_ul li a').unbind('click');
            $('.themes_ul li a').click(function(){
                return false;
            });
        }

        /***********************************************************************/


        $(".gd_elem_hover_bg").live({
            mouseenter: function () {
                $(this).parent().find(".gd_elem_hover_bg .tx1").center_vert_inner();
                $(this).parent().find(".gd_elem_hover_bg").stop().fadeTo(500, 0.7);
            },
            mouseleave: function () {
                $(this).parent().find(".gd_elem_hover_bg").stop().fadeTo(200, 0, function() {} );
            }
        });

        // внизу кнопка показать еще выезжает при наведении
        $(".gd_elem_more_butt").live({
            mouseenter: function () {
                $(".gd_elem_more_butt").stop().animate({
                    "margin-top": "-15px", 
                    opacity: 1
                }, 250);
            },
            mouseleave: function () {
                $(".gd_elem_more_butt").stop().animate({
                    "margin-top": "-25px", 
                    opacity: 0.7
                }, 250);
            }
        });


        // верхнее меню анимация
        $('.rcm_e1').find('div').stop().animate({
            opacity: 0.6
        }, 1);

        $(".rcm_e1").hover(
            function () {
                $(this).find('div').stop().animate({
                    opacity: 1
                }, 200);
                $(this).stop().animate({
                    opacity: 0.8
                }, 200);
            },
            function () {
                $(this).find('div').stop().animate({
                    opacity: 0.6
                }, 200);
                $(this).stop().animate({
                    opacity: 1
                }, 200);
            }
            );



        // клик на метке возле checkbox
        $("#login .checkbox label").click(function(){
            $(this).parent().toggleClass("checked");
            var path = $("input", this);
            if(path.is(':checked')){
                path.attr("checked", false);
            }else{
                path.attr("checked", true);
            }
            return false;
        }
        );

        // клик на checkbox
        $("#login .checkbox .check").click(function(){
            $(this).parent().toggleClass("checked");
            var path = $("input", this);
            if(path.is(':checked')){
                path.attr("checked", false);
            }else{
                path.attr("checked", true);
            }
        }
        );


        $('#kupon_bay_pop .kupon_elem:odd').addClass('gr');


    //show_login(3);
    //show_prof_pop_win();
    }
    );




//$.getScript('map_script.js');




jQuery.fn.center = function()
{
    var w = $(window);
    this.css("position", "absolute");
    this.css("top",(w.height()-this.height())/2+w.scrollTop() + "px");
    this.css("left",(w.width()-this.width())/2+w.scrollLeft() + "px");
    return this;
}

jQuery.fn.center_innersel = function(sel)
{
    var w = $(sel);
    var p1 = $(sel).position();
    this.css("position", "absolute");
    //this.css("top",(w.height()-this.height())/2+w.scrollTop() + "px");
    this.css("left",(w.width() - this.width())/2+p1.left + "px");
    return this;
}


jQuery.fn.center_vert_inner = function()
{
    var w = this.parent();
    this.css("position", "absolute");
    this.css("top",(w.height()-this.height())/2+w.scrollTop() + "px");
    /*this.css("left",(w.width()-this.width())/2+w.scrollLeft() + "px");*/
    return this;
}

jQuery.fn.center_hor_inner = function()
{
    var w = this.parent();
    //this.css("position", "absolute");
    /*this.css("top",(w.height()-this.height())/2+w.scrollTop() + "px");*/
    this.css("margin-left",(w.width()-this.width())/2+w.scrollLeft() + "px");
    return this;
}


// Плагин для JQuery для переключения checkbox флажков
jQuery.fn.check = function(mode) {
    // если mode не определен, используем 'on' по умолчанию
    var mode = mode || 'on';

    return this.each(function()
    {
        switch(mode) {
            case 'on':
                this.checked = true;
                break;
            case 'off':
                this.checked = false;
                break;
            case 'toggle':
                this.checked = !this.checked;
                break;
        }
    });
};



// проверка емайла
function checkmail(value) {
    reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    return value.match(reg);
}





function show_city_block() {
    $("#city_dv").slideDown("fast", function(){});
}

function hide_city_block() {
    $("#city_dv").slideUp("fast", function(){});
}

function switch_city() {
    if ( $("#city_dv").is(":hidden") == true ) {

        show_city_block();

    }
    else {

        hide_city_block();

    }
}

// функция используется на внутрених страницах с красной волнистой линией справа, для подсчета координат
// для ее правильного отображения
function get_pos_1(sel_1) {

    var pos_smech = 16;

    var pos_2 = $(sel_1).position();                                    // нижняя позиция

    var pos_hg_ceil = Math.ceil( (pos_2.top-pos_smech) / 24.5) * 24.5;  // округленная разница позиций

    return  (pos_hg_ceil + pos_smech - pos_2.top);

}








/******************* ******* ВХОД / РЕГИСТРАЦИЯ  ******************************/



// ошибка авторизации [логин, пароль]
var login_err = [0,0];

// ошибка авторизации [логин, пароль, оферта]
var reg_err = [0,0,0];

// открытая вкладка 1 - вход, 2 - регистрация
var curr_tp_auth = 1;



// показать окно входа - 1, регистрации - 2
function show_login(num) {

    $("body").append('<div id="fade" ></div>');
    body_height = document.documentElement.scrollHeight;
    $("body #fade").css("height",body_height);

    $("#login").center();

    login_set_menu(num);

    if ($.browser.msie) {

        $("body #fade").fadeTo(300, 0.4, function() {
            $("#login").show();
        });

    } else {

        $("body #fade").fadeTo(300, 0.4);

        $("#login").fadeTo(300, 1);
    }

    $("#fade").click(close_login);
}







// закрыть окно логина/регистрации
function close_login() {

    $('#login').hide();

    $("#fade").remove();               // удалить затенение

    $('.lg_cont_tab').hide();

}


// выбор вкладки 1 - "Вход" / 2 - "Регистрация"
function login_set_menu(num) {

    if (num == 3) { // вход через соц сеть
        $('.lg_menu_cont a:nth-child(1)').hide();
        $('.lg_menu_cont a:nth-child(2)').hide();
        $('.lg_menu_cont a:nth-child(3)').show();
    } else {
        $('.lg_menu_cont a:nth-child(1)').show();
        $('.lg_menu_cont a:nth-child(2)').show();
        $('.lg_menu_cont a:nth-child(3)').hide();
    }

    $('.lg_menu_lnk.active').removeClass('active');

    $('.lg_menu_cont a:nth-child('+num+')').addClass('active');

    // если вкладка переключилась - обнулить все поля
    if (curr_tp_auth != num) {

        if (num == 1) { // авторизация

            login_err = [0,0];

            // логин
            $('#auth_login').val('Введите логин').removeClass('act').parent().parent().addClass('off');

            $('.lg_auth_err').hide();
            $('.lg_inpit_dv').removeClass('err');

            // пароль
            $('#auth_pass').val('Пароль').removeClass('act').prev().show().parent().parent().addClass('off').removeClass('err');
            $('.lg_cont_tab .selectbox').hide();

        }
        if (num == 2) {    // регистрация

            reg_err = [0,0,0];

            // логин
            $('#reg_login').val('Введите е-мейл').removeClass('act').parent().parent().addClass('off');
            $('#reg_login_comment').show();

            // пароль
            $('#reg_pass').val('Придумайте пароль').removeClass('act').prev().show().parent().parent().addClass('off').removeClass('err');
            $('#reg_pass_comment').removeClass('err');

            // чекбокс
            $('#lg_checkb_offer').check('off').parent().removeClass("checked");

            $('.lg_cont_tab .selectbox').css('display', 'inline-block');

        }

        if (num == 3) {  // вход через соц сеть

            // логин
            $('#soc_login').val('Ваш е-мейл');

            // чекбокс
            $('#lg_checkb_infakcii').check('off').parent().removeClass("checked");

        }
    }

    curr_tp_auth = num;

    $('.lg_cont_tab').hide();
    $('.lg_cont_div .lg_cont_tab:nth-child('+num+')').show();
}





// проверка авторизации "логин"
function auth_check_login() {

    if ($('#auth_login').val() == '') {

        $('#auth_login').parent().parent().removeClass('err');
        $('#auth_login_err').hide();
        login_err[0] = 0;

    } else {

        if (!checkmail($('#auth_login').val())) {

            $('#auth_login').parent().parent().addClass('err');
            $('#auth_login_err').show();
            login_err[0] = 1;

        } else {

            $('#auth_login').parent().parent().removeClass('err');
            $('#auth_login_err').hide();
            login_err[0] = 0;
        }
    }
}



// авторизация, если нет ошибок отправка формы
function auth_submit() {

    if ($('#auth_login').val() == 'Введите логин')
        return;

    if ($('#auth_pass').val() == 'Пароль')
        return;

    if ( (login_err[0] + login_err[1]) == 0 ) {
        alert('ок, авторизация, отправка формы...');
        document.auth_form.submit();
    }
}



// проверка регистрации "логин"
function reg_check_login() {

    if ($('#reg_login').val() == '') {
        $('#reg_login').parent().parent().removeClass('err');
        $('#reg_login_err').hide();
        $('#reg_login_comment').show();
        reg_err[0] = 0;


    } else {

        if (!checkmail($('#reg_login').val())) {

            $('#reg_login').parent().parent().addClass('err');
            $('#reg_login_err').show();
            $('#reg_login_comment').hide();
            reg_err[0] = 1;

        } else {

            $('#reg_login').parent().parent().removeClass('err');
            $('#reg_login_err').hide();
            $('#reg_login_comment').show();
            reg_err[0] = 0;
        }
    }
}


// проверка регистрации "пароль"
function reg_check_pass() {

    if ($('#reg_pass').val() == '') {
        $('#reg_pass').parent().parent().removeClass('err');
        $('#reg_pass_comment').removeClass('err');
        reg_err[1] = 0;


    } else {

        if ($('#reg_pass').val().length < 8) {

            $('#reg_pass').parent().parent().addClass('err');
            $('#reg_pass_comment').addClass('err');
            reg_err[1] = 1;

        } else {

            $('#reg_pass').parent().parent().removeClass('err');
            $('#reg_pass_comment').removeClass('err');
            reg_err[1] = 0;

        }
    }
}


// регистрация, если нет ошибок отправка формы
function reg_submit() {

    if ($('#reg_login').val() == 'Введите е-мейл')
        return;

    if ($('#reg_pass').val() == 'Придумайте пароль')
        return;

    if ( !$('#lg_checkb_offer').is(':checked') )
        return;

    if ( (reg_err[0] + reg_err[1] + reg_err[2]) == 0 ) {

        alert('ок, регистрация, отправка формы...');
        document.register_form.submit();

    }
}


// показать окно покупки купона
function show_kupon_bay() {

    var pos_1 = $('.ram_yelow_dv_rg_butt').offset();
    var pos_2 = $('#content_all').offset();

    $('body').append($('#kupon_bay_pop'));
    $('#kupon_bay_pop').css({
        'left': pos_2.left+8,
        'top': pos_1.top + 40
    });
    $('#kupon_bay_pop').stop().animate({
        "height": "show",
        "opacity": "show"
    }, 200);
    
    $("body").stop().live('click', close_kupon_bay);
    return false;
}

// скрыть окно покупки купона
function close_kupon_bay(event) {
    $('#kupon_bay_pop').stop().animate({
        "height": "hide", 
        "opacity": "hide"
    }, 400);
}


function close_prof_pop_win() {
    $('#prof_pop_win').hide();
    $('#fade').remove();
}

// показать корзину
function show_basket() {

    if ($('#fade')[0] == undefined)
    {
        $("body").append('<div id="fade" ></div>');
        body_height = document.documentElement.scrollHeight;
        $("body #fade").css("height",body_height);
    }

    $("#shop_basket").center();

    var w = $(window);
    $("#shop_basket").css('top', 20+w.scrollTop()+'px');

    if ($.browser.msie) {

        $("body #fade").fadeTo(300, 0.4, function() {
            $("#shop_basket").show();
        });

    } else {

        $("body #fade").fadeTo(500, 0.4);
        $("#shop_basket").fadeTo(500, 1);
    }
    $("#fade").click(close_basket);
    return false;
}

// закрыть корзину
function close_basket() {

    $('#shop_basket').slideUp(500, function() {
        $("#fade").remove();
    });
}

(function($){
    $(function(){
        $('#orderBasket').live('click', show_basket);
//        $('#showKuponBay').live('click', show_kupon_bay);

        $('.show-number-1').live('click',show_kupon_bay);

        $('.show-number-2').live('click', function(event) {
            $('body,html').animate({
                scrollTop: 0
            }, 1300, function() {
//                $('.show-number-1').click();
                show_kupon_bay();
            });
        });


        $('.putToBasket').live('click', function(){
            var id = $(this).data('actid');
            $.ajax({
                'url' : '/acts/addToBasket/act_id/'+id,
                'type': 'GET',
                'dataType' : 'json'
            })
            .done(function(resp){
                $('#topBar').fadeOut(function(){
                    $('#topBar').replaceWith(resp.small).fadeIn('slow');
                });
                $('#shop_basket').replaceWith(resp.full);
            })
            .error(function(resp){
                console.log('Error: ' + resp);
            });
            return false;
        });

        $('.deleteFromBasket').live('click', function(){
            var id = $(this).data('actid');
            $.ajax({
                'url' : '/acts/deleteFromBasket/act_id/'+id,
                'type': 'GET',
                'dataType' : 'json'
            })
            .done(function(resp){
                $('#shop_basket').fadeOut(function(){
                    $(this).replaceWith(resp.full);
                    show_basket();
                });
                $('#topBar').replaceWith(resp.small);
            })
            .error(function(resp){
                console.log('Error: ' + resp);
            });
            return false;
        })

        $('.updateBasket').live('change', function(){
            var id = $(this).data('actid'),
            amount = $(this).val();
            $.ajax({
                'url' : '/acts/updateBasket/act_id/'+id+'/amount/'+amount,
                'type': 'GET',
                'dataType' : 'json'
            })
            .done(function(resp){
                $('#shop_basket').fadeOut(function(){
                    $(this).replaceWith(resp.full);
                    show_basket();
                });
                $('#topBar').replaceWith(resp.small);
            })
            .error(function(resp){
                console.log('Error: ' + resp);
            });
            return false;
        })
    });
})(jQuery);