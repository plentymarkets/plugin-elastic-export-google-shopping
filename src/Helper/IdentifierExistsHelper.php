<?php

namespace ElasticExportGoogleShopping\Helper;

/**
 * Class IdentifierExistsHelper
 * @package ElasticExportGoogleShopping\Helper
 */
class IdentifierExistsHelper
{
    const IDENTIFIER_YES = 'yes';
    const IDENTIFIER_NO = 'no';

    /**
     * @param array $variation
     * @return string
     */
    public function identifierExists(array $variation):string
    {
        $count = 0;
        if(strlen($variation['mpn']) > 0) {
            $count++;
        }

        if(strlen($variation['gtin']) > 0 || strlen($variation['isbn']) > 0) {
            $count++;
        }

        if(strlen($variation['brand']) > 0) {
            $count++;
        }

        if($count >= 2) {
            $variation['identifier_exists'] = self::IDENTIFIER_YES;
        } else {
            $variation['identifier_exists'] = self::IDENTIFIER_NO;
        }

        return $variation['identifier_exists'];
    }
}