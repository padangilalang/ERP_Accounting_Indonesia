<?php
$this->widget('bootstrap.widgets.BootMenu', array(
		'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
		'stacked'=>false, // whether this is a stacked menu
		'items'=>array(
				array('label'=>'Public Folder','url'=>Yii::app()->createUrl('/sFileBrowser/publicFolder'),'active'=>true),
				array('label'=>'Personal Folder','url'=>Yii::app()->createUrl('/sFileBrowser/personalFolder')),

		),
));
?>

<?php
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', array(
        'connectorRoute' => 'sFileBrowser/connectorPublicFolder',
        )
);

?>