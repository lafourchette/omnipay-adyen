<?php
namespace Omnipay\AdyenApi\Tests;

use Guzzle\Http\ClientInterface as HttpClient;
use Omnipay\AdyenApi\Message\Payment\Authorise\Request as AuthorizeRequest;
use Omnipay\AdyenApi\Message\Payment\CancelOrRefund\Request as CancelOrRefundRequest;
use Omnipay\AdyenApi\Message\Payment\Refund\Request as RefundRequest;
use Omnipay\AdyenApi\PaymentApiGateway;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class PaymentApiGatewayTest
 */
class PaymentApiGatewayTest extends \PHPUnit_Framework_TestCase
{
    /** @var PaymentApiGateway */
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
        $this->gateway = new PaymentApiGateway(
            $this->httpClient->reveal(),
            $this->httpRequest->reveal()
        );
    }

    /**
     */
    public function testGetName()
    {
        $this->assertSame(
            'AdyenPaymentApi',
            $this->gateway->getName()
        );
    }

    /**
     */
    public function testAuthorize()
    {
        /** @var AuthorizeRequest $request */
        $request = $this->gateway->authorize();

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Payment\\Authorise\\Request',
            $request
        );
    }

    /**
     */
    public function testRefund()
    {
        /** @var RefundRequest $request */
        $request = $this->gateway->refund();

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Payment\\Refund\\Request',
            $request
        );
    }

    /**
     */
    public function testCancelOrRefund()
    {
        /** @var CancelOrRefundRequest $request */
        $request = $this->gateway->cancelOrRefund();

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Payment\\CancelOrRefund\\Request',
            $request
        );
    }
}
