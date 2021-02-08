<?php

namespace ElasticExportGoogleShopping\Helper;

/**
 * Class BarcodeHelper
 * @package ElasticExportGoogleShopping\Helper
 */
class BarcodeHelper
{
    /**
     * @param string $barcodeValue
     * @return string
     */
    public function barcodeValue(string $barcodeValue):string
    {
        $test=0;
        if($barcodeValue == 'EAN_13') {
            $barcode = 'barcode-1';
        }
        if($barcodeValue == 'EAN_128') {
            $barcode = 'barcode-2';
        }
        if($barcodeValue == 'ISBN') {
            $barcode = 'barcode-4';
        }
        return $barcode;
    }

}