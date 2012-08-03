<?php

//Yii::import('.........');	//uncomment line if you are going to use your own custom validator class

/**
 * repeat a validator for an array attribute
 * @author pligor
 */
class ArrayValidator extends CValidator {
	public $validatorClass;
	public $params;
	public $separateParams;

	public $allowEmpty;

	protected $validator;
	protected $curParams;

	public function __construct() {
		$this->allowEmpty = true;
	}

	protected function loadValidatorParams() {
		foreach($this->curParams as $paramName => $paramValue) {
			$this->validator->$paramName = $paramValue;
		}
	}

	/**
	 * Validates the attribute of the object.
	 * If there is any error, the error message is added to the object.
	 * @param CModel $object the object being validated
	 * @param string $attribute the attribute being validated
	 */
	protected function validateAttribute($object, $attribute) {
		if($this->separateParams === null) {
			$this->addError($object, $attribute, Yii::t('', 'you must set separateParams attribute before using validator'));
			return;
		}

		if(isset($object->$attribute)) {
			if($this->allowEmpty === true) {
				$object->$attribute = null;
				return;
			}
			$this->addError($object, $attribute, Yii::t('', 'not allowed to be empty'));
			return;
		}

		if( !is_array($object->$attribute) ) {
			$this->addError($object, $attribute, Yii::t('', 'you are trying to validate a non-array attribute'));
			return;
		}

		$validatorClass = $this->validatorClass;
		$this->validator = new $validatorClass();

		$attributeArray = $object->$attribute;	//storing original array

		$this->curParams = $this->params;
		if($this->separateParams === false) {
			$this->loadValidatorParams();
		}

		$array = $object->$attribute;
		foreach($array as $key => $value) {
			if($this->separateParams){
				$this->curParams = $this->params[$key];
				$this->loadValidatorParams();
			}

			$object->$attribute = $value;	//get the value

			$this->validator->attributes = array($attribute);
			$this->validator->validate($object);
		}

		$object->$attribute = $attributeArray;	//restoring original array
	}
}