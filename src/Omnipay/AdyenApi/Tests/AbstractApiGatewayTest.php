<?php
namespace Omnipay\AdyenApi\Tests;

use Guzzle\Http\ClientInterface as HttpClient;
use Omnipay\AdyenApi\Tests\Mock\AbstractApiGatewayTestMock;
use Omnipay\AdyenApi\Tests\Mock\ApiRequestTestMock;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractApiGatewayTest
 */
class AbstractApiGatewayTest extends \PHPUnit_Framework_TestCase
{
    /** @var AbstractApiGatewayTestMock */
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
        $this->gateway = new AbstractApiGatewayTestMock(
            $this->httpClient->reveal(),
            $this->httpRequest->reveal()
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
    public function testGatewayParamsTransferredToRequest()
    {
        $this->gateway->initialize();
        /** @var ApiRequestTestMock $request */
        $request = $this->gateway->test();

        $this->assertInstanceOf(
            'Omnipay\\AdyenApi\\Tests\\Mock\\ApiRequestTestMock',
            $request
        );

        $gatewayParameters = $this->gateway->getParameters();
        $requestParameters = $request->getParameters();

        $missingParameters = array_diff_key($gatewayParameters, $requestParameters);
        $extraParameters = array_diff_key($requestParameters, $gatewayParameters);

        $this->assertCount(
            0,
            $missingParameters,
            sprintf(
                'Following parameters are missing on request : %s',
                implode(', ', array_keys($missingParameters))
            )
        );
        $this->assertCount(
            0,
            $missingParameters,
            sprintf(
                'Extra parameters found on request : %s',
                implode(', ', array_keys($extraParameters))
            )
        );
    }

    /**
     */
    public function testGatewayParamsMergedAndTransferredToRequest()
    {
        $this->gateway->initialize();
        $customParamList = array(
            'apiUser' => 'MyCustomApiUser',
            'apiPassword' => 'MyCustomApiPassword',
            'customParameter' => 'MyCustomParam',
        );
        /** @var ApiRequestTestMock $request */
        $request = $this->gateway->test($customParamList);

        $gatewayParameters = $this->gateway->getParameters();
        $requestParameters = $request->getParameters();

        $missingParameters = array_diff_key(
            array_replace($gatewayParameters, $customParamList),
            $requestParameters
        );
        $extraParameters = array_diff_key($requestParameters, $gatewayParameters, $customParamList);

        $this->assertCount(
            0,
            $missingParameters,
            sprintf(
                'Following parameters are missing on request : %s',
                implode(', ', array_keys($missingParameters))
            )
        );
        $this->assertCount(
            0,
            $missingParameters,
            sprintf(
                'Extra parameters found on request : %s',
                implode(', ', array_keys($extraParameters))
            )
        );

        foreach ($customParamList as $key => $value) {
            $this->assertSame(
                $value,
                $requestParameters[$key],
                sprintf(
                    '%s should be "%s" but "%s" defined !',
                    $key,
                    $value,
                    $requestParameters[$key]
                )
            );
        }
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
