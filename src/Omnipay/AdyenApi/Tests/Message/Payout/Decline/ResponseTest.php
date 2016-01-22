<?php
namespace Omnipay\AdyenApi\Tests\Message\Payout\Decline;

use Omnipay\AdyenApi\Message\Payout\Decline\Request;
use Omnipay\AdyenApi\Message\Payout\Decline\Response;
use Omnipay\AdyenApi\Message\ResponseCode;
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
            'response' => 'response',
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
            $data['response'],
            $response->getResponse(),
            'response mismatch'
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
                    'response' => ResponseCode::PAYOUT_DECLINE_RECEIVED,
                ),
                true,
            ),
            'KO - refused' => array(
                array(
                    'response' => 'Plop',
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
