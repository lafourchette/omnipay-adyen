<?php
namespace Omnipay\AdyenApi\Message\Errors;

/**
 * Class RefusalReason
 * provide constant about refusal reason
 * @see https://docs.adyen.com/display/TD/Authorisation+refusal+reasons
 *
 * And @see Omnipay\AdyenApi\Message\Errors\GenericRefusalReason
 */
class RefusalReason
{
    /** VALIDATION ERROR */
    // Card number
    const INVALID_CARD_NUMBER = 'Invalid Card Number';
    // CVC
    const CVC_DECLINED = 'CVC Declined';
    // Pin
    const PIN_VALIDATION_NOT_POSSIBLE = 'Pin validation not possible';
    const INVALID_PIN = 'Invalid Pin';
    const PIN_TRIES_EXCEEDED = 'Pin tries exceeded';
    // 3D secure
    const THREE_D_NOT_AUTHENTICATED = '3D Not Authenticated';

    /** FRAUD */
    const ACQUIRER_FRAUD = 'Acquirer Fraud';
    const FRAUD = 'FRAUD';
    const FRAUD_CANCELLED = 'FRAUD-CANCELLED';

    /** INVALID CARD */
    const BLOCKED_CARD = 'Blocked Card';
    const EXPIRED_CARD = 'Expired Card';
    const RESTRICTED_CARD = 'Restricted Card';
    const NOT_ENOUGH_BALANCE = 'Not enough balance';

    /** THIRD PARTY ERROR */
    const ACQUIRER_ERROR = 'Acquirer Error';
    const SHOPPER_CANCELLED = 'Shopper Cancelled';
    const ISSUER_UNAVAILABLE = 'Issuer Unavailable';
    const REVOCATION_OF_AUTH = 'Revocation Of Auth';
    const TRANSACTION_NOT_PERMITTED = 'Transaction Not Permitted';
    const NOT_SUPPORTED = 'Not supported';
    const DECLINED_NON_GENERIC = 'Declined Non Generic';

    /** API VALIDATION ERROR */
    const INVALID_AMOUNT = 'Invalid Amount';

    /** ADYEN INTERNAL */
    const NOT_SUBMITTED = 'Not Submitted';
    const PENDING = 'Pending';
    const CANCELLED = 'Cancelled';
    const REFUSED = 'Refused';

    /** ? */
    const REFERRAL = 'Referral';
    const UNKNOWN = 'Unknown';
}
