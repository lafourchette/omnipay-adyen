<?php
namespace Omnipay\AdyenApi\Message\Payout;

use Omnipay\AdyenApi\Message\Payout\AbstractPayoutResponse;
use Omnipay\AdyenApi\Message\Payout\ResponseCode;

/**
 * Interface ReviewPayoutResponseInterface
 */
interface ReviewPayoutResponseInterface
{
    /**
     * Available if call failed
     * The Adyen code that is mapped to the error message.
     * @see https://docs.adyen.com/display/TD/Error+response+fields
     * @see https://docs.adyen.com/pages/viewpage.action?pageId=5376980
     * @return string
     */
    public function getErrorCode();

    /**
     * Available in all cases (success or error)
     *
     * @return string
     */
    public function getResponse();
}
