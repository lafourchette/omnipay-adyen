<?php
namespace Omnipay\AdyenApi;

use Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Request as ListRecurringDetailsRequest;

/**
 * Payment Api Gateway
 *
 * Provide recurring api methods such as :
 *  - listRecurringDetails
 */
class RecurringApiGateway extends AbstractApiGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'AdyenRecurringApi';
    }

    /**
     * @param array $parameters
     *
     * @return ListRecurringDetailsRequest
     */
    public function listRecurringDetails(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Request', $parameters);
    }
}
