<div class="art-header">
	<div class="art-header-clip">
<?php
        $this->widget('ext.slider.slider', array(
            'container'=>'slideshow',
            'width'=>'100%', 
            'height'=>'100%', 
            'timeout'=>6000,
            'infos'=>true,
            'constrainImage'=>true,
            'images'=>array('01.jpg','02.jpg','03.jpg'),
			'alts'=>array(Yii::app()->name),
            //'defaultUrl'=>Yii::app()->request->hostInfo
            )
        );
        ?>	
		
</div>
</div>
		
	
<div class="cleared reset-box"></div>
