<div class="page-header">
	<h1>
		<?php //echo Yii::app()->name; ?>
	</h1>
</div>

<div class="row-fluid">
	<div class="span6 well">
		<?php $form=$this->beginWidget('BootActiveForm', array(
				'id'=>'login-form',
				'type'=>'horizontal',
				'enableAjaxValidation'=>true,
		)); ?>


	<?php echo $form->textFieldRow($model,'username',array('class'=>'span3')); ?>
		<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3')); ?>
		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

		<div class="form-actions">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Submit', array('class'=>'btn-large', 'type'=>'submit')); ?>
		</div>

		<?php $this->endWidget(); ?>
		
		<p class="note"><b>Welcome to ERP Indonesia - HR and ACCOUNTING Application.</b> You have to enter username and password before using this great product. Thank You...</p>
	
	</div>
	<div class="span5">
		<?php 
			$_slide="slide".Yii::app()->dateFormatter->format("d",time()).".jpg";
			echo CHtml::image(Yii::app()->request->baseUrl.'/images/photo/'.$_slide,'image',array('style'=>'width: 100%')); 
		?>
	</div>
</div>

<br/>

<div class="row-fluid">
	<div class="span12">
		<div class="alert alert-info">
			<h4 class="alert-heading">Note!!</h4>
			For the reason, to speed development and concentrate to make a good business process and workflow system, this application design to be opened with Chrome, Firefox or Opera Browser. so, please do not open this application with Internet Explorer. It will be banned automatically, we are sorry..
		</div>
	</div>
</div>

<div class="row-fluid">

		<?php 
			//$_slide="slide".Yii::app()->dateFormatter->format("d",time()).".jpg";
			//echo CHtml::image(Yii::app()->request->baseUrl.'/images/photo/'.$_slide,'image',array('style'=>'width: 100%')); 
			if (isset($xml->photos->photo)) {
				echo "<h4>";
				echo "Powered by: <a href=\"http://www.flikr.com\" target=\"_blank\">Flickr</a>";
				echo "</h4>";
				echo "</br>";
				foreach ($xml->photos->photo as $photo) {
					$title = $photo['title'];
					$farmid = $photo['farm'];
					$serverid = $photo['server'];
					$id = $photo['id'];
					$secret = $photo['secret'];
					$owner = $photo['owner'];
					$thumb_url = "http://farm{$farmid}.static.flickr.com/{$serverid}/{$id}_{$secret}_t.jpg";
					//$image = "http://farm{$farmid}.static.flickr.com/{$serverid}/{$id}_{$secret}.jpg";
					$page_url = "http://www.flickr.com/photos/{$owner}/{$id}";
					$image_html= "<a href='{$page_url}' target='_blank'><img alt='{$title}' src='{$thumb_url}' height='160px' width='100%' /></a>";
					print "<div class='span1'>$image_html</div>";
				}
			}
		?>
</div>

