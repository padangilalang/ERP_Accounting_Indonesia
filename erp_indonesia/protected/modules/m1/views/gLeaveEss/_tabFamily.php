<?php $this->widget('bootstrap.widgets.BootGridView',array(
		'id'=>'g-family-grid',
		'dataProvider'=>gPersonFamily::model()->search($model->id),
		'template'=>'{items}',
		//'filter'=>$model,
		'columns'=>array(
				'vc_nmfm',
				array(
						'header'=>'Relation',
						'value'=>'isset($data->relation) ? $data->relation->name: ""',
				),
				//'vc_hubfm',
				'd_tgllhr',
				array(
						'header'=>'Sex',
						'value'=>'isset($data->sex) ? $data->sex->name : ""',
				),
				array(
						'header'=>'Birth Place',
						'value'=>'isset($data->birthplace) ? $data->birthplace->name : "" ',
				),
				array(
						'header'=>'Status',
						'value'=>'isset($data->status) ? $data->status->name : ""',
				),
				//'b_aktif',
				'vc_ket',
				/*
				 'userid',
'tglmodify',
'pt_kodept',
'py_kodeproyek',
'f_cover',
*/
		),
)); ?>
