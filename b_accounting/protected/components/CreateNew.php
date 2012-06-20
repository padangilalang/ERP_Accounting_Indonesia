<?php
 
Yii::import('zii.widgets.CPortlet');
 
class CreateNew extends CPortlet
{
    //public $title='Search';
 
    protected function renderContent()
    {
		$this->render('CreateNew');
    }
}

?>
