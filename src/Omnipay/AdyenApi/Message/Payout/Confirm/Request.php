<?php
namespace Omnipay\AdyenApi\Message\Payout\Confirm;

use Omnipay\AdyenApi\Message\Payout\AbstractPayoutRequest;

/**
 * Adyen Payout confirm Request
 * @see https://docs.adyen.com/display/DODL/Confirm+payout+request
 *
 * Mandatory values :
 *  - originalReference
 */
class Request extends AbstractPayoutRequest
{
    /**
     * @return string
     */
    public function getOriginalReference()
    {
        return $this->getParameter('originalReference');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setOriginalReference($value)
    {
        return $this->setParameter('originalReference', $value);
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

    /**
     * {@inheritDoc}
     */
    public function getMethodName()
    {
        return 'confirm';
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('merchantAccount', 'originalReference');

        return array(
            'originalReference' => $this->getOriginalReference(),
            'merchantAccount' => $this->getMerchantAccount(),
        );
    }
}
