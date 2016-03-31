<?php
namespace Omnipay\AdyenApi\Tests;

use Guzzle\Http\ClientInterface as HttpClient;
use Omnipay\AdyenApi\Message\Payout\StoreDetail\Request as StorePayoutDetailRequest;
use Omnipay\AdyenApi\Message\Payout\Submit\Request as SubmitPayoutRequest;
use Omnipay\AdyenApi\StorePayoutApiGateway;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class StorePayoutApiGatewayTest
 */
class StorePayoutApiGatewayTest extends \PHPUnit_Framework_TestCase
{
    /** @var StorePayoutApiGateway */
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
        $this->gateway = new StorePayoutApiGateway(
            $this->httpClient->reveal(),
            $this->httpRequest->reveal()
        );
    }

    /**
     */
    public function testGetName()
    {
        $this->assertSame(
            'AdyenStorePayoutApi',
            $this->gateway->getName()
        );
    }

    /**
     */
    public function testStorePayoutDetail()
    {
        /** @var StorePayoutDetailRequest $request */
        $request = $this->gateway->storeDetails();

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Payout\\StoreDetail\\Request',
            $request
        );
    }

    /**
     */
    public function testSubmitPayout()
    {
        /** @var SubmitPayoutRequest $request */
        $request = $this->gateway->submit();

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Payout\\Submit\\Request',
            $request
        );
    }
}
