<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class modPhotosHelper
{
	static $_path;
	static $width;
	static $height;
	
	private function _setPath($folder)
	{
		self::$_path = JPATH_SITE.DS.'images'.DS.$folder;
	}
	
	public function getPhotos($path, $width, $height)
	{
		if ($path)
			self::_setPath($path);
		
		self::$width = $width;
		self::$height = $height;
			
		$path = self::$_path;
		$result = JFolder::files($path, '.jpg', false, true);
		
		if (!empty($result))
		{
			foreach ($result as $img)
			{
				if (strpos($img, '-mid.') === false)
				{
					if (!file_exists(str_replace('.jpg', '-min.jpg', self::$_path.DS.'min'.DS.basename($img))))
					{
						self::createThumb($img);
					}
					
					$mid_images[] = str_replace('.jpg', '-mid.jpg', $img);
				}
			}
		}
		
		
		return $mid_images;
	}
	
	public function createThumb($image)
	{
		
		if (!file_exists(self::$_path.DS.'min'))
		{
			mkdir(self::$_path.DS.'min', 0777);	
		}
		
		$midOptions = array(
				'width' => 800,
				'height' => 600,
				'method' => THUMBNAIL_METHOD_HEIGHT_PRIORITY,
			);
			
		
		$minOptions = array(
				'width' => self::$width,
				'height' => self::$height,
				'method' => THUMBNAIL_METHOD_SCALE_MIN,
			);
			
		$midImage = Thumbnail::render($image, $midOptions);
		@imageJpeg($midImage, str_replace('.jpg', '-mid.jpg', $image), 100);
		@imagedestroy($midImage);
		
		
		$minImage = Thumbnail::render($image, $minOptions);
		@imageJpeg($minImage, str_replace('.jpg', '-min.jpg', self::$_path.DS.'min'.DS.basename($image)), 80);
		@imagedestroy($minImage);
	}
}
