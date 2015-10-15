<?php
namespace Omnipay\AdyenApi\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Base Adyen Json Response
 */
abstract class AbstractJsonResponse extends AbstractResponse
{
    /**
     * @param RequestInterface $request
     * @param string           $data    A json encoded string
     */
    public function __construct(RequestInterface $request, $data)
    {
        // Based on http://www.thedarksideofthewebblog.com/les-petits-choses-marrantes-en-php-json_decode/
        // It's better and more secured to use array than \StdClass
        $decodedData = json_decode($data, true);
        parent::__construct($request, $decodedData);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $key
     *
     * @return null|mixed null in case of data value is not defined
     */
    public function getDataValue($key)
    {
        if (!isset($this->data[$key])) {
            return null;
        }

        return $this->data[$key];
    }

    /**
     * @param array $keysPath
     *
     * @return mixed|null null in case of one of data value is not defined
     */
    public function getNestedDataValue(array $keysPath)
    {
        $currentData = $this->data;
        foreach ($keysPath as $key) {
            if (!isset($currentData[$key])) {
                return null;
            }
            $currentData = $currentData[$key];
        }

        return $currentData;
    }
}
