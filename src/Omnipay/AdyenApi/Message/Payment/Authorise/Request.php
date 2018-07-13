<?php
namespace Omnipay\AdyenApi\Message\Payment\Authorise;

use Omnipay\AdyenApi\Message\Payment\AbstractPaymentRequest;

/**
 * Adyen Authorise Request
 * @see https://docs.adyen.com/api-explorer/#/Payment/v30/authorise
 *
 * Mandatory values :
 *  - amountCurrency (amountValue can be ignored for BIN card verification)
 *  - reference
 *  - encryptedForm OR card Data (not already handle) must be provided (depends of CSE use or not)
 *
 * Optional values :
 *  - additionalAmountValue : for BIN card verification
 *  - additionalAmountCurrency : for BIN card verification
 *  - recurringContract : for recurring payment
 *  - recurringDetailName : for recurring payment
 *  - shopperReference
 *  - shopperEmail
 *  - selectedRecurringDetailReference
 *  - shopperInteraction
 */
class Request extends AbstractPaymentRequest
{
    const RECURRING_CONTRACT_TYPE_ONECLICK = 'ONECLICK';
    const RECURRING_CONTRACT_TYPE_RECURRING = 'RECURRING';
    const RECURRING_CONTRACT_TYPE_PAYOUT = 'PAYOUT';

    const SHOPPER_INTERACTION_ECOMMERCE = 'Ecommerce';
    const SHOPPER_INTERACTION_CONTAUTH = 'ContAuth';
    const SHOPPER_INTERACTION_MOTO = 'Moto';

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
    public function getAdditionalAmountValue()
    {
        return $this->getParameter('additionalAmountValue');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setAdditionalAmountValue($value)
    {
        return $this->setParameter('additionalAmountValue', $value);
    }

    /**
     * @return string
     */
    public function getAdditionalAmountCurrency()
    {
        return $this->getParameter('additionalAmountCurrency');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setAdditionalAmountCurrency($value)
    {
        return $this->setParameter('additionalAmountCurrency', $value);
    }

    /**
     * @return string
     * One of ONECLICK, RECURRING or PAYOUT
     */
    public function getRecurringContract()
    {
        return $this->getParameter('recurringContract');
    }

    /**
     * @param string $value
     * Must be one of ONECLICK, RECURRING or PAYOUT
     *
     * @return Request
     */
    public function setRecurringContract($value)
    {
        return $this->setParameter('recurringContract', $value);
    }

    /**
     * @return string
     */
    public function getRecurringDetailName()
    {
        return $this->getParameter('recurringDetailName');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setRecurringDetailName($value)
    {
        return $this->setParameter('recurringDetailName', $value);
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
    public function getShopperInteraction()
    {
        return $this->getParameter('shopperInteraction');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setShopperInteraction($value)
    {
        return $this->setParameter('shopperInteraction', $value);
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
     * @return Request
     */
    public function setSelectedRecurringDetailReference($value)
    {
        return $this->setParameter('selectedRecurringDetailReference', $value);
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
    public function getEncryptedForm()
    {
        return $this->getParameter('encryptedForm');
    }

    /**
     * @param string $value
     *
     * @return Request
     */
    public function setEncryptedForm($value)
    {
        return $this->setParameter('encryptedForm', $value);
    }

    /**
     * @return string
     */
    public function getShopperStatement()
    {
        return $this->getParameter('shopperStatement');
    }
    /**
     * @param string $value
     *
     * @return Request
     */
    public function setShopperStatement($value)
    {
        return $this->setParameter('shopperStatement', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        // Don't validate amountValue with this function it can be equal to 0 for card checking
        $this->validate('amountCurrency', 'reference', 'merchantAccount');

        if ($this->getAmountValue() != 0 && $this->getAmountValue() !== null) {
            $this->validate('amountValue');
        }
        $data = array(
            'amount' => array(
                /* Amount must be in minor units => no cents */
                'value' => $this->getAmountValue()*100,
                'currency' => $this->getAmountCurrency(),
            ),
            'reference' => $this->getReference(),
            'merchantAccount' => $this->getMerchantAccount(),
        );

        $data = $this->appendAdditionalData($data);
        $data = $this->appendAdditionalAmountData($data);
        $data = $this->appendRecurringData($data);
        $data = $this->appendShopperData($data);

        return $data;
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
     * @return string
     */
    public function getMethodName()
    {
        return 'authorise';
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function appendAdditionalData(array $data)
    {
        if ($this->getEncryptedForm() !== null) {
            $data = $this->appendParameter(
                $data,
                'additionalData',
                array('card.encrypted.json' => $this->getEncryptedForm())
            );
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function appendAdditionalAmountData(array $data)
    {
        if ($this->getAdditionalAmountValue() != null) {
            $data = $this->appendParameter(
                $data,
                'additionalAmount',
                /* Amount must be in minor units => no cents */
                array('value' => $this->getAdditionalAmountValue()*100)
            );
        }
        if ($this->getAdditionalAmountCurrency() != null) {
            $data = $this->appendParameter(
                $data,
                'additionalAmount',
                array('currency' => $this->getAdditionalAmountCurrency())
            );
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function appendRecurringData(array $data)
    {
        if ($this->getRecurringContract() !== null) {
            $data = $this->appendParameter(
                $data,
                'recurring',
                array('contract' => $this->getRecurringContract())
            );
        }
        if ($this->getRecurringDetailName() !== null) {
            $data = $this->appendParameter(
                $data,
                'recurring',
                array('recurringDetailName' => $this->getRecurringDetailName())
            );
        }
        if ($this->getSelectedRecurringDetailReference() !== null) {
            $data = $this->appendParameter(
                $data,
                'selectedRecurringDetailReference',
                $this->getSelectedRecurringDetailReference()
            );
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function appendShopperData(array $data)
    {
        if ($this->getShopperReference() !== null) {
            $data = $this->appendParameter($data, 'shopperReference', $this->getShopperReference());
        }
        if ($this->getShopperEmail() !== null) {
            $data = $this->appendParameter($data, 'shopperEmail', $this->getShopperEmail());
        }
        if ($this->getShopperInteraction() !== null) {
            $data = $this->appendParameter($data, 'shopperInteraction', $this->getShopperInteraction());
        }
        if ($this->getShopperStatement() !== null) {
            $data = $this->appendParameter($data, 'shopperStatement', $this->getShopperStatement());
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
