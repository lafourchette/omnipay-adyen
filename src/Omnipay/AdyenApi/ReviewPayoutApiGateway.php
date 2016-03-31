<?php
namespace Omnipay\AdyenApi;

use Omnipay\AdyenApi\Message\Payout\Confirm\Request as ConfirmPayoutRequest;
use Omnipay\AdyenApi\Message\Payout\Decline\Request as DeclinePayoutRequest;

/**
 * Review Payout Api Gateway
 *
 * Provide review payout api methods such as :
 *  - confirm
 *  - decline
 */
class ReviewPayoutApiGateway extends AbstractApiGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'AdyenReviewPayoutApi';
    }

    /**
     * @param array $parameters
     *
     * @return ConfirmPayoutRequest
     */
    public function confirm(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payout\Confirm\Request', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return DeclinePayoutRequest
     */
    public function decline(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payout\Decline\Request', $parameters);
    }
}
