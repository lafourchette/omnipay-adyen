<?php
namespace Omnipay\AdyenApi\Message;

/**
 * Class ResultCode
 * provide constant about result code field
 * @see https://docs.adyen.com/display/TD/Payment+responses#Paymentresponses-pspReferenceApiResultCode
 */
class ResultCode
{
    const AUTHORISED = 'Authorised';
    const REFUSED = 'Refused';
    const ERROR = 'Error';
    const CANCELLED = 'Cancelled';
    const RECEIVED = 'Received';
    const REDIRECT_SHOPPER = 'RedirectShopper';
    const SUCCESS = 'Success';

    //Payout
    const PAYOUT_SUBMIT_RECEIVED = 'payout-submit-received';
}
