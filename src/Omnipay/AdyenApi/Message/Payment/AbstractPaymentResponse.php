<?php
namespace Omnipay\AdyenApi\Message\Payment;

use Omnipay\AdyenApi\Message\AbstractJsonResponse;

/**
 * Base Adyen Payment Response
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
abstract class AbstractPaymentResponse extends AbstractJsonResponse
{
    /**
     * Available if call is successful
     * The unique reference that is associated with the payment
     * @deprecated since  2.0.0 and will be removed on 3.0.0
     *
     * @return string
     */
    public function getPspReference()
    {
        return $this->getTransactionReference();
    }

    /**
     * Available if call is successful
     * The unique reference that is associated with the payment
     *
     * @return string
     */
    public function getTransactionReference()
    {
        return $this->getData()->pspReference;
    }

    /**
     * Available if call failed
     * The HTTP response status code.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getData()->status;
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
        return $this->getData()->errorCode;
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
        return $this->getData()->message;
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
        return $this->getData()->errorType;
    }
}
