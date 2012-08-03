<?php $this->widget('bootstrap.widgets.BootGridView',array(
		'id'=>'g-karir-grid',
		'dataProvider'=>gPersonKarir::model()->search($model->id),
		//'filter'=>$model,
		'template'=>'{items}',
		'columns'=>array(
				'd_awalkr',
				'd_akhirkr',
				array(
						'header'=>'Unit',
						'value'=>'isset($data->unit->name) ? $data->unit->name : ""',
				),
				'c_direkkr',
				//'c_departkr',
				array(
						'header'=>'Golongan',
						'value'=>'isset($data->department->name) ? $data->department->name : ""',
				),
				array(
						'header'=>'Golongan',
						'value'=>'isset($data->golongan->name) ? $data->golongan->name : ""',
				),
				array(
						'header'=>'Level',
						'value'=>'isset($data->level->name) ? $data->level->name : ""',
				),
				//'c_jabatankr',
				array(
						'header'=>'Position',
						'value'=>'isset($data->position->name) ? $data->position->name : ""',
				),
				array(
						'header'=>'Status',
						'value'=>'isset($data->status->name) ? $data->status->name : ""',
				),
				//'c_perushkr',
				/*
				 'vc_lokasikr',
'vc_alasankr',
'c_alhriskd',
'c_lokasikr',
'c_alasankr',
'userid',
'tglmodify',
'pt_kodept',
'py_kodeproyek',
't_status',
't_stat',
*/
		),
)); ?>
