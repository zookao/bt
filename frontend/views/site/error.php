<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = '磁力搜索-bt搜索-磁力链接-迅雷下载_水熊BT'.$name;
?>
<div class="container" style="padding-top:120px; padding-bottom:50px; font-size:18px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>
            <p>服务器处理请求时发生错误</p>
            <p>请联系管理员，谢谢。</p>
            <p><a href="http://bt.vieway.cn">返回首页</a></p>
        </div>
    </div> <!-- /.row -->
</div>
<?php echo \Yii::$app->view->renderFile('@frontend/views/layouts/footer1.php'); ?>