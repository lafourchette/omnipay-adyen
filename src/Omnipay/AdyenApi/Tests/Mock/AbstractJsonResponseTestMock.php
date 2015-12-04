<?php
namespace Omnipay\AdyenApi\Tests\Mock;

use Omnipay\AdyenApi\Message\AbstractJsonResponse;

/**
 * Class AbstractJsonResponseTestMock
 */
class AbstractJsonResponseTestMock extends AbstractJsonResponse
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
