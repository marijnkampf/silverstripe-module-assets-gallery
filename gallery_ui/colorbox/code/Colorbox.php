<?php 

class Colorbox extends ImageGalleryUI
{
	static $link_to_demo = "http://www.jacklmoore.com/colorbox";
	static $label = "Colorbox";
	public $item_template = "Colorbox_item";
	
	public function initialize()
	{
//		Requirements::javascript(THIRDPARTY_DIR.'/jquery/jquery.js'); 
		Requirements::javascript(ASSETS_GALLERY_BASE.'/gallery_ui/colorbox/javascript/jquery.colorbox-min.js');
		Requirements::javascript(ASSETS_GALLERY_BASE.'/gallery_ui/colorbox/javascript/colorbox_init.js');
		Requirements::css(ASSETS_GALLERY_BASE.'/gallery_ui/colorbox/css/colorbox.css');
		
	}
	
}