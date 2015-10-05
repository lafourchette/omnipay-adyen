<?php
namespace Omnipay\AdyenApi\Tests;

use Guzzle\Http\ClientInterface as HttpClient;
use Omnipay\AdyenApi\Gateway;
use Omnipay\AdyenApi\Message\Payment\Authorise\Request as AuthorizeRequest;
use Omnipay\AdyenApi\Message\Payment\Refund\Request as RefundRequest;
use Omnipay\AdyenApi\Message\Payment\CancelOrRefund\Request as CancelOrRefundRequest;
use Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Request as ListRecurringDetailsRequest;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class GatewayTest
 */
class GatewayTest extends \PHPUnit_Framework_TestCase
{
    /** @var Gateway */
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
        parent::setUp();

        $this->httpClient = $this->prophesize('Guzzle\Http\ClientInterface');
        $this->httpRequest = $this->prophesize('Symfony\Component\HttpFoundation\Request');
        $this->gateway = new Gateway(
            $this->httpClient->reveal(),
            $this->httpRequest->reveal()
        );
    }

    /**
     */
    public function testGetName()
    {
        $this->assertSame(
            'AdyenApi',
            $this->gateway->getName()
        );
    }

    /**
     */
    public function testGetDefaultParameters()
    {
        $this->assertSame(
            array(
                'testMode' => true,
                'merchantAccount' => 'see-what-is-configured-in-the-adyen-website',
                'apiUser' => 'see-what-is-configured-in-the-adyen-website',
                'apiPassword' => 'see-what-is-configured-in-the-adyen-website',
            ),
            $this->gateway->getDefaultParameters()
        );
    }

    /**
     * Check that default parameters are applied on initialize
     */
    public function testDefaultParameters()
    {
        $this->gateway->initialize();

        $this->assertSame(
            array(
                'testMode' => true,
                'merchantAccount' => 'see-what-is-configured-in-the-adyen-website',
                'apiUser' => 'see-what-is-configured-in-the-adyen-website',
                'apiPassword' => 'see-what-is-configured-in-the-adyen-website',
            ),
            $this->gateway->getParameters()
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
        $this->gateway->initialize(array($parameterName => $parameterValue));

        $getter = sprintf(
            'get%s',
            ucfirst($parameterName)
        );

        $this->assertTrue(method_exists($this->gateway, $getter));

        $this->assertSame(
            $parameterValue,
            $this->gateway->$getter()
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

        $this->assertTrue(method_exists($this->gateway, $setter));

        $this->gateway->$setter($parameterValue);

        $this->assertSame(
            $parameterValue,
            $this->gateway->$getter()
        );
    }

    /**
     */
    public function testAuthorize()
    {
        $parameters = array(
            'apiUser' => 'myApiUser',
            'apiPassword' => 'myApiPassword',
        );
        $defaultParameters = $this->gateway->getDefaultParameters();

        /** @var AuthorizeRequest $request */
        $request = $this->gateway->authorize($parameters);

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Payment\\Authorise\\Request',
            $request
        );

        $this->assertSame(
            $parameters['apiUser'],
            $request->getApiUser()
        );
        $this->assertSame(
            $parameters['apiPassword'],
            $request->getApiPassword()
        );
        $this->assertSame(
            $defaultParameters['merchantAccount'],
            $request->getMerchantAccount()
        );
    }

    /**
     */
    public function testRefund()
    {
        $parameters = array(
            'apiUser' => 'myApiUser',
            'apiPassword' => 'myApiPassword',
        );
        $defaultParameters = $this->gateway->getDefaultParameters();

        /** @var RefundRequest $request */
        $request = $this->gateway->refund($parameters);

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Payment\\Refund\\Request',
            $request
        );

        $this->assertSame(
            $parameters['apiUser'],
            $request->getApiUser()
        );
        $this->assertSame(
            $parameters['apiPassword'],
            $request->getApiPassword()
        );
        $this->assertSame(
            $defaultParameters['merchantAccount'],
            $request->getMerchantAccount()
        );
    }

    /**
     */
    public function testCancelOrRefund()
    {
        $parameters = array(
            'apiUser' => 'myApiUser',
            'apiPassword' => 'myApiPassword',
        );
        $defaultParameters = $this->gateway->getDefaultParameters();

        /** @var CancelOrRefundRequest $request */
        $request = $this->gateway->cancelOrRefund($parameters);

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Payment\\CancelOrRefund\\Request',
            $request
        );

        $this->assertSame(
            $parameters['apiUser'],
            $request->getApiUser()
        );
        $this->assertSame(
            $parameters['apiPassword'],
            $request->getApiPassword()
        );
        $this->assertSame(
            $defaultParameters['merchantAccount'],
            $request->getMerchantAccount()
        );
    }

    /**
     */
    public function testListRecurringDetails()
    {
        $parameters = array(
            'apiUser' => 'myApiUser2',
            'apiPassword' => 'myApiPassword2',
        );
        $defaultParameters = $this->gateway->getDefaultParameters();

        /** @var ListRecurringDetailsRequest $request */
        $request = $this->gateway->listRecurringDetails($parameters);

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Message\\Recurring\\ListRecurringDetails\\Request',
            $request
        );

        $this->assertSame(
            $parameters['apiUser'],
            $request->getApiUser()
        );
        $this->assertSame(
            $parameters['apiPassword'],
            $request->getApiPassword()
        );
        $this->assertSame(
            $defaultParameters['merchantAccount'],
            $request->getMerchantAccount()
        );
    }


    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            array('apiUser', 'MyApiUser'),
            array('apiPassword', 'MyApiPassword'),
            array('merchantAccount', 'MyMerchantAccount'),
        );
    }
}
