<?php

/**
 * @author Serg Kosiy <serg.kosiy@gmail.com>
 */
class UIDashboardController extends UIController
{

	public $layout = '//layouts/column1';
	public $defaultAction = 'dash';
	private $_portlets = array(); // id, title, content
	private $_tableName;
	private $_userIdFieldName;
	private $_userPrefFieldName;
	private $_columns = 3;
	private $_showHeader = true;
	private $_autoSave = false;
	private $editable = false; // user can save/reset preference
	private $url;              // images url
	private $contentBefore;
	private $contentAfter;

	public function init()
	{
		parent::init();
		if(!empty($_GET['layout'])) $this->layout = $_GET['layout'];
	}

	/**
	 * Set params needed for store user's preference to DB
	 * @param <string> $tableName the table name
	 * @param <string> $userIdField the user's ID field name
	 * @param <string> $userPrefField the user's preference field name
	 */
	public function setTableParams($tableName, $userIdField, $userPrefField)
	{
		$this->_tableName = $tableName;
		$this->_userIdFieldName = $userIdField;
		$this->_userPrefFieldName = $userPrefField;
		$this->editable = true;
	}

	/**
	 * Array of portlets definition.
	 * The portlet is array
	 *      id - integer
	 *      title - string
	 *      content - string
	 * @param <array> $portlets
	 */
	public function setPortlets($portlets)
	{
		if (count($portlets) < $this->_columns)
			$this->_columns = count($portlets);
		$this->_portlets = $portlets;
	}

	/**
	 * Sets dashboard columns count
	 * @param <int> $columnsCount
	 */
	public function setColumns($columnsCount)
	{
		$this->_columns =
		($columnsCount < count($this->_columns)) ?
		count($this->_portlets) : $columnsCount;
	}

	/**
	 * Autosave dashboard state via AJAX
	 * @param <bool> $flagAutosave
	 */
	public function setAutosave($flagAutosave)
	{
		$this->_autoSave = $flagAutosave;
	}

	/**
	 * Show or hide dashboard header
	 * @param <bool> $flagShow
	 */
	public function setShowHeaders($flagShow = true)
	{
		$this->_showHeader = $flagShow;
	}
	/**
	 * Set page's content before dashboard
	 * @param <string> $content
	 */
	public function setContentBefore($content = null)
	{
		$this->contentBefore = $content;
	}
	/**
	 * Set page's content after dashboard
	 * @param <string> $content
	 */
	public function setContentAfter($content = null)
	{
		$this->contentAfter = $content;
	}

	/**
	 *  The controller's default action
	 */
	public function actionDash()
	{
		$this->registerScript();
		$pref = $this->getPreference();
		$this->render('application.components.views.dashboard.showDash', array(
				'portlets' => $this->applyUserPref($pref),
				'columns' => $this->_columns,
				'showHeader' => $this->_showHeader,
				'autoSave' => $this->_autoSave,
				'editable' => $this->editable,
				'resetUrl' => $this->createUrl('resetDash'),
				'url' => $this->url,
				'contentBefore'=>$this->contentBefore,
				'contentAfter'=>$this->contentAfter,
		));
	}

	/**
	 * Save dashboard state via AJAX
	 * @param <int> $userId
	 */
	public function actionSaveDash($userId)
	{
		if ((Yii::app()->request->isAjaxRequest) and !empty($userId))
		{
			$preference = serialize(array(
					'columnsCount' => $_POST['columnsCount'],
					'widgetsPos' => $_POST['widgetsPos']
			));
			echo (int) $this->setPreference($preference);
			Yii::app()->end();
		}
	}

	/**
	 * Reset dashboard state to default and go to default action
	 */
	public function actionResetDash()
	{
		if($this->setPreference(null))
		{
			Yii::app()->user->setFlash('resetDashboard', YII::t('Dashboard', 'Dashboard reset to default.'));
			$this->redirect(array($this->defaultAction));
		}
	}

	/**
	 * Store dashboard state to DB
	 * If $preference is null - reset to default
	 * @param <string> $preference
	 * @return <bool>
	 */
	private function setPreference($preference)
	{
		$conn = Yii::app()->db;
		$command = $conn->createCommand();
		try
		{
			$command->update($this->_tableName,
					array($this->_userPrefFieldName => $preference),
					$this->_userIdFieldName . "=:id",
					array(":id" => $this->uid));
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}

	/**
	 * Read dashboard state from DB
	 * @return <array>
	 */
	private function getPreference()
	{
		$pref = Yii::app()->db->createCommand(
				array(
						'select' => $this->_userPrefFieldName,
						'from' => $this->_tableName,
						'where' => $this->_userIdFieldName . " = :id",
						'params' => array(":id" => $this->uid)
				)
		)->queryRow();
		return ($pref[$this->_userPrefFieldName] === null) ? '' : unserialize($pref[$this->_userPrefFieldName]);
	}

	private function registerScript()
	{
		$scriptUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.components.assets.dashboard'));
		$this->cs->registerCssFile($scriptUrl . '/dashboard.css');
		$this->cs->registerScriptFile($scriptUrl . '/dashboard.js');
		$this->url = $scriptUrl . '/images';
		$param['saveUrl'] = $this->createUrl('saveDash', array('userId' => $this->uid));
		$param['autoSave'] = $this->_autoSave;
		$param = CJavaScript::encode($param);
		$js = "jQuery().dashbrd($param);";
		$this->cs->registerScript(__CLASS__ . '#dashboard', $js);
	}

	/**
	 * Reorder portlets
	 * @param <array> $pref
	 * @return <array>
	 */
	private function applyUserPref($pref)
	{
		$tempArray = array();
		if ($pref != null)
		{
			if (($this->_columns - 1 >= $pref['columnsCount']) and (count($pref['widgetsPos']) <= count($this->_portlets)))
			{
				$widgets = $pref['widgetsPos'];
				foreach ($widgets as $keyColumn => $widgetColumn)
				{
					if (!empty($widgetColumn))
					{
						foreach ($widgetColumn as $keyRow => $widgetRow)
						{
							foreach ($this->_portlets as $key1 => $portlet)
							{
								if ($portlet['id'] == $widgetRow)
								{
									$tempArray[$keyColumn][$keyRow] = $portlet;
									$this->_portlets[$key1]['indexed'] = true;
									break;
								}
							}
							unset($portlet);
						}
						unset($widgetRow);
					}
				}
				unset($widgetColumn);
				if (count($this->_portlets) > count($tempArray))
					foreach ($this->_portlets as $portlet)
					{
						if (empty($portlet['indexed']))
							$tempArray[$keyColumn][++$keyRow] = $portlet;
					}
			}
		}
		if (empty($tempArray))
		{
			$i = 0; // column
			$j = 0; //row
			foreach ($this->_portlets as $portlet)
			{
				$tempArray[$i++][$j] = $portlet;
				if ($i >= $this->_columns)
				{
					$i = 0;
					$j++;
				}
			}
		}
		return $tempArray;
	}

}

?>
