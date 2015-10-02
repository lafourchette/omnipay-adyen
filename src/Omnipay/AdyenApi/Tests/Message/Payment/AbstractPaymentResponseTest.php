<?php
namespace Omnipay\AdyenApi\Tests\Message\Payment;

use Omnipay\AdyenApi\Tests\Mock\AbstractPaymentResponseTestMock;
use Prophecy\Prophecy\ObjectProphecy;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class AbstractPaymentRequestTest
 */
class AbstractPaymentResponseTest extends \PHPUnit_Framework_TestCase
{
    /** @var RequestInterface|ObjectProphecy */
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
     * @covers Omnipay\AdyenApi\Message\Payment\AbstractPaymentResponse::getPspReference
     * @covers Omnipay\AdyenApi\Message\Payment\AbstractPaymentResponse::getStatus
     * @covers Omnipay\AdyenApi\Message\Payment\AbstractPaymentResponse::getErrorCode
     * @covers Omnipay\AdyenApi\Message\Payment\AbstractPaymentResponse::getMessage
     * @covers Omnipay\AdyenApi\Message\Payment\AbstractPaymentResponse::getErrorType
     */
    public function testGetter()
    {
        $data = array(
            'pspReference' => 'pspReference',
            'status' => 'status',
            'errorCode' => 'errorCode',
            'message' => 'message',
            'errorType' => 'errorType',
        );
        $response = new AbstractPaymentResponseTestMock(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertSame($data['pspReference'], $response->getPspReference());
        $this->assertSame($data['status'], $response->getStatus());
        $this->assertSame($data['errorCode'], $response->getErrorCode());
        $this->assertSame($data['message'], $response->getMessage());
        $this->assertSame($data['errorType'], $response->getErrorType());
    }
}
