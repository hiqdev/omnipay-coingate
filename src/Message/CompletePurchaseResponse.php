<?php

/**
 * CoinGate driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-coingate
 * @package   omnipay-coingate
 * @license   MIT
 * @copyright Copyright (c) 2019, HiQDev (http://hiqdev.com/)
 * @forked    https://developer.coingate.com/
 */
namespace Omnipay\CoinGate\Message;

/**
 * CoinGate Purchase Request
 */

class CompletePurchaseResponse extends PurchaseResponse
{
    /**
     * Get purchase status
     * @return boolean
     */
    public function isSuccessful()
    {
        return !$this->getMessage();
    }

    /**
     * @return boolean
     */
    public function isRedirect()
    {
        return false;
    }

    /**
     * Get order status
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->data['status'];
    }

    /**
     * Check paid status
     * @return boolean
     */
    public function isPaid()
    {
        return $this->getOrderStatus() === 'paid';
    }
}
