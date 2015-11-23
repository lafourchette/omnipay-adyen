<?php
namespace Omnipay\AdyenApi\Message\Payout;

use Omnipay\AdyenApi\Message\AbstractApiRequest;

/**
 * Base Adyen Payout Request
 * Mandatory values :
 *  - merchantAccount
 */
abstract class AbstractPayoutRequest extends AbstractApiRequest
{
    protected $liveEndpoint = 'https://pal-live.adyen.com/pal/servlet/Payout/v12/';
    protected $testEndpoint = 'https://pal-test.adyen.com/pal/servlet/Payout/v12/';

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
