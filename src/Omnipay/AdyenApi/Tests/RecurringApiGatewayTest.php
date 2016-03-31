<?php
namespace Omnipay\AdyenApi\Tests;

use Guzzle\Http\ClientInterface as HttpClient;
use Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Request as ListRecurringDetailsRequest;
use Omnipay\AdyenApi\RecurringApiGateway;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class RecurringApiGatewayTest
 */
class RecurringApiGatewayTest extends \PHPUnit_Framework_TestCase
{
    /** @var RecurringApiGateway */
    private $gateway;

    /** @var HttpClient|ObjectProphecy */
    private $httpClient;

    /** @var HttpRequest|ObjectProphecy */
    private $httpRequest;

    /**
     * @{inheritdoc}
     */
    public function setUp()
    {
        $this->httpClient = $this->prophesize('Guzzle\Http\ClientInterface');
        $this->httpRequest = $this->prophesize('Symfony\Component\HttpFoundation\Request');
        $this->gateway = new RecurringApiGateway(
            $this->httpClient->reveal(),
            $this->httpRequest->reveal()
        );
    }

    /**
     */
    public function testGetName()
    {
        $this->assertSame(
            'AdyenRecurringApi',
            $this->gateway->getName()
        );
    }

    /**
     */
    public function testListRecurringDetails()
    {
        /** @var ListRecurringDetailsRequest $request */
        $request = $this->gateway->listRecurringDetails();

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Recurring\\ListRecurringDetails\\Request',
            $request
        );
    }
}
