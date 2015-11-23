<?php
namespace Omnipay\AdyenApi\Tests\Mock;

use Omnipay\AdyenApi\Message\Payout\AbstractPayoutResponse;

/**
 * Class AbstractPayoutResponseTestMock
 */
class AbstractPayoutResponseTestMock extends AbstractPayoutResponse
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
