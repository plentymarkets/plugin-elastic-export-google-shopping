<?php

namespace ElasticExportGoogleShopping\Helper;

class UnitHelper
{
    /**
     * Returns the unit, if there is any unit configured, which is allowed for GoogleShopping.
     *
     * @param  int $unitId
     * @return string
     */
    public function getUnit($unitId):string
    {
        switch((int)$unitId)
        {
            case '1':
                return 'ct'; //Stück
            case '32':
                return 'ml'; // Milliliter
            case '5':
                return 'l'; // Liter
            case '4':
                return 'mg'; //Milligramm
            case '3':
                return 'g'; // Gramm
            case '2':
                return 'kg'; // Kilogramm
            case '51':
                return 'cm'; // Zentimeter
            case '31':
                return 'm'; // Meter
            case '38':
                return 'sqm'; // Quadratmeter
            default:
                return '';
        }
    }

    /**
     * Calculate and get unit price.
     *
     * @param array $variation
     * @return string
     */
    public function getUnitPricingBaseMeasure($variation):string
    {
        $basePriceUnit = $this->getUnit($variation['data']['unit']['id']);

        if(in_array($variation['data']['unit']['id'], array('3','32')))
        {
            if((float)$variation['data']['unit']['content'] <= 250)
            {
                $basePriceContent = 100;
            }
            else
            {
                $basePriceContent = 1;
                $basePriceUnit = $basePriceUnit == 'g' ? 'kg' : 'l';
            }
        }
        else
        {
            $basePriceContent = 1;
        }

        return (string)$basePriceContent.' '.(string)$basePriceUnit;
    }
}