
<div class="row-fluid">
	<div class="span12">
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
	</div>
</div>

<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
		//$this->widget('ext.groupgridview.GroupGridView', array(
		//'extraRowColumns' => array('d_cuti'),
		'id'=>'g-person-grid',
		'dataProvider'=>gLeave::model()->search($model->id),
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
						'template'=>'{print}',
						'buttons'=>array
						(
								'print' => array
								(
										'label'=>'Print',
										'url'=>'Yii::app()->createUrl("/m1/gLeaveEss/print",array("id"=>$data->id,"pid"=>$data->person->id))',
										'visible'=>'$data->approved_id ==1',
										'options'=>array(
												'class'=>'btn btn-mini',
												'target'=>'_blank',
										),
								),
						),

				),
				array(
						'class'=>'BootButtonColumn',
						'template'=>'{summary}',
						'buttons'=>array
						(
								'summary' => array
								(
										'label'=>'Summary',
										'url'=>'Yii::app()->createUrl("/m1/gLeaveEss/summary",array("pid"=>$data->person->id))',
										'visible'=>'$data->approved_id ==1',
										'options'=>array(
												'class'=>'btn btn-mini',
												'target'=>'_blank',
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
