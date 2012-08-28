<?php
$this->breadcrumbs=array(
		'G Recruitments'=>array('index'),
		$model->id,
);

$this->menu=array(
		array('label'=>'Home ', 'icon'=>'home', 'url'=>array('/m1/gRecruitment')),
);
?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/user.png') ?>
		<?php echo $model->candidate_name; ?>
	</h1>
</div>


<?php $this->widget('XDetailView', array(
		'ItemColumns' => 2,
		'data'=>$model,
		'attributes'=>array(
				'for_position',
				'for_project',
				'candidate_name',
				'birthdate',
				'quick_background',
				'work_experience',
				'sallary_expectation',
				'source_id',
		),
)); ?>

<?php $this->widget('XDetailView', array(
		'ItemColumns' => 3,
		'data'=>$model,
		'attributes'=>array(
				'followup_date',
				'followup_id',
				'followup_remark',
				'interview1_date',
				'interview1_by',
				'interview1_result',
				'interview2_date',
				'interview2_by',
				'interview2_result',
				'interview3_date',
				'interview3_by',
				'interview3_result',
				'review',
				null,
				null,
				'final_result_id',
				null,
				null,
				'general_remark',
				null,
				null,
		),
)); ?>

<h3>Attachment Document</h3>

<?php 


if (isset($files))
{
	foreach ($files as $file)
	{
		//echo $file."<br/>" ;
		?>
<a
	href="<?php echo Yii::app()->baseUrl."/images/recruitment/".$model->id."/".$file ?>"
	target="_blank"><?php echo $file ?> </a>
<br />
<?php
     } 
}

?>