<?php
namespace Omnipay\AdyenApi\Message\Payout;

use Omnipay\AdyenApi\Message\AbstractJsonResponse;

/**
 * Base Adyen Payout Response
 * Provide getter for :
 *  - status
 *  - errorCode
 *  - message
 *  - errorType
 *
 * That are available if request failed
 *
 * And getter for pspReference if call is successful
 */
abstract class AbstractPayoutResponse extends AbstractJsonResponse
{
    /**
     * Available if call is successful
     * The unique reference that is associated with the payment
     *
     * @return string
     */
    public function getTransactionReference()
    {
        return $this->getDataValue('pspReference');
    }

    /**
     * Available if call failed
     * The HTTP response status code.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getDataValue('status');
    }

    /**
     * Available if call failed
     * The Adyen code that is mapped to the error message.
     * @see https://docs.adyen.com/display/TD/Error+response+fields
     * @see https://docs.adyen.com/pages/viewpage.action?pageId=5376980
     * @return string
     */
    public function getErrorCode()
    {
        return $this->getDataValue('errorCode');
    }

    /**
     * Available if call failed
     * The message, a short explanation of the issue.
     * @see https://docs.adyen.com/display/TD/Error+response+fields
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->getDataValue('message');
    }

    /**
     * Available if call failed
     * The type of error that was encountered.
     * One of internal/validation/security/configuration
     * @see https://docs.adyen.com/display/TD/Error+response+fields
     *
     * @return string
     */
    public function getErrorType()
    {
        return $this->getDataValue('errorType');
    }
}
