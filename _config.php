<?php

define('ASSETS_GALLERY_BASE', basename(dirname(__FILE__)));

Object::add_extension('Folder', 'AssetsGalleryFolder');
Object::add_extension('File', 'AssetsGalleryFile');
