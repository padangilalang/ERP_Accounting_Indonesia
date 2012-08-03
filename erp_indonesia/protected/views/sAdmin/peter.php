<?php /*
$connected = @fsockopen("www.google.com", 80);
if ($connected){
$this->widget('application.extensions.livechat.LivechatWidget',
		array(
				'account_hash' =>'z01q6amlq6jva7ocv89e4t4k6n0a8ef5kilniseokuahka7bn6cdhltgjurgainv9jodn005lplctrvg8vgo7vtef6n79u04uu9gf15vbpvo0rkjuqrosbcp4n7g59d905u0u3e3l111uhmkt65kjomcq0ivmcbtjb4b61jm4',    //your account hash
				'display_type' =>'default', //statusicon/hyperlink/url/custom/default
				'link_title' =>'Title of your Link', //link title
				'link_text' =>'Text of your Link', //link text
				'always_show_badge' =>'1', //we always show the badge even if away/offline
				'badge_on_away' =>'1', //we show badge on online and away only (not offline)
		));
} */
?>

<?php /*
$this->widget('ext.WGoogleStaticMap',array(
		'center'=>'-6.175713', // Or you can use text eg. Dundee, Scotland
		'alt'=>"Map for location of something", // Alt text for image (optional)
		'zoom'=>14, // Google map zoom level
		'width'=>250, // image width
		'height'=>250, // image Height
		'markers'=>array(
				array(
						'style'=>array('color'=>'blue','label'=>'X'),
						'locations'=>array('-6.175713,106.790049'),
				),
		),
		// 'linkUrl'=>array('location/view'), // Where the image should link (optional)
		'linkOptions'=>array('target'=>'_blank'), // HTML options for link tag (optional)
		'imageOptions'=>array('class'=>'map-image'), // HTML options for img tag (optional)
)); */
?>


<?php /*
Yii::import('ext.kml.*');

// add one Icon style to the generator
$iconStyle = new EGMapKMLIconStyle('testStyle', 'iconID', 'http://maps.google.com/mapfiles/ms/icons/purple-pushpin.png');

$kml->addTag($iconStyle);

// create one marker placemark
$placemark = new EGMapKMLPlacemark('Another Marker');
// tell which style we are going to use
$placemark->styleUrl = '#testStyle';
// the following will be displayed on its bubble info window
$placemark->description = 'This marker has <b>HTML</b>';
// add a tag child EGMapKMLPoint which will tell the
// latitude and longitude of the marker
// *Note that for KML the lat and lon are the other way around
// should be lon - lat
$placemark->addChild(new EGMapKMLPoint('39.718762871171776', '2.903637075424208'));

$kml->addTag($placemark);

// generate feed
$kml->generateFeed(); */
?>

<?php  /*
Yii::import('ext.jquery-gmap.*');
$gmap = new EGmap3Widget();

$options = new EGmap3MapOptions();
$options->scaleControl = true;
$options->streetViewControl = false;
$options->zoom = 1;
$options->center = array(0,0);
$options->mapTypeId = EGmap3MapTypeId::HYBRID;

$typeOptions = new EGmap3MapTypeControlOptions();
$typeOptions->style = EGmap3MapTypeControlStyle::DROPDOWN_MENU;
$typeOptions->position = EGmap3ControlPosition::TOP_CENTER;
$options->mapTypeControlOptions = $typeOptions;

$zoomOptions = new EGmap3ZoomControlOptions();
$zoomOptions->style = EGmap3ZoomControlStyle::SMALL;
$zoomOptions->position = EGmap3ControlPosition::BOTTOM_CENTER;
$options->zoomControlOptions = $zoomOptions;

$gmap->setOptions($options);  */
?>

<?php /*
// init the model (usually passed to view)
Yii::import('ext.jquery-gmap.*');

$address = new Address();

// init the map
$gmap = new EGmap3Widget();
$gmap->setOptions(array('zoom' => 14));

// create the marker
$marker = new EGmap3Marker(array(
		'title' => 'Draggable address marker',
		'draggable' => true,
));
$marker->address = '10 Downing St, Westminster, London SW1A 2, UK';
$marker->centerOnMap();

// set the marker to relay its position information a model
$marker->capturePosition(
		// the model object
		$address,
		// model's latitude property name
		'latitude',
		// model's longitude property name
		'longitude',
		// Options set :
		//   show the fields, defaults to hidden fields
		//   update the fields during the marker drag event
		array('visible','drag')
);
$gmap->add($marker);

// Capture the map's zoom level, by default generates a hidden field
// for passing the value through POST
$gmap->map->captureZoom(
		// model object
		$address,
		// model attribute
		'mapZoomLevel',
		// whether to auto generate the field
		true,
		// HTML options to pass to the field
		array('class' => 'myCustomClass'));

$gmap->renderMap(); */
?>

<?php
/*$this->widget('ext.cfilebrowser.CFileBrowserWidget',array(
		'script'=>array('menu/filebrowser'),
		'root'=>'c:/',
		'folderEvent'=>'click',
		'expandSpeed'=>1000,
		'collapseSpeed'=>1000,
		'expandEasing'=>'easeOutBounce',
		'collapseEasing'=>'easeOutBounce',
		'multiFolder'=>true,
		'loadMessage'=>'File Browser Is Loading...hang on a sec',
		'callbackFunction'=>'alert("I selected " + f)',
		//'customData'=>array(Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken),
));
*/ ?>
