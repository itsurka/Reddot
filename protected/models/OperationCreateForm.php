<?php

/**
 * FeedbackForm class.
 * FeedbackForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class OperationCreateForm extends CFormModel {

    /**
     * @var int пополнение счета или покупка товаров.
     */
    public $type;

    /**
     * @var string мобильный телефон покупателя (для qiwi)
     */
    public $mobile;

    /**
     *
     * @var float сумма платежа
     */
    public $summ;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // name, email, subject and body are required
            array('type', 'required'),
            array('mobile', 'required', 'on' => 'qiwi'),
            array('type, mobile', 'numerical'),
            //array('summ', 'type' => 'float'),
            //array('summ', 'length', 'max' => 15000),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'type' => 'Тип операции',
            'mobile' => 'Мобильный телефон',
            'summ' => 'Сумма',
        );
    }

}