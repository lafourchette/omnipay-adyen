<?php
namespace Omnipay\AdyenApi\Message;

/**
 * Class ResultCode
 * provide constant about result code field
 *
 */
class ResultCode
{
    /**
     * Payment result codes
     * @see https://docs.adyen.com/display/TD/Payment+responses#Paymentresponses-pspReferenceApiResultCode
     */
    const AUTHORISED = 'Authorised';
    const REFUSED = 'Refused';
    const ERROR = 'Error';
    const CANCELLED = 'Cancelled';
    const RECEIVED = 'Received';
    const REDIRECT_SHOPPER = 'RedirectShopper';

    /**
     * PayOut result codes
     */
    //@see https://docs.adyen.com/display/DODL/Store+detail+response
    const SUCCESS = 'Success';
    //@see https://docs.adyen.com/display/DODL/Submit+payout+response
    //@see https://docs.adyen.com/display/DODL/Store+detail+and+submit+response
    const PAYOUT_SUBMIT_RECEIVED = 'payout-submit-received';
}
