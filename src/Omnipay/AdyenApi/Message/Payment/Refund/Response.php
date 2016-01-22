<?php
namespace Omnipay\AdyenApi\Message\Payment\Refund;

use Omnipay\AdyenApi\Message\Payment\AbstractPaymentResponse;
use Omnipay\AdyenApi\Message\ResponseCode;

/**
 * Adyen Refund Response.
 * @see https://www.adyen.com/apidocs/?example=Refund%201
 */
class Response extends AbstractPaymentResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getResponse() == ResponseCode::REFUND_RECEIVED;
    }

    /**
     * Available if call is successful
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->getDataValue('response');
    }
}
