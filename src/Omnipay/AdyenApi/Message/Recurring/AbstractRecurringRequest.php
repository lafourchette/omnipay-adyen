<?php
namespace Omnipay\AdyenApi\Message\Recurring;

use Omnipay\AdyenApi\Message\AbstractApiRequest;

/**
 * Base Adyen Recurring Request
 */
abstract class AbstractRecurringRequest extends AbstractApiRequest
{
    protected $liveEndpoint = 'https://pal-live.adyen.com/pal/servlet/Recurring/v25/';
    protected $testEndpoint = 'https://pal-test.adyen.com/pal/servlet/Recurring/v25/';
}
