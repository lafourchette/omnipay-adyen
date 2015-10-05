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
        $decodedData = json_decode($data);
        // If $data is an empty json array json_decode will return an array
        // instead of an object :/
        if (!is_object($decodedData)) {
            $decodedData = new \StdClass();
        }
        parent::__construct($request, $decodedData);
    }

    /**
     * @return \StdClass
     */
    public function getData()
    {
        return $this->data;
    }
}
