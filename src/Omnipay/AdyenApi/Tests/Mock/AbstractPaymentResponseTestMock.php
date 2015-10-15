<?php
namespace Omnipay\AdyenApi\Tests\Mock;

use Omnipay\AdyenApi\Message\Payment\AbstractPaymentResponse;

/**
 * Class AbstractPaymentResponseTestMock
 */
class AbstractPaymentResponseTestMock extends AbstractPaymentResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->getDataValue('success');
    }
}
