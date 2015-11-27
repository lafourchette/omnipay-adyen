<?php
namespace Omnipay\AdyenApi\Tests\Message\Payout\Submit;

use Omnipay\AdyenApi\Message\Payout\Submit\Request;
use Omnipay\AdyenApi\Message\Payout\Submit\Response;
use Omnipay\AdyenApi\Message\ResultCode;
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
        $this->request = $this->prophesize('Omnipay\Common\Message\RequestInterface');
    }

    /**
     */
    public function testGetter()
    {
        $data = array(
            'pspReference' => 'pspReference',
            'refusalReason' => 'refusalReason',
            'resultCode' => 'resultCode',
        );
        $response = new Response(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertSame(
            $data['pspReference'],
            $response->getTransactionReference(),
            'pspReference mismatch'
        );
        $this->assertSame(
            $data['refusalReason'],
            $response->getRefusalReason(),
            'refusalReason mismatch'
        );
        $this->assertSame(
            $data['resultCode'],
            $response->getResultCode(),
            'resultCode mismatch'
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
                array(
                    'resultCode' => ResultCode::PAYOUT_SUBMIT_RECEIVED,
                ),
                true,
            ),
            'KO - refused' => array(
                array(
                    'resultCode' => ResultCode::ERROR,
                ),
                false,
            ),
            'KO - no data' => array(
                array(),
                false,
            ),
        );
    }
}
