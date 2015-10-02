<?php
namespace Omnipay\AdyenApi\Message\Payment\Refund;

use Omnipay\AdyenApi\Message\Payment\AbstractPaymentResponse;

/**
 * Adyen Refund Response.
 * @see https://www.adyen.com/apidocs/?example=Refund%201
 */
class Response extends AbstractPaymentResponse
{
    const RESPONSE_RECEIVED = '[refund-received]';

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getResponse() == self::RESPONSE_RECEIVED;
    }

    /**
     * Available if call is successful
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->getData()->response;
    }
}
