<?php
namespace Omnipay\AdyenApi\Message\Payout;

/**
 * Class ResponseCode
 * provide constant about response field for confirm/decline response
 *
 */
class ResponseCode
{
    //@see https://docs.adyen.com/display/DODL/Confirm+payout+response
    const PAYOUT_CONFIRM_RECEIVED = 'payout-confirm-received';
    //@see https://docs.adyen.com/display/DODL/Decline+payout+response
    const PAYOUT_DECLINE_RECEIVED = 'payout-decline-received';
}
