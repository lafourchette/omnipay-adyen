<?php
namespace Omnipay\AdyenApi\Message\Payment\CancelOrRefund;

use Omnipay\AdyenApi\Message\Payment\Refund\Request as RefundRequest;

/**
 * Adyen CancelOrRefund Request
 * @see https://pal-test.adyen.com/pal/servlet/Payment/v30/cancelOrRefund
 *
 * Mandatory values :
 *  - merchantAccount
 *  - amountValue
 *  - amountCurrency
 *  - reference
 *  - originalReference
 *
 * Currently it's the same request than refund request
 */
class Request extends RefundRequest
{
    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $httpResponse = $this->getHttpResponse($data);

        return ($this->response = new Response($this, $httpResponse->getBody()));
    }

    /**
     * @return string
     */
    public function getMethodName()
    {
        return 'cancelOrRefund';
    }
}
