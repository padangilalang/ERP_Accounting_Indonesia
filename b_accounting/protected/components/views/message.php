<div class="art-block">
	<div class="art-block-body">
		<div class="art-blockheader">
			<div class="l"></div>
			<div class="r"></div>
			<h3 class="t">Message</h3>
		</div>
		<div class="art-blockcontent">
			<div class="art-blockcontent-tl"></div>
			<div class="art-blockcontent-tr"></div>
			<div class="art-blockcontent-bl"></div>
			<div class="art-blockcontent-br"></div>
			<div class="art-blockcontent-tc"></div>
			<div class="art-blockcontent-bc"></div>
			<div class="art-blockcontent-cl"></div>
			<div class="art-blockcontent-cr"></div>
			<div class="art-blockcontent-cc"></div>
			<div class="art-blockcontent-body">
				<div>
					<!--  <p>Lorem ipsum dolor sit amet. Nam sit amet sem. Mauris a ante.</p> -->
					<div class="wide form">

						<?php 

						$form=$this->beginWidget('CActiveForm', array(
								'id'=>'snotification-form',
								'enableAjaxValidation'=>false,
						)); ?>

						<div class="row">
							<?php echo $form->labelEx($model,'receiver_id'); ?>
							<?php echo $form->dropDownList($model, 'receiver_id', sUser::model()->allUsers()); ?>
						</div>

						<div class="row">
							<?php echo $form->labelEx($model,'long_desc'); ?>
							<?php //echo $form->textField($model,'long_desc',array('size'=>80,'maxlength'=>250)); ?>
							<?php echo CHtml::activeTextArea($model,'long_desc',array('rows'=>2, 'cols'=>65)); ?>
						</div>

						<div class="row buttons">
							<?php
							$this->widget('zii.widgets.jui.CJuiButton', array(
									'buttonType'=>'submit',
									'name'=>'btnGo3',
									'caption'=>$model->isNewRecord ? 'Share':'Save',
									'options'=>array('icons'=>'js:{secondary:"ui-icon-extlink"}'),
							));
							?>
						</div>

						<?php $this->endWidget(); ?>

					</div>
					<!-- form -->


					<?php $this->widget('zii.widgets.CListView', array(
							'dataProvider'=>$dataProvider,
							'itemView'=>'_view',
					)); ?>


				</div>
				<div class="cleared"></div>
			</div>
		</div>
		<div class="cleared"></div>
	</div>
</div>



