<?php
namespace Omnipay\AdyenApi\Tests\Message\Recurring\ListRecurringDetails;

use Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Request;
use Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class ResponseTest
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /** @var Request|ObjectProphecy */
    private $request;

    /**
     * @{inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->request = $this->prophesize('Omnipay\Common\Message\RequestInterface');
    }

    /**
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getCreationDate
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getShopperReference
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getRecurringDetail
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getAdditionalData
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getCardBin
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getAlias
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getAliasType
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getCard
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getExpiryMonth
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getExpiryYear
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getHolderName
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getNumber
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getContractTypes
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getFirstPspReference
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getName
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getPaymentMethodVariant
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getRecurringDetailReference
     * @covers Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Response::getVariant
     */
    public function testGetter()
    {
        $data = array(
            'creationDate' => '2015-07-30T22:54:13+02:00',
            'details' => array(
                array(
                    'RecurringDetail' => array(
                        'additionalData' => array(
                            'cardBin' => '492179',
                        ),
                        'card' => array(
                           'expiryMonth' => '2',
                           'expiryYear' => '2017',
                           'holderName' => 'John Doe',
                           'number' => '0380',
                        ),
                        'creationDate' => '2015-07-30T22:54:13+02:00',
                        'contractTypes' => array('CONTRACT TYPE'),
                        'name' => 'NAME',
                        'alias' => 'H123456789012345',
                        'aliasType' => 'Default',
                        'firstPspReference' => '1314362892522014',
                        'recurringDetailReference' => '8313147988756818',
                        'paymentMethodVariant' => 'visadebit',
                        'variant' => 'visa',
                    ),
                ),
            ),
            'shopperReference' => '14194858',
        );
        $response = new Response(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertSame(
            $data['creationDate'],
            $response->getCreationDate(),
            'creationDate'
        );
        $this->assertSame(
            $data['shopperReference'],
            $response->getShopperReference(),
            'shopperReference'
        );
        // json_decode/json_encode is used to convert StdClass to array
        $this->assertEquals(
            $data['details'][0]['RecurringDetail'],
            json_decode(json_encode($response->getRecurringDetail()), true),
            'RecurringDetail'
        );
        $this->assertEquals(
            $data['details'][0]['RecurringDetail']['additionalData'],
            json_decode(json_encode($response->getAdditionalData()), true),
            'additionalData'
        );
        $this->assertEquals(
            $data['details'][0]['RecurringDetail']['additionalData']['cardBin'],
            json_decode(json_encode($response->getCardBin()), true),
            'cardBin'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['alias'],
            $response->getAlias(),
            'alias'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['aliasType'],
            $response->getAliasType(),
            'aliasType'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['card'],
            (array) $response->getCard(),
            'card'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['card']['expiryMonth'],
            $response->getExpiryMonth(),
            'expiryMonth'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['card']['expiryYear'],
            $response->getExpiryYear(),
            'expiryYear'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['card']['holderName'],
            $response->getHolderName(),
            'holderName'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['card']['number'],
            $response->getNumber(),
            'number'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['contractTypes'],
            $response->getContractTypes(),
            'contractTypes'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['firstPspReference'],
            $response->getFirstPspReference(),
            'firstPspReference'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['name'],
            $response->getName(),
            'name'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['paymentMethodVariant'],
            $response->getPaymentMethodVariant(),
            'paymentMethodVariant'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['recurringDetailReference'],
            $response->getRecurringDetailReference(),
            'recurringDetailReference'
        );
        $this->assertSame(
            $data['details'][0]['RecurringDetail']['variant'],
            $response->getVariant(),
            'variant'
        );

        $this->assertSame(
            $data['details'][0]['RecurringDetail']['creationDate'],
            $response->getCreationDate(),
            'creationDate #2'
        );
    }

    /**
     * @dataProvider getTestGetDetails
     *
     * @param array $data
     * @param mixed $expectedGetDetails
     */
    public function testHasDetails($data, $expectedGetDetails)
    {

        $response = new Response(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertSame(
            (is_array($expectedGetDetails) && count($expectedGetDetails)),
            $response->hasDetails()
        );
    }

    /**
     * @dataProvider getTestIsSuccessfullData
     * @param array $data
     * @param bool  $isSuccessful
     */
    public function testIsSuccessful($data, $isSuccessful)
    {
        $response = new Response(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertSame(
            $isSuccessful,
            $response->isSuccessful()
        );
    }

    /**
     * @return array
     */
    public function getTestIsSuccessfullData()
    {
        return array(
            'OK' => array(
                array('data' => array()),
                true,
            ),
            'KO' => array(
                array(),
                false,
            ),
        );
    }

    /**
     * @dataProvider getTestGetDetails
     *
     * @param array $data
     * @param mixed $expectedGetDetails
     */
    public function testGetDetails($data, $expectedGetDetails)
    {

        $response = new Response(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertSame(
            $expectedGetDetails,
            $response->getDetails()
        );
    }

    /**
     */
    public function testGetOneDetail()
    {
        $data = array(
            'creationDate' => '2015-07-30T22:54:13+02:00',
            'details' => array(
                array('A'),
                array('B'),
                array('C'),
            ),
            'shopperReference' => '14194858',
        );
        $response = new Response(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertSame(
            $data['details'][0],
            $response->getOneDetails(0)
        );
        $this->assertSame(
            $data['details'][1],
            $response->getOneDetails(1)
        );
        $this->assertSame(
            $data['details'][2],
            $response->getOneDetails(2)
        );
    }

    /**
     * @return array
     */
    public function getTestGetDetails()
    {
        $baseData = array(
            'creationDate' => '2015-07-30T22:54:13+02:00',
            'shopperReference' => '14194858',
        );

        return array(
            array($baseData + array('details' => array()), array()),
            array($baseData + array('details' => array(array())), array(array())),
            array($baseData, null),
        );
    }
}
