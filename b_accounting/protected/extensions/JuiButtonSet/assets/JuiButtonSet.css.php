<?php header('Content-type: text/css'); //$_GET = unserialize(base64_decode($_GET['data'])); ?>
/** * jQuery UI Styles for JuiButtonSet **/ .fg-button { cursor:pointer;
margin:0 1px 0 0; outline-color:-moz-use-text-color; outline-style:none;
outline-width:0; padding:0.3em 1em 0.4em 1em; position:relative;
text-align:center; text-decoration:none !important; border:1px solid
transparent; } .fg-button .ui-icon { left:50%; margin-left:-8px;
margin-top:-8px; position:absolute; top:50%; } a.fg-button { float:left;
} button.fg-button { overflow:visible; width:auto; }
.fg-button-icon-left { padding-left:1.8em; } .fg-button-icon-right {
padding-right:2.1em; } .fg-button-icon-left .ui-icon { left:0.2em;
margin-left:0; right:auto; } .fg-button-icon-right .ui-icon { left:auto;
margin-left:0; right:0.2em; } .fg-button-icon-solo { display:block;
text-indent:-9999px; width:8px; } .fg-buttonset { /*float:left;*/ }
.fg-buttonset .fg-button { float:left; } .fg-buttonset-single
.fg-button, .fg-buttonset-multi .fg-button { margin-right: 0px; }
.fg-toolbar { margin-bottom: 5px ; padding:1px; } .fg-toolbar
.fg-buttonset { margin-right:1em; padding-left:0px; } .fg-toolbar
.fg-button { font-size:1em; } .fg-toolbar ul, .fg-toolbar ol{
list-style-type:none; margin:0 3px 3px 0; padding: 0; }
