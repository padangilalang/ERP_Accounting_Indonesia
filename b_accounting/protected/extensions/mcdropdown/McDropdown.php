<?php

/**
 * McDropdown class file.
 *
 * @author Salvador Aceves (xalakox@gmail.com)
 * @copyright Copyright &copy; 2011 Xalakox
 *
 */
class McDropdown extends CWidget{
	private $baseurl;
	public $model;
	public $attribute;
	public $form;
	public $data;
	public function init()
	{
		$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'source';
		$this->baseurl = Yii::app()->getAssetManager()->publish($dir);
		Yii::app()->clientScript->registerCoreScript('jquery');
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($this->baseurl."/lib/jquery.mcdropdown.min.js");
		$cs->registerCssFile($this->baseurl.'/css/jquery.mcdropdown.min');
		if(!$this->getId(false))
			$this->setId('nav-'.$this->attribute);
		parent::init();
	}
	public function run(){
		$attribute = $this->attribute;
		$idoftxtfield = get_class($this->model)."_".$this->attribute;
		$idoftxtfield2 = get_class($this->model)."DD".$this->attribute;
		$idofulmenu = get_class($this->model)."-".$this->attribute."-ul";
		$varname = $idoftxtfield."js";
		echo $this->form->hiddenField($this->model,$this->attribute);
		echo $this->getul($this->data," id='".$idofulmenu."' class='mcdropdown_menu'");
		echo "
		<input type=\"text\" size=\"45\" value=\"".$this->model->$attribute."\" id=\"".$idoftxtfield2."\">
		<script type=\"text/javascript\">
		var ".$varname."=null;
		$(document).ready(function (){
		$('#".$idoftxtfield2."').mcDropdown('#".$idofulmenu."',{allowParentSelect: true,select:function(){
		$('#".$idoftxtfield."').val(".$varname.".getValue()[0]);
	}});
	".$varname."= $('#".$idoftxtfield2."').mcDropdown();
	});

	</script>";
		parent::run();
	}
	private function getul($data,$st=""){
		$retval = "<ul".$st.">";
		foreach($data as $dato) {
			$retval.= '<li rel=\''.$dato['id'].'\'>'.$dato['text'];
			if ($dato['children'])
				$retval.= $this->getul($dato['children'],"");
			$retval.= "</li>";
		}
		$retval.= "</ul>";
		return $retval;
	}
}