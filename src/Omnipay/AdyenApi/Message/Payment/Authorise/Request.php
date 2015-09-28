<?php
namespace Omnipay\AdyenApi\Message\Payment\Authorise;

use Omnipay\AdyenApi\Message\Payment\AbstractPaymentRequest;

/**
 * Adyen Authorise Request
 * @see https://www.adyen.com/apidocs/?example=CSE%20Authorisation
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
 */
class Request extends AbstractPaymentRequest
{
    const RECURRING_CONTRACT_TYPE_ONECLICK = 'ONECLICK';
    const RECURRING_CONTRACT_TYPE_RECURRING = 'RECURRING';
    const RECURRING_CONTRACT_TYPE_PAYOUT = 'PAYOUT';

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
     * {@inheritdoc}
     */
    public function getData()
    {
        // Don't validate amountValue with this function it can be equal to 0 for card checking
        $this->validate('amountCurrency', 'reference', 'merchantAccount', 'encryptedForm');

        if ($this->getAmountValue() !== 0 && $this->getAmountValue() !== null) {
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
        $additionalData = array();
        if ($this->getEncryptedForm() !== null) {
            $additionalData += array(
                'card.encrypted.json' => $this->getEncryptedForm(),
            );
        }
        if (count($additionalData)) {
            $data = $this->appendParameter($data, 'additionalData', $additionalData);
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
        $additionalAmountData = array();
        if ($this->getAdditionalAmountValue() != null) {
            $additionalAmountData += array(
                /* Amount must be in minor units => no cents */
                'value' => $this->getAdditionalAmountValue()*100,
            );
        }
        if ($this->getAdditionalAmountCurrency() != null) {
            $additionalAmountData += array(
                'currency' => $this->getAdditionalAmountCurrency(),
            );
        }
        if (count($additionalAmountData)) {
            $data = $this->appendParameter($data, 'additionalAmount', $additionalAmountData);
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
        $recurringData = array();
        if ($this->getRecurringContract() !== null) {
            $recurringData += array(
                'contract' => $this->getRecurringContract(),
            );
        }
        if ($this->getRecurringDetailName() !== null) {
            $recurringData += array(
                'recurringDetailName' => $this->getRecurringDetailName(),
            );
        }
        if (count($recurringData)) {
            $data = $this->appendParameter($data, 'recurring', $recurringData);
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
