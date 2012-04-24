<?php
 
Yii::import('zii.widgets.CPortlet');
 
class SearchBlock extends CPortlet
{
    //public $title='Search';
 
    protected function renderContent()
    {
		$this->render('siteSearch');
    }
}

?>
