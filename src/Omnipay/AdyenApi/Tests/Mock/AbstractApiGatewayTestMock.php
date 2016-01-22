<?php
namespace Omnipay\AdyenApi\Tests\Mock;

use Omnipay\AdyenApi\AbstractApiGateway;

/**
 * Class AbstractApiGatewayTestMock
 */
class AbstractApiGatewayTestMock extends AbstractApiGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'AbstractApiGatewayTestMock';
    }

    /**
     * @param array $parameters
     *
     * @return ApiRequestTestMock
     */
    public function test(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Tests\Mock\ApiRequestTestMock', $parameters);
    }
}
