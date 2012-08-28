<?php
/**
 * CmsSettings
 *
 * @package OneTwist CMS
 * @author twisted1919 (cristian.serban@onetwist.com)
 * @copyright OneTwist CMS (www.onetwist.com)
 * @version 1.1e
 * @since 1.0
 * @access public
 *
 * 1.1e - Special thanks to Gustavo (http://www.yiiframework.com/forum/index.php?/user/6112-gustavo/)
 */
class CmsSettings extends CApplicationComponent
{

	protected $_saveItemsToDatabase=array();
	protected $_deleteItemsFromDatabase=array();
	protected $_deleteCategoriesFromDatabase=array();
	protected $_cacheNeedsFlush=array();

	protected $_items=array();
	protected $_loaded=array();

	protected $_cacheComponentId='cache';
	protected $_cacheId='global_website_settings';
	protected $_cacheTime=0;

	protected $_dbComponentId='db';
	protected $_tableName='s_settings';
	protected $_createTable=false;
	protected $_dbEngine='InnoDB';

	public function init()
	{
		parent::init();
		Yii::app()->attachEventHandler('onEndRequest', array($this, 'whenRequestEnds'));

		if($this->getCreateTable())
			$this->createTable();
	}


	/**
	 * CmsSettings::set()
	 *
	 * @param string $category name of the category
	 * @param mixed $key
	 * can be either a single item (string) or an array of item=>value pairs
	 * @param mixed $value value to set for the key, leave this empty if $key is an array
	 * @param bool $toDatabase whether to save the items to the database
	 * @return CmsSettings
	 */
	public function set($category='system', $key='', $value='', $toDatabase=true)
	{
		if(is_array($key))
		{
			foreach($key AS $k=>$v)
				$this->set($category, $k, $v, $toDatabase);
		}
		else
		{
			if($toDatabase)
			{
				if(isset($this->_saveItemsToDatabase[$category])&&is_array($this->_saveItemsToDatabase[$category]))
					$this->_saveItemsToDatabase[$category]=array_merge($this->_saveItemsToDatabase[$category], array($key=>$value));
				else
					$this->_saveItemsToDatabase[$category]=array($key=>$value);
			}
			if(isset($this->_items[$category])&&is_array($this->_items[$category]))
				$this->_items[$category]=array_merge($this->_items[$category], array($key=>$value));
			else
				$this->_items[$category]=array($key=>$value);
		}
		return $this;
	}

	/**
	 * CmsSettings::get()
	 *
	 * @param string $category name of the category
	 * @param mixed $key
	 * can be either :
	 * empty, returning all items of the selected category
	 * a string, meaning a single key will be returned
	 * an array, returning an array of key=>value pairs
	 * @param string $default the default value to be returned
	 * @return mixed
	 */
	public function get($category='system', $key='', $default=null)
	{
		if(!isset($this->_loaded[$category]))
			$this->load($category);

		if(empty($key)&&empty($default)&&!empty($category))
			return isset($this->_items[$category])?$this->_items[$category]:null;

		if(!empty($key)&&is_array($key))
		{
			$toReturn=array();
			foreach($key AS $k=>$v)
			{
				if(is_numeric($k))
					$toReturn[$v]=$this->get($category, $v);
				else
					$toReturn[$k]=$this->get($category, $k, $v);
			}
			return $toReturn;
		}

		if(isset($this->_items[$category][$key]))
			return $this->_items[$category][$key];
		return $default;
	}

	/**
	 * delete an item or all items from a category
	 *
	 * @param string $category the name of the category
	 * @param mixed $key
	 * can be either:
	 * empty, meaning it will delete all items of the selected category
	 * a single key
	 * an array of keys
	 * @return CmsSettings
	 */
	public function delete($category, $key='')
	{
		if(empty($category))
			return $this;

		if(!empty($category)&&empty($key))
		{
			$this->_deleteCategoriesFromDatabase[]=$category;
			if(isset($this->_items[$category]))
				unset($this->_items[$category]);
			return;
		}
		if(is_array($key))
		{
			foreach($key AS $k)
				$this->delete($category, $k);
		}
		else
		{
			if(isset($this->_items[$category][$key]))
			{
				unset($this->_items[$category][$key]);
				if(empty($this->_deleteItemsFromDatabase[$category]))
					$this->_deleteItemsFromDatabase[$category]=array();
				$this->_deleteItemsFromDatabase[$category][]=$key;
			}
		}
		return $this;
	}

	/**
	 * load from database the items of the specified category
	 *
	 * @param string $category
	 * @return array the items of the category
	 */
	public function load($category)
	{
		$items=$this->getCacheComponent()->get($category.'_'.$this->getCacheId());
		$this->_loaded[$category]=true;

		if(!$items)
		{
			$connection=$this->getDbComponent();
			$command=$connection->createCommand('SELECT `key`, `value` FROM '.$this->getTableName().' WHERE category=:cat');
			$command->bindParam(':cat', $category);
			$result=$command->queryAll();

			if(empty($result))
				return;

			$items=array();
			foreach($result AS $row)
				$items[$row['key']] = @unserialize($row['value']);
			$this->getCacheComponent()->add($category.'_'.$this->getCacheId(), $items, $this->getCacheTime());
		}

		if(isset($this->_items[$category]))
			$items=array_merge($items, $this->_items[$category]);

		$this->set($category, $items, null, false);
		return $items;
	}

	public function toArray()
	{
		return $this->_items;
	}

	/**
	 * @param int $int the time to cache the keys, defaults to 0
	 */
	public function setCacheTime($int)
	{
		$this->_cacheTime=(int)$int>0?$int:0;
	}

	/**
	 * @return int the time to cache the keys, defaults to 0
	 */
	public function getCacheTime()
	{
		return $this->_cacheTime;
	}

	/**
	 * @param string $str the cache key to prepend to all categories, defaults to 'global_website_settings'
	 */
	public function setCacheId($str='')
	{
		$this->_cacheId=!empty($str)?$str:$this->_cacheId;
	}

	/**
	 * @return string the cache key to prepend to all categories, defaults to 'global_website_settings'
	 */
	public function getCacheId()
	{
		return $this->_cacheId;
	}

	/**
	 * @param string $name the name of the cache component to use, defaults to 'cache'
	 */
	public function setCacheComponentId($name)
	{
		$this->_cacheComponentId=$name;
	}

	/**
	 * @return string the name of the cache component to use, defaults to 'cache'
	 */
	public function getCacheComponentId()
	{
		return $this->_cacheComponentId;
	}

	/**
	 * @param $name string the name of the settings database table, defaults to '{{settings}}'
	 */
	public function setTableName($name)
	{
		if($this->getCreateTable()&&(strpos($name, '{{')!=0||strpos($name, '}}')!=(strlen($name)-2)))
			throw new CException('The table name must be like "{{'.$name.'}}" not just "'.$name.'"');
		$this->_tableName=$name;
	}

	/**
	 * @return string the name of the settings database table, defaults to '{{settings}}'
	 */
	public function getTableName()
	{
		return $this->_tableName;
	}

	/**
	 * @param string $name the name of the db component to use, defaults to 'db'
	 */
	public function setDbComponentId($name)
	{
		$this->_dbComponentId=$name;
	}

	/**
	 * @return string the name of the db component to use, defaults to 'db'
	 */
	public function getDbComponentId()
	{
		return $this->_dbComponentId;
	}

	/**
	 * wheter to create the settings table if the table does not exist
	 * set this to false in production mode as it will slow down the application
	 * defaults to false
	 * @param boolean $bool
	 */
	public function setCreateTable($bool)
	{
		$this->_createTable=(bool)$bool;
	}

	/**
	 * wheter to create the settings table if the table does not exist
	 * set this to false in production mode as it will slow down the application
	 * defaults to false
	 * @return boolean
	 */
	public function getCreateTable()
	{
		return $this->_createTable;
	}

	/**
	 * @param string $name the engine to use when creating a new table, defaults to 'InnoDb'
	 */
	public function setDbEngine($name)
	{
		$this->_dbEngine=$name;
	}

	/**
	 * @return string the dbEngine to use when creating a new table, defaults to 'InnoDb'
	 */
	public function getDbEngine()
	{
		return $this->_dbEngine;
	}

	/**
	 * @return CCache the cache component
	 */
	protected function getCacheComponent()
	{
		return Yii::app()->getComponent($this->getCacheComponentId());
	}

	/**
	 * @return CDbConnection the db connection component
	 */
	protected function getDbComponent()
	{
		return Yii::app()->getComponent($this->getDbComponentId());
	}

	protected function addDbItem($category='system', $key, $value)
	{
		$connection=$this->getDbComponent();
		$command=$connection->createCommand('SELECT id FROM '.$this->getTableName().' WHERE `category`=:cat AND `key`=:key LIMIT 1');
		$command->bindParam(':cat', $category);
		$command->bindParam(':key', $key);
		$result=$command->queryRow();
		$value=@serialize($value);

		if(!empty($result))
			$command=$connection->createCommand('UPDATE '.$this->getTableName().' SET `value`=:value WHERE `category`=:cat AND `key`=:key');
		else
			$command=$connection->createCommand('INSERT INTO '.$this->getTableName().' (`category`,`key`,`value`) VALUES(:cat,:key,:value)');

		$command->bindParam(':cat', $category);
		$command->bindParam(':key', $key);
		$command->bindParam(':value', $value);
		$command->execute();
	}

	protected function whenRequestEnds()
	{
		$this->_cacheNeedsFlush=array();

		if(count($this->_deleteCategoriesFromDatabase)>0)
		{
			foreach($this->_deleteCategoriesFromDatabase AS $catName)
			{
				$connection=$this->getDbComponent();
				$command=$connection->createCommand('DELETE FROM '.$this->getTableName().' WHERE `category`=:cat');
				$command->bindParam(':cat', $catName);
				$command->execute();
				$this->_cacheNeedsFlush[]=$catName;

				if(isset($this->_deleteItemsFromDatabase[$catName]))
					unset($this->_deleteItemsFromDatabase[$catName]);
				if(isset($this->_saveItemsToDatabase[$catName]))
					unset($this->_saveItemsToDatabase[$catName]);
			}
		}

		if(count($this->_deleteItemsFromDatabase)>0)
		{
			foreach($this->_deleteItemsFromDatabase AS $catName=>$keys)
			{
				$params=array();
				$i=0;
				foreach($keys AS $v)
				{
					if(isset($this->_saveItemsToDatabase[$catName][$v]))
						unset($this->_saveItemsToDatabase[$catName][$v]);
					$params[':p'.$i]=$v;
					++$i;
				}
				$names=implode(',', array_keys($params));

				$connection=$this->getDbComponent();
				$query='DELETE FROM '.$this->getTableName().' WHERE `category`=:cat AND `key` IN('.$names.')';
				$command=$connection->createCommand($query);
				$command->bindParam(':cat', $catName);

				foreach($params AS $key=>$value)
					$command->bindParam($key, $value);

				$command->execute();
				$this->_cacheNeedsFlush[]=$catName;
			}
		}

		if(count($this->_saveItemsToDatabase)>0)
		{
			foreach($this->_saveItemsToDatabase AS $catName=>$keyValues)
			{
				foreach($keyValues AS $k=>$v)
					$this->addDbItem($catName, $k, $v);
				$this->_cacheNeedsFlush[]=$catName;
			}
		}

		if(count($this->_cacheNeedsFlush)>0)
		{
			foreach($this->_cacheNeedsFlush AS $catName)
				$this->getCacheComponent()->delete($catName.'_'.$this->getCacheId());
		}
	}

	/**
	 * create the settings table
	 */
	protected function createTable()
	{
		$connection=$this->getDbComponent();
		$tableName=$connection->tablePrefix.str_replace(array('{{','}}'), '', $this->getTableName());
		$sql='CREATE TABLE IF NOT EXISTS `'.$tableName.'` (
		`id` int(11) NOT NULL auto_increment,
		`category` varchar(64) NOT NULL default \'system\',
		`key` varchar(255) NOT NULL,
		`value` text NOT NULL,
		PRIMARY KEY  (`id`),
		KEY `category_key` (`category`,`key`)
		) '.($this->getDbEngine() ? 'ENGINE='.$this->getDbEngine() : '').'  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ';
		$command=$connection->createCommand($sql);
		$command->execute();
	}

}