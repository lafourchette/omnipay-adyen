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
        foreach (GenericRefusalReason::$validationRefusalList as $anError) {
            $data[] = array($anError, GenericRefusalReason::GENERIC_VALIDATION_REFUSAL);
        }
        foreach (GenericRefusalReason::$fraudRefusalList as $anError) {
            $data[] = array($anError, GenericRefusalReason::GENERIC_FRAUD_REFUSAL);
        }
        foreach (GenericRefusalReason::$invalidCardRefusalList as $anError) {
            $data[] = array($anError, GenericRefusalReason::GENERIC_INVALID_CARD_REFUSAL);
        }
        foreach (GenericRefusalReason::$thirdPartyRefusalList as $anError) {
            $data[] = array($anError, GenericRefusalReason::GENERIC_THIRD_PARTY_REFUSAL);
        }
        foreach (GenericRefusalReason::$apiValidationRefusalList as $anError) {
            $data[] = array($anError, GenericRefusalReason::GENERIC_API_VALIDATION_REFUSAL);
        }
        foreach (GenericRefusalReason::$adyenRefusalList as $anError) {
            $data[] = array($anError, GenericRefusalReason::GENERIC_ADYEN_REFUSAL);
        }
        foreach (GenericRefusalReason::$otherRefusalList as $anError) {
            $data[] = array($anError, GenericRefusalReason::GENERIC_OTHER_REFUSAL);
        }
        $data[] = array('PLOP', GenericRefusalReason::GENERIC_UNKNOWN_REFUSAL);

        return $data;
    }
}
