<?php
namespace Omnipay\AdyenApi\Message\Recurring\ListRecurringDetails;

use Omnipay\AdyenApi\Message\AbstractJsonResponse;

/**
 * Adyen ListRecurringDetails Response.
 * @see https://docs.adyen.com/display/TD/listRecurringDetails+response
 */
class Response extends AbstractJsonResponse
{
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->hasData();
    }

    /**
     * @return string
     */
    public function getCreationDate()
    {
        return $this->getDataValue('creationDate');
    }

    /**
     * In some cases details is not provided (contract not already created on adyen side)
     * @return \stdClass[]|null
     */
    public function getDetails()
    {
        return $this->getDataValue('details');
    }

    /**
     * @param int $detailNumber
     *
     * @return \stdClass
     */
    public function getOneDetails($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber);
    }

    /**
     * @return string
     */
    public function getShopperReference()
    {
        return $this->getDataValue('shopperReference');
    }

    /**
     * @param int $detailNumber
     *
     * @return \stdClass
     */
    public function getRecurringDetail($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail');
    }

    /**
     * @param int $detailNumber
     *
     * @return \stdClass
     */
    public function getAdditionalData($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'additionalData');
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getCardBin($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'additionalData', 'cardBin');
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getAlias($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'alias');
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getAliasType($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'aliasType');
    }

    /**
     * @param int $detailNumber
     *
     * @return \stdClass
     */
    public function getCard($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'card');
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getExpiryMonth($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'card', 'expiryMonth');
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getExpiryYear($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'card', 'expiryYear');
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getHolderName($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'card', 'holderName');
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getNumber($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'card', 'number');
    }

    /**
     * @param int $detailNumber
     *
     * @return string[]
     */
    public function getContractTypes($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'contractTypes');
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getFirstPspReference($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'firstPspReference');
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getName($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'name');
    }

    /**
     * @param int $detailNumber
     *
     * @return string could be amex, mccorporate, visaclassic, ...
     */
    public function getPaymentMethodVariant($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'paymentMethodVariant');
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getRecurringDetailReference($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'recurringDetailReference');
    }

    /**
     * @param int $detailNumber
     *
     * @return string could be amex, mc, visa, ....
     */
    public function getVariant($detailNumber = 0)
    {
        return $this->getDataValue('details', $detailNumber, 'RecurringDetail', 'variant');
    }

    /**
     * @return bool
     */
    public function hasData()
    {
        return count($this->getData()) > 0;
    }

    /**
     * @return bool
     */
    public function hasDetails()
    {
        $details = $this->getDetails();

        return is_array($details) && count($details);
    }
}
