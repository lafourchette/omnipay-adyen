<?php
namespace Omnipay\AdyenApi\Message\Payout\StoreDetail;

use Omnipay\AdyenApi\Message\Payout\AbstractPayoutRequest;

/**
 * Adyen Payout store details Request
 * @see https://pal-test.adyen.com/pal/servlet/Payout/v30/storeDetail
 *
 * Currently only IBAN submission is handled.
 * Bic is not mandatory but in case it is provided, it will be sent
 *
 * Mandatory values :
 *  - shopperEmail
 *  - shopperReference
 *  - iban
 *
 * Optionnal values :
 *  - bankCountryCode
 *  - ibanOwnerName
 *  - bic
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
    public function getBic()
    {
        return $this->getParameter('bic');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setBic($value)
    {
        return $this->setParameter('bic', $value);
    }

    /**
     * @return string
     */
    public function getBankCountryCode()
    {
        return $this->getParameter('bankCountryCode');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setBankCountryCode($value)
    {
        return $this->setParameter('bankCountryCode', $value);
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
     * @return $this
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
     * @return $this
     */
    public function setShopperReference($value)
    {
        return $this->setParameter('shopperReference', $value);
    }

    /**
     * @return string
     */
    public function getIbanOwnerName()
    {
        return $this->getParameter('ibanOwnerName');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setIbanOwnerName($value)
    {
        return $this->setParameter('ibanOwnerName', $value);
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
        $this->validate('shopperEmail', 'shopperReference', 'merchantAccount');

        $data = array(
            'recurring' => array(
                'contract' => 'PAYOUT',
            ),
            'shopperEmail' => $this->getShopperEmail(),
            'shopperReference' => $this->getShopperReference(),
            'merchantAccount' => $this->getMerchantAccount(),
        );

        return $this->appendBankData($data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function appendBankData(array $data)
    {
        $this->validate('iban');
        $data = $this->appendParameter($data, 'bank', array('iban' => $this->getIban()));

        if ($this->getBic() !== null) {
            $this->validate('bic');
            $data = $this->appendParameter($data, 'bank', array('bic' => $this->getBic()));
        }
        if ($this->getIbanOwnerName() !== null) {
            $data = $this->appendParameter($data, 'bank', array('ownerName' => $this->getIbanOwnerName()));
        }
        if ($this->getBankCountryCode() !== null) {
            $data = $this->appendParameter($data, 'bank', array('countryCode' => $this->getBankCountryCode()));
        }

        return $data;
    }

    /**
     * @param array  $container
     * @param string $parameterName
     * @param mixed  $parameterValue
     *
     * @return array
     */
    private function appendParameter(array $container, $parameterName, $parameterValue)
    {
        if (array_key_exists($parameterName, $container) && is_array($parameterValue)) {
            $subContainer = $container[$parameterName];
            foreach ($parameterValue as $subParameterName => $subParameterValue) {
                $subContainer = $this->appendParameter($subContainer, $subParameterName, $subParameterValue);
            }
            $container[$parameterName] = $subContainer;

            return $container;
        }
        $container[$parameterName] = $parameterValue;

        return $container;
    }
}
