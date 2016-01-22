<?php
namespace Omnipay\AdyenApi\Message\Payment\CancelOrRefund;

use Omnipay\AdyenApi\Message\Payment\Refund\Response as RefundResponse;
use Omnipay\AdyenApi\Message\ResponseCode;

/**
 * Adyen CancelOrRefund Response.
 * @see https://www.adyen.com/apidocs/?example=Cancel%20Or%20Refund%201
 *
 * Currently it's the same response than refund response (except for response content)
 */
class Response extends RefundResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getResponse() == ResponseCode::CANCEL_OR_REFUND_RECEIVED;
    }
}
