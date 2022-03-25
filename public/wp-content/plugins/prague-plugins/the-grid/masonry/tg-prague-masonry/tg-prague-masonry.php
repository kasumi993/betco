<?php
/**
* @package   The_Grid
* @author    Themeone <themeone.master@gmail.com>
* @copyright 2015 Themeone
*
* Skin Name: Prague Masonry
* Skin Slug: tg-prague-masonry
* Date: 11/28/18 - 02:24:27PM
*
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

// Init The Grid Elements instance
$tg_el = The_Grid_Elements();

// Prepare main data for futur conditions
$image  = $tg_el->get_attachment_url();
$format = $tg_el->get_item_format();

$output = null;

$media = $tg_el->get_media();

// if there is a media
if ($media) {

	// Media wrapper start
	$output .= $tg_el->get_media_wrapper_start();

	// Media content (image, gallery, audio, video)
	$output .= $media;

	// if there is an image
	if ($image || in_array($format, array('gallery', 'video'))) {

		// Media content holder start
		$output .= $tg_el->get_media_content_start();




		// Media content holder end
		$output .= $tg_el->get_media_content_end();

	}

	$output .= $tg_el->get_media_wrapper_end();
	// Media wrapper end

}


return $output;