<?php
namespace Omnipay\AdyenApi\Message;

use Guzzle\Http\Message\Response;
use Omnipay\Common\Message\AbstractRequest;

/**
 * Base Adyen Request
 *
 * Mandatory values :
 *  - apiUser
 *  - apiPassword
 */
abstract class AbstractApiRequest extends AbstractRequest
{
    /** MUST BE DEFINED BY EXTENDING CLASS */
    protected $liveEndpoint = null;
    protected $testEndpoint = null;

    /**
     * @return string the method name (ex : authorize, capture, ...)
     */
    abstract public function getMethodName();

    /**
     * @return string
     */
    public function getBaseEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
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
    public function getEndpoint()
    {
        $base = rtrim($this->getBaseEndpoint(), '/').'/';
        $method = ltrim($this->getMethodName(), '/');

        return $base.$method;
    }

    /**
     * @param mixed $data
     *
     * @return Response
     */
    public function getHttpResponse($data)
    {
        $request = $this->httpClient->post($this->getEndpoint());
        $request->setAuth($this->getApiUser(), $this->getApiPassword());
        $request->setBody(json_encode($data));
        $request->setHeader('Content-Type', 'application/json;charset=utf-8');

        return $request->send();
    }
}
