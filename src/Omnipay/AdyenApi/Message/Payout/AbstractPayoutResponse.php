<?php
namespace Omnipay\AdyenApi\Message\Payout;

use Omnipay\AdyenApi\Message\AbstractJsonResponse;

/**
 * Base Adyen Payout Response
 * Provide getter for :
 *  - pspReference
 */
abstract class AbstractPayoutResponse extends AbstractJsonResponse
{
    /**
     * Available if call is successful
     * The unique reference that is associated with the payment
     *
     * @return string
     */
    public function getTransactionReference()
    {
        return $this->getDataValue('pspReference');
    }
}
