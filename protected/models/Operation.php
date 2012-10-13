<?php

/**
 * This is the model class for table "operation".
 *
 * The followings are the available columns in table 'operation':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property integer $user_id
 * @property integer $summ
 * @property integer $type
 * @property integer $status
 * @property string $extra
 * @property integer $created
 * @property integer $modified
 */
class Operation extends CActiveRecord {
    /**
     * Типы операций
     */

    const TYPE_PAYMENT_PURCHASE = 1; // Оплата товаров в корзине
    const TYPE_DEPOSIT = 2; // Пополнение баланса

    public $typeListData = array(
        self::TYPE_PAYMENT_PURCHASE => 'Покупка товара',
        self::TYPE_DEPOSIT => 'Пополнение баланса',
    );

    /**
     * Статусы операций
     */

    const STATUS_SUCCESS = 1; // Операция прошла успешно
    const STATUS_FAIL = 2; // В ходе операции произошла ошибка
    const STATUS_WAITING = 3; // Ожидание оплаты

    public $statusListData = array(
        self::STATUS_SUCCESS => 'Успешно',
        self::STATUS_FAIL => 'Ошибка',
        self::STATUS_WAITING => 'Ожидание оплаты',
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Operation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'operation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, summ, type, user_id', 'required'),
            array('user_id, summ, type, status, object_id, created, modified', 'numerical', 'integerOnly' => true),
            array('title, description', 'length', 'max' => 255),
            array('object_type', 'length', 'max' => 64),
            array('extra', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, description, user_id, summ, type, status, extra, created, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
//            'user' => self::BELONGS_TO, 'User', 'user_id',
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Название операции',
            'description' => 'Описание',
            'user_id' => 'Пользователь',
            'summ' => 'Сумма',
            'type' => 'Тип операции',
            'status' => 'Статус',
            'extra' => 'Причина',
            'created' => 'Дата проведения',
            'modified' => 'Modified',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('summ', $this->summ);
        $criteria->compare('type', $this->type);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'id DESC'),
        ));
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->created = time();
            }

            $this->modified = time();
            return true;
        }
    }

    public function getStatusHtml() {
        $color = $this->status == self::STATUS_SUCCESS ? 'green' : 'red';

        $tag = '';
        $tag .= CHTml::openTag('span', array('style' => "color: {$color}"));
        $tag .= $this->statusListData[$this->status];
        $tag .= CHtml::closeTag('span');

        return $tag;
    }

    /**
     * Возвращаем ссылку на товар (для отображения в архиве операций)
     */
    public function getPurchaseSmallLink() {
        if ($this->object_id && $this->object_type) {
            $model = CActiveRecord::model($this->object_type)->findByPk((int) $this->object_id);
            $u = strtolower('/' . $this->object_type . '/' . $this->object_id);
            if ($model) {
                return CHtml::link("#{$this->object_id}", Yii::app()->createUrl($u), array('target' => '__blanc'));
            }
        }
    }

    /**
     * Добавляем новую запись в таблицу операций. 
     * 
     * @param array $attributes информация о операции
     * @return Operation возвращаем добавленную операцию
     */
    public function addLog($attributes = array()) {
        $operation = new Operation();
        $operation->setAttributes($attributes);
        $operation->save();

        return $operation;
    }

    /**
     * Оплачиваем покупки из корзины.
     *
     * Оплата производится непосредственно со счета пользователя
     * @param $purchaseByBonus boolean Оплатить бонусами
     * @return array возвращаем массив проведенных операций для отображения пользователю
     */
    public function paymentPurchase($purchaseByBonus=false) {
        $extra = ''; // Сообщение в случае ошибки
        $purchases = Yii::app()->shoppingCart->getPositions();
        $operations = array();
        $user = User::model()->findByPk(Yii::app()->user->id);

        $boughtCoupons = array();

        // Проходимся по всем позициям
        foreach ($purchases as $item) {

            // Если выбрана оплата бонусами а акция не
            // бонусная, тогда пропускаем это позицию
            if ($purchaseByBonus && !$item->act->is_bonus)
                continue;

            $quantity = $item['quantity'];
            $item = Coupon::model()->findByPk($item['id']);
            // Проходимся по всем элементам позиции (в позиции может быть больше одного купона)
            for ($i = 0; $i < $quantity; $i++) {
                // Для добавления в историю операций
                $operationAttributes = array(
                    'title' => 'Оплата товара',
                    'description' => $item->getTitle(),
                    'user_id' => $user->id,
                    'summ' => $item->getPrice(),
                    'type' => self::TYPE_PAYMENT_PURCHASE,
                    'object_type' => 'Acts',
                    'object_id' => $item->id,
                );

                // Создаем новую покупку
                $purchase = new Purchase();
                $purchase->user_id = $user->id;
                $purchase->act_id = $item->act_id;
                $purchase->secret_key = $purchase->getUniqueKey();
                $purchase->status = Purchase::STATUS_NOT_ACTIVATED;
                $purchase->org_id = $item->act->id_org_act;
                $hasErrors = $this->purchaseHasErrors($user, $item, $purchaseByBonus);
                if ($hasErrors == false) {
                    // Если не возникло ошибок, то списываем деньги со счета пользователя
                    if ($purchase->hasErrors() == false && $purchase->save()) {

                        if (!$purchaseByBonus)
                            $user->balance -= $item->getPrice(); // оплата деньшами
                        else
                            $user->bonus -= $item->getPrice(); // оплата бонусами
                        $user->save();

                        // Покупка прошла успешно. Устанавливаем соответствующий статус для операции
                        $operationAttributes['status'] = self::STATUS_SUCCESS;
                        // Накручиваем ко-во купленных купонов
                        $item->act->coupon_purchased++;
                        $item->act->save();

                        // Удаляем эту покупку с корзины и берем пиво =)
                        Yii::app()->shoppingCart->remove($item->id);

                        $boughtCoupons[] = $purchase;
                    }
                } else {
                    $operationAttributes['status'] = self::STATUS_FAIL;
                    $operationAttributes['extra'] = $hasErrors;
                }

                // Добавляем запись операции в таблицу
                $operations[] = Operation::model()->addLog($operationAttributes);
            }
        }

        // Возвращаем произведенные операции
        return array(
            'operations' => $operations,
            'boughtCoupons' => $boughtCoupons
        );
    }

    /**
     * Проверяем:
     * - хаватет ли средств для оплаты
     * - активна ли акция, есть ли купоны и т.д.
     *
     * @param $user
     * @param $item
     * @param $purchaseByBonus Оплатат бонусами
     * @return bool|string
     */
    public function purchaseHasErrors($user, $item, $purchaseByBonus) {

        // Проверяем хватает ли средств
        if (!$purchaseByBonus) {
            // акция не бонусная, проверяем кол-во рублей
            if ($user->balance <= $item->getPrice())
                return 'Не достаточно средств на счете';
        } elseif($item->act->is_bonus) {
            // акция бонусная, проверяем кол-во бонусов
            if ($user->bonus <= $item->getPrice())
                return 'Не достаточно бонусов на счете';
        } else {
            return 'Купон нельзя оплатить бонусами';
        }

        if (!$item->act->isForSale()) {
            return 'Закончились купоны';
        }

        if (strtotime($item->act->date_end_act) < time()) {
            return 'Истек срок действия акции';
        }

        return false;
    }

    /**
     * Зачисление денег на счет пользователя.
     * 
     * @param $summ сумма пополнения баланса
     * @return bool
     */
    public function raiseDeposit($summ) {
        // Пополняем счет пользователю
        $user = User::model()->findByPk(Yii::app()->user->id);
        $user->balance += $summ;

        if ($user->save()) {
            // Создаем запись в таблице операций
            $this->addLog(array(
                'title' => 'Пополнение баланса',
                'summ' => $summ,
                'user_id' => Yii::app()->user->id,
                'type' => self::TYPE_DEPOSIT,
                'status' => self::STATUS_SUCCESS,
            ));

            return true;
        }

        return false;
    }

    public function setStatus($status) {
        if ($this->status == $status)
            return false;

        $this->status = $status;
        if ($this->status == self::STATUS_SUCCESS && $this->type == self::TYPE_PAYMENT_PURCHASE) {
            $this->paymentPurchase(json_decode($this->extra, true), $this->user);
            $this->save();
        }

        return true;
    }

    /**
     * Оплачиваем покупки из корзины
     *
     * Оплата производится непосредственно со счета пользователя, оплата бонусами
     * @return array возвращаем массив проведенных операций для отображения пользователю
     */
    public function paymentPurchaseByBonus() {
        $purchases = Yii::app()->shoppingCart->getPositions();
        $operations = array();
        $user = User::model()->findByPk(Yii::app()->user->id);

        // Проходимся по всем позициям
        foreach ($purchases as $item) {
            $quantity = $item['quantity'];
            $item = Coupon::model()->findByPk($item['id']);
            // Проходимся по всем элементам позиции (в позиции может быть больше одного купона)
            for ($i = 0; $i < $quantity; $i++) {
                // Для добавления в историю операций
                $operationAttributes = array(
                    'title' => 'Оплата товара',
                    'description' => $item->getTitle(),
                    'user_id' => $user->id,
                    'summ' => $item->getPrice(),
                    'type' => self::TYPE_PAYMENT_PURCHASE,
                    'object_type' => 'Acts',
                    'object_id' => $item->id,
                );

                // Создаем новую покупку
                $purchase = new Purchase();
                $purchase->user_id = $user->id;
                $purchase->act_id = $item->id;
                $purchase->secret_key = $purchase->getUniqueKey();
                $purchase->status = Purchase::STATUS_NOT_ACTIVATED;
                $purchase->org_id = $item->act->id_org_act;
                $hasErrors = $this->purchaseHasErrors($user, $item);
                if ($hasErrors == false) {

                    // Если не возникло ошибок, то списываем деньги со счета пользователя
                    if ($purchase->hasErrors()==false && $purchase->save()) {

                        // Cпсисываем деньги со счета
                        if (!$item->act->is_bouns) {
                            // Если акция НЕ бонусная, спысывем деньги
                            $user->balance -= $item->getPrice();
                        } else {
                            // акция бонусная, списываем бонусы
                            $user->bonus -= $item->getPrice();
                        }
                        $user->save();

                        // Покупка прошла успешно. Устанавливаем соответствующий статус для операции
                        $operationAttributes['status'] = self::STATUS_SUCCESS;
                        // Накручиваем ко-во купленных купонов
                        $item->act->coupon_purchased++;
                        $item->act->save();

                        // Удаляем эту покупку с корзины и берем пиво =)
                        Yii::app()->shoppingCart->remove($item->id);
                    }
                } else {
                    $operationAttributes['status'] = self::STATUS_FAIL;
                    $operationAttributes['extra'] = $hasErrors;
                }

                // Добавляем запись операции в таблицу
                $operations[] = Operation::model()->addLog($operationAttributes);
            }
        }

        // Возвращаем произведенные операции
        return $operations;
    }
}