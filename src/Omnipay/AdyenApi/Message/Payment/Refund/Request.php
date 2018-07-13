<?php
namespace Omnipay\AdyenApi\Message\Payment\Refund;

use Omnipay\AdyenApi\Message\Payment\AbstractPaymentRequest;

/**
 * Adyen Refund Request
 * @see https://pal-test.adyen.com/pal/servlet/Payment/v30/refund
 *
 * Mandatory values :
 *  - merchantAccount
 *  - amountValue
 *  - amountCurrency
 *  - reference
 *  - originalReference
 */
class Request extends AbstractPaymentRequest
{

    /**
     * @return string
     */
    public function getAmountValue()
    {
        return $this->getParameter('amountValue');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setAmountValue($value)
    {
        return $this->setParameter('amountValue', $value);
    }

    /**
     * @return string
     */
    public function getAmountCurrency()
    {
        return $this->getParameter('amountCurrency');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setAmountCurrency($value)
    {
        return $this->setParameter('amountCurrency', $value);
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->getParameter('reference');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setReference($value)
    {
        return $this->setParameter('reference', $value);
    }

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
     * @return Request
     */
    public function setOriginalReference($value)
    {
        return $this->setParameter('originalReference', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('amountValue', 'amountCurrency', 'originalReference', 'reference', 'merchantAccount');

        return array(
            'merchantAccount' => $this->getMerchantAccount(),
            'modificationAmount' => array(
                /* Amount must be in minor units => no cents */
                'value' => $this->getAmountValue()*100,
                'currency' => $this->getAmountCurrency(),
            ),
            'originalReference' => $this->getOriginalReference(),
            'reference' => $this->getReference(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $httpResponse = $this->getHttpResponse($data);

        return ($this->response = new Response($this, $httpResponse->getBody()));
    }

    /**
     * @return string
     */
    public function getMethodName()
    {
        return 'refund';
    }
}
