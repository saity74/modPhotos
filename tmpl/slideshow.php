<?php // no direct access
defined('_JEXEC') or die('Restricted access');
	
$big_img = str_replace(JPATH_SITE, '', $photos[0]).'?'.rand(0,100000);

$sort = $params->get('sort', 0);

switch ($sort){
	case 1 : $photos = array_reverse($photos);
}
		
$main_photo_index = $params->get('main_photo', 1) - 1;
if ($params->get('gallery_type', 0) == 1 && isset($photos[$main_photo_index]))
{
	$main_photo = basename($photos[$main_photo_index]);
	$main_photo_img = str_replace('-mid.jpg', '-min.jpg', $main_photo);
	unset($photos[$main_photo_index]);
}
?>

<div class="photos">
	<div class="photos-nav">
            <a href="#" class="slider-prev"></a>
            <div class="list-previews-wrap">
                <ul class="list-previews unstyled">
                        <? foreach ($photos as $key => $photo) : ?>
                                <?php 
                                        $image_name = basename($photo);
                                        $min_img = str_replace('-mid.jpg', '-min.jpg', $image_name);
                                        
                                ?>
                                        <li><a rel="lightbox-gallery" title="<?php echo $params->get('title_'.($key+1)) ?>" href="/images/<?=$params->get('path')?>/<?=$image_name?>" class="thumb"><img src="/images/<?=$params->get('path')?>/min/<?=$min_img?>" /></a></li>
                        <? endforeach; ?>
                </ul>
            </div>
            <a href="#" class="slider-next"></a>
        </div>
</div>