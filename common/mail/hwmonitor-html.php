<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['index.html']);
?>

    <p>您好 <?= Html::encode($userCode) ?>,</p>
    <p>欢迎注册明源新房直通车！</p>

    <p>您的商家账户信息和密码如下：</p>
    <p>　　商家名称：<?= Html::encode($orgName) ?></p>
    <p>　　企业代码：<?= Html::encode($orgCode) ?></p>
    <p>　　管理员账号：<?= Html::encode($userCode) ?></p>
    <p>　　管理员密码：<?= Html::encode($password) ?></p>

要立即登录，单击  <A href="<?= Html::encode($middleEndurl) ?>" target=_blank><?= Html::encode($middleEndurl) ?></A>
<br />
<br />
<br />
<br />
地址：深圳市南山区高新科技园南区高新南一道中科大厦9层 邮编：518057
<br />
电话：0755-86309791-8082   总机：0755-86309788
<br />
传真：0755-86309797