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
     * Function accept N arguments (not only one) like sum or var_dump function
     *
     * @param string $firstKey ,... unlimited number of additional key
     *
     * @return null|mixed null in case of data value is not defined
     */
    public function getDataValue($firstKey)
    {
        $currentData = $this->data;
        foreach (func_get_args() as $key) {
            if (!isset($currentData[$key])) {
                return null;
            }
            $currentData = $currentData[$key];
        }

        return $currentData;
    }
}
