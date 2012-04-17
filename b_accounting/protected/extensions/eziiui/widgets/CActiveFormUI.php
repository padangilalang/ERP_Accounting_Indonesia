<?php
Yii::import('ext.eziiui.helpers.UHtml');

/**
 * This class extends CActiveForm and uses UHtml to create fields
 */
class CActiveFormUI extends CActiveForm
{
	private $_attributes=array();
	private $_summary;

	/**
	 * Displays a summary of validation errors for one or several models.
	 * This method is very similar to {@link CHtml::errorSummary} except that it also works
	 * when AJAX validation is performed.
	 * @param mixed the models whose input errors are to be displayed. This can be either
	 * a single model or an array of models.
	 * @param string a piece of HTML code that appears in front of the errors
	 * @param string a piece of HTML code that appears at the end of the errors
	 * @param array additional HTML attributes to be rendered in the container div tag.
	 * @return string the error summary. Empty if no errors are found.
	 * @see CHtml::errorSummary
	 */
	public function errorSummary($models,$header=null,$footer=null,$htmlOptions=array())
	{
		if(!$this->enableAjaxValidation)
			return UHtml::errorSummary($models,$header,$footer,$htmlOptions);

		if(!isset($htmlOptions['id']))
			$htmlOptions['id']=$this->id.'_es_';
		$html=UHtml::errorSummary($models,$header,$footer,$htmlOptions);
		if($html==='')
		{
			if($header===null)
				$header='<p>'.Yii::t('yii','Please fix the following input errors:').'</p>';
			if(!isset($htmlOptions['class']))
				$htmlOptions['class']=UHtml::$errorSummaryCss;
			$htmlOptions['style']=isset($htmlOptions['style']) ? rtrim($htmlOptions['style'],';').';display:none' : 'display:none';
			$html=UHtml::tag('div',$htmlOptions,$header."\n<ul><li>dummy</li></ul>".$footer);
		}

		$this->_summary=$htmlOptions['id'];
		return $html;
	}

	/**
	 * Renders a text field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTextField}.
	 * Please check {@link CHtml::activeTextField} for detailed information
	 * about the parameters for this method.
	 */
	public function textField($model,$attribute,$htmlOptions=array())
	{
		return UHtml::activeTextField($model,$attribute,$htmlOptions);
	}

	/**
	 * Renders a hidden field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeHiddenField}.
	 * Please check {@link CHtml::activeHiddenField} for detailed information
	 * about the parameters for this method.
	 */
	public function hiddenField($model,$attribute,$htmlOptions=array())
	{
		return UHtml::activeHiddenField($model,$attribute,$htmlOptions);
	}

	/**
	 * Renders a password field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activePasswordField}.
	 * Please check {@link CHtml::activePasswordField} for detailed information
	 * about the parameters for this method.
	 */
	public function passwordField($model,$attribute,$htmlOptions=array())
	{
		return UHtml::activePasswordField($model,$attribute,$htmlOptions);
	}

	/**
	 * Renders a text area for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTextArea}.
	 * Please check {@link CHtml::activeTextArea} for detailed information
	 * about the parameters for this method.
	 */
	public function textArea($model,$attribute,$htmlOptions=array())
	{
		return UHtml::activeTextArea($model,$attribute,$htmlOptions);
	}

	/**
	 * Renders a dropdown list for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeDropDownList}.
	 * Please check {@link CHtml::activeDropDownList} for detailed information
	 * about the parameters for this method.
	 */
	public function dropDownList($model,$attribute,$data,$htmlOptions=array())
	{
		return UHtml::activeDropDownList($model,$attribute,$data,$htmlOptions);
	}

	/**
	 * Renders a list box for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeListBox}.
	 * Please check {@link CHtml::activeListBox} for detailed information
	 * about the parameters for this method.
	 */
	public function listBox($model,$attribute,$data,$htmlOptions=array())
	{
		return UHtml::activeListBox($model,$attribute,$data,$htmlOptions);
	}

}
