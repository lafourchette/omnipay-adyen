<?php
namespace Omnipay\AdyenApi\Message\Errors;

/**
 * Class GenericRefusalReason
 * @see Omnipay\AdyenApi\Message\Errors\RefusalReason
 */
class GenericRefusalReasonTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider getTestGetGenericRefusalData
     * @param string $error
     * @param string $expected
     */
    public function testGetGenericRefusal($error, $expected)
    {
        $this->assertSame(
            GenericRefusalReason::getGenericRefusal($error),
            $expected
        );
    }

    /**
     * @return array
     */
    public function getTestGetGenericRefusalData()
    {
        $data = array();
        $data[] = array('PLOP', GenericRefusalReason::GENERIC_UNKNOWN_REFUSAL);

        return $data;
    }
}
