<?php
/**
 * DecimalI18NBehavior
 *
 * Converts DECIMALs between DB and locale specific display format.
 *
 * After reading from DB, all DECIMAL columns will be formatted with the
 * Yii::app()->numberFormatter component. By default, the default decimal
 * format for the current locale  will be used (CNumberFormatter::formatDecimal).
 *
 * Alternatively $format can be set to:
 *
 *   1. A format string for CNumberFormatter::format()
 *   2. The value 'db' to read the number of decimals from DB. The
 *      Number will be formatted in locale specific format, but with
 *      this number of decimals. So a DECIMAL(10,4) will be displayed
 *      with 4 decimals.
 *
 * To configure formats for specific attributes, $formats can be an
 * Array of name/format pairs:
 *
 *      array(
 *          'someColumn' =>'#0.0',
 *      )
 *
 * If $parseExpression is set, the attribute will be converted back to DB
 * specific format before the record is saved. In this expression, $value will
 * contain the attribute value. For example to convert "1,234" to "1.234",
 * this expression can be configured:
 *
 *      'parseExpression'=>"strtr( \$value, ',', '.')",
 *
 * @version $Id$
 * @author Michael Härtl <haertl.mike@googlemail.com>
 */
class DecimalI18NBehavior  extends CActiveRecordBehavior
{
	const REGEX_DECIMALS='/^decimal\(\d+,(\d+)\)/';

	/**
	 * @var mixed Default decimal format for attributes not specified in 'formats'.
	 * If not set, system specific decimal format will be used. If 'db', the number of decimals will be read from DB.
	 */
	public $format;

	/**
	 * @var array CNumberFormatter format patterns per attribute (indexed by attribute name)
	 */
	public $formats=array();

	/**
	 * @var mixed A valid PHP expression string to convert a formatted number back to
	 * a valid decimal before save, for example "strtr(\$value,',','.')". $value will contain the attribute value.
	 */
	public $parseExpression;


	public function beforeSave($e)
	{
		if ($this->parseExpression!==null)
		{
			$model=$this->owner;
			$evalcode="return {$this->parseExpression};";
			foreach($this->owner->getTableSchema()->columns as $name => $column)
			{
				if (preg_match(self::REGEX_DECIMALS,$column->dbType,$m) && ($value=$model->$name)!==null)
					$model->$name=eval($evalcode);
			}
		}

		return true;
	}

	public function afterFind($e)
	{
		$model=$this->owner;
		$nf=Yii::app()->numberFormatter;

		foreach($model->getTableSchema()->columns as $name => $column)
		{
			// Find DECIMAL(x,y) and match y as $m[1]
			if ($model->$name!==null && preg_match(self::REGEX_DECIMALS,$column->dbType,$m) && $m[1]!=0)
			{
				if (isset($this->formats[$name]))
					$model->$name=$nf->format($this->formats[$name],$model->$name);
				elseif($this->format===null)
				$model->$name=$nf->formatDecimal($model->$name);
				else
				{
					$format= $this->format==='db' ? sprintf("0.%0{$m[1]}d",0) : $this->format;
					$model->$name=$nf->format($format,$model->$name);
				}
			}
		}
		return true;
	}
}
