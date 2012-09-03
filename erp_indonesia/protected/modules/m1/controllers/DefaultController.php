<?php

class DefaultController extends Controller
{
	//public $layout='//layouts/column2';
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'rights',
		);
	}

	public function actionIndex()
	{
		$this->render('index');
	}
}