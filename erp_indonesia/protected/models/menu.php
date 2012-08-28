<?php

class menu extends BaseModel
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 's_module';
	}

	public function relations()
	{
		return array(
				'getparent' => array(self::BELONGS_TO, 'menu', 'parent_id'),
				'childs' => array(self::HAS_MANY, 'menu', 'parent_id', 'order' => 'sort,id ASC'),
		);
	}

	public function getListed() {
		$subitems = array();

		$model=sUserModule::model()->find(array(
				'condition'=>'s_module_id = :module AND s_user_id = :user',
				'params'=>array(':module'=>$this->id,':user'=>Yii::app()->user->id)
		));
		if ($model !=null or Yii::app()->user->name == 'admin') {
			if($this->childs) foreach($this->childs as $child)
				$subitems[] = $child->getListed();

			$returnarray = array('label' => $this->title, 'icon'=>'th-large', 'url' => array($this->link));

			if($subitems != array())
				$returnarray = array_merge($returnarray, array('items' => $subitems));

			return $returnarray;
		}

	}

	public function getTree() {
		$subitems = array();

		if($this->childs) foreach($this->childs as $child) {
			$subitems[] = $child->getTree();
		}
		$returnarray = array(
				'text' => CHtml::link($this->title,Yii::app()->createUrl($this->link))." ".
				CHtml::link('.E.',Yii::app()->createUrl('smodule/update',array('id'=>$this->id))) ,
				'id' => array($this->id));
		if($subitems != array())
			$returnarray = array_merge($returnarray, array('children' => $subitems));
		return $returnarray;
	}

	public function getData($cnd=" = 0") {
		$data = array();
		foreach(menu::model()->findAll('parent_id'.$cnd) as $model) {
			$row['text'] = $model->title;
			$row['id'] = $model->id;
			$row['children'] = Menu::getData(' ='.$model->id);
			$data[] = $row;
		}
		return $data;
	}
}