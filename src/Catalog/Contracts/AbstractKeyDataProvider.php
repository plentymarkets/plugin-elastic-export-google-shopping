<?php

namespace ElasticExportGoogleShopping\Catalog\Contracts;

use Plenty\Modules\Catalog\DataProviders\KeyDataProvider;
use Plenty\Plugin\Translation\Translator;

/**
 * Class AbstractKeyDataProvider
 * @package ElasticExportGoogleShopping\Catalog\Contracts
 */
abstract class AbstractKeyDataProvider extends KeyDataProvider
{

    /** @var Translator */
    protected $translator;

    /** @var string */
    protected $translationPath = '';

    /**
     * AbstractKeyDataProvider constructor.
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

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

        $row['label'] = $this->translator->trans($this->translationPath.$value);
//        $row['label'] = $value;

        $row['required'] = $required;

        if (isset($position)) {
            $row['position'] = $position;
        }

        return $row;
    }
}