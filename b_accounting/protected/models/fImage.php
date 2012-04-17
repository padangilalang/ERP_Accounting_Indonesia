<?php

class fImage extends CFormModel
{
	public $image;

	public function rules()
	{
		return array(
				array('image', 'required'),
				array('image', 'file', 'types'=>'jpg, gif, png'),
		);
	}

	public function attributeLabels()
	{
		return array(
				'image'=>'Nama File Image',
		);
	}
}
