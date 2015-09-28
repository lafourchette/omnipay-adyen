<?php
namespace Omnipay\AdyenApi\Message\Payment\Authorise;

use Omnipay\AdyenApi\Message\AbstractJsonResponse;

/**
 * Adyen Authorise Response.
 * @see https://www.adyen.com/apidocs/?example=CSE%20Authorisation
 */
class Response extends AbstractJsonResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getResultCode() == 'Authorised';
    }

    /**
     * Available if call is successful
     * The unique reference that is associated with the payment
     *
     * @return string
     */
    public function getPspReference()
    {
        return $this->getData()->pspReference;
    }

    /**
     * Available if call is successful
     * The result of the payment.
     * One of Authorised/Refused/Error/Cancelled/Received/RedirectShopper
     *
     * @return string
     */
    public function getResultCode()
    {
        return $this->getData()->resultCode;
    }

    /**
     * Available if call is successful and payment accepted
     * The authorisation code if the payment was successful
     *
     * @return string
     */
    public function getAuthCode()
    {
        return $this->getData()->authCode;
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

    /**
     * Available if call failed
     * The mapped refusal reason
     * @see https://docs.adyen.com/display/TD/Authorisation+refusal+reasons
     *
     * @return string
     */
    public function getRefusalReason()
    {
        return $this->getData()->refusalReason;
    }
}
