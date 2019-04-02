<?php

/**
 * CoinGate driver for the Omnipay v2 PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-coingate
 * @package   omnipay-coingate
 * @license   MIT
 * @forked    https://developer.coingate.com/
 */

namespace Omnipay\CoinGate;

use Omnipay\Common\AbstractGateway;
use Omnipay\CoinGate\Message\PurchaseRequest;
use Omnipay\CoinGate\Message\CompletePurchaseRequest;

class Gateway extends AbstractGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CoinGate';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
            'receiveCurrency' => 'EUR',
            'testMode' => false,
        );
    }

    /**
     * Get the merchant api key
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @param string $value merchant api key
     * @return self
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get the merchant currency
     * @return string merchant currency
     */
    public function getReceiveCurrency()
    {
        return $this->getParameter('receiveCurrency');
    }

    /**
     * @param string $value merchant currency
     * @return self
     */
    public function setReceiveCurrency($value)
    {
        return $this->setParameter('receiveCurrency', $value);
    }

    /**
     * @param array $parameters
     * @return PurchaseRequest|\Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     * @return CompletePurchaseRequest|\Omnipay\Common\Message\AbstractRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }
}
