<?php
namespace Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails;

use Omnipay\AdyenApi\Message\Recurring\AbstractRecurringRequest;
use Omnipay\Common\Message\AbstractRequest;

/**
 * Adyen ListRecurringDetails Request
 * @see https://docs.adyen.com/display/TD/listRecurringDetails+request
 *
 * Mandatory values :
 *  - merchantAccount
 *  - shopperReference
 *  - recurringContract
 */
class Request extends AbstractRecurringRequest
{
    /**
     * @return string
     */
    public function getMerchantAccount()
    {
        return $this->getParameter('merchantAccount');
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest
     */
    public function setMerchantAccount($value)
    {
        return $this->setParameter('merchantAccount', $value);
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
     * @return AbstractRequest
     */
    public function setRecurringContract($value)
    {
        return $this->setParameter('recurringContract', $value);
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
     * @return AbstractRequest
     */
    public function setShopperReference($value)
    {
        return $this->setParameter('shopperReference', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('recurringContract', 'shopperReference', 'merchantAccount');
        $data = array(
            'merchantAccount' => $this->getMerchantAccount(),
            'shopperReference' => $this->getShopperReference(),
            'recurring' => array(
                'contract' => $this->getRecurringContract(),
            ),
        );

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $httpResponse = $this->getHttpResponse($data);

        return new Response($this, $httpResponse->getBody());
    }

    /**
     * @return string
     */
    public function getMethodName()
    {
        return 'listRecurringDetails';
    }
}
