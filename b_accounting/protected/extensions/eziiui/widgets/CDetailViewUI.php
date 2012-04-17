<?php
Yii::import('zii.widgets.CDetailView');

class CDetailViewUI extends CDetailView
{
	public $itemTemplate="<tr class=\"{class}\"><th class=\"ui-state-priority-primary\">{label}</th><td>{value}</td></tr>\n";

	public function init()
	{
		$this->htmlOptions=array_merge($this->htmlOptions,array('class'=>'ui-widget ui-widget-content detail-view'));
		$this->baseScriptUrl=Yii::app()->getAssetManager()->publish(dirname(__FILE__).'/assets/detailviewui');
		parent::init();
	}

}
