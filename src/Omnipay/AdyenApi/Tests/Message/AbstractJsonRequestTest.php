<?php
namespace Omnipay\AdyenApi\Tests\Message;

use Omnipay\AdyenApi\Tests\Mock\AbstractJsonResponseTestMock;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class AbstractApiRequestTest
 */
class AbstractJsonResponseTest extends \PHPUnit_Framework_TestCase
{
    /** @var RequestInterface */
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
     * @dataProvider getIsSuccess
     *
     * @param bool $isSuccess
     */
    public function testSuccess($isSuccess)
    {
        $abstractJsonResponse = new AbstractJsonResponseTestMock(
            $this->request->reveal(),
            json_encode(array('success' => $isSuccess))
        );

        $this->assertSame(
            $isSuccess,
            $abstractJsonResponse->isSuccessful()
        );
    }

    /**
     * @return array
     */
    public function getIsSuccess()
    {
        return array(
            'SUCCESS' => array(true),
            'FAILURE' => array(false),
        );
    }
}
