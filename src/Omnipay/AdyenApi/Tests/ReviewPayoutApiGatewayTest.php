<?php
namespace Omnipay\AdyenApi\Tests;

use Guzzle\Http\ClientInterface as HttpClient;
use Omnipay\AdyenApi\Message\Payout\Confirm\Request as ConfirmPayoutRequest;
use Omnipay\AdyenApi\Message\Payout\Decline\Request as DeclinePayoutRequest;
use Omnipay\AdyenApi\ReviewPayoutApiGateway;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class ReviewPayoutApiGatewayTest
 */
class ReviewPayoutApiGatewayTest extends \PHPUnit_Framework_TestCase
{
    /** @var ReviewPayoutApiGateway */
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
        $this->gateway = new ReviewPayoutApiGateway(
            $this->httpClient->reveal(),
            $this->httpRequest->reveal()
        );
    }

    /**
     */
    public function testGetName()
    {
        $this->assertSame(
            'AdyenReviewPayoutApi',
            $this->gateway->getName()
        );
    }

    /**
     */
    public function testConfirmPayout()
    {
        /** @var ConfirmPayoutRequest $request */
        $request = $this->gateway->confirm();

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Payout\\Confirm\\Request',
            $request
        );
    }

    /**
     */
    public function testDeclinePayout()
    {
        /** @var DeclinePayoutRequest $request */
        $request = $this->gateway->decline();

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Payout\\Decline\\Request',
            $request
        );
    }
}
