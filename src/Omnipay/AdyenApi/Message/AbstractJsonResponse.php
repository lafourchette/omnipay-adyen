<?php
namespace Omnipay\AdyenApi\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Base Adyen Request
 *
 * Mandatory values :
 *  - apiUser
 *  - apiPassword
 */
abstract class AbstractJsonResponse extends AbstractResponse
{
    /**
     * @param RequestInterface $request
     * @param string           $data    A json encoded string
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, json_decode($data));
    }

    /**
     * @return \StdClass
     */
    public function getData()
    {
        return $this->data;
    }
}
