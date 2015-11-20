<?php
namespace Omnipay\AdyenApi\Tests\Message\Payment;

use Omnipay\AdyenApi\Tests\Mock\AbstractPayoutResponseTestMock;
use Omnipay\Common\Message\RequestInterface;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class AbstractPaymentRequestTest
 */
class AbstractPayoutResponseTest extends \PHPUnit_Framework_TestCase
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
        $response = new AbstractPayoutResponseTestMock(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertSame($data['pspReference'], $response->getTransactionReference());
        $this->assertSame($data['status'], $response->getStatus());
        $this->assertSame($data['errorCode'], $response->getErrorCode());
        $this->assertSame($data['message'], $response->getMessage());
        $this->assertSame($data['errorType'], $response->getErrorType());
    }
}
