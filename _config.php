<?php

// Ensure compatibility with PHP 7.2 ("object" is a reserved word),
// with SilverStripe 3.6 (using Object) and SilverStripe 3.7 (using SS_Object)
if (!class_exists('SS_Object')) class_alias('Object', 'SS_Object');

define('ASSETS_GALLERY_BASE', basename(dirname(__FILE__)));

SS_Object::add_extension('Folder', 'AssetsGalleryFolder');
SS_Object::add_extension('File', 'AssetsGalleryFile');
