<?php
namespace Omnipay\AdyenApi\Message\Payout\Submit;

use Omnipay\AdyenApi\Message\Payout\AbstractPayoutRequest;

/**
 * Adyen Payout submit Request
 * @see https://docs.adyen.com/api-explorer/#/Payout/v30/submitThirdParty
 *
 * Mandatory values :
 *  - amountCurrency
 *  - amountValue
 *  - reference
 *  - shopperEmail
 *  - shopperReference
 *  - selectedRecurringDetailReference
 *
 * Optionnal values :
 *  - shopperStatement
 */
class Request extends AbstractPayoutRequest
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function setAmountCurrency($value)
    {
        return $this->setParameter('amountCurrency', $value);
    }

    /**
     * @return string
     */
    public function getAmountCurrency()
    {
        return $this->getParameter('amountCurrency');
    }

    /**
     * @param float $value
     *
     * @return $this
     */
    public function setAmountValue($value)
    {
        return $this->setParameter('amountValue', $value);
    }

    /**
     * @return float
     */
    public function getAmountValue()
    {
        return $this->getParameter('amountValue');
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
     * @return $this
     */
    public function setReference($value)
    {
        return $this->setParameter('reference', $value);
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
    public function getSelectedRecurringDetailReference()
    {
        return $this->getParameter('selectedRecurringDetailReference');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setSelectedRecurringDetailReference($value)
    {
        return $this->setParameter('selectedRecurringDetailReference', $value);
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setShopperStatement($value)
    {
        return $this->setParameter('shopperStatement', $value);
    }

    /**
     * @return string
     */
    public function getShopperStatement()
    {
        return $this->getParameter('shopperStatement');
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
        return 'submitThirdParty';
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate(
            'merchantAccount',
            'amountCurrency',
            'amountValue',
            'reference',
            'shopperEmail',
            'shopperReference',
            'selectedRecurringDetailReference'
        );

        $data = array(
            'amount' => array(
                'currency' => $this->getAmountCurrency(),
                'value' => ($this->getAmountValue()*100),
            ),
            'recurring' => array(
                'contract' => 'PAYOUT',
            ),
            'reference' => $this->getReference(),
            'selectedRecurringDetailReference' => $this->getSelectedRecurringDetailReference(),
            'shopperEmail' => $this->getShopperEmail(),
            'shopperReference' => $this->getShopperReference(),
            'merchantAccount' => $this->getMerchantAccount(),
        );

        if (null != $this->getShopperStatement()) {
            $data['shopperStatement'] = $this->getShopperStatement();
        }

        return $data;
    }
}
