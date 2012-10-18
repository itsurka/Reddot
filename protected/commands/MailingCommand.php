<?php

Yii::import('application.components.shoppingCart.IECartPosition');

class MailingCommand extends CConsoleCommand
{
    /**
     * @param $args
     * @return void
     * TODO: протестить
     */
    public function actionRun($args)
    {
        $totalSend = 0;
        $this->log('start');

        // Запускаем функции для добавления новых уведомлений - Начало {
        $past = CMailer::addPastActsNotifications();
        $this->log('added past acts: ' . $past);

        CMailer::addExpiredCouponsDateActsNotifications();

        $monthlyInfo = CMailer::addMonthlyInfoNotification();
        $this->log("newUsersCount: {$monthlyInfo['newUsersCount']}, soldCouponsCount: {$monthlyInfo['soldCouponsCount']}");
        // Запускаем функции для добавления новых уведомлений - Конец }

        $queues = $this->getMailing();

        $queuesCount = count($queues);
        if($queuesCount > 0)
        {
            foreach($queues as $eachQueue)
            {
                //$this->send($eachQueue->recipientEmail, $eachQueue->subject, $eachQueue->body);
                $eachQueue->status = Mailing::STATUS_COMPLETED;
                $eachQueue->save();
                $totalSend++;
            }
        }

        $this->log("Отправлено писем: {$totalSend} из {$queuesCount}.");
        $this->log('end');
    }

    protected function send($to, $subject, $body)
    {
        Yii::import('ext.email.Email');
        $email = new Email();
        $email->to = $to;
        $email->subject = $subject;
        $email->message = $body;
        $email->send();
    }

    protected function startMailing($users, Mailing $mailing)
    {
        if ($users) {
            foreach ($users as $recipient) {
                $this->send($recipient->email, $mailing->subject, $mailing->body);
            }
        }
    }

    /**
     * Берем новые письма
     * @return CActiveRecord
     */
    protected function getMailing()
    {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('status', array(Mailing::STATUS_PENDING));
        $criteria->limit = CMailer::SEND_ITEMS_BY_CALL;
        $criteria->order = 'id ASC';

        return Mailing::model()->findAll($criteria);
    }

    private function log($text)
    {
        if($text=='start' || $text=='end' || $text == 'exit')
        {
            echo "\n";
            echo "\n";
            echo "--".strtoupper($text)."--";
            echo "\n";
            echo "\n";
            if ($text != 'start')
                exit;
        }
        else
        {
            echo "\n";
            echo "{$text}";
            echo "\n";
        }
    }
}