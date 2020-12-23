<?php

namespace ElasticExportGoogleShopping\Catalog\Contracts;

use Plenty\Modules\Catalog\DataProviders\KeyDataProvider;

/**
 * Class AbstractKeyDataProvider
 * @package Rewe\Templates\Contracts
 */
abstract class AbstractKeyDataProvider extends KeyDataProvider
{

    /**
     * @return array
     */
    abstract protected function getProviderValues():array;

    /**
     * @return array
     */
    public function getRows(): array
    {
        $rows = [];

        foreach ($this->getProviderValues() as $value) {
            $rows[] = $this->getRow($value);
        }

        return $rows;
    }

    /**
     * @param string $value
     * @param bool $required
     * @param null $position
     * @return array
     */
    private function getRow(string $value, bool $required = false, $position = null):array
    {
        $row['value'] = $value;

        $row['required'] = $required;

        if (isset($position)) {
            $row['position'] = $position;
        }

        return $row;
    }

    /**
     * Searchs the english and german labels for a specific key.
     *
     * The result has to be an array with structure:
     * ['de' => 'germanLabel, 'en' => 'englishLabel']
     *
     * @param string $key
     * @return array
     */
//    public function getLabelsByKey(string $key): array
//    {
//        $labels = [];
//
//        $en = $this->translator->trans($this->translationPath.$key, [], 'en');
//        if (is_string($en) && strlen($en)) {
//            $labels['en'] = (string)$en;
//        }
//
//        $de = $this->translator->trans($this->translationPath.$key, [], 'de');
//        if (is_string($de) && strlen($de)) {
//            $labels['de'] = (string)$de;
//        }
//
//        return $labels;
//    }
}