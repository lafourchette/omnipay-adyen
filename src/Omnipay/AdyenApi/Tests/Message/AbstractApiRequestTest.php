<?php
namespace Omnipay\AdyenApi\Tests\Message;

use Guzzle\Http\ClientInterface as HttpClient;
use Guzzle\Http\Message\EntityEnclosingRequestInterface;
use Guzzle\Http\Message\Response;
use Omnipay\AdyenApi\Message\AbstractApiRequest;
use Omnipay\AdyenApi\Tests\Mock\AbstractApiRequestTestMock;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractApiRequestTest
 */
class AbstractApiRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var AbstractApiRequest */
    private $abstractApiRequest;

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
        $this->abstractApiRequest = new AbstractApiRequestTestMock(
            $this->httpClient->reveal(),
            $this->httpRequest->reveal()
        );
        $this->abstractApiRequest->initialize();
    }

    /**
     */
    public function testBaseEndpoint()
    {
        $this->abstractApiRequest->setTestMode(false);
        $this->assertSame(
            'LIVE',
            $this->abstractApiRequest->getBaseEndpoint()
        );

        $this->abstractApiRequest->setTestMode(true);
        $this->assertSame(
            'TEST',
            $this->abstractApiRequest->getBaseEndpoint()
        );
    }

    /**
     */
    public function testGetEndPoint()
    {
        $this->abstractApiRequest->setTestMode(false);
        $this->assertSame(
            'LIVE/MOCK_METHOD',
            $this->abstractApiRequest->getEndpoint()
        );

        $this->abstractApiRequest->setTestMode(true);
        $this->assertSame(
            'TEST/MOCK_METHOD',
            $this->abstractApiRequest->getEndpoint()
        );
    }

    /**
     */
    public function testGetHttpResponse()
    {
        $endPoint = 'LIVE/MOCK_METHOD';
        $params = array(
            'testMode' => false,
            'apiUser' => 'API_USER',
            'apiPassword' => 'API_PASSWORD',
        );
        $data = array(
            'toto' => 'tutu',
        );

        $this->abstractApiRequest->initialize($params);

        /** @var EntityEnclosingRequestInterface|ObjectProphecy $request */
        $request = $this->prophesize('Guzzle\Http\Message\EntityEnclosingRequestInterface');
        /** @var Response|ObjectProphecy $response */
        $response = $this->prophesize('Guzzle\Http\Message\Response');

        $this->httpClient->post($endPoint)
            ->willReturn($request->reveal())
            ->shouldBeCalledTimes(1);
        $request->setAuth($params['apiUser'], $params['apiPassword'])
            ->shouldBeCalledTimes(1);
        $request->setBody(json_encode($data))
            ->shouldBeCalledTimes(1);
        $request->setHeader('Content-Type', 'application/json;charset=utf-8')
            ->shouldBeCalledTimes(1);

        $request->send()
            ->willReturn($response->reveal())
            ->shouldBeCalledTimes(1);

        $this->assertSame(
            $response->reveal(),
            $this->abstractApiRequest->getHttpResponse($data)
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
        $this->abstractApiRequest->initialize(array($parameterName => $parameterValue));

        $getter = sprintf(
            'get%s',
            ucfirst($parameterName)
        );

        $this->assertTrue(method_exists($this->abstractApiRequest, $getter));

        $this->assertSame(
            $parameterValue,
            $this->abstractApiRequest->$getter()
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

        $this->assertTrue(method_exists($this->abstractApiRequest, $setter));

        $this->abstractApiRequest->$setter($parameterValue);

        $this->assertSame(
            $parameterValue,
            $this->abstractApiRequest->$getter()
        );
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'API_USER' => array('apiUser', 'MyApiUser'),
            'API_PASSWORD' => array('apiPassword', 'MyApiPassword'),
        );
    }
}
