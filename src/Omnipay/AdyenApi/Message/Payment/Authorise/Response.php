<?php
namespace Omnipay\AdyenApi\Message\Payment\Authorise;

use Omnipay\AdyenApi\Message\Payment\AbstractPaymentResponse;

/**
 * Adyen Authorise Response.
 * @see https://www.adyen.com/apidocs/?example=CSE%20Authorisation
 */
class Response extends AbstractPaymentResponse
{
    const STATUS_AUTHORISED = 'Authorised';
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->getResultCode() == self::STATUS_AUTHORISED;
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
     * Available if call is successful and payment not accepted
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
