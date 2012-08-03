<?php

class CalWidget extends CWidget
{
	public function run()
	{
		$calendarOptions = Yii::app()->controller->module->calendarOptions;

		$cs = Yii::app()->getClientScript();
		$scriptUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.cal.components.fullCal'));
		$cs->registerCssFile($cs->getCoreScriptUrl().'/jui/css/2blitzer/jquery-ui-1.8.14.custom.css');
		//if($calendarOptions['theme'])
		//    $cs->registerCssFile($scriptUrl . '/' . $calendarOptions['themeName'] . '/theme.css');
		$cs->registerCssFile($scriptUrl . '/fullcalendar.css');
		$cs->registerCssFile($scriptUrl . '/eventCal.css');
		$cs->registerCoreScript('jquery');
		$cs->registerScriptFile($cs->getCoreScriptUrl().'/jui/js/jquery-ui.min.js');
		$cs->registerScriptFile($scriptUrl . '/fullcalendar.min.js');
		$cs->registerScriptFile($scriptUrl . '/eventCal.js');

		$param['baseUrl']= Yii::app()->createUrl('cal/main').'/';
		$param['newEventPromt']=Yii::t('CalModule.fullCal', 'New event:');
		$param['calendar'] = $this->translateArray($calendarOptions);
		$param = CJavaScript::encode($param);
		$js = "jQuery().eventCal($param);";
		$cs->registerScript(__CLASS__ . '#EventCal', $js);
	}

	function translateArray($arr)
	{
		foreach ($arr as $key => $data)
		{
			if (is_array($data))
			{
				foreach ($data as $k => $d)
					$data[$k] = Yii::t('CalModule.fullCal', $d);
				$arr[$key] = $data;
			}
			else
				$arr[$key] = Yii::t('CalModule.fullCal', $data);
		}
		return $arr;
	}
}

?>
