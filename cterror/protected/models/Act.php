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
 * @property integer $coupon_count
 * @property integer $coupon_need
 * @property integer $is_bonus
 * @property string $date_start_act
 * @property string $date_end_act
 * @property string $date_end_coupon_act
 */
class Act extends CActiveRecord
{
        public $delete_picture; 
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Act the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'act';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_act, photo_act, short_text_act, full_text_act, id_org_act, id_town_act, id_themes_act, price_old, price_new, coupon_count, coupon_need, is_bonus, date_start_act, date_end_act, date_end_coupon_act', 'required'),
			array('id_org_act,delete_picture, id_town_act, id_themes_act, coupon_count, coupon_need, is_bonus', 'numerical', 'integerOnly'=>true),
			array('price_old, price_new', 'numerical'),
			array('name_act', 'length', 'max'=>500),
                        array('photo_act', 'file', 'types'=>'jpg, gif, png',"allowEmpty"=>TRUE),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_act, delete_picture, name_act, photo_act, short_text_act, full_text_act, id_org_act, id_town_act, id_themes_act, price_old, price_new, coupon_count, coupon_need, is_bonus, date_start_act, date_end_act, date_end_coupon_act', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
                        'town'=>array(self::BELONGS_TO,'Town','id_town_act'),
                        'user'=>array(self::BELONGS_TO,'User','id_org_act'),
			//'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
		);
	}
        
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'id_act' => '#',
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
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_act',$this->id_act);
		$criteria->compare('name_act',$this->name_act,true);
		$criteria->compare('photo_act',$this->photo_act,true);
		$criteria->compare('short_text_act',$this->short_text_act,true);
		$criteria->compare('full_text_act',$this->full_text_act,true);
		$criteria->compare('id_org_act',$this->id_org_act);
		$criteria->compare('id_town_act',$this->id_town_act);
		$criteria->compare('id_themes_act',$this->id_themes_act);
		$criteria->compare('price_old',$this->price_old);
		$criteria->compare('price_new',$this->price_new);
		$criteria->compare('coupon_count',$this->coupon_count);
		$criteria->compare('coupon_need',$this->coupon_need);
		$criteria->compare('is_bonus',$this->is_bonus);
		$criteria->compare('date_start_act',$this->date_start_act,true);
		$criteria->compare('date_end_act',$this->date_end_act,true);
		$criteria->compare('date_end_coupon_act',$this->date_end_coupon_act,true);
    
                if (Yii::app()->user->role==  User::ROLE_LOCALE_ADMIN)
                            $criteria->compare('id_town_act', Yii::app()->user->getTownId(), true);

                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

//////////////////////////// сохранение прикрепленного изображения к акции        

        private function getCurrentOrder()
        {
            $current_order = 1000;
            while ($this->id_act > $current_order)
                $current_order += 1000;

            return $current_order;
        }

        public function getPictureSavePath($md5_hash,$type)
        {
            if (!in_array($type,array("original","resized")))
                throw new Exception("Unknown avatar type");
            else
            {
                if (!is_dir ($_SERVER["DOCUMENT_ROOT"]."/upload/act/".$type."/".$this->getCurrentOrder()))
                    mkdir($_SERVER["DOCUMENT_ROOT"]."/upload/act/".$type."/".$this->getCurrentOrder(),0777,true);

                return $_SERVER["DOCUMENT_ROOT"]."/upload/act/".$type."/".$this->getCurrentOrder()."/".$md5_hash.".jpg";                
            }
        }    

        public function getPictureWebPath($type)
        {
            return "/upload/act/".$type."/".$this->getCurrentOrder()."/".$this->photo_act.".jpg"; 
        }

        public function getPictureImageHtmlCode($type)
        {
            if ($this->photo_act)
                return "<img src='".$this->getPictureWebPath($type)."' >"; 
            else
                return "";
        }    


        public function savePicture()
        {
            $this->photo_act = CUploadedFile::getInstance($this,'photo_act');
            if (!empty($this->photo_act->tempName))
            {
                $orig_save_path = $this->getPictureSavePath(md5_file($this->photo_act->tempName),"original");
                $this->photo_act->saveAs($orig_save_path);
                $resize_save_path = $this->getPictureSavePath(md5_file($orig_save_path),"resized");
                WideImage::load($orig_save_path)->resize(200,200)->saveToFile($resize_save_path);
                $this->photo_act = md5_file($orig_save_path);
                $this->save(false);
            }
        }

        public function deletePicture()
        {
            $photo_act = $this->photo_act;
            if (!empty($this->photo_act))
                if (unlink($this->getPictureSavePath($this->photo_act,"original"))
                        &&
                    unlink($this->getPictureSavePath($this->photo_act,"resized")))
                    {
                        $this->photo_act = NULL;
                        $this->save();            
                        Act::model()->updateAll(array("photo_act"=>NULL),"photo_act='".$photo_act."'");                
                        return true;
                    }
            return false;
        }


        public function beforeDelete() 
        {
            $this->deletePicture();
            return parent::beforeDelete();
        }

        public function getPictureSrc($type)
        {
            if ($this->photo_act)
                return $this->getPictureSavePath($this->photo_act, $type);
            else
                return false;
        }        
}