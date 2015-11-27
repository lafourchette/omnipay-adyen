<?php
namespace Omnipay\AdyenApi\Message\Payout\Decline;

use Omnipay\AdyenApi\Message\Payout\Confirm\Response as ConfirmResponse;
use Omnipay\AdyenApi\Message\Payout\ResponseCode;
use Omnipay\AdyenApi\Message\Payout\ReviewPayoutResponseInterface;

/**
 * Adyen Payout confirm Response.
 * @see https://docs.adyen.com/display/DODL/Decline+payout+response
 * Provide getter for :
 *  - response
 */
class Response extends ConfirmResponse implements ReviewPayoutResponseInterface
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getResponse() == ResponseCode::PAYOUT_DECLINE_RECEIVED;
    }
}
