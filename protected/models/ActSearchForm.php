<?php

/**
 * FeedbackForm class.
 * FeedbackForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ActSearchForm extends CFormModel {

    public $query;
    public $id_themes_act;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('query', 'required'),
            array('query', 'length', 'min' => 3, 'max' => 20),
            array('id_themes_act', 'numerical'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'query' => 'Запрос',
        );
    }

}
