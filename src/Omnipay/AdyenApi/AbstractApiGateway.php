<?php
namespace Omnipay\AdyenApi;

use Omnipay\Common\AbstractGateway;

/**
 * Abstract Api Gateway
 * Provide merchantAccount, apiUser and apiPassword parameters helper
 */
abstract class AbstractApiGateway extends AbstractGateway
{
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
     * @return $this
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
     * @return $this
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
}
