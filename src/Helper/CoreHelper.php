<?php
namespace ElasticExportGoogleShopping\Helper;

class CoreHelper
{
	/**
	 * @param mixed $variable
	 * @return int
	 */
	public static function count($variable)
	{
		if(is_array($variable) || (is_object($variable) && $variable instanceof \Countable)){
			return count($variable);
		}

		return 0;
	}
}