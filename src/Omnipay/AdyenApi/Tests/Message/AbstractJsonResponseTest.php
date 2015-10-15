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
     */
    public function testGetDataValue()
    {
        $testKey = 'test';
        $testValue = 'ok';
        $abstractJsonResponse = new AbstractJsonResponseTestMock(
            $this->request->reveal(),
            json_encode(array($testKey => $testValue))
        );

        $this->assertSame(
            $testValue,
            $abstractJsonResponse->getDataValue($testKey)
        );
    }

    /**
     */
    public function testGetDataValueWithUndefinedKey()
    {
        $testKey = 'test';
        $testValue = 'ok';
        $abstractJsonResponse = new AbstractJsonResponseTestMock(
            $this->request->reveal(),
            json_encode(array('plop' => $testValue))
        );

        $this->assertSame(
            null,
            $abstractJsonResponse->getDataValue($testKey)
        );
    }

    /**
     */
    public function testGetDataValueWithNestedValue()
    {
        $testKey = 'test1';
        $testKey2 = 'test2';
        $testKey3 = 'test3';
        $testValue = 'ok';
        $abstractJsonResponse = new AbstractJsonResponseTestMock(
            $this->request->reveal(),
            json_encode(
                array(
                    $testKey => array(
                        $testKey2 => array(
                            $testKey3 => $testValue,
                        ),
                    ),
                )
            )
        );

        $this->assertSame(
            $testValue,
            $abstractJsonResponse->getDataValue($testKey, $testKey2, $testKey3)
        );
    }

    /**
     */
    public function testGetDataValueWithUndefinedNestedValue()
    {
        $testKey = 'test1';
        $testKey2 = 'test2';
        $testKey3 = 'test3';
        $testValue = 'ok';
        $abstractJsonResponse = new AbstractJsonResponseTestMock(
            $this->request->reveal(),
            json_encode(
                array(
                    $testKey => array(
                        'plop' => array(
                            $testKey3 => $testValue,
                        ),
                    ),
                )
            )
        );

        $this->assertSame(
            null,
            $abstractJsonResponse->getDataValue($testKey, $testKey2, $testKey3)
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
