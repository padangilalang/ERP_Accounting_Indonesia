<li class="span1">
    <a href="<?php echo $data['url'] ?>" class="thumbnail" rel="tooltip" data-title="Tooltip">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/big_icons/<?php echo $data['icon']; ?>" alt="">
    </a>
<?php	
//echo CHtml::link(CHtml::image(http://placehold.it/50x50, "No Photo", array("class"=>"span1")),
//						Yii::app()->createUrl("/m1/gRecruitment/view",array("id"=>$data->id)))	

?>	
</li>