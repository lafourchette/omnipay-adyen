<?php
namespace Omnipay\AdyenApi\Message\Payout;

/**
 * Class ResponseCode
 * provide constant about response field for confirm/decline response
 *
 */
class ResponseCode
{
    //@see https://docs.adyen.com/developers/features/third-party-payouts/confirm-or-decline-payout
    const PAYOUT_CONFIRM_RECEIVED = '[payout-confirm-received]';
    const PAYOUT_DECLINE_RECEIVED = '[payout-decline-received]';
}
