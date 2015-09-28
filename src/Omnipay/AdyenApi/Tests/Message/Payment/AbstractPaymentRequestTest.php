<?php
namespace Omnipay\AdyenApi\Tests\Message\Payment;

use Omnipay\AdyenApi\Message\AbstractApiRequest;
use Omnipay\AdyenApi\Message\Payment\AbstractPaymentRequest;
use Omnipay\Common\Message\ResponseInterface;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class AbstractPaymentRequestTest
 */
class AbstractPaymentRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var AbstractPaymentRequest|ObjectProphecy */
    private $abstractPaymentRequest;

    /**
     * @{inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->httpClient = $this->prophesize('Guzzle\Http\ClientInterface');
        $this->httpRequest = $this->prophesize('Symfony\Component\HttpFoundation\Request');
        $this->abstractPaymentRequest = new AbstractPaymentRequestTest_Mock(
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
            'https://pal-live.adyen.com/pal/servlet/Payment/v12/',
            $this->abstractPaymentRequest->getBaseEndpoint()
        );

        $this->abstractPaymentRequest->setTestMode(true);
        $this->assertSame(
            'https://pal-test.adyen.com/pal/servlet/Payment/v12/',
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


/**
 * Class AbstractPaymentRequestTest_Mock
 */
class AbstractPaymentRequestTest_Mock extends AbstractPaymentRequest
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
