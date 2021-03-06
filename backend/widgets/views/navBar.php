<?php
use navatech\language\Translate;
use navatech\language\widgets\LanguageWidget;
use yii\helpers\Url;

/**
 * @var \common\web\View $this
 */
?>
<!-- START HEADER -->
<div class="header ">
	<!-- START MOBILE CONTROLS -->
	<div class="container-fluid relative">
		<!-- LEFT SIDE -->
		<div class="pull-left full-height visible-sm visible-xs">
			<!-- START ACTION BAR -->
			<div class="header-inner">
				<a href="#" class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block padding-5" data-toggle="sidebar">
					<span class="icon-set menu-hambuger"></span>
				</a>
			</div>
			<!-- END ACTION BAR -->
		</div>
		<div class="pull-center hidden-md hidden-lg">
			<div class="header-inner">
				<div class="brand inline">
					<img src="<?= Yii::$app->setting->get('general_logo') ?>" alt="logo" data-src="<?= Yii::$app->setting->get('general_logo') ?>" data-src-retina="<?= Yii::$app->setting->get('general_logo') ?>" width="78" height="22">
				</div>
			</div>
		</div>
	</div>
	<!-- END MOBILE CONTROLS -->
	<div class=" pull-left sm-table hidden-xs hidden-sm">
		<div class="header-inner">
			<div class="brand inline">
				<img src="<?= Yii::$app->setting->get('general_logo') ?>" alt="logo" height="22">
			</div>
			<!-- START NOTIFICATION LIST -->
			<ul class="notification-list no-margin hidden-sm hidden-xs b-grey b-l b-r no-style p-l-30 p-r-20">
				<?= LanguageWidget::widget([
					'type' => 'selector',
				]); ?>
			</ul>
			<!-- END NOTIFICATIONS LIST -->
		</div>
	</div>
	<div class=" pull-right">
		<!-- START User Info-->
		<div class="visible-lg visible-md m-t-10">
			<div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
				<span class="semi-bold"><?= Translate::welcome() . ' ' . ($this->user !== null ? $this->user->username : '') ?></span>
			</div>
			<div class="dropdown pull-right">
				<button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="thumbnail-wrapper d32 circular inline m-t-5">
                <img src="<?= $this->user !== null ? $this->user->profile->getAvatarUrl(32) : '/img/profiles/avatar.jpg'; ?>" alt="" width="32" height="32">
            </span>
				</button>
				<ul class="dropdown-menu profile-dropdown" role="menu">
					<li><a href="<?= Url::to([
							'/user/admin/update',
							'id' => $this->user !== null ? $this->user->id : '',
						]) ?>"><i class="pg-settings_small"></i><?= Translate::setting() ?></a></li>
					<li class="bg-master-lighter">
						<a href="<?= Url::to(['/user/logout']) ?>" class="clearfix" data-method='post'>
							<span class="pull-left"><?= Translate::logout() ?></span>
							<span class="pull-right"><i class="pg-power"></i></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- END User Info-->
	</div>
</div>
<!-- END HEADER -->