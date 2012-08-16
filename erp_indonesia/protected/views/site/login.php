<div class="page-header">
	<h1>
		<?php //echo Yii::app()->name; ?>
	</h1>
</div>

<?php 

$browser=checkBrowser::getInstance()->getBrowser();

if ($browser['name'] =='Internet Explorer') 
	header("Location: not_support.php");

?>

<?php

  $tag="landscape";
  $tag = urlencode($tag);

  $api_key = "3febaac31cc6a34b93349523beacbfee";
  $per_page="6";
  $url = "http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key={$api_key}&tags={$tag}&per_page={$per_page}";

  //$feed = getResource($url);
if  (in_array  ('curl', get_loaded_extensions())) {
  $chandle = curl_init();
  curl_setopt($chandle, CURLOPT_URL, $url);
  curl_setopt($chandle, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($chandle);
  curl_close($chandle);

  $xml = simplexml_load_string($result);
}  
  
?>

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
			In the reason for speed development and concentrate on business process and workflow process, this application HAS DESIGNED to open with Chrome, Firefox or Opera. Internet Explorer will be banned automatically...
		</div>
	</div>
</div>

<div class="row-fluid">

		<?php 
			//$_slide="slide".Yii::app()->dateFormatter->format("d",time()).".jpg";
			//echo CHtml::image(Yii::app()->request->baseUrl.'/images/photo/'.$_slide,'image',array('style'=>'width: 100%')); 
			if (isset($xml->photos->photo)) {
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
					$image_html= "<a href='{$page_url}'><img alt='{$title}' src='{$thumb_url}' height='160px' width='100%'/></a>";
					print "<div class='span2'>$image_html</div>";
				}
				echo "<p>";
				echo "Powered by: <a href=\"http://www.flikr.com\" target=\"_blank\">Flickr</a>";
			}
		?>
</div>
