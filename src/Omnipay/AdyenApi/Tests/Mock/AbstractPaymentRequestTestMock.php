<?php
namespace Omnipay\AdyenApi\Tests\Mock;

use Omnipay\AdyenApi\Message\Payment\AbstractPaymentRequest;

/**
 * Class AbstractPaymentRequestTest_Mock
 */
class AbstractPaymentRequestTestMock extends AbstractPaymentRequest
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
