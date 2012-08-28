<?php $this->widget('bootstrap.widgets.BootGridView',array(
		'id'=>'g-education-grid',
		'dataProvider'=>gPersonEducation::model()->search($model->id),
		//'filter'=>$model,
		'columns'=>array(
				'c_fmjenjang',
				'vc_fmnama',
				'c_fmkota',
				'c_fmjurusan',
				'n_fmlulus',
				'c_rfnegara',
				'c_institusi',
				/*
				 'userid',
'tglmodify',
'pt_kodept',
'py_kodeproyek',
'pf_ipk',
't_jenis',
*/
		),
)); ?>
