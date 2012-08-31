<?php

/**
 * EActiveDataProviderEx class file
 * Some CActiveDataProvider enhancements (query caching, total item count fix)
 *
 *
 * @author Alban Jubert <alban.jubert@trinidev.fr>
 * @link http://www.trinidev.fr/
 * @version 1.1.1
 */

/*
 * EActiveDataProviderEx enhance the CActiveDataProvider class by:
* - adding the new query caching feature introduced in Yii 1.1.7
* - circumventing the issue of miscalculation of the number of elements when a having and / or group criteria is used by the active record
*
* Requirements
* ------------
* Yii 1.1.7 or later
*
* Installation
* ------------
* Extract the release file under protected/components
* Be sure to import the component using the 'import' parameter of the config file
*
* Usage
* -----
* Use EActiveDataProviderEx the exact same way you use CActiveDataPrivider.
* In addition, you can specify a 'cache' property as an array consisting in two parameter: array($cache_duration, $cache_dependency).
* $cache_duration is the cache duration in seconds
* $cache_dependency is an optional CCacheDependency object
*
* Exemple
* -------
* ~~~
* [php]
* $criteria=new CDbCriteria;
* // add some criteria here
* $dependency = new CDbCacheDependency('SELECT MAX(UNIX_TIMESTAMP(`modified`)) FROM yourModelTable'); // Optional
* $activeDataProviderEx = new EActiveDataProviderEx(yourModel, array(
*      'criteria'=>$criteria,
*      'pagination' => array('pageSize' => 30),
*      'sort' => array('defaultOrder' => '`t`.`name`'),
*      'cache' => array(3600, $dependency)
* ));
* ~~~
*
*/
class EActiveDataProviderEx extends CActiveDataProvider {

	private $_cache_duration;
	private $_cache_dependency;

	public function getCache() {
		return array($this->_cache_duration, $this->_cache_dependency);
	}

	public function setCache($value) {
		if (is_array($value) && count($value)) {
			$this->_cache_duration = $value[0];
			if (count($value) > 1) {
				$this->_cache_dependency = $value[1];
			} else {
				$this->_cache_dependency = null;
			}
		} else {
			$this->_cache_duration = null;
			$this->_cache_dependency = null;
		}
	}

	protected function fetchData() {
		if(!is_null($this->_cache_duration))
			$this->model=$this->model->cache($this->_cache_duration, $this->_cache_dependency,2);
		return parent::fetchData();
	}

	protected function calculateTotalItemCount() {
		$baseCriteria=$this->model->getDbCriteria(false);
		if($baseCriteria!==null)
			$baseCriteria=clone $baseCriteria;
		if($this->getCriteria()->having || $this->getCriteria()->group)
			$count=$this->model->dbConnection->commandBuilder->createCountCommand($this->model->tableName(), $this->getCriteria())->queryScalar();
		else
			$count=$this->model->count($this->getCriteria());
		$this->model->setDbCriteria($baseCriteria);
		return $count;
	}

}

?>
