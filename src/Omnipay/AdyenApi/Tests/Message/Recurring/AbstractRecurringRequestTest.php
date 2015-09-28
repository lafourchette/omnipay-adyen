<?php
namespace Omnipay\AdyenApi\Tests\Message\Recurring;

use Omnipay\AdyenApi\Message\Recurring\AbstractRecurringRequest;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class AbstractRecurringRequestTest
 */
class AbstractRecurringRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var AbstractRecurringRequest|ObjectProphecy */
    private $abstractPaymentRequest;

    /**
     * @{inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->httpClient = $this->prophesize('Guzzle\Http\ClientInterface');
        $this->httpRequest = $this->prophesize('Symfony\Component\HttpFoundation\Request');
        $this->abstractPaymentRequest = new AbstractRecurringRequestTest_Mock(
            $this->httpClient->reveal(),
            $this->httpRequest->reveal()
        );
        $this->abstractPaymentRequest->initialize();
    }

    /**
     */
    public function testBaseEndpoint()
    {
        $this->abstractPaymentRequest->setTestMode(false);
        $this->assertSame(
            'https://pal-live.adyen.com/pal/servlet/Recurring/v12/',
            $this->abstractPaymentRequest->getBaseEndpoint()
        );

        $this->abstractPaymentRequest->setTestMode(true);
        $this->assertSame(
            'https://pal-test.adyen.com/pal/servlet/Recurring/v12/',
            $this->abstractPaymentRequest->getBaseEndpoint()
        );
    }
}


/**
 * Class AbstractRecurringRequestTest_Mock
 */
class AbstractRecurringRequestTest_Mock extends AbstractRecurringRequest
{
    /**
     * {@inheritdoc}
     */
    public function getMethodName()
    {
        return 'MOCK_METHOD';
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
    }
}
