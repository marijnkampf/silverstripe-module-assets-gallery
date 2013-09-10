<?php 

class Lightbox extends ImageGalleryUI
{
	static $link_to_demo = "http://leandrovieira.com/projects/jquery/lightbox/";
	static $label = "LightBox";
	public $item_template = "Lightbox_item";
	
	public function initialize()
	{
//		Requirements::javascript(THIRDPARTY_DIR.'/jquery/jquery.js'); 
		Requirements::javascript(ASSETS_GALLERY_BASE.'/gallery_ui/lightbox/javascript/jquery.lightbox-0.5.js');
		Requirements::javascript(ASSETS_GALLERY_BASE.'/gallery_ui/lightbox/javascript/lightbox_init.js');
		Requirements::css(ASSETS_GALLERY_BASE.'/gallery_ui/lightbox/css/jquery.lightbox-0.5.css');
		
	}
	
}