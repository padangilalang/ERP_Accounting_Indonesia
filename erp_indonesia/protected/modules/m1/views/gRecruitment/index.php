<?php
$this->breadcrumbs=array(
		'Recruitment',
);

$this->menu=array(
		//array('label'=>'Home ', 'icon'=>'home', 'url'=>array('Recruitment')),
);

//$this->menu1=gRecruitment::getTopUpdated();
//$this->menu2=gRecruitment::getTopCreated();
$this->menu5=array('Recruitment');

?>

<div class="page-header">
	<h1>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/icon/cash.png') ?>
		Recruitment:
		<?php if ($id==1) echo "Pending"; elseif ($id==2) echo "UnPaid"; else ""; ?>
	</h1>
</div>

<?php
$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
				array('label'=>'Waiting for process','url'=>Yii::app()->createUrl('/m1/gRecruitment',array("id"=>1)),'active'=>($id==1)),
				array('label'=>'Waiting for Interview','url'=>Yii::app()->createUrl('/m1/gRecruitment',array("id"=>2)),'active'=>($id==2)),
				array('label'=>'Interviewed','url'=>Yii::app()->createUrl('/m1/gRecruitment',array("id"=>3)),'active'=>($id==3)),
				array('label'=>'Show All','url'=>Yii::app()->createUrl('/m1/gRecruitment',array("id"=>0)),'active'=>($id==0)),
		),
));
?>

<?php $this->widget('BootGridView', array(
		'id'=>'g-recruitment-grid',
		'dataProvider'=>gRecruitment::model()->search($id),
		'template'=>'{items}{pager}',
		//'filter'=>$model,
		'columns'=>array(
				array(
						'type'=>'raw',
						'value'=>'CHtml::link(CHtml::image(Yii::app()->request->baseUrl . "/images/recruitment/".$data->photo_path, "No Photo", array("class"=>"span2")),
						Yii::app()->createUrl("/m1/gRecruitment/view",array("id"=>$data->id)))',
				),
				'for_position',
				'for_project',
				array(
						'header'=>'Candidate Name',
						'type'=>'raw',
						'value'=>'CHtml::link($data->candidate_name,Yii::app()->createUrl("/m1/gRecruitment/view",array("id"=>$data->id)))',
				),
				'birthdate',
				'quick_background',
				//'work_experience',
				'sallary_expectation',
				'source_id',
				//'followup_date',
				//'followup_id',
				//'followup_remark',
				'review',
				'final_result_id',
				'general_remark',
				array(
						'class'=>'BootButtonColumn',
				),
		),
)); ?>
