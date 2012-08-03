<?php

/**
 * @author Serg.Kosiy <serg.kosiy@gmail.com>
 */
class DashController extends UIDashboardController
{
	// uncomment the following to apply new layout for the controller view.
	public $layout = '//layouts/main';

	public function init()
	{
		parent::init();

		$model=$this->newNotification();
		$modeltask=$this->newTask();

		// Create new field in your users table for store dashboard preference
		// Set table name, user ID field name, user preference field name
		$this->setTableParams('dashboard_page', 'user_id', 'title');

		// set array of portlets
		$this->setPortlets(
				array(
						array('id' => 1, 'title' => 'Document', 'content' => 'content here...'),
						array('id' => 2, 'title' => 'Report', 'content' => 'content here...'),
						array('id' => 3, 'title' => 'Note', 'content' => 'Notes list'),
						array('id' => 4, 'title' => 'Department', 'content' => 'content here...'),
						array('id' => 5, 'title' => 'Reference', 'content' => '*************'),
						array('id' => 6, 'title' => 'Task', 'content' => $this->renderPartial('/dash/task', array('model'=>$model,'modeltask'=>$modeltask), true)),
						array('id' => 7, 'title' => 'Reminder', 'content' => 'All Reminder is here'),
							
				)
		);

		//set content BEFORE dashboard
		$this->setContentBefore(
				//Pay attension: ExtController looking view in current dir!!!
				//$this->renderPartial('/../views/dash/before', null, true)
		);

		//set content AFTER dashboard
		//$this->setContentAfter('<br><div align="center"><a href="http://kosiy.blogspot.com/p/donate.html">Donate next release</a></div>');

		// uncomment the following to apply jQuery UI theme
		// from protected/components/assets/themes folder
		//$this->applyTheme('ui-darkness');

		// uncomment the following to change columns count
		//$this->setColumns(4);

		// uncomment the following to enable autosave
		$this->setAutosave(true);

		// uncomment the following to disable dashboard header
		//$this->setShowHeaders(false);

		// uncomment the following to enable context menu and add needed items
		/*
		 $this->menu = array(
		 		array('label' => 'Index', 'url' => array('index')),
		 );
		*/
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}

	public function newNotification()
	{
		$model=new sNotification;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['sNotification']))
		{
			$model->attributes=$_POST['sNotification'];
			$model->sender_id=Yii::app()->user->id;
			$model->type_id=2;
			$model->read_id=1;
			$model->category_id=12;
			if($model->save()) {
				Yii::app()->user->setFlash('success','data has been saved successfully');
				$this->refresh();
			}
		}

		return $model;

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function newTask()
	{
		$model=new sTask;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['sTask']))
		{
			$model->attributes=$_POST['sTask'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','data has been saved successfully');
				$this->refresh();
			}
		}

		return $model;
	}


}
