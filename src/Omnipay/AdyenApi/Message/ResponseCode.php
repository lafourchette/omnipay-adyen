<?php
namespace Omnipay\AdyenApi\Message;

/**
 * Class ResponseCode
 * provide constant about response field
 *
 */
class ResponseCode
{
    /** PAYMENT */
    //@see https://docs.adyen.com/display/TD/Capture+modification+response
    const CAPTURE_RECEIVED = '[capture-received]';
    //@see https://docs.adyen.com/display/TD/Cancel+modification+response
    const CANCEL_RECEIVED = '[cancel-received]';
    //@see https://docs.adyen.com/display/TD/Refund+modification+response
    const REFUND_RECEIVED = '[refund-received]';
    //@see https://docs.adyen.com/display/TD/Cancel+or+refund+modification+response
    const CANCEL_OR_REFUND_RECEIVED = '[cancelOrRefund-received]';

    /** PAYOUT */
    //@see https://docs.adyen.com/display/DODL/Confirm+payout+response
    const PAYOUT_CONFIRM_RECEIVED = '[payout-confirm-received]';
    //@see https://docs.adyen.com/display/DODL/Decline+payout+response
    const PAYOUT_DECLINE_RECEIVED = '[payout-decline-received]';
}
