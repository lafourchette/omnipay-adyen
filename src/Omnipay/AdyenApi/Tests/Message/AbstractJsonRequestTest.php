<?php
namespace Omnipay\AdyenApi\Tests\Message;

use Omnipay\AdyenApi\Message\AbstractJsonResponse;
use Omnipay\Common\Message\RequestInterface;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class AbstractApiRequestTest
 */
class AbstractJsonResponseTest extends \PHPUnit_Framework_TestCase
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
     * @dataProvider getIsSuccess
     *
     * @param bool $isSuccess
     */
    public function testSuccess($isSuccess)
    {
        $abstractJsonResponse = new AbstractJsonResponseTest_Mock(
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


/**
 * Class AbstractJsonResponseTest_Mock
 */
class AbstractJsonResponseTest_Mock extends AbstractJsonResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->getData()->success;
    }
}
