<?php
class SFileBrowserController extends Controller
{
	public $layout='//layouts/column1';

	public function filters()
	{
		return array(
				'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
				array('allow',
						'actions'=>array('personalFolder','connectorPersonalFolder'),
						'users'=>array(Yii::app()->user->name),
				),
				array('allow',
						'users'=>array('admin'),
				),
				array('allow',
						'actions'=>array('publicFolder','connectorPublicFolder'),
						'users'=>array('@'),
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}

    public function actions()
    {
        return array(
            'connector' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot.images.docs'),
                    'URL' => Yii::app()->baseUrl . '/images/docs/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
					//'uploadDeny'    => array('all'),
					
                )
            ),
            'connectorPublicFolder' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot.images.docs'),
                    'URL' => Yii::app()->baseUrl . '/images/docs/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
					'uploadDeny'    => array('all'),
					
                )
            ),
            'connectorPersonalFolder' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot.personalfolder').'/'.Yii::app()->user->name.'/',
                    //'URL' => Yii::app()->baseUrl . '/personalfolder/'.Yii::app()->user->name,
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none',
					//'uploadDeny'    => array('all'),
					
                )
            ),
        );
    }
	
	public function actionIndex() {
	
		$this->render('index');
	}

	public function actionPublicFolder() {
	
		$this->render('publicFolder');
	}
	
	public function actionPersonalFolder() {
		if (!is_dir(Yii::getPathOfAlias('webroot.personalfolder') . '/'.Yii::app()->user->name))
				mkdir(Yii::getPathOfAlias('webroot.personalfolder') . '/'.Yii::app()->user->name);
			
		$this->render('personalFolder');
	}

	
}
 
/* 
//server file input
$this->widget('ext.elFinder.ServerFileInput', array(
        'model' => $model,
        'attribute' => 'serverFile',
        'connectorRoute' => 'admin/elfinder/connector',
        )
);
 
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', array(
        'connectorRoute' => 'admin/elfinder/connector',
        )
);

*/
?>