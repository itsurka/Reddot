<?php

/**
 * 
 */
class YandexMaps extends CWidget {

    public $yandexJSAPIURL = 'http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU';
    public $jsInitYandexMap = '';
    public $pointsArray = array();
    public $defaultPointImgURL = '/images/map_myIcon.png';
    public $pointOnHoverImgUrl = '/images/map_myIcon.png';
    public $dataProvider = null;
    public $isClearMap = false; // Если $isClearMap установлен в true, то отображать точки на карте не будем

    public function init() {
        parent::init();

        $cnt = 0;
        if (count($this->dataProvider->getData()) > 0) {
            $uniqueAddressArray = array();
            foreach ($this->dataProvider->getData() as $data) {
                foreach ($data->user->getAddressToArray() as $item) {
                    $uniqueValue = md5($item->address . $data->id_themes_act);
                    if (!in_array($uniqueValue, $uniqueAddressArray)) {
                        $uniqueAddressArray[] = $uniqueValue;
                        $this->addPoint($item->address, $data, $data->id_themes_act);
                        $cnt++;
                    }
                }
            }
        }

        if ($cnt == 0) {
            $town = Yii::app()->user->getTown()->name_towns;
            $this->addPoint($town, '', '');
            $this->isClearMap = true;
        }

        $this->generateMap();
    }

    public function addPoint($pointAddress, $pointActModel, $pointTheme = '', $pointImgUrl = '') {

        $newPoint = array();
        $newPoint['pointActModel'] = $pointActModel;
        $newPoint['pointTheme'] = $pointTheme;
        $newPoint['pointImgUrl'] = $pointImgUrl;

        if (is_string($pointAddress)) {
            $newPoint['pointAddress'] = $pointAddress;
        } elseif (is_array($pointAddress)) {
            $newPoint['pointLong'] = $pointAddress[0];
            $newPoint['pointLat'] = $pointAddress[1];
        }

        array_push($this->pointsArray, $newPoint);
        return true;
    }

    public function generateMap() {
        $centerCoordArray = $this->_getCenterCoordinates();
        $zoom = $this->_getZoom();

        $this->jsInitYandexMap = "
            var map_ob_group_arr        = [];       // массив с группами объктов на карте
            var map_ob_currnum_elsel    = 0;        // изначально выбранная категория меню
            var map_ob_on_load_all      = 0;        // когда карта загрузится и появится селектор = 1

            $.getScript('{$this->yandexJSAPIURL}', function() {

                setTimeout(function(){
                    map_ob_onload();
                }, 500);

                function map_ob_onload() {
                    if ((typeof(ymaps) == 'undefined') || (typeof(ymaps.Map) == 'undefined')) {
                        setTimeout(function() {
                            map_ob_onload();
                        }, 100);

                    } else {
                        map_ob_init();
                    }
                }
            });

            var myMap = false;
            var marks = [];

            function map_ob_init() {
                $('#myMap').html('');";

        foreach ($this->pointsArray as $key => $point) {
            $this->jsInitYandexMap .= "
                var geocode_{$key} = ymaps.geocode('{$point['pointAddress']}', {
                    results: 1
                });

                geocode_{$key}.then(function (res) {
                    var geoObject_{$key} = res.geoObjects.get(0);
                    myPlacemark_{$key}_coordinatesArray = geoObject_{$key}.geometry.getCoordinates();
                    var pointLong_{$key} = myPlacemark_{$key}_coordinatesArray[0];
                    pointLong_{$key} = pointLong_{$key}.toFixed(2);
                    var lat_{$key} = myPlacemark_{$key}_coordinatesArray[1];
                    lat_{$key} = lat_{$key}.toFixed(2);

                    myPlacemark_{$key}_coordinates = [pointLong_{$key}, lat_{$key}];
                    var myPlacemark_{$key} = new ymaps.Placemark(myPlacemark_{$key}_coordinates, {
                        balloonContentBody: '" . addslashes($this->render('yandexmapsballoon', array('model' => $point['pointActModel']), true)) . "',
                    }, {
                        iconImageHref: '{$this->defaultPointImgURL}',
                        iconImageSize: [26, 32],   // размеры картинки
                        iconImageOffset: [-3, -42] // смещение картинки
                    });

                    myPlacemark_{$key}.events.add('mouseenter', function(elem){
                        oldImgURL_{$key} = myPlacemark_{$key}.options.get('iconImageHref');
                        myPlacemark_{$key}.options.set({
                            iconImageHref: '{$this->pointOnHoverImgUrl}'
                        });
                    });

                    myPlacemark_{$key}.events.add('balloonclose', function(elem){
                        myPlacemark_{$key}.options.set({
                            iconImageHref: '{$this->pointOnHoverImgUrl}'
                        });
                    });

                    myPlacemark_{$key}.events.add('mouseleave', function(elem){
                        myPlacemark_{$key}.options.set({
                            iconImageHref: '{$this->pointOnHoverImgUrl}'
                        });
                    });

                    var mapProperties_{$key} = {
                        //center: [{$centerCoordArray[0]}, {$centerCoordArray[1]}],
                        center: geoObject_{$key}.geometry.getCoordinates(),
                        zoom: {$zoom}
                    };

                    if(myMap == false) {
                        myMap = new ymaps.Map('myMap', mapProperties_{$key});
                        myMap.controls.add('mapTools').add('zoomControl').add('typeSelector');
                    }

                    marks[{$key}] = [];
                    marks[{$key}]['placemark'] = myPlacemark_{$key};
                    marks[{$key}]['theme_id'] = '{$point['pointTheme']}';";

            if (!$this->isClearMap) {
                $this->jsInitYandexMap .= "
                    if(params.id_themes_act == marks[{$key}]['theme_id'] || typeof(params.id_themes_act) == 'undefined') {
                        myMap.geoObjects.add(myPlacemark_{$key});
                    }
                ";
            }

            $this->jsInitYandexMap .= "});";
        }

        $this->jsInitYandexMap .= "}";

        Yii::app()->clientScript->registerScript('yandexMaps', $this->jsInitYandexMap);
        $this->render('yandexMaps');
    }

    private function _getZoom() {
        $rigthPoint = false;
        $leftPoint = false;
        $topPoint = false;
        $bottomPoint = false;
        $extremePoints = array();
        $zoom = 10;

        if (count($this->pointsArray) > 0) {
            foreach ($this->pointsArray as $key => $point) {
                if (isset($point['pointLong'], $point['pointLat'])) {
                    if ($rigthPoint === false || $rigthPoint[1] < $point['pointLat'] && $rigthPoint['id'] !== $key && !array_search($key, $extremePoints)) {
                        if ($rigthPoint) {
                            if (in_array($rigthPoint['id'], $extremePoints))
                                unset($extremePoints[array_search($rigthPoint['id'], $extremePoints)]);
                            array_push($extremePoints, $key);
                        }
                        $rigthPoint = array(
                            $point['pointLong'],
                            $point['pointLat'],
                            'id' => $key,
                        );
                    }
                    if ($leftPoint === false || $leftPoint[1] > $point['pointLat'] && $leftPoint['id'] !== $key && !array_search($key, $extremePoints)) {
                        if ($leftPoint) {
                            if (in_array($leftPoint['id'], $extremePoints))
                                unset($extremePoints[array_search($leftPoint['id'], $extremePoints)]);
                            array_push($extremePoints, $key);
                        }
                        $leftPoint = array(
                            $point['pointLong'],
                            $point['pointLat'],
                            'id' => $key,
                        );
                    }
                    if ($topPoint === false || $topPoint[0] < $point['pointLong'] && $topPoint['id'] !== $key && !array_search($key, $extremePoints)) {
                        if ($topPoint) {
                            if (in_array($topPoint['id'], $extremePoints))
                                unset($extremePoints[array_search($topPoint['id'], $extremePoints)]);
                            array_push($extremePoints, $key);
                        }
                        $topPoint = array(
                            $point['pointLong'],
                            $point['pointLat'],
                            'id' => $key,
                        );
                    }
                    if ($bottomPoint === false || $bottomPoint[0] > $point['pointLong'] && $bottomPoint['id'] !== $key && !array_search($key, $extremePoints)) {
                        if ($bottomPoint) {
                            if (in_array($bottomPoint['id'], $extremePoints))
                                unset($extremePoints[array_search($bottomPoint['id'], $extremePoints)]);
                            array_push($extremePoints, $key);
                        }
                        $bottomPoint = array(
                            $point['pointLong'],
                            $point['pointLat'],
                            'id' => $key,
                        );
                    }
                }
            }
        }
        $diffHorizontal = false;
        if ($leftPoint && $rigthPoint)
            $diffHorizontal = abs($rigthPoint[1] - $leftPoint[1]);
        if (!$diffHorizontal && $rigthPoint && $topPoint)
            $diffHorizontal = abs($rigthPoint[1] - $topPoint[1]);
        if (!$diffHorizontal && $rigthPoint && $bottomPoint)
            $diffHorizontal = abs($rigthPoint[1] - $bottomPoint[1]);
        if (!$diffHorizontal && $leftPoint && $topPoint)
            $diffHorizontal = abs($leftPoint[1] - $topPoint[1]);
        if (!$diffHorizontal && $leftPoint && $bottomPoint)
            $diffHorizontal = abs($leftPoint[1] - $bottomPoint[1]);
        // diff top - bottom
        $diffVertical = false;
        if ($topPoint && $bottomPoint)
            $diffVertical = abs($topPoint[0] - $bottomPoint[0]);
        if (!$diffVertical && $topPoint && $rigthPoint)
            $diffVertical = abs($topPoint[0] - $rigthPoint[0]);
        if (!$diffVertical && $topPoint && $leftPoint)
            $diffVertical = abs($topPoint[0] - $leftPoint[0]);
        if (!$diffVertical && $bottomPoint && $rigthPoint)
            $diffVertical = abs($bottomPoint[0] - $rigthPoint[0]);
        if (!$diffVertical && $bottomPoint && $leftPoint)
            $diffVertical = abs($bottomPoint[0] - $leftPoint[0]);

        $maxDiff = false;
        if ($diffHorizontal && $diffVertical) {
            $maxDiff = $diffHorizontal > $diffVertical ? $diffHorizontal : $diffVertical;
        } elseif ($diffHorizontal) {
            $maxDiff = $diffHorizontal;
        } elseif ($diffVertical) {
            $maxDiff = $diffVertical;
        }

        if ($maxDiff) {
            $maxDiff = (float) $maxDiff;
            $s = $maxDiff * $maxDiff * $maxDiff;
            $zoom = (100 - $maxDiff) * 0.0850000;
        }
        return floor($zoom);
    }

    private function _getCenterCoordinates() {
        $longAmount = 0;
        $latAmount = 0;
        $longAverage = 0;
        $latAverage = 0;
        $numPoints = 0;
        if (count($this->pointsArray) > 0) {
            foreach ($this->pointsArray as $key => $point) {
                if (isset($point['pointLong'], $point['pointLat'])) {
                    $longAmount += (float) $point['pointLong'];
                    $latAmount += (float) $point['pointLat'];
                    $numPoints++;
                }
            }
        }
        if ($longAmount > 0 && $latAmount > 0) {
            $longAverage = number_format($longAmount / $numPoints, 2);
            $latAverage = number_format($latAmount / $numPoints, 2);
        } else {
            $longAverage = '55.60';
            $latAverage = '37.45';
        }
        return array($longAverage, $latAverage);
    }

    public function setDefaultPointImgURL($url) {
        $this->defaultPointImgURL = $url;
    }

}