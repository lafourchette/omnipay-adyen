<?php
namespace Omnipay\AdyenApi\Tests\Message\Recurring\ListRecurringDetails;

use Guzzle\Http\ClientInterface as HttpClient;
use Guzzle\Http\Message\EntityEnclosingRequestInterface;
use Guzzle\Http\Message\Response as GuzzleResponse;
use Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Request;
use Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class RequestTest
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var Request|ObjectProphecy */
    private $request;

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
        $this->request = new Request(
            $this->httpClient->reveal(),
            $this->httpRequest->reveal()
        );
        $this->request->initialize();
    }

    /**
     */
    public function testGetData()
    {
        $data = array(
            'merchantAccount' => 'MERCHANT',
            'recurringContract' => 'CONTRACT',
            'shopperReference' => 'REF',
        );

        $this->request->initialize($data);

        $this->assertEquals(
            array(
                'merchantAccount' => $data['merchantAccount'],
                'shopperReference' => $data['shopperReference'],
                'recurring' => array(
                    'contract' => $data['recurringContract'],
                ),
            ),
            $this->request->getData()
        );
    }

    /**
     */
    public function testSendData()
    {
        /** @var EntityEnclosingRequestInterface|ObjectProphecy $httpRequest */
        $httpRequest = $this->prophesize('Guzzle\Http\Message\EntityEnclosingRequestInterface');
        /** @var GuzzleResponse|ObjectProphecy $response */
        $response = $this->prophesize('Guzzle\Http\Message\Response');

        $this->httpClient->post(Argument::type('string'))
            ->willReturn($httpRequest->reveal())
            ->shouldBeCalledTimes(1);
        $httpRequest->setAuth(Argument::type('string'), Argument::type('string'))
            ->shouldBeCalledTimes(1);
        $httpRequest->setBody(Argument::type('string'))
            ->shouldBeCalledTimes(1);
        $httpRequest->setHeader('Content-Type', 'application/json;charset=utf-8')
            ->shouldBeCalledTimes(1);

        $httpRequest->send()
            ->willReturn($response->reveal())
            ->shouldBeCalledTimes(1);

        $response->getBody()
            ->willReturn(json_encode(array('ok' => true)))
            ->shouldBeCalledTimes(1);


        $this->request->initialize(array(
            'apiUser' => 'USER',
            'apiPassword' => 'PASSWORD',
            'merchantAccount' => 'MERCHANT',
            'recurringContract' => 'CONTRACT',
            'shopperReference' => 'REF',
        ));

        /** @var Response $response */
        $response = $this->request->sendData(array());
        $this->assertInstanceOf(
            'Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response',
            $response
        );

        $this->assertEquals(
            true,
            $response->getDataValue('ok')
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
        $this->request->initialize(array($parameterName => $parameterValue));

        $getter = sprintf(
            'get%s',
            ucfirst($parameterName)
        );

        $this->assertTrue(method_exists($this->request, $getter));

        $this->assertSame(
            $parameterValue,
            $this->request->$getter()
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

        $this->assertTrue(method_exists($this->request, $setter));

        $this->request->$setter($parameterValue);

        $this->assertSame(
            $parameterValue,
            $this->request->$getter()
        );
    }

    /**
     */
    public function testGetMethodName()
    {
        $this->assertSame(
            'listRecurringDetails',
            $this->request->getMethodName()
        );
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array(
            'MERCHANT_ACCOUNT' => array('merchantAccount', 'MyMerchantAccount'),
            'RECURRING_CONTRACT' => array('recurringContract', 'MyRecurringContract'),
            'SHOPPER_REFERENCE' => array('shopperReference', 'MyShopperReference'),
        );
    }
}
