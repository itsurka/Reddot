<?php

/**
 * This is the model class for table "act".
 *
 * The followings are the available columns in table 'act':
 * @property integer $id_act
 * @property string $name_act
 * @property string $photo_act
 * @property string $short_text_act
 * @property string $full_text_act
 * @property integer $id_org_act
 * @property integer $id_town_act
 * @property integer $id_themes_act
 * @property double $price_old
 * @property double $price_new
 * @property integer $coupon_need
 * @property integer $is_bonus
 * @property string $date_start_act
 * @property string $date_end_act
 * @property string $date_end_coupon_act
 * @property string $is_active
 * @property string $is_published
 * @property string $sent_past_notification
 * @property string $sent_expired_coupons_date_notification Отправлено ли уведомление об окончании срока действия купонов
 * @property string $additional_images
 */
class Act extends CActiveRecord implements IECartPosition {

    const ITEMS_PER_PAGE = 20; // Кол-во акций на одной странице
    const RAISE_BONUS = 100;

    public $imageAvailableSizes = array("original", "resized", '340x185', '550x315', '185x100', '120x214');
    public $filter = null;
    public $delete_picture;
    public $coupon_count = 0;
    public $shortUrlPattern = '|^[a-zA-Z0-9-_]+|';
    public $additionalImagesArray;

    /**
     * Дополнительные параметры для фильтра в админке
     */
    public $isActive = null; // Акция закончилась?
    public $endedCoupons = null; // Закончились купоны
    public $orgNameSearch = null; // Название организации

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Act the static model class
     */

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'act';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name_act, short_text_act, coupon_count, photo_act, short_url, full_text_act, terms, id_org_act, id_town_act, id_themes_act, is_bonus, date_start_act, date_end_act, date_end_coupon_act, is_active', 'required'),
            array('paid,id_org_act,delete_picture, id_town_act, id_themes_act, coupon_count, coupon_need, is_bonus, is_active', 'numerical', 'integerOnly' => true),
            array('price_old, price_new', 'numerical'),
            array('short_url', 'unique'),
            array('short_url', 'match', 'pattern' => $this->shortUrlPattern, 'allowEmpty' => false, 'message' => 'ЧПУ содержит не допустимые символы. Разрешается использовать: a-z A-Z - _'),
            array('name_act, price_new_description, seo_title, seo_keywords, seo_description', 'length', 'max' => 500),
            array('short_url', 'length', 'max' => 32),
            array('photo_act', 'file', 'types' => 'jpg, jpeg, gif, png', "allowEmpty" => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_act, filter, id_tag_act, orgNameSearch, name_act, short_text_act, id_org_act, id_town_act, coupon_count, is_bonus, date_start_act, date_end_act, date_end_coupon_act, is_published, additional_images', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        $relations = array(
            'town' => array(self::BELONGS_TO, 'Town', 'id_town_act'),
            'theme' => array(self::BELONGS_TO, 'Theme', 'id_themes_act'),
            'user' => array(self::BELONGS_TO, 'User', 'id_org_act'),
            'coupons' => array(self::HAS_MANY, 'Coupon', 'act_id'),
            'firstCoupon' => array(self::HAS_ONE, 'Coupon', 'act_id', 'order' => 'total_cost ASC'),
            'couponCount' => array(self::STAT, 'Coupon', 'act_id', 'order' => 'total_cost ASC'),
            'favorites' => array(self::HAS_MANY, 'Favorites', 'id_act_fav', 'condition' => 'id_user_fav = :id_user_fav', 'params' => array(':id_user_fav' => 0)),
        );
        // Костыль, если скрипт запущен не из консоли,
        if (php_sapi_name() != 'cli')
            $relations['favorites']['params'][':id_user_fav'] = Yii::app()->user->id;

        return $relations;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_act' => '#',
            'paid' => 'Родительская акция',
            'name_act' => 'Название',
            'photo_act' => 'Фото',
            'short_text_act' => 'Краткое описание',
            'full_text_act' => 'Полное описание',
            'id_org_act' => 'Организация',
            'id_town_act' => 'Город',
            'id_themes_act' => 'Тема',
            'price_old' => 'Старая цена',
            'price_new' => 'Новая цена',
            'coupon_count' => 'Количество купонов',
            'coupon_need' => 'Необходимо купонов',
            'is_bonus' => 'Бонус',
            'date_start_act' => 'Начало',
            'date_end_act' => 'Окончание',
            'date_end_coupon_act' => 'Действует до',
            'terms' => 'Условия акции',
            'seo_title' => 'Название страницы',
            'seo_keywords' => 'Ключевые слова',
            'seo_description' => 'Описание страницы',
            'short_url' => 'Ссылка (ЧПУ)',
            'coupon_purchased' => 'Куплено купонов',
            'price_new_description' => 'Price Description',
            'is_active' => 'Показывать на сайте',
            'is_published' => 'Is published',
            'sent_past_notification' => 'Sent act. is past notification',
            'sent_expired_coupons_date_notification' => 'Отправлено ли уведомление об окончании срока действия купонов',
            'additional_images' => 'Дополнительные картинки',
        );
    }

    public function adminSearch() {
        $criteria = new CDbCriteria;
        $criteria->with = array('user');

        $criteria->compare('t.id_act', $this->id_act);
        $criteria->compare('t.name_act', $this->name_act, true);
        $criteria->compare('t.id_org_act', $this->id_org_act);
        $criteria->compare('t.id_town_act', $this->id_town_act);
        $criteria->compare('t.is_bonus', $this->is_bonus == 1 ? $this->is_bonus : null);
        $criteria->compare('user.company_name', $this->orgNameSearch, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 15,
                    ),
                ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($addCondition = '', $limit = '') {
        $criteria = new CDbCriteria;
        if (!Yii::app()->controller->module) {
            $limit = ($limit == '') ? self::ITEMS_PER_PAGE : $limit;
            $criteria = new CDbCriteria;
//            $criteria->select = 'NOW() AS terms';
            $criteria->compare('id_act', $this->id_act);
            $criteria->compare('id_themes_act', $this->id_themes_act);
            if ($addCondition) {
                $criteria->addCondition($addCondition);
            }

            if ((int) $this->filter > 0) {
                $criteria->compare('id_tag_act', $this->filter);
            }

            $criteria->addCondition('id_town_act = :id_town_act');
            $criteria->params[':id_town_act'] = Yii::app()->user->getTown() ? Yii::app()->user->getTown()->id_towns : 0;

            switch ($this->filter) {
                case 'top' : break;
                case 'new' : {
                        $interval = 100; //last days
                        $criteria->addCondition("date_start_act > DATE_SUB(CURDATE(), INTERVAL {$interval} DAY)");
                        break;
                    };
                case 'fav' : {
                        $criteria->with = array('favorites');
                        $criteria->addInCondition('id_act', CHtml::listData(Favorites::model()->findAll(
                                                array(
                                                    'condition' => ':id_user_fav',
                                                    'params' => array(':id_user_fav' => Yii::app()->user->id),
                                        )), 'id_act_fav', 'id_act_fav'));
                        break;
                    };
            }

            /**
             * It works just on 2 levels depth
             */
            $criteria->order = "case when paid = 0 then id_act else paid end,
                            case when paid = 0 then '1' else '2' end,
                            id_act";
        }

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => $limit,
                    ),
                ));
    }

//////////////////////////// сохранение прикрепленного изображения к акции        

    private function getCurrentOrder() {
        $current_order = 1000;
        while ($this->id_act > $current_order)
            $current_order += 1000;

        return $current_order;
    }

    public function getPictureSavePath($md5_hash, $type) {
        if (!in_array($type, $this->imageAvailableSizes))
            throw new Exception("Unknown avatar type");
        else {
            if (!is_dir(Yii::getPathOfAlias('webroot') . "/upload/act/" . $type . "/" . $this->getCurrentOrder())) {
                mkdir(Yii::getPathOfAlias('webroot') . "/upload/act/" . $type . "/" . $this->getCurrentOrder(), 0777, true);
            }

            return Yii::getPathOfAlias('webroot') . "/upload/act/" . $type . "/" . $this->getCurrentOrder() . "/" . $md5_hash . ".jpg";
        }
    }

    public function getPictureWebPath($type) {
        return "/upload/act/" . $type . "/" . $this->getCurrentOrder() . "/" . $this->photo_act . ".jpg";
    }

    public function getAdditionalPictureWebPath($type, $photo) {
        return "/upload/act/" . $type . "/" . $this->getCurrentOrder() . "/" . $photo . ".jpg";
    }

    public function getPictureImageHtmlCode($type, $htmlOptions = array(), $alt = '') {
        if ($this->photo_act)
            return CHtml::image($this->getPictureWebPath($type), $alt, $htmlOptions);
        else
            return "";
    }

    public function savePicture() {

        $_oldValue = $this->photo_act;
        $this->photo_act = CUploadedFile::getInstance($this, 'photo_act');

        if (!empty($this->photo_act->tempName)) {
            $orig_save_path = $this->getPictureSavePath(md5_file($this->photo_act->tempName), "original");
            $this->photo_act->saveAs($orig_save_path);

            // 550x315
            $resize_save_path = $this->getPictureSavePath(md5_file($orig_save_path), "550x315");
            WideImage::load($orig_save_path)->resize(550, 315, 'outside')->saveToFile($resize_save_path);
            //340x185
            $resize_save_path = $this->getPictureSavePath(md5_file($orig_save_path), "340x185");
            WideImage::load($orig_save_path)->resize(340, 185, 'outside')->saveToFile($resize_save_path);
            // 200x200
            $resize_save_path = $this->getPictureSavePath(md5_file($orig_save_path), "resized");
            WideImage::load($orig_save_path)->resize(200, 200)->saveToFile($resize_save_path);
            //185x100
            $resize_save_path = $this->getPictureSavePath(md5_file($orig_save_path), "185x100");
            WideImage::load($orig_save_path)->resize(185, 100, 'outside')->saveToFile($resize_save_path);
            //120x214
            $resize_save_path = $this->getPictureSavePath(md5_file($orig_save_path), "120x214");
            $image = WideImage::load($orig_save_path)->resize(null, 214, 'outside');
            WideImage::load($image->getHandle())->crop('left', 'top', '120')->saveToFile($resize_save_path);
            //
            $this->photo_act = md5_file($orig_save_path);
            $this->save(false);
            return md5_file($orig_save_path);
        }
        $this->photo_act = $_oldValue;
        return '';
    }

    public function getAdditionalImages() {
        $return = array();
        if (!empty($this->additional_images)) {
            if (is_string($this->additional_images) && is_array(json_decode($this->additional_images))) {
                $return = json_decode($this->additional_images);
            } else if (is_array($this->additional_images)) {
                $return = $this->additional_images;
            }
        }
        return $return;
    }

    /**
     * Сохраняем доп. картинки для акций
     * @return bool
     */
    public function saveAdditionalImages($mainImage=null) {
        $this->clearAdditionalImages();
        $savedAdditionalImages = array();

        // Save old images (if exists)
        if (!empty($_POST['added_act_photo'])) {
            $this->additional_images = $_POST['added_act_photo'];
        }
        if (!empty($mainImage)) {
            $this->addToAdditionalImages($mainImage, 'prepend');
        }

        // Save uploaded images
        $countImages = count(@$_FILES['Act']['name']['additional_images']);

        if (!$countImages) {
            $this->additional_images = array_merge($this->getAdditionalImages(), $savedAdditionalImages);
            $this->save(false);
            return false;
        }

        for ($i=0; $i<$countImages; $i++) {
            $uploadedImage = CUploadedFile::getInstance($this, "additional_images[$i]");

            if ($uploadedImage!==null && !$uploadedImage->getHasError()) {
                $orig_save_path = $this->getPictureSavePath(md5_file($uploadedImage->tempName), "original");
                $uploadedImage->saveAs($orig_save_path);

                // 550x315
                $resize_save_path = $this->getPictureSavePath(md5_file($orig_save_path), "550x315");
                WideImage::load($orig_save_path)->resize(550, 315, 'outside')->saveToFile($resize_save_path);

                $savedAdditionalImages[] = md5_file($orig_save_path);
            }
        }
        $this->additional_images = array_merge($this->getAdditionalImages(), $savedAdditionalImages);
        $this->save(false);

        return true;
    }

    public function addToAdditionalImages($image, $addType='append') {
        $_additional_images = $this->getAdditionalImages();
        if (!in_array($image, $_additional_images)) {
            if ($addType == 'append') {
                $_additional_images[] = $image;
            } else {
                array_unshift($_additional_images, $image);
            }
            $this->additional_images = $_additional_images;
            return true;
        }
        return false;
    }

    public function clearAdditionalImages() {
        $this->additional_images = array();
    }

    public function clonePictures($image, $cloneImage) {
        $image .= '.jpg';
        $cloneImage .= '.jpg';

        $sizes = array(
            '550x315',
            '340x185',
            '200x200',
            '185x100',
            '120x214',
            'original',
            'resized',
        );

        foreach ($sizes as $eachSize) {
            $dir = Yii::getPathOfAlias('webroot.upload.act') . '/' . $eachSize . '/' . $this->getCurrentOrder() . '/';
            $imageSource = $dir . $image;
            $imageDest = $dir . $cloneImage;
            if(!is_dir($dir))
                mkdir($dir . 0777, true);
            copy($imageSource, $imageDest);
        }
    }

    public function deletePicture() {
        $photo_act = $this->photo_act;
        if (!empty($this->photo_act))
            if (unlink($this->getPictureSavePath($this->photo_act, "original"))
                    &&
                    unlink($this->getPictureSavePath($this->photo_act, "resized"))) {
                $this->photo_act = NULL;
                $this->save();
                Act::model()->updateAll(array("photo_act" => NULL), "photo_act='" . $photo_act . "'");
                return true;
            }
        return false;
    }

    public function beforeDelete() {
        $this->deletePicture();
        return parent::beforeDelete();
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            $this->additional_images = json_encode($this->getAdditionalImages());
            return true;
        }
        else
            return false;
    }

    public function getPictureSrc($type) {
        if ($this->photo_act)
            return $this->getPictureSavePath($this->photo_act, $type);
        else
            return false;
    }

    public function getIsFav() {
        $exists = Favorites::model()->exists(array(
            'condition' => 'id_user_fav = :id_user_fav AND id_act_fav = :id_act_fav',
            'params' => array(
                ':id_user_fav' => Yii::app()->user->id,
                ':id_act_fav' => $this->id_act,
            ),
                ));

        return $exists;
    }

    public function getEndActionStr() {
        if (strtotime($this->date_end_act) < time())
            return false;

        $array = real_date_diff($this->date_end_act);
        $pos = array('г.', 'мес.', 'дн.', 'ч.', 'мин.', 'сек.');
        $str = '';

        for ($i = 0, $itemsCount = 0; $i < count($array); $i++) {
            if ($array[$i] == 0)
                continue;
            if ($itemsCount >= 2)
                break;

            $str .= "{$array[$i]} {$pos[$i]} ";
            $itemsCount++;
        }

        return $str;
    }

    public function getDiscount() {
        return round($this->firstCoupon->discount);
        //return round($this->price_new);
    }

    public function getTotalCost() {
        return $this->firstCoupon->total_cost;
    }

    public function getCurrencyStr() {
        return $this->is_bonus ? ' бон.' : ' руб.';
    }

    public function getEndDateReadable() {
        $formatter = new CDateFormatter('ru');
        return $formatter->format('d MMMM y', strtotime($this->date_end_act)) . ' г.';
    }

    /** IEPosition interface implementation */
    public function getId() {
        return $this->id_act;
    }

    public function getPrice() {
        return $this->price_new;
    }

    public function getShortName() {
        if (strlen($this->name_act) > 20) {
            return mb_substr($this->name_act, 0, 70, 'UTF-8') . '...';
        } else {
            return $this->name_act;
        }
    }

    public function getRaiseBonusCount() {
        return self::RAISE_BONUS;
    }

    /**
     * Возвращаем кол-во оставшихся купонов
     * @return int
     */
    public function getCouponRemaining() {
        return $this->coupon_count - $this->coupon_purchased;
    }

    public function isForSale() {
        if (($this->coupon_count > $this->coupon_purchased || !$this->getHasLimitedCouponsForSale()) && strtotime($this->date_end_coupon_act) > time()) {
            return true;
        }

        return false;
    }

    /**
     * Делаем обрезание, если название оч. длинное -_-
     * @return type
     */
    public function getShortTitle() {
        // Пока не предусмотрено
        return $this->name_act;
    }

    /**
     * Делаем обрезание, если описание оч. длинное -_-
     * @return type
     */
    public function getShortText() {
        // Пока не предусмотрено
        return $this->short_text_act;
    }

    /**
     * Проверяем если акция ограничена
     * количеством купонов для продажи
     * @return bool
     */
    public function getHasLimitedCouponsForSale() {
        return $this->coupon_count > 0 ? true : false;
    }

/*    protected function beforeSave() {
        if (parent::beforeSave()) {
            if (!$this->isNewRecord && $this->is_active && !$this->is_published) {
                CMailer::addNewActNotification($this);
            }
            return true;
        }
        else
            return false;

    }*/

    /**
     * Условие для того чтобы акция считалась прошедшей
     * @static
     * @return string
     */
    public static function getPastActCondition() {
        return 'is_bonus = 0 AND ((date_end_act <= NOW()) OR  (coupon_count <= coupon_purchased AND coupon_count > 0))  AND paid = 0 AND is_active IS TRUE';
    }

    /**
     * Условие для того чтобы акция считалась прошедшей
     * @static
     * @return string
     */
    public static function getExpiredCouponsDateActCondition() {
        return 'date_end_coupon_act <= NOW()';
    }

    public function getUrl() {
        return CHtml::link(CHtml::encode($this->shortName), array("/{$this->short_url}"));
    }

    public function getStrActType() {
        return $this->is_bonus ? 'Бонусеая' : 'Денежная';
    }
}