<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

define('DS', DIRECTORY_SEPARATOR);

jimport('joomla.filesystem.folder');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');
require_once (dirname(__FILE__).DS.'thumbnail.php');
	
$photos = modPhotosHelper::getPhotos($params->get('path'), $params->get('width'), $params->get('height'));

require(JModuleHelper::getLayoutPath('mod_photos'));