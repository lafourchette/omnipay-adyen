<?php
namespace Omnipay\AdyenApi\Message\Payout\Submit;

use Omnipay\AdyenApi\Message\Payout\AbstractPayoutResponse;
use Omnipay\AdyenApi\Message\ResultCode;

/**
 * Adyen Payout submit Response.
 * @see https://docs.adyen.com/display/DODL/Submit+payout+response
 * Provide getter for :
 *  - resultCode
 *  - refusalReason
 */
class Response extends AbstractPayoutResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getResultCode() == ResultCode::PAYOUT_SUBMIT_RECEIVED;
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
     * Available if call is successful and payment not accepted
     * The mapped refusal reason
     * @see https://docs.adyen.com/display/TD/Authorisation+refusal+reasons
     *
     * @return string
     */
    public function getRefusalReason()
    {
        return $this->getDataValue('refusalReason');
    }
}
