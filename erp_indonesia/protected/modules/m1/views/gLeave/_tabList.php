

	<?php
	$this->widget('bootstrap.widgets.BootDetailView', array(
			//$this->widget('ext.XDetailView', array(
			//'ItemColumns' => 3,
			'data'=>array(
					'id'=>1,
					'unit_joindate'=>$model->d_joinunit,
					'group_joindate'=>$model->d_joingrp,
			),
			'attributes'=>array(
					array('name'=>'unit_joindate', 'label'=>'Unit Join Date'),
					array('name'=>'group_joindate', 'label'=>'Group Join Date'),
			),
	)); ?>

<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
		//$this->widget('ext.groupgridview.GroupGridView', array(
		//'extraRowColumns' => array('d_cuti'),
		'id'=>'g-person-grid',
		'dataProvider'=>GLeave::model()->search($model->id),
		//'filter'=>$model,
		'template'=>'{items}',
		'columns'=>array(
				//'d_cuti',
				'd_dari',
				'd_sampai',
				'n_jmlhari',
				'd_h_masuk',
				'r_cuti',
				'n_cutiii',
				'c_masal',
				'c_pribadi',
				'n_sisacuti',
				'c_ganti',
				array(
						'header'=>'State',
						'value'=>'$data->approved->name',
				),
				array(
						'class'=>'BootButtonColumn',
						'template'=>'{approved}',
						'buttons'=>array
						(
								'approved' => array
								(
										'label'=>'Approved',
										'url'=>'Yii::app()->createUrl("/m1/gLeave/approved",array("id"=>$data->id,"pid"=>$data->person->id))',
										'visible'=>'$data->approved_id ==1',
										'options'=>array(
												'ajax'=>array(
														'type'=>'GET',
														'url'=>"js:$(this).attr('href')",
														'success'=>'js:function(data){
														$.fn.yiiGridView.update("g-person-grid", {
														data: $(this).serialize()
});
}',
												),
										),
								),
						),

				),
				/*
				 'c_ajukan',
				'c_ketahui',
				'c_setuju',
				'd_ajukan',
				'd_ketahui',
				'd_setuju',
				'userid',
				'tglmodify',
				'pt_kodept',
				'pt_kodeproyek',
				't_keterangan',
				'Id_OLD',
				'tahunke',
				*/
		),
)); ?>
