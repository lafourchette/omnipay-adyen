<?php
namespace Omnipay\AdyenApi\Tests\Message\Payment\Authorise;

use Omnipay\AdyenApi\Message\Payment\Authorise\Request;
use Omnipay\AdyenApi\Message\Payment\Authorise\Response;
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
     * @covers Omnipay\AdyenApi\Message\Payment\Authorise\Response::getPspReference
     * @covers Omnipay\AdyenApi\Message\Payment\Authorise\Response::getResultCode
     * @covers Omnipay\AdyenApi\Message\Payment\Authorise\Response::getAuthCode
     * @covers Omnipay\AdyenApi\Message\Payment\Authorise\Response::getStatus
     * @covers Omnipay\AdyenApi\Message\Payment\Authorise\Response::getErrorCode
     * @covers Omnipay\AdyenApi\Message\Payment\Authorise\Response::getMessage
     * @covers Omnipay\AdyenApi\Message\Payment\Authorise\Response::getErrorType
     * @covers Omnipay\AdyenApi\Message\Payment\Authorise\Response::getRefusalReason
     */
    public function testGetter()
    {
        $data = array(
            'pspReference' => 'pspReference',
            'resultCode' => 'resultCode',
            'authCode' => 'authCode',
            'status' => 'status',
            'errorCode' => 'errorCode',
            'message' => 'message',
            'errorType' => 'errorType',
            'refusalReason' => 'refusalReason',
        );
        $response = new Response(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertSame($data['pspReference'], $response->getPspReference());
        $this->assertSame($data['resultCode'], $response->getResultCode());
        $this->assertSame($data['authCode'], $response->getAuthCode());
        $this->assertSame($data['status'], $response->getStatus());
        $this->assertSame($data['errorCode'], $response->getErrorCode());
        $this->assertSame($data['message'], $response->getMessage());
        $this->assertSame($data['errorType'], $response->getErrorType());
        $this->assertSame($data['refusalReason'], $response->getRefusalReason());
    }

    /**
     */
    public function testIsSuccessful()
    {
        $response = new Response(
            $this->request->reveal(),
            json_encode(array('resultCode' => 'Authorised'))
        );

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * @dataProvider getIsNotSuccessfulData
     * @param array $data
     */
    public function testIsNotSuccessful(array $data)
    {
        $response = new Response(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertFalse($response->isSuccessful());
    }

    /**
     * @return array
     */
    public function getIsNotSuccessfulData()
    {
        return array(
            'invalid' => array(array('resultCode' => 'plop')),
            'not_provided' => array(array('resultCode' => null)),
        );
    }
}
