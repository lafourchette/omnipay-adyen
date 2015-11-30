<?php
namespace Omnipay\AdyenApi\Tests\Message\Payment;

use Omnipay\AdyenApi\Tests\Mock\AbstractPaymentResponseTestMock;
use Omnipay\Common\Message\RequestInterface;
use Prophecy\Prophecy\ObjectProphecy;

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
        $this->request = $this->prophesize('Omnipay\Common\Message\RequestInterface');
    }

    /**
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
        $this->assertSame($data['pspReference'], $response->getTransactionReference());
        $this->assertSame($data['status'], $response->getStatus());
        $this->assertSame($data['errorCode'], $response->getErrorCode());
        $this->assertSame($data['message'], $response->getMessage());
        $this->assertSame($data['errorType'], $response->getErrorType());
    }
}
