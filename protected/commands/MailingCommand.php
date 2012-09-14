<?php

Yii::import('application.models.Mailing');
Yii::import('application.models.User');

class MailingCommand extends CConsoleCommand {

    public function run($args) {
        $mailing = $this->getMailing();
        $criteria = new CDbCriteria();
        $criteria->condition = 'email != :email';
        $criteria->params = array(
            ':email' => '',
        );

        if ($mailing->type) {
            $criteria->addCondition('role = :role');
            $criteria->params = $criteria->params + array(
                ':role' => $mailing->type,
            );
        }

        if ($mailing->town_id) {
            $criteria->addCondition('id_towns_user = :id_towns_user');
            $criteria->params = $criteria->params + array(
                ':id_towns_user' => $mailing->town_id,
            );
        }

        $users = User::model()->findAll($criteria);
        $this->startMailing($users, $mailing);

        $mailing->status = Mailing::STATUS_COMPLETED;
        $mailing->save();
    }

    protected function send($to, $subject, $body) {
        Yii::import('ext.email.Email');
        $email = new Email();
        $email->to = $to;
        $email->subject = $subject;
        $email->message = $body;
        $email->send();
    }

    protected function startMailing($users, Mailing $mailing) {
        if ($users) {
            foreach ($users as $recipient) {
                $this->send($recipient->email, $mailing->subject, $mailing->body);
            }
        }
    }

    protected function getMailing() {
        /**
         * Get mailing list
         */
        $criteria = new CDbCriteria;
        $criteria->condition = 'status = :status';
        $criteria->params = array(
            ':status' => Mailing::STATUS_PENDING,
        );

        $mailing = Mailing::model()->find($criteria);
        if (!$mailing) {
            Yii::app()->end();
        }
        else {
            $mailing->status = Mailing::STATUS_STARTED;
            $mailing->save();
        }

        return $mailing;
    }

}