<?php

class AssetsGalleryWidget extends Widget {
	static $db = array(
		"WidgetTitle" => "Varchar(255)",
	);

	static $title = "Assets Gallery";
	static $cmsTitle = "Assets Gallery";
	static $description = "Shows menu for assets gallery";

	function Title() {
		return $this->WidgetTitle ? $this->WidgetTitle : self::$title;
	}

	function getCMSFields() {
		return new FieldSet(
			new TextField("WidgetTitle", "Title")
		);
	}
}

?>