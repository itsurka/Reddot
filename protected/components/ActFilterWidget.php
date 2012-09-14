<?php

class ActFilterWidget extends CWidget {

    public $availableActions = array('index', 'archive', 'bonus', 'map', 'search');

    public function init() {
        parent::init();

        $this->_registerScript();
    }

    public function getUrl($params = array(), $clearParams = false) {
        $actionId = 'index';
        if (in_array($this->controller->action->id, $this->availableActions))
            $actionId = $this->controller->action->id;

        if (!$clearParams)
            $params = array_merge($_GET, $params);
        else if (isset($_GET['ActSearchForm'])) {
            unset($params);
            $params['ActSearchForm'] = $_GET['ActSearchForm'];
        }

        if (isset($params['id']))
            unset($params['id']);

        return Yii::app()->createUrl("acts/{$actionId}", $params);
    }

    private function _registerScript() {
        $script = "
            var params = {};
            ";

        if ($this->controller->action->id == 'map') {
            $script .= "
                map_ob_moveto_num(0);
                // перемещение селектора меню слева для выбора группы объектов на карте
                $('#map_ob_draggable').draggable({
                    handle: '#lf_menu_map_select_handle',
                    cursor: 'move',
                    axis:   'y',
                    containment: 'parent',
                    stop: function(event, ui) {
                        map_ob_moveto_selected();
                    }
                });

                // элементы меню на которые будет реагировать перемещаемый селектор
                $('.themes_ul li').droppable({
                    hoverClass: 'hover',
                    accept: '#map_ob_draggable',

                    over: function(event, ui) {

                        $('.themes_ul li.selected').removeClass('selected');
                        $('.themes_ul li.hover:first').addClass('selected');
                    }
                });

                // удалить с меню прошлые события кликов
                $('.themes_ul li a').unbind('click');

                // при клике на элементе меню - перемещеие туда селектора и выбор группы
                $('.themes_ul li a').click(function(){

                    if (!map_ob_on_load_all) {
                        //  return false;
                    }

                    $('.themes_ul li.selected').removeClass('selected');
                    $($(this).parent()).addClass('selected');
                    map_ob_moveto_selected();

                    return false;
                });

                // переместить селектор меню в позицию с номером
                function map_ob_moveto_num(num) {

                    $($('.themes_ul li:eq('+num+')')).addClass('selected');
                    map_ob_moveto_selected();
                }

                // переместить селектор меню в позицию с классом selected
                function map_ob_moveto_selected() {
                    var pos = $('.themes_ul li.selected:first').position();
                    map_ob_movesel_topos(pos.top);
                    // получить номер меню
                    var el =  $('.themes_ul li.selected:first').get(0);
                    map_ob_currnum_elsel = $('.themes_ul li').index(el);

                    if ($('#map_ob_draggable').is(':hidden')) {
                        $('#map_ob_draggable').fadeIn(100);
                        map_ob_on_load_all = 1;
                    }

                    onClickLink($(el).find('a'));
                }

                // анимация перемещения меню в по координате top
                function map_ob_movesel_topos(top) {
                    $('#map_ob_draggable').stop().animate({'top': top + 3}, 400);
                }

                function checkMarks() {
                    for(var i = 0; i < marks.length; i++) {
                        myMap.geoObjects.remove(marks[i]['placemark']);
                    }

                    for(var i = 0; i < marks.length; i++) {
                        if(marks[i].theme_id == params.id_themes_act || typeof(params.id_themes_act) == 'undefined') {
                            myMap.geoObjects.add(marks[i]['placemark']);
                        }
                    }
                }

                function checkActiveLinks() {

                    $('.type_themes li').removeClass('active');
                    $('.themes_ul li.selected').removeClass('selected');

                    //Если в параметрах выбрана какая-то тема, то ищем активную ссылку для темы
                    if(array_key_exists('id_themes_act', params)) {
                        $('.type_themes li').removeClass('active');
                        $('.type_themes_' + params.id_themes_act).addClass('selected');
                        map_ob_moveto_selected();
                    }

                    checkMarks();
                }
            ";
        }
        else {
            $script .= "
                    function checkActiveLinks(){
                    //Сбрасываем все активные ссылки
                    $('.type_themes li').removeClass('active');
                    $('.type_top_menu div').removeClass('mn2_act');

                    //Если в параметрах выбрана какая-то тема, то ищем активную ссылку для темы
                    if(array_key_exists('id_themes_act', params)) {
                        $('.type_themes li').removeClass('active');
                        $('.type_themes_' + params.id_themes_act).addClass('active');
                    }

                    //Если в параметрах выбран какой-то фильтр, то ищем активную ссылку для фильтра
                    if(array_key_exists('filter', params)) {
                        $('.type_top_menu div').removeClass('mn2_act');
                        $('.type_top_menu_' + params.filter).addClass('mn2_act');
                    }

                    //Если в не выбрана ни одна тема, то делаем активной ссылку 'Все темы'
                    if(!array_key_exists('id_themes_act', params)) {
                        $('.type_themes_reset_all').addClass('active');
                    }
                    
                    //Если не выбран ни один фильтр, то делаем активной кнопку 'Новые'
                    if(!array_key_exists('filter', params) ) {
                        $('.type_top_menu_new').addClass('mn2_act');
                    }
                }";
        }

        $script .= "
            function getContent() {
                $.ajax({
                    url: '" . $this->url . "',
                    data: params,
                    complete: function(response) {
                        $('#acts_container').html(response.responseText);
                    }
                });

                checkActiveLinks();
            }

            function setParams(url) {
                if(!url) {
                    var hash = window.location.hash.replace('#!', '?');
                    if(!hash)
                        return;

                    url = hash;
                }

                params = array_merge(params, URL.parse(url).params);
            }

            setParams();
            getContent();

            function onClickLink(link) {
                var href = $(link).attr('href');

                if($(link).attr('id') == 'resetAll') {
                    delete params.id_themes_act;
                }
                else {
                    setParams(href);
                }

                window.location = URL.parse(href).pathname + '#!' + URL.serialize(params).replace('=undefined', '');
            }

            $('.filter_link a').click(function() {
                onClickLink($(this));
                return false;
            });

            $(window).bind('hashchange', function() {
                getContent();
            });
        ";
        if (Yii::app()->controller->action->id !== 'search')
            Yii::app()->clientScript->registerScript('filterWidget', $script);
    }

}