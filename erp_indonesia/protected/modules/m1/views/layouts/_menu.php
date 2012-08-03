
<?php if (!Yii::app()->user->isGuest) {
	?>
<div class="art-navMenu">

	<ul class="art-hmenu">
		<li><b><a href="#"><span class="r"></span><span class="t"><?php echo Yii::app()->user->name ?>
						|</span> </a> </b>
		</li>
		<li><a href="#" class="active"><span class="l"></span><span class="r"></span><span
				class="t">Help</span> </a>
		</li>
		<li><a href="#" class="active"><span class="l"></span><span class="r"></span><span
				class="t">Setting</span> </a>
		</li>
		<li><a href=<?php echo Yii::app()->createUrl("site/logout") ?>
			class="active"><span class="l"></span><span class="r"></span><span
				class="t">Log Out</span> </a>
		</li>
	</ul>
</div>

<?php
}
?>
