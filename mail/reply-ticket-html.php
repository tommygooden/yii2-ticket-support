<?php
/**
 * @author akiraz@bk.ru
 * @link https://github.com/akiraz2/yii2-ticket-support
 * @copyright 2018 akiraz2
 * @license MIT
 */

use akiraz2\support\models\Ticket;

/* @var $this yii\web\View */
/* @var $model \akiraz2\support\models\Content */

?>

<div id="header" style="background-color: #279EFF;color: #fff;text-align: center;padding: 20px;border-radius: 10px 10px 0px 0px;">
    <h1><?php echo Yii::$app->name; ?> Helpdesk</h1>
    <img src="<?php echo \Yii::$app->getModule('support')->logoUrl; ?>" style="width: 150px;margin: 10px 0;">
</div>

<div id="ticket-status" style="background-color: #f1f1f1;padding: 20px;border: 1px solid #ddd;border-radius: 0px 0px 10px 10px;box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;">
    <h2>Ticket Update</h2>

    <div class="badge urgent" style="padding: 5px 10px;border-radius: 10px 10px 10px 10px;font-weight: bold;color: #fff;background-color: #3AA6B9;">Priority - <?php switch ($model->ticket->priority) {
                                                                                                                                                                    case Ticket::PRIORITY_LOW:
                                                                                                                                                                        echo 'Low';
                                                                                                                                                                        break;
                                                                                                                                                                    case Ticket::PRIORITY_MIDDLE:
                                                                                                                                                                        echo 'Medium';
                                                                                                                                                                        break;
                                                                                                                                                                    case Ticket::PRIORITY_HIGH:
                                                                                                                                                                        echo 'High';
                                                                                                                                                                        break;

                                                                                                                                                                    default:
                                                                                                                                                                        echo 'Low';
                                                                                                                                                                        break;
                                                                                                                                                                } ?></div>

    <p>Hi <?php echo $model->ticket->user->{\Yii::$app->getModule('support')->userName}; ?>, an update has been posted for ticket id: <strong><?php echo $model->ticket->hash_id; ?></strong>.</p>
</div>

<div id="ticket-content" style="padding: 20px;">

    <div id="ticket-details">
        <p><strong>Category:</strong> <span class="subject"><?php echo $model->ticket->category->title ?? ''; ?></span></p>

        <p><strong>Status:</strong> <span class="department"><?php echo $model->ticket->getStatusText(); ?></span></p>
    </div>

    <div class="update-separator" style="border: 1px solid #eee;margin: 15px 0;"></div>

    <div id="new-update">

        <div class="update-header">
            <p>Update posted by <?php echo $model->user->{\Yii::$app->getModule('support')->userName}; ?>. on <?php echo date("M d, Y \a\t h:i A", $model->created_at); ?></p>
        </div>

        <br>

        <div class="update-body standout" style="background-color: #fef5d9;padding: 15px;border-radius: 6px;">
            <?= Yii::$app->formatter->asHtml($model->content) ?>
        </div>

    </div>

    <br>

    <div id="actions" style="margin-top: 12px;">
        <a href="<?php echo $model->ticket->getUrl(true); ?>" class="btn" style="display: inline-block;padding: 10px 20px;background: #4285f4;color: #fff;text-decoration: none;border-radius: 5px;">View Ticket</a>
    </div>

</div>