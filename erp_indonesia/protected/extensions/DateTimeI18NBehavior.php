<?php

/*
 * DateTimeI18NBehavior
* Automatically converts date and datetime fields to I18N format
*
* Author: Ricardo Grana <rickgrana@yahoo.com.br>, <ricardo.grana@pmm.am.gov.br>
* Version: 1.1
* Requires: Yii 1.0.9 version
*/

class DateTimeI18NBehavior  extends CActiveRecordBehavior
{
	public $dateOutcomeFormat = 'Y-m-d';  //Format pengisian tanggal di My-SQL yang ditentukan
	public $dateTimeOutcomeFormat = 'Y-m-d H:i:s';

	public $dateIncomeFormat = 'yyyy-MM-dd';
	public $dateTimeIncomeFormat = 'yyyy-MM-dd hh:mm:ss';

	public function beforeSave($event){

		//search for date/datetime columns. Convert it to pure PHP date format
		foreach($event->sender->tableSchema->columns as $columnName => $column){

			if (($column->dbType != 'date') and ($column->dbType != 'datetime')) continue;

			if (!strlen($event->sender->$columnName)){
				$event->sender->$columnName = null;
				continue;
			}

			if (($column->dbType == 'date')) {
				$event->sender->$columnName = date($this->dateOutcomeFormat, CDateTimeParser::parse($event->sender->$columnName, 'dd-MM-yyyy'));
			} else {

				$event->sender->$columnName = date($this->dateTimeOutcomeFormat,
						CDateTimeParser::parse($event->sender->$columnName,
								strtr(Yii::app()->locale->dateTimeFormat,
										array("{0}" => Yii::app()->locale->timeFormat,
												"{1}" => Yii::app()->locale->dateFormat))));
			}

		}

		return true;
	}


	public function afterFind($event){
			
		foreach($event->sender->tableSchema->columns as $columnName => $column){

			if (($column->dbType != 'date') and ($column->dbType != 'datetime')) continue;

			if (!strlen($event->sender->$columnName)){
				$event->sender->$columnName = null;
				continue;
			}

			if ($column->dbType == 'date'){
				$event->sender->$columnName = Yii::app()->dateFormatter->format('dd-MM-yyyy',
						CDateTimeParser::parse($event->sender->$columnName, $this->dateIncomeFormat));
			}else{
				$event->sender->$columnName =
				Yii::app()->dateFormatter->formatDateTime(
						CDateTimeParser::parse($event->sender->$columnName,	$this->dateTimeIncomeFormat),
						'medium', 'medium');
			}
		}
		return true;
	}
}