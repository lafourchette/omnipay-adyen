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
        $this->request = $this->prophesize('Omnipay\Common\Message\RequestInterface');
    }

    /**
     */
    public function testGetter()
    {
        $data = array(
            'resultCode' => 'resultCode',
            'authCode' => 'authCode',
            'refusalReason' => 'refusalReason',
        );
        $response = new Response(
            $this->request->reveal(),
            json_encode($data)
        );

        $this->assertSame($data['resultCode'], $response->getResultCode());
        $this->assertSame($data['authCode'], $response->getAuthCode());
        $this->assertSame($data['refusalReason'], $response->getRefusalReason());
    }

    /**
     */
    public function testIsSuccessful()
    {
        $response = new Response(
            $this->request->reveal(),
            json_encode(array('resultCode' => Response::STATUS_AUTHORISED))
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
