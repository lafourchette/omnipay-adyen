<?php
namespace Omnipay\AdyenApi;

use Omnipay\AdyenApi\Message\Payout\StoreDetail\Request as StorePayoutDetailRequest;
use Omnipay\AdyenApi\Message\Payout\Submit\Request as SubmitPayoutRequest;

/**
 * Store Payout Api Gateway
 *
 * Provide store payout api methods such as :
 *  - storeDetails
 *  - submit
 */
class StorePayoutApiGateway extends AbstractApiGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'AdyenStorePayoutApi';
    }

    /**
     * @param array $parameters
     *
     * @return StorePayoutDetailRequest
     */
    public function storeDetails(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payout\StoreDetail\Request', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return SubmitPayoutRequest
     */
    public function submit(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payout\Submit\Request', $parameters);
    }
}
