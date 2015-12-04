<?php
namespace Omnipay\AdyenApi\Tests\Mock;

/**
 * Class ApiRequestTestMock
 */
class ApiRequestTestMock extends AbstractApiRequestTestMock
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
     * @return $this
     */
    public function setMerchantAccount($value)
    {
        return $this->setParameter('merchantAccount', $value);
    }

    /**
     * @return string
     */
    public function getCustomParameter()
    {
        return $this->getParameter('customParameter');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCustomParameter($value)
    {
        return $this->setParameter('customParameter', $value);
    }
}
