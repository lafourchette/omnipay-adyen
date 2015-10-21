<?php
namespace Omnipay\AdyenApi\Message\Errors;

/**
 * Class ErrorType
 * provide constant about error type field
 * @see https://docs.adyen.com/display/TD/Error+response+fields
 */
class ErrorType
{
    const INTERNAL = 'internal';
    const VALIDATION = 'validation';
    const SECURITY = 'security';
    const CONFIGURATION = 'configuration';

    const UNKNOWN = 'unknown';
}
