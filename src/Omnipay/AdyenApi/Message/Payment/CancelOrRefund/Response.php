<?php
namespace Omnipay\AdyenApi\Message\Payment\CancelOrRefund;

use Omnipay\AdyenApi\Message\Payment\Refund\Response as RefundResponse;

/**
 * Adyen CancelOrRefund Response.
 * @see https://www.adyen.com/apidocs/?example=Cancel%20Or%20Refund%201
 *
 * Currently it's the same response than refund response (except for response content)
 */
class Response extends RefundResponse
{
    const RESPONSE_RECEIVED = '[captureOrRefund-received]';

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getResponse() == self::RESPONSE_RECEIVED;
    }
}
