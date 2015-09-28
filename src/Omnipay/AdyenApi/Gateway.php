<?php
namespace Omnipay\AdyenApi;

use Omnipay\Common\AbstractGateway;

/**
 * Api Gateway
 * Provide merchantAccount, apiUser and apiPassword parameters helper
 */
class Gateway extends AbstractGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'AdyenApi';
    }


    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return array(
            'testMode' => true,
            'merchantAccount' => 'see-what-is-configured-in-the-adyen-website',
            'apiUser' => 'see-what-is-configured-in-the-adyen-website',
            'apiPassword' => 'see-what-is-configured-in-the-adyen-website',
        );
    }

    /**
     * @return string
     */
    public function getApiUser()
    {
        return $this->getParameter('apiUser');
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest
     */
    public function setApiUser($value)
    {
        return $this->setParameter('apiUser', $value);
    }

    /**
     * @return string
     */
    public function getApiPassword()
    {
        return $this->getParameter('apiPassword');
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest
     */
    public function setApiPassword($value)
    {
        return $this->setParameter('apiPassword', $value);
    }

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
     * @return $this
     */
    public function setMerchantAccount($value)
    {
        return $this->setParameter('merchantAccount', $value);
    }

    /**
     * @param array $parameters
     *
     * @return Request
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payment\Authorise\Request', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return mixed
     */
    public function listRecurringDetails(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Request', $parameters);
    }
}
