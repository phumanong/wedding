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
 <meta charset="UTF-8" />
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Edenplaza</title>
    <link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl ?>/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl ?>/css/style.css">

    <!-- dich vu -->
    <link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl ?>/css/accordion-slider.min.css" media="screen"/>
    <!-- khuyen mai -->
    <link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl ?>/css/gallery.css" />

    <!-- font-awesome icon -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- footer -->
    <link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl ?>/css/style10.css" />
    <!-- menu -->
    <link rel="stylesheet" type="text/css" href="<?= Yii::$app->request->baseUrl ?>/css/component.css" />

    <script type="text/javascript" src="<?= Yii::$app->request->baseUrl ?>/js/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= Yii::$app->request->baseUrl ?>/js/modernizr.custom.26887.js"></script> 
    <script type="text/javascript" src="<?= Yii::$app->request->baseUrl ?>/js/jquery.accordionSlider.min.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/TweenMax.min.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/gallery.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/navigation.js"></script>
    <script src="<?= Yii::$app->request->baseUrl ?>/js/menu.js"></script>
    <script type="text/javascript" src="<?= Yii::$app->request->baseUrl ?>/js/cbpFWTabs.js"></script>

</head>
<body>
<?php $this->beginBody() ?>
    <!-- !Header -->
    <header>
        <!-- <?php //include "blocks/navigation.php" ?> -->
    </header>
    <!-- end Header -->
    <div id="main-content">
        <?= $content ?>
    </div>
<footer class="footer">
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
