<?php
namespace Omnipay\AdyenApi\Message\Payout\StoreDetail;

use Omnipay\AdyenApi\Message\Payment\AbstractPayoutRequest;

/**
 * Adyen Payout store details Request
 * @see https://docs.adyen.com/display/DODL/Store+detail+request
 *
 * Currently only IBAN submission is handled
 *
 * Mandatory values :
 *  - shopperEmail
 *  - shopperReference
 *  - iban
 */
class Request extends AbstractPayoutRequest
{
    /**
     * @return string
     */
    public function getIban()
    {
        return $this->getParameter('iban');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setIban($value)
    {
        return $this->setParameter('iban', $value);
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->getParameter('countryCode');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCountryCode($value)
    {
        return $this->setParameter('countryCode', $value);
    }

    /**
     * @return string
     */
    public function getShopperEmail()
    {
        return $this->getParameter('shopperEmail');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setShopperEmail($value)
    {
        return $this->setParameter('shopperEmail', $value);
    }

    /**
     * @return string
     */
    public function getShopperReference()
    {
        return $this->getParameter('shopperReference');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setShopperReference($value)
    {
        return $this->setParameter('shopperReference', $value);
    }

    /**
     * @return string
     */
    public function getOwnerName()
    {
        return $this->getParameter('ownerName');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setOwnerName($value)
    {
        return $this->setParameter('ownerName', $value);
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
        return 'storeDetail';
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array(
            'bank' => array(
                'iban' => $this->getIban(),
                'countryCode' => $this->getCountryCode(),
                'ownerName' => $this->getOwnerName(),
            ),
            'recurring' => array(
                'contract' => 'PAYOUT',
            ),
            'shopperEmail' => $this->getShopperEmail(),
            'shopperReference' => $this->getShopperReference(),
        );
    }
}
