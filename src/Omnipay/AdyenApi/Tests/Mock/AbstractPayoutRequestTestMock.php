<?php
namespace Omnipay\AdyenApi\Tests\Mock;

use Omnipay\AdyenApi\Message\Payout\AbstractPayoutRequest;

/**
 * Class AbstractPayoutRequestTestMock
 */
class AbstractPayoutRequestTestMock extends AbstractPayoutRequest
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
