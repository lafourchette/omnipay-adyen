<?php
namespace Omnipay\AdyenApi\Message\Payout\Decline;

use Omnipay\AdyenApi\Message\Payout\Confirm\Request as ConfirmRequest;

/**
 * Adyen Payout confirm Request
 * @see https://docs.adyen.com/display/DODL/Decline+payout+request
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
        return 'decline';
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
