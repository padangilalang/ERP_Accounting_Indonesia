ESpaceHolder
============

It is a Yii Framework (http://yiiframework.com) extension, so you'll need a running **Yii** install to use it. (you'll also need internet access!)

It (hopefully) makes it easier to use http://placehold.it/


Installation
------------

*Step 1)* extract the content under _protected/extensions_

*Step 2)* call it in a view like:

```
// a default (but useless) 50x50 box
$this->widget( 'ext.espaceholder.ESpaceHolder' );

// something more useful
$this->widget( 
  'ext.espaceholder.ESpaceHolder', 
  array( 
    'size' => '250', // you can also do 300x250
	'text' => 'Yii ROCKS!', 
	'htmlOptions' => array( 'title' => 'test image' ) 
  ) 
); 
```
