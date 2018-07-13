<?php
namespace Omnipay\AdyenApi\Tests\Message\Recurring;

use Guzzle\Http\ClientInterface as HttpClient;
use Omnipay\AdyenApi\Message\Recurring\AbstractRecurringRequest;
use Omnipay\AdyenApi\Tests\Mock\AbstractRecurringRequestTestMock;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractRecurringRequestTest
 */
class AbstractRecurringRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var AbstractRecurringRequest|ObjectProphecy */
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
        $this->httpClient = $this->prophesize('Guzzle\Http\ClientInterface');
        $this->httpRequest = $this->prophesize('Symfony\Component\HttpFoundation\Request');
        $this->abstractPaymentRequest = new AbstractRecurringRequestTestMock(
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
            'https://pal-live.adyen.com/pal/servlet/Recurring/v25/',
            $this->abstractPaymentRequest->getBaseEndpoint()
        );

        $this->abstractPaymentRequest->setTestMode(true);
        $this->assertSame(
            'https://pal-test.adyen.com/pal/servlet/Recurring/v25/',
            $this->abstractPaymentRequest->getBaseEndpoint()
        );
    }
}
