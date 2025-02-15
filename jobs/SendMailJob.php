<?php
/**
 * @author akiraz@bk.ru
 * @link https://github.com/akiraz2/yii2-ticket-support
 * @copyright 2018 akiraz2
 * @license MIT
 */

namespace akiraz2\support\jobs;

use yii\base\BaseObject;
use akiraz2\support\Mailer;
use akiraz2\support\models\Content;
use akiraz2\support\traits\ModuleTrait;

class SendMailJob extends BaseObject implements \yii\queue\RetryableJobInterface
{
    use ModuleTrait;

    public $contentId;
    public $mailerFrom;

    public function execute($queue)
    {
        $content = Content::findOne(['id' => $this->contentId]);
        if ($content !== null) {
            $email = $content->ticket->user_contact;
            /* send email */
            $subject = \akiraz2\support\Module::t(
                'support',
                '[{APP} Ticket #{ID}] Re: {TITLE}',
                ['APP' => \Yii::$app->name, 'ID' => $content->ticket->hash_id, 'TITLE' => $content->ticket->title]
            );

            $this->getMailer()->compose(
                ['html' => 'reply-ticket-html', 'text' => 'reply-ticket-text'],
                [
                    'title' => $subject,
                    'model' => $content
                ]
            ) // a view rendering result becomes the message body here
                ->setFrom($this->mailerFrom)
                ->setTo($email)
                ->setSubject($subject)
                ->send();
        }
    }

    public function getTtr()
    {
        return 60;
    }

    public function canRetry($attempt, $error)
    {
        return ($attempt < 50);
    }

    protected function getMailer()
    {
        return \Yii::$container->get(Mailer::className());
    }
}