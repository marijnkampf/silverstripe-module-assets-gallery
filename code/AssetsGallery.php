<?php

/**
 * @package FileGallery
 */

class AssetsGallery extends Page {
	
	/**
	 * @var string
	 */
	public static $description = 'Adds a gallery based on files found in (sub)folders of assets.';

	/**
	 * @var array Fields on the user defined form page.
	 */
	public static $db = array(
		"Folder" => "Varchar",
	);
	
	/**
	 * @var array Default values of variables when this page is created
	 */ 
	public static $defaults = array(
	);

	/**
	 * @var Array
	 */
	public static $has_one = array(
	);

	/**
	 * @var Array
	 */
	public static $has_many = array(
	);

	
	/**
	 * Setup the CMS Fields for the User Defined Form
	 * 
	 * @return FieldSet
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->findOrMakeTab('Root.Gallery', _t('FileGallery.GALLERY', 'Gallery'));
		$fields->addFieldToTab("Root.Gallery", new TextField('Folder',_t('FileGallery.FOLDER',"Root folder")));
		
		return $fields;
	}
	
	public function index() {
		Debug::Show("index()");
	}
}

/**
 * Controller for the {@link UserDefinedForm} page type.
 *
 * @package userforms
 */

class AssetsGallery_Controller extends Page_Controller {
    public static $url_handlers = array(
        'show/$a/$b/$c/$d/$e/$f/$g/$h/$i/$j/$k' => 'show',
        '$a/$b/$c/$d/$e/$f/$g/$h/$i/$j/$k' => 'show'
    );
	
	/**
	 * Load all the custom jquery needed to run the custom 
	 * validation 
	 */
	public function init() {
		parent::init();
		$ui = new Colorbox();
		$ui->initialize();
		

		Requirements::css(ASSETS_GALLERY_BASE . '/css/AssetsGallery.css');

				
/*		
		// load the jquery
		Requirements::javascript(FRAMEWORK_DIR .'/thirdparty/jquery/jquery.js');
		Requirements::javascript('userforms/thirdparty/jquery-validate/jquery.validate.min.js');
		Requirements::javascript('userforms/javascript/UserForm_frontend.js');
*/
	}
	
	public function show(SS_HTTPRequest $request) {
		if (is_null($request->param('Action'))) {
			$folderPath = ASSETS_PATH . '/' . $this->Folder;
			if(!file_exists($folderPath)) {
				$this->httpError(404);
			}
			$folder = Folder::get_one("Folder", "\"Name\" = '" . $this->Folder . "'");
		} else {
			$folderPath = ASSETS_PATH;
			foreach($request->latestParams() as $param) {
				if (!is_null($param)) $folderPath .= "/" . $param;
			}
			if(!file_exists($folderPath)) {
				$this->httpError(404);
			}
			$folder = Folder::find_or_make(str_replace(ASSETS_DIR, "", $folderPath));
		}
		
		if (class_exists("BreadcrumbNavigation")) {
			$parentFolders = explode("/", $folderPath);
			
			$parents = array_reverse($folder->parentStack());

			for($i = 0; $i < count($parents); $i++) {
				$parents[$i]->markExpanded();
				$parents[$i]->markOpened();
				if ($i > 0) {
					$do = new DataObject();
					$do->Link = $parents[$i]->AbsoluteLink();
					$do->MenuTitle = $parents[$i]->MenuTitle();
					if ($i == count($parents)-1) $do->isSelf = true;
					$this->owner->AddBreadcrumbAfter($do);
				}
			}
		}
		
		
//		Debug::Show($parentFolders);
		
		return $this->customise(array(
			'Content' => $this->customise(
				array(
					'CurrentFolder' => $folder
				))->renderWith('AssetsGalleryMain', 'Page'),
			'Form' => '',
		));
	}
	
	public function index() {
		$folder = ASSETS_PATH . '/' . $this->Folder;
		if(!file_exists($folder)) {
			$this->httpError(404);
		}
		$folder = Folder::get_one("Folder", "\"Name\" = '" . $this->Folder . "'");
		
//		Debug::Show($folder->myChildren());
		return $this->customise(array(
			'Content' => $this->customise(
				array(
					'CurrentFolder' => $folder
				))->renderWith('AssetsGalleryMain', 'Page'),
			'Form' => '',
		));
	}
	
	public function AssetsGallerySideBarMenu() {
		//Debug::Show("AssetsGallerySideBarMenu " . $this->Folder . " " . Director::absoluteBaseURL () . " " . $this->AbsoluteLink());
		$folder = Folder::get_one("Folder", "\"Name\" = '" . $this->Folder . "'");
		$folder->markUnexpanded();
		
		return $this->customise(array('Root' => $folder))->renderWith('AssetsGallerySideBar');


		$this->renderWith("AssetsGallerySideBarMenu");		
		//$widget = new RSSWidget();
		//$widget->RssUrl = "http://feeds.feedburner.com/silverstripe-blog";
		//return $widget->renderWith("AssetsGallerySideBarMenu");		
	}
}

class AssetsGalleryFolder extends DataExtension {
	static $db = array(
	);

	static $has_one = array(
			'Thumbnail' => 'Image',
	);
	
	public function getThumbnail() {
		if ($this->owner->Thumbnail()->ID != 0) {
			return $this->owner->Thumbnail();
		} else {
			foreach($this->owner->Children() as $child) {
				if (!$child->isFolder) {
					return $child;
				}
			}
		}
		return null;
	}
	
	public function MenuTitle() {
		return str_replace("-", " ", $this->owner->Name);
	}

	public function AbsoluteLink() {
//		Debug::Show("AbsoluteLink " . " " . Director::absoluteBaseURL () . " " . Director::get_current_page()->AbsoluteLink() . " " . $this->Path());
		return Director::get_current_page()->AbsoluteLink() . $this->Path();
	}
	
	public function Path() {
		return "show" . str_replace(array(ASSETS_DIR, "//"), array("", "/"), $this->owner->getRelativePath());
	}

  public function updateCMSFields(FieldList $fields) {
  	$fields->push($uploadField = new TextField("Caption", "Text"));

  	$fields->push($uploadField = new UploadField("Thumbnail", "Thumbnail"));
  	$uploadField->setConfig('canUpload', 'false');
  	$uploadField->setFolderName(str_replace(ASSETS_DIR, "", $this->owner->getRelativePath()));
  	$uploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
  	//$fields = new FileField("Thumbnail", "Thumbnail");
  	return $fields;
  }

	static function isFolder() {
		return true;
	}
	
	public function getFileCount() {
		return $this->owner->Children()->Count() - $this->owner->ChildFolders()->Count();
	}
	
	public function LinkingMode() {
		
	}
}

class AssetsGalleryFile extends DataExtension {
	public function Basename() {
		return basename($this->owner->getFilename(), "." . 	$this->owner->getExtension());
	}	
	
	static function isFolder() {
		return false;
	}
}