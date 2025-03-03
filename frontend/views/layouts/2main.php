<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="main-bg">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    if (!Yii::$app->user->isGuest) {
        NavBar::begin([
            'brandLabel' => \frontend\models\Functions::getBrandName(),
            'brandUrl' => Yii::$app->homeUrl,
            'innerContainerOptions' => ['class' => 'container-fluid'],
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top anime-nav',
            ],
        ]);

        if (Yii::$app->user->isGuest) {

            $menuItems[] = ['label' => 'Kirish', 'url' => ['/site/login']];
        } else {
            $menuItems = [

                ['label' => '<i class="glyphicon glyphicon-user"></i> Kabinet', 'items' => [
//                    ['label' => 'Ticket', 'url' => ['/setting/print']],
                    ['label' => '<i class="glyphicon glyphicon-log-out"></i> Chiqish', 'url' => ['/site/logout']],
                ],
                ],
            ];

        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
            'encodeLabels' => false,
        ]);

        NavBar::end();
    } else {
        Yii::$app->user->logout();
    }
    ?>
    <input type="hidden" value="/<?= Yii::$app->language?>" id="lang">


            <div class="left-sidebar">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="glyphicon glyphicon-tasks"></i>
                                    <p>Asosiy malumotlar</p>
                                </a>
                         </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <ul>
                                    <li>
                                          <a href="/uz/qmain/index">
                                            <i class="glyphicon glyphicon-map-marker"></i>
                                            <p>  Xizmat ko`rsatish markazlari</p>
                                          </a>
                                    </li>
                                    <li>
                                        <a href="/uz/qcategory/index">
                                            <i class="glyphicon glyphicon-fire"></i>
                                            <p>Xizmat turlari</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/uz/users/index">
                                           <i class="glyphicon glyphicon-inbox"></i>
                                            <p> Xizmat ko`rsatuvchilar</p>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#Reports" aria-expanded="false" aria-controls="Reports">
                                    <i class="glyphicon glyphicon-certificate"></i>
                                    <p>Xisobotlar</p>
                                </a>
                            </h4>
                        </div>
                        <div id="Reports" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <ul>
                                    <li>
                                        <a href="/uz/qorders/index">
                                            <i class="glyphicon glyphicon-th-large"></i>
                                            <p>  Navbat bo`yicha</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/uz/qmain/reports">
                                            <i class="glyphicon glyphicon-paperclip"></i>
                                            <p>  Viloyat va tumanlar kesimida</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/uz/qmain/reports-operator">
                                            <i class="glyphicon glyphicon-edit"></i>
                                            <p>Operatorlar kesimida</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="glyphicon glyphicon-inbox"></i>
                                            <p> Xizmat turlari kesimida</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/uz/qmain/reports-rating">
                                            <i class="glyphicon glyphicon-signal"></i>
                                            <p> Baholash </p>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    <p>Sozlash</p>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <ul>
                                    <li>
                                        <a href="/uz/setting/print">
                                            <i class="glyphicon glyphicon-barcode"></i>
                                            <p>  Ticket namunasi</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/uz/setting/company">
                                            <i class="glyphicon glyphicon-edit"></i>
                                            <p>Tashkilot malumotlari</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="glyphicon glyphicon-inbox"></i>
                                            <p> Xizmat ko`rsatuvchilar</p>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
<!--                    <div class="panel panel-default">-->
<!--                        <div class="panel-heading" role="tab" id="headingThree">-->
<!--                            <h4 class="panel-title">-->
<!--                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">-->
<!--                                    Collapsible Group Item #3-->
<!--                                </a>-->
<!--                            </h4>-->
<!--                        </div>-->
<!--                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">-->
<!--                            <div class="panel-body">-->
<!--                              -->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>

    <div class="main-content" style="padding-top: 90px">
        <div class="panel panel-default shadow-1">
            <div class="panel-body">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>



</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
