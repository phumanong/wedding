<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use backend\models\User;
$user = User::findOne(Yii::$app->user->getId());
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?= Yii::$app->charset?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php Yii::$app->request->baseUrl ?>admin/img/logo.jpg" sizes="32x32">
	<?= Html::csrfMetaTags()?>
	<title><?= Html::encode($this->title)?></title>

	<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/css/font-awesome.min.css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
	<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>css/ace-rtl.min.css" />
	<script src="<?= Yii::$app->request->baseUrl ?>/js/jquery-1.11.3.min.js"></script>
</head>
<body class="login-layout">
	<div class="main-container">
		<div class="main-content">
			<?= $content ?>
		</div><!-- /.main-content -->
	</div><!-- /.main-container -->
	<script src="<?= Yii::$app->request->baseUrl ?>ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript">
		window.jQuery || document.write("<script src='<?= Yii::$app->request->baseUrl ?>js/jquery.min.js'>"+"<"+"/script>");
	</script>
	<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='<?= Yii::$app->request->baseUrl ?>js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {
		 $(document).on('click', '.toolbar a[data-target]', function(e) {
			e.preventDefault();
			var target = $(this).data('target');
			$('.widget-box.visible').removeClass('visible');//hide others
			$(target).addClass('visible');//show target
		 });
		});
		
		
		
		//you don't need this, just used for changing background
		jQuery(function($) {
		 $('#btn-login-dark').on('click', function(e) {
			$('body').attr('class', 'login-layout');
			$('#id-text2').attr('class', 'white');
			$('#id-company-text').attr('class', 'blue');
			
			e.preventDefault();
		 });
		 $('#btn-login-light').on('click', function(e) {
			$('body').attr('class', 'login-layout light-login');
			$('#id-text2').attr('class', 'grey');
			$('#id-company-text').attr('class', 'blue');
			
			e.preventDefault();
		 });
		 $('#btn-login-blur').on('click', function(e) {
			$('body').attr('class', 'login-layout blur-login');
			$('#id-text2').attr('class', 'white');
			$('#id-company-text').attr('class', 'light-blue');
			
			e.preventDefault();
		 });
		 
		});
	</script>
</body>
</html>