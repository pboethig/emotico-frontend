<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 16.06.17
 * Time: 14:33
 */

namespace App\Repository\Emotico;

/**
 * Class Queue
 * @package App\Repository\Emotico
 */
class MediaconverterConfig extends Client
{
    /**
     * Returns mediaconverterconfig
     *
     * @return array
     */
    public function all()
    {
        $response = $this->get('/config/get');

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Returns item by key (first index level of all items)
     *
     * @param string $key
     * @return array|mixed
     */
    public function getByKey(string $key)
    {
        $allItems = $this->all();

        if(isset($allItems->$key)) return $allItems->$key;

        throw new \InvalidArgumentException('config item: ' . $key . ' does not exist.');
    }

    /**
     * Returns all formats grouped by converter
     *
     * @return array
     */
    public function getFormatsGroupedByConverter()
    {
        $converters = $this->getByKey('converters');

        $formats = [];

        foreach ($converters as $converterName=>$propertyValues)
        {
            foreach ($propertyValues as $name=>$value)
            {
                if($name=='formats')
                {
                    $formats[$converterName] = $value;
                }
            }
        }

        return $formats;
    }

    /**
     * Returns all formats grouped by converter
     *
     * @return array
     */
    public function getAllSupportedFormatsAsString()
    {
        $allFormatsGroupedByConverter = $this->getFormatsGroupedByConverter();

        $formatString = '';

        foreach ($allFormatsGroupedByConverter as $converterName=>$formats)
        {
            $formatString.="," . str_replace(" ","",$formats);
        }

        $formatString=ltrim(str_replace(",", ",.", $formatString), ",");

        return $formatString;
    }
}