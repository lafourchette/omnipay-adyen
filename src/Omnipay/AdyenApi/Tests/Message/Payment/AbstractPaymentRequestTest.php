<?php
namespace Omnipay\AdyenApi\Tests\Message\Payment;

use Guzzle\Http\ClientInterface as HttpClient;
use Omnipay\AdyenApi\Message\Payment\AbstractPaymentRequest;
use Omnipay\AdyenApi\Tests\Mock\AbstractPaymentRequestTestMock;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractPaymentRequestTest
 */
class AbstractPaymentRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var AbstractPaymentRequest|ObjectProphecy */
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
        $this->abstractPaymentRequest = new AbstractPaymentRequestTestMock(
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
            'https://pal-live.adyen.com/pal/servlet/Payment/v30/',
            $this->abstractPaymentRequest->getBaseEndpoint()
        );

        $this->abstractPaymentRequest->setTestMode(true);
        $this->assertSame(
            'https://pal-test.adyen.com/pal/servlet/Payment/v30/',
            $this->abstractPaymentRequest->getBaseEndpoint()
        );
    }

    /**
     * @dataProvider getParameters
     *
     * @param string $parameterName
     * @param mixed  $parameterValue
     */
    public function testParametersGetAfterInitialize($parameterName, $parameterValue)
    {
        $this->abstractPaymentRequest->initialize(array($parameterName => $parameterValue));

        $getter = sprintf(
            'get%s',
            ucfirst($parameterName)
        );

        $this->assertTrue(method_exists($this->abstractPaymentRequest, $getter));

        $this->assertSame(
            $parameterValue,
            $this->abstractPaymentRequest->$getter()
        );
    }

    /**
     * @dataProvider getParameters
     *
     * @param string $parameterName
     * @param mixed  $parameterValue
     */
    public function testParametersSetGet($parameterName, $parameterValue)
    {
        $getter = sprintf(
            'get%s',
            ucfirst($parameterName)
        );
        $setter = sprintf(
            'set%s',
            ucfirst($parameterName)
        );

        $this->assertTrue(method_exists($this->abstractPaymentRequest, $setter));

        $this->abstractPaymentRequest->$setter($parameterValue);

        $this->assertSame(
            $parameterValue,
            $this->abstractPaymentRequest->$getter()
        );
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'MERCHANT_ACCOUNT' => array('merchantAccount', 'MyMerchantAccount'),
        );
    }
}
