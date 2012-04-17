<?php
/**
 * CCheckBoxColumnUI class file.
 *
 * @author Corey Tisdale modified by Marco C.
 */

Yii::import('zii.widgets.grid.CCheckboxColumn');

/**
 * CCheckBoxColumnUI represents a grid view column of checkboxes that allows the check all button
 * to maintain the checked status of the rows
 *
 * I hope this fix will be rolled in to a future release so that this file will be unneccessary
 *
 * @author Corey Tisdale
 */


class CCheckBoxColumnUI extends CCheckBoxColumn
{

	/**
	 * Initializes the column.
	 * This method registers necessary client script for the checkbox column.
	 * The only thing I changed is that the check all button correctly modifies the selected-ness of the
	 * Parent tr so the js api works correctly.
	 */
	public function init()
	{
		if(isset($this->checkBoxHtmlOptions['name']))
			$name=$this->checkBoxHtmlOptions['name'];
		else
		{
			$name=$this->id;
			if(substr($name,-2)!=='[]')
				$name.='[]';
			$this->checkBoxHtmlOptions['name']=$name;
		}
		$name=strtr($name,array('['=>"\\[",']'=>"\\]"));
		if($this->grid->selectableRows==1)
			$one="\n\tjQuery(\"input:not(#\"+$(this).attr('id')+\")[name='$name']\").attr('checked',false);";
		else
			$one='';
		$js=<<<EOD
		jQuery('#{$this->id}_all').live('click',function() {
		var checked=this.checked;
		jQuery("input[name='$name']").each(function() {
		this.checked=checked;
		if(checked) { //CMT added 2010-07-09
		$(this).closest('tr').addClass('selected ui-state-highlight'); //CMT added 2010-07-09
	} else { //CMT added 2010-07-09
	$(this).closest('tr').removeClass('selected ui-state-highlight'); //CMT added 2010-07-09
	} //CMT added 2010-07-09
	});
	});
	jQuery("input[name='$name']").live('click', function() {
	jQuery('#{$this->id}_all').attr('checked', jQuery("input[name='$name']").length==jQuery("input[name='$name']:checked").length);{$one}
	});
	EOD;
	Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$this->id,$js);
	}
	}
