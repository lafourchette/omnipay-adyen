<?php
namespace Omnipay\AdyenApi;

use Omnipay\Common\AbstractGateway;
use Omnipay\AdyenApi\Message\Payment\Authorise\Request as AuthoriseRequest;
use Omnipay\AdyenApi\Message\Payment\Refund\Request as RefundRequest;
use Omnipay\AdyenApi\Message\Payment\CancelOrRefund\Request as CancelOrRefundRequest;
use Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Request as ListRecurringDetailsRequest;

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
     * @return AuthoriseRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payment\Authorise\Request', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payment\Refund\Request', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return CancelOrRefundRequest
     */
    public function cancelOrRefund(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Payment\CancelOrRefund\Request', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return ListRecurringDetailsRequest
     */
    public function listRecurringDetails(array $parameters = array())
    {
        return $this->createRequest('Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails\Request', $parameters);
    }
}
