<?php
namespace Omnipay\AdyenApi\Tests\Mock;

use Omnipay\AdyenApi\Message\Recurring\AbstractRecurringRequest;

/**
 * Class AbstractRecurringRequestTest_Mock
 */
class AbstractRecurringRequestTestMock extends AbstractRecurringRequest
{
    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'MOCK_METHOD';
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
    }
}
