<?php
namespace Omnipay\AdyenApi\Message\Recurring;

use Omnipay\AdyenApi\Message\AbstractApiRequest;

/**
 * Base Adyen Request
 *
 * Mandatory values :
 *  - apiUser
 *  - apiPassword
 */
abstract class AbstractRecurringRequest extends AbstractApiRequest
{
    protected $liveEndpoint = 'https://pal-live.adyen.com/pal/servlet/Recurring/v12/';
    protected $testEndpoint = 'https://pal-test.adyen.com/pal/servlet/Recurring/v12/';
}
