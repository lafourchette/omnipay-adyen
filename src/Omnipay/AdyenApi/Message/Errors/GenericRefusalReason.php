<?php
namespace Omnipay\AdyenApi\Message\Errors;

/**
 * Class GenericRefusalReason
 * @see Omnipay\AdyenApi\Message\Errors\RefusalReason
 */
class GenericRefusalReason
{
    const GENERIC_VALIDATION_REFUSAL = 'GENERIX_VALIDATION_REFUSAL';
    const GENERIC_FRAUD_REFUSAL = 'GENERIX_FRAUD_REFUSAL';
    const GENERIC_INVALID_CARD_REFUSAL = 'GENERIX_INVALID_CARD_REFUSAL';
    const GENERIC_THIRD_PARTY_REFUSAL = 'GENERIC_THIRD_PARTY_REFUSAL';
    const GENERIC_API_VALIDATION_REFUSAL = 'GENERIC_API_VALIDATION_REFUSAL';
    const GENERIC_ADYEN_REFUSAL = 'GENERIC_ADYEN_REFUSAL';
    const GENERIC_OTHER_REFUSAL = 'GENERIC_OTHER_REFUSAL';
    const GENERIC_UNKNOWN_REFUSAL = 'GENERIC_UNKNOWN_REFUSAL';

    public static $validationRefusalList = array(
        RefusalReason::INVALID_CARD_NUMBER,
        RefusalReason::CVC_DECLINED,
        RefusalReason::PIN_VALIDATION_NOT_POSSIBLE,
        RefusalReason::INVALID_PIN,
        RefusalReason::PIN_TRIES_EXCEEDED,
        RefusalReason::THREE_D_NOT_AUTHENTICATED,
    );
    public static $fraudRefusalList = array(
        RefusalReason::ACQUIRER_FRAUD,
        RefusalReason::FRAUD,
        RefusalReason::FRAUD_CANCELLED,
    );
    public static $invalidCardRefusalList = array(
        RefusalReason::BLOCKED_CARD,
        RefusalReason::EXPIRED_CARD,
        RefusalReason::RESTRICTED_CARD,
        RefusalReason::NOT_ENOUGH_BALANCE,
    );
    public static $thirdPartyRefusalList = array(
        RefusalReason::ACQUIRER_ERROR,
        RefusalReason::SHOPPER_CANCELLED,
        RefusalReason::ISSUER_UNAVAILABLE,
        RefusalReason::REVOCATION_OF_AUTH,
        RefusalReason::TRANSACTION_NOT_PERMITTED,
        RefusalReason::NOT_SUPPORTED,
        RefusalReason::DECLINED_NON_GENERIC,
    );
    public static $apiValidationRefusalList = array(
        RefusalReason::INVALID_AMOUNT,
    );
    public static $adyenRefusalList = array(
        RefusalReason::NOT_SUBMITTED,
        RefusalReason::PENDING,
        RefusalReason::CANCELLED,
        RefusalReason::REFUSED,
    );
    public static $otherRefusalList = array(
        RefusalReason::REFERRAL,
        RefusalReason::UNKNOWN,
    );

    /**
     * @param string $errorMessage
     *
     * @return string
     */
    public static function getGenericRefusal($errorMessage)
    {
        if (in_array($errorMessage, self::$validationRefusalList)) {
            return self::GENERIC_VALIDATION_REFUSAL;
        } elseif (in_array($errorMessage, self::$fraudRefusalList)) {
            return self::GENERIC_FRAUD_REFUSAL;
        } elseif (in_array($errorMessage, self::$invalidCardRefusalList)) {
            return self::GENERIC_INVALID_CARD_REFUSAL;
        } elseif (in_array($errorMessage, self::$thirdPartyRefusalList)) {
            return self::GENERIC_THIRD_PARTY_REFUSAL;
        } elseif (in_array($errorMessage, self::$apiValidationRefusalList)) {
            return self::GENERIC_API_VALIDATION_REFUSAL;
        } elseif (in_array($errorMessage, self::$adyenRefusalList)) {
            return self::GENERIC_ADYEN_REFUSAL;
        } elseif (in_array($errorMessage, self::$otherRefusalList)) {
            return self::GENERIC_OTHER_REFUSAL;
        }

        return self::GENERIC_UNKNOWN_REFUSAL;
    }
}
