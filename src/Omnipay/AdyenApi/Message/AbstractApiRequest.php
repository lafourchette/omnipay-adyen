<?php
namespace Omnipay\AdyenApi\Message;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Message\Response;
use Omnipay\Common\Message\AbstractRequest;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

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

    private $handleUnprocessableEntity = false;

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

        try {
            $response = $request->send();
        } catch (ClientErrorResponseException $e) {
            // Adyen will return a 422 http code in case entity is invalid
            // but adyen still return some data (as errors for example)
            // Usefull for authorise call for example to catch invalid CVC or invalid card number
            if (
                $this->getHandleUnprocessableEntity()
                && $e->getResponse()->getStatusCode() == HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            ) {
                return $e->getResponse();
            }
            throw $e;
        }

        return $response;
    }

    /**
     * @return boolean
     */
    public function getHandleUnprocessableEntity()
    {
        return $this->handleUnprocessableEntity;
    }

    /**
     * @param boolean $handleUnprocessableEntity
     */
    public function setHandleUnprocessableEntity($handleUnprocessableEntity)
    {
        $this->handleUnprocessableEntity = $handleUnprocessableEntity == true;
    }
}
