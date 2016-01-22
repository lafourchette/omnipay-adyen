<?php
namespace Omnipay\AdyenApi;

use Omnipay\AdyenApi\Message\Payment\Authorise\Request as AuthoriseRequest;
use Omnipay\AdyenApi\Message\Payment\CancelOrRefund\Request as CancelOrRefundRequest;
use Omnipay\AdyenApi\Message\Payment\Refund\Request as RefundRequest;

/**
 * Payment Api Gateway
 *
 * Provide payment/recurring api methods such as :
 *  - authorize
 *  - refund
 *  - cancelOrRefund
 */
class PaymentApiGateway extends AbstractApiGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'AdyenPaymentApi';
    }

    /**
     * @param array $parameters
     *
     * @return AuthoriseRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payment\Authorise\Request', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payment\Refund\Request', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return CancelOrRefundRequest
     */
    public function cancelOrRefund(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payment\CancelOrRefund\Request', $parameters);
    }
}
