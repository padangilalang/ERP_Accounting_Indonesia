<?php

/**
 * This is the model class for table "s_group".
 *
 * The followings are the available columns in table 's_group':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $organization_root_id
 */
class sGroup extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return sGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 's_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('parent_id, organization_root_id', 'required'),
				array('parent_id, organization_root_id', 'numerical', 'integerOnly'=>true),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, parent_id, organization_root_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
				'organization_root' => array(self::BELONGS_TO, 'aOrganization', 'organization_root_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'parent_id' => 'Parent',
				'organization_root_id' => 'Organization Root',
		);
	}

	public function search($id)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}