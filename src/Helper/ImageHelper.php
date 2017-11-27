<?php

namespace ElasticExportGoogleShopping\Helper;


class ImageHelper
{
	const MAIN_IMAGE		=	'mainImage';
	const ADDITIONAL_IMAGES	=	'additionalImages';

	/**
	 * Gets an array of images.
	 *
	 * @param array $imageList
	 * @return array
	 */
	public function getImages($imageList)
	{
		$images = [
			'mainImage'			=> '',
			'additionalImages'	=> ''
		];
		
		if(count($imageList) > 0 && array_key_exists(0, $imageList))
		{
			$images[self::MAIN_IMAGE] = array_shift($imageList);
			
			if(count($imageList))
			{
				$images[self::ADDITIONAL_IMAGES] = implode(',', $imageList);
			}
		}
		
		return $images;
	}
}