<?php
namespace Omnipay\AdyenApi\Tests\Message\Payout;

use Guzzle\Http\ClientInterface as HttpClient;
use Omnipay\AdyenApi\Message\Payout\AbstractPayoutRequest;
use Omnipay\AdyenApi\Tests\Mock\AbstractPayoutRequestTestMock;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractPayoutRequestTest
 */
class AbstractPayoutRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var AbstractPayoutRequest|ObjectProphecy */
    private $abstractPaymentRequest;

    /** @var HttpClient|ObjectProphecy */
    private $httpClient;

    /** @var HttpRequest|ObjectProphecy */
    private $httpRequest;

    /**
     * @{inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->httpClient = $this->prophesize('Guzzle\Http\ClientInterface');
        $this->httpRequest = $this->prophesize('Symfony\Component\HttpFoundation\Request');
        $this->abstractPaymentRequest = new AbstractPayoutRequestTestMock(
            $this->httpClient->reveal(),
            $this->httpRequest->reveal()
        );
        $this->abstractPaymentRequest->initialize();
    }

    /**
     */
    public function testBaseEndpoint()
    {
        $this->abstractPaymentRequest->setTestMode(false);
        $this->assertSame(
            'https://pal-live.adyen.com/pal/servlet/Payout/v12/',
            $this->abstractPaymentRequest->getBaseEndpoint()
        );

        $this->abstractPaymentRequest->setTestMode(true);
        $this->assertSame(
            'https://pal-test.adyen.com/pal/servlet/Payout/v12/',
            $this->abstractPaymentRequest->getBaseEndpoint()
        );
    }
}
