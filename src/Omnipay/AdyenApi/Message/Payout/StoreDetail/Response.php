<?php
namespace Omnipay\AdyenApi\Message\Payout\StoreDetail;

use Omnipay\AdyenApi\Message\Payout\AbstractPayoutResponse;
use Omnipay\AdyenApi\Message\ResultCode;

/**
 * Adyen Payout store detail Response.
 * @see https://docs.adyen.com/display/DODL/Store+detail+response
 * Provide getter for :
 *  - resultCode
 *  - recurringDetailReference
 */
class Response extends AbstractPayoutResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getResultCode() == ResultCode::SUCCESS;
    }

    /**
     * Available if call is successful
     *
     * @return string
     */
    public function getResultCode()
    {
        return $this->getDataValue('resultCode');
    }

    /**
     * Available if call is successful
     * The unique reference that is associated with the recurring contract
     *
     * @return string
     */
    public function getRecurringDetailReference()
    {
        return $this->getDataValue('recurringDetailReference');
    }
}
