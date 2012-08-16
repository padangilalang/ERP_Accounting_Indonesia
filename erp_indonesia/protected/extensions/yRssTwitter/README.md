yRssTwitter
===========

Twitter timeline widget for Yii (1.1.6+) from RSS feed

Developed by Why Not Soluciones, S.L. [1] 
Copyright 2012 Why Not Soluciones, S.L.


Index
=====

1. FEATURES
2. REQUIREMENTS
3. INSTALLATION
4. CONFIGURATION
5. USAGE
6. MINSCRIPT INTEGRATION
7. TWITTER LOGOS
8. REFERENCES


Content
=====

1. FEATURES

    - Twitter timeline from RSS feed (this improves loading time). 
    - Integrates with minscript [2] in order to minify the CSS scripts.
    - Lightweight internationalization setup
    - Easy color config to fit your Yii application

2. REQUIREMENTS

    - Tested with Yii 1.1.6. Should work with Yii 1.1.2+
    - Tested with PHP 5.3+. Should work with PHP 5+

3. INSTALLATION

    - Place the yRssTwitter directory under protected/components/widgets

4. CONFIGURATION
   
     You can set up yRssTwitter widget with a configuration array. 
    The allowed config variables are the following:

    - display
        Type: boolean
        Default value: true
        For development purposes. It defines whether or not run the widget

    - displayName
        Type: string
        Default value: Why Not Soluciones
        Name of your choice: eg. company name

    - twitterUser
        Type: string
        Default value: ynotsoluciones
        The twitter user from which the feed will be grabbed (do not preceed whith @)

    - twitterActions
        Type: array
        Default value: array('reply'=>'responder', 'favorite'=>'favorito')
        For internationalization purposes. Defines the text used for 'reply' and 
        'favorite'

    - tweetsToDisplay
        Type: integer
        Default value: 5
        Number of Tweets that the widget will show

    - locales
        Type: integer
        Default value: array("es_ES.UTF-8", "es_ES@euro", "es_ES", "esp")
        For internationalization purposes. Defines the locales used with LC_TIME in 
        order to set the timestamp to your timezone.

    - timeNames
        Type: array
        Default value: array('segundo', 'minuto', 'hora', 'día', 'semana', 'mes', 'año', 'decada')
        For internationalization purposes. In this order: second, minute, hour, day, 
        week, month and decade. This is used to show the time from the Tweet's post.

    - minscript
        Type: boolean
        Default value: true
        Defines if you are using minscript extension[1] or not. If true, the assets 
        will always be published in the same directory (crc sum of the asset name).
        If minscript is set to false it will work with the assets common behavior.

    - twitterLogo
        Type: string
        Default value: dark
        Allowed values: dark, light
        Defines wich color scheme to use: dark (use with dark backgrounds) and light
        (use with light backgrounds).

    - color
        Type: string
        Allowed values: css compliant colors
        Default value: #361d27
        Color used for the header (background color of the twitter logo and border) 
        and the footer.

    - linkColor
        Type: string
        Allowed values: css compliant colors
        Default value: #361d27
        Color used for the links of the widget 

    - linkHoverColor
        Type: string
        Allowed values: css compliant colors
        Default value: #FF6319
        Color used for the hover selector for the links of the widget 

5. USAGE

    $config = array(
        'display' => true, 
        'displayName' => 'Why Not Soluciones',
        'twitterUser' => 'ynotsoluciones',
        'twitterActions' => array('reply'=>'reply', 'favorite'=>'favorite'),
        'tweetsToDisplay' => 2,
        'locales' => array("en_EN.UTF-8", "en_EN"),
        'timeNames' => array('second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'decade'),
        'minscript' => true,
        'twitterLogo' => 'dark',
        'color' => 'black',
        'linkColor' => 'green',
        'linkHoverColor' => 'red',
    ); 

    $this->widget('application.components.widgets.yRssTwitter.YRssTwitter', $config);

6. MINSCRIPT INTEGRATION

    If you don't change names of files, just add the following line to the minscript 
    config:

    'minScript'=>array(
        'class'=>'application.extensions.minScript.components.ExtMinScript',
        'groupMap'=>array(
            'cssgroup'=>array(
                'assets/52ccd3ac/yRssTwitter.css'
            ),
        ),
    )

    If you decide to change the name of the css, to find out the name of the asset
    directory, try the following:

    $dir = sprintf('%x',crc32(NAME_OF_FILE.Yii::getVersion())
    $result = 'asset/' . $dir . '/NAME_OF_FILE'

7. TWITTER LOGOS

    All the logos used in this widget are property of Twitter and comply with the 
    "Using the Twitter brand and trademarks" from Twitter web page [3]

    At the time of this writing, these are the guidelines followed:

        Do:
        Use our official, unmodified Twitter bird to represent our brand.
        Make sure the bird faces right.
        Allow for at least 150% buffer space around the bird.

        Don't:
        Use speech bubbles or words around the bird.
        Rotate or change the direction of the bird.
        Anima al pájaro.
        Duplica al pájaro.
        Cambiar el color del pájaro.
        Use any other marks or logos to represent our brand.

    If you feel that we are not following the current guidelines, please, let us 
    know and we'll fix it as soon as possible.

6. REFERENCES

    [1] http://www.whynotsoluciones.com
    [2] http://www.yiiframework.com/extension/minscript/
    [3] http://twitter.com/logo
