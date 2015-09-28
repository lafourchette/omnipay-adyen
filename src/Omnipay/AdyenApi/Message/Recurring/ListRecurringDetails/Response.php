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
        return $this->getData()->creationDate;
    }

    /**
     * In some cases details is not provided (contract not already created on adyen side)
     * @return \stdClass[]|null
     */
    public function getDetails()
    {
        if (!property_exists($this->getData(), 'details')) {
            return null;
        }

        return $this->getData()->details;
    }

    /**
     * @param int $detailNumber
     *
     * @return \stdClass
     */
    public function getOneDetails($detailNumber = 0)
    {
        $details = $this->getDetails();

        return $details[$detailNumber];
    }

    /**
     * @return string
     */
    public function getShopperReference()
    {
        return $this->getData()->shopperReference;
    }

    /**
     * @param int $detailNumber
     *
     * @return \stdClass
     */
    public function getRecurringDetail($detailNumber = 0)
    {
        return $this->getOneDetails($detailNumber)->RecurringDetail;
    }

    /**
     * @param int $detailNumber
     *
     * @return \stdClass
     */
    public function getAdditionalData($detailNumber = 0)
    {
        return $this->getRecurringDetail($detailNumber)->additionalData;
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getCardBin($detailNumber = 0)
    {
        return $this->getAdditionalData($detailNumber)->cardBin;
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getAlias($detailNumber = 0)
    {
        return $this->getRecurringDetail($detailNumber)->alias;
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getAliasType($detailNumber = 0)
    {
        return $this->getRecurringDetail($detailNumber)->aliasType;
    }

    /**
     * @param int $detailNumber
     *
     * @return \stdClass
     */
    public function getCard($detailNumber = 0)
    {
        return $this->getRecurringDetail($detailNumber)->card;
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getExpiryMonth($detailNumber = 0)
    {
        return $this->getCard($detailNumber)->expiryMonth;
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getExpiryYear($detailNumber = 0)
    {
        return $this->getCard($detailNumber)->expiryYear;
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getHolderName($detailNumber = 0)
    {
        return $this->getCard($detailNumber)->holderName;
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getNumber($detailNumber = 0)
    {
        return $this->getCard($detailNumber)->number;
    }

    /**
     * @param int $detailNumber
     *
     * @return string[]
     */
    public function getContractTypes($detailNumber = 0)
    {
        return $this->getRecurringDetail($detailNumber)->contractTypes;
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getFirstPspReference($detailNumber = 0)
    {
        return $this->getRecurringDetail($detailNumber)->firstPspReference;
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getName($detailNumber = 0)
    {
        return $this->getRecurringDetail($detailNumber)->name;
    }

    /**
     * @param int $detailNumber
     *
     * @return string could be amex, mccorporate, visaclassic, ...
     */
    public function getPaymentMethodVariant($detailNumber = 0)
    {
        return $this->getRecurringDetail($detailNumber)->paymentMethodVariant;
    }

    /**
     * @param int $detailNumber
     *
     * @return string
     */
    public function getRecurringDetailReference($detailNumber = 0)
    {
        return $this->getRecurringDetail($detailNumber)->recurringDetailReference;
    }

    /**
     * @param int $detailNumber
     *
     * @return string could be amex, mc, visa, ....
     */
    public function getVariant($detailNumber = 0)
    {
        return $this->getRecurringDetail($detailNumber)->variant;
    }

    /**
     * @return bool
     */
    public function hasData()
    {
        return count(get_object_vars($this->getData())) > 0;
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
