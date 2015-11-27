<?php
namespace Omnipay\AdyenApi\Message\Payout\Confirm;

use Omnipay\AdyenApi\Message\Payout\AbstractPayoutResponse;
use Omnipay\AdyenApi\Message\Payout\ResponseCode;
use Omnipay\AdyenApi\Message\Payout\ReviewPayoutResponseInterface;

/**
 * Adyen Payout confirm Response.
 * @see https://docs.adyen.com/display/DODL/Confirm+payout+response
 * Provide getter for :
 *  - response
 */
class Response extends AbstractPayoutResponse implements ReviewPayoutResponseInterface
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getResponse() == ResponseCode::PAYOUT_CONFIRM_RECEIVED;
    }

    /**
     * Available in all cases (success or error)
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->getDataValue('response');
    }
}
