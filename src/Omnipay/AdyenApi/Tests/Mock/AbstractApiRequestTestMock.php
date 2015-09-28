<?php
namespace Omnipay\AdyenApi\Tests\Mock;

use Omnipay\AdyenApi\Message\AbstractApiRequest;

/**
 * Class AbstractApiRequestTest_Mock
 */
class AbstractApiRequestTestMock extends AbstractApiRequest
{
    protected $liveEndpoint = 'LIVE';
    protected $testEndpoint = 'TEST';

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
