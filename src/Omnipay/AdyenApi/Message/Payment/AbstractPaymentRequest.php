<?php
namespace Omnipay\AdyenApi\Message\Payment;

use Omnipay\AdyenApi\Message\AbstractApiRequest;

/**
 * Base Adyen Payment Request
 * Mandatory values :
 *  - merchantAccount
 */
abstract class AbstractPaymentRequest extends AbstractApiRequest
{
    protected $liveEndpoint = 'https://pal-live.adyen.com/pal/servlet/Payment/v12/';
    protected $testEndpoint = 'https://pal-test.adyen.com/pal/servlet/Payment/v12/';

    /**
     * @return string
     */
    public function getMerchantAccount()
    {
        return $this->getParameter('merchantAccount');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setMerchantAccount($value)
    {
        return $this->setParameter('merchantAccount', $value);
    }
}
