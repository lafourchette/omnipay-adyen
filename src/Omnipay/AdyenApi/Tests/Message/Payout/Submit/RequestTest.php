<?php
namespace Omnipay\AdyenApi\Tests\Message\Payout\Submit;

use Guzzle\Http\ClientInterface as HttpClient;
use Guzzle\Http\Message\EntityEnclosingRequestInterface;
use Guzzle\Http\Message\Response as GuzzleResponse;
use Omnipay\AdyenApi\Message\Payout\Submit\Request;
use Omnipay\AdyenApi\Message\Payout\Submit\Response;
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
            'amountCurrency' => 'MyAmountCurrency',
            'amountValue' => 12.5,
            'reference' => 'MyReference',
            'shopperEmail' => 'MyShopperEmail',
            'shopperReference' => 'MyShopperReference',
            'selectedRecurringDetailReference' => 'MySelectedRecurringDetailReference',
        );

        $this->request->initialize($data);

        $this->assertEquals(
            array(
                'amount' => array(
                    'currency' => $data['amountCurrency'],
                    'value' => ($data['amountValue'] * 100),
                ),
                'recurring' => array(
                    'contract' => 'PAYOUT',
                ),
                'reference' => $data['reference'],
                'shopperEmail' => $data['shopperEmail'],
                'selectedRecurringDetailReference' => $data['selectedRecurringDetailReference'],
                'shopperReference' => $data['shopperReference'],
                'merchantAccount' => $data['merchantAccount'],
            ),
            $this->request->getData()
        );
    }

    /**
     */
    public function testGetDataWithAllData()
    {
        $data = array(
            'merchantAccount' => 'MERCHANT',
            'amountCurrency' => 'MyAmountCurrency',
            'amountValue' => 12.5,
            'reference' => 'MyReference',
            'shopperEmail' => 'MyShopperEmail',
            'shopperReference' => 'MyShopperReference',
            'selectedRecurringDetailReference' => 'MySelectedRecurringDetailReference',
            'shopperStatement' => 'MyShopperStatement',
        );

        $this->request->initialize($data);

        $this->assertEquals(
            array(
                'amount' => array(
                    'currency' => $data['amountCurrency'],
                    'value' => ($data['amountValue'] * 100),
                ),
                'recurring' => array(
                    'contract' => 'PAYOUT',
                ),
                'reference' => $data['reference'],
                'shopperEmail' => $data['shopperEmail'],
                'selectedRecurringDetailReference' => $data['selectedRecurringDetailReference'],
                'shopperReference' => $data['shopperReference'],
                'merchantAccount' => $data['merchantAccount'],
                'shopperStatement' => $data['shopperStatement'],
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
            'amountCurrency' => 'MyAmountCurrency',
            'amountValue' => 12.5,
            'reference' => 'MyReference',
            'shopperEmail' => 'MyShopperEmail',
            'shopperReference' => 'MyShopperReference',
            'selectedRecurringDetailReference' => 'MySelectedRecurringDetailReference',
        ));

        /** @var Response $response */
        $response = $this->request->sendData(array());
        $this->assertInstanceOf(
            'Omnipay\AdyenApi\Message\Payout\Submit\Response',
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
            'submit',
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
            'SHOPPER_REFERENCE' => array('shopperReference', 'MyShopperReference'),
            'SHOPPER_EMAIL' => array('shopperEmail', 'MyShopperEmail'),
            'REFERENCE' => array('reference', 'MyReference'),
            'AMOUNT_CURRENCY' => array('amountCurrency', 'MyAmountCurrency'),
            'AMOUNT_VALUE' => array('amountValue', 'MyAmountValue'),
            'SELECTED_RECURRING_DETAIL_REF' => array('selectedRecurringDetailReference', 'LKJLSDKJ'),
            'SHOPPER_STATEMENT' => array('shopperStatement', 'MyShopperStatement'),
        );
    }
}
