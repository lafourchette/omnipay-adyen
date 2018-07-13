<?php
namespace Omnipay\AdyenApi\Message\Payout\Decline;

use Omnipay\AdyenApi\Message\Payout\Confirm\Request as ConfirmRequest;

/**
 * Adyen Payout decline Request
 * @see https://docs.adyen.com/api-explorer/#/Payout/v30/declineThirdParty
 *
 * Mandatory values :
 *  - originalReference
 */
class Request extends ConfirmRequest
{
    /**
     * {@inheritDoc}
     */
    public function getMethodName()
    {
        return 'declineThirdParty';
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $this->setHandleUnprocessableEntity(true);
        $httpResponse = $this->getHttpResponse($data);

        return ($this->response = new Response($this, $httpResponse->getBody()));
    }
}
